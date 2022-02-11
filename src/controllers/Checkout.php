<?php

use App\Services\Controller;

include_once 'Auth.php';

Class Checkout extends Controller
{
    protected $page_title = "BLUEBEARD | Commander";

    public function index()
    {
        // Redirection si le panier est vide :
        if(!isset($this->cart)) {
            header("Location: " . ROOT . "cart");
            die;
        }

        // Récupération des adresses si l'utilisateur est connecté :
        if(isset($this->user)) {
            $address = $this->loadModel('Address');
            $addresses = $address->find('user_id', $this->user->id_user);
            $data['addresses'] = $addresses;
        }

        $data['page_title'] = $this->page_title;
        $data['collections'] = $this->collections;
        $data['user'] = $this->user;
        $data['cart'] = $this->cart;
        $data['wishlist'] = $this->wishlist;

        $this->view('checkout', $data);
    }


    /*
    * Confirmer la commande (envoi des données de facturation) :
    */
    public function confirm()
    {        
        if($_SERVER['REQUEST_METHOD'] == "POST") {

            // * (1) Si l'utilisateur n'est pas connecté, on lui crée un compte (et une adresse) :
            if(!isset($this->user)) {
                $auth = new Auth();
                $user = $auth->signupCheckout($_POST);

                if(is_object($user)) {
                    $this->user = $user;
                } else {
                    // Ré-affichage de la page avec les erreurs :
                    header("Location: " . ROOT . "checkout");
                    die;
                }
            }
            // * (2) On ajoute l'adresse de facturation dans la base de données (ou pas si elle existe déjà):
            $billing_address_id = $this->processAddress($_POST, 'billing');
            
            // * (3) On récupère l'adresse de livraison :
            if($_POST['shipping-address'] == 'billing-address') {
                $shipping_address_id = $billing_address_id;
            } else if ($_POST['shipping-address'] == 'new-address') {
                $shipping_address_id = $this->processAddress($_POST, 'shipping');
            } else {
                $shipping_address_id = $_POST['shipping-address'];
            }
            // * (4) On crée la commande dans la base de données :
            $order_id = $this->createOrder($billing_address_id, $shipping_address_id);

            // * (5) On ajoute les données du paiement dans la base de données :
            if(!isset($_POST['paypal-raw-data']) || $_POST['paypal-raw-data'] == '') {
                $this->error = "Le paiement a échoué. Vous n'avez pas été débité.";
                $_SESSION['error'] = $this->error;
                header("Location: " . ROOT . "checkout");
                die;
            }
            $paypal_data = $_POST['paypal-raw-data'];
            $this->processPayment($paypal_data, $order_id);
        }
        
        // Renvoie vers la page d'accueil :
        unset($_SESSION['cart']);
        header("Location: " . ROOT . "home/success");
        die;
    }

    /*
    * Traiter l'adresse :
    * @return l'id de l'adresse.
    */
    private function processAddress($POST, $param = 'billing')
    {
        $string = $param == 'billing' ? "facturation" : "livraison"; // "Facturation" ou "Livraison"

        $data['user_id']    = $this->user->id_user;
        $data['first_name'] = trim($POST[$param . '-first_name']);
        $data['last_name']  = trim($POST[$param . '-last_name']);
        $data['street']     = trim($POST[$param . '-street']);
        $data['zipcode']    = trim($POST[$param . '-zipcode']);
        $data['country']    = trim($POST[$param . '-country'] ?? 'France');

        // Validation du prénom :
        if(empty($data['first_name']) || !preg_match("/^[A-zÀ-ú\s-]*$/", $data['first_name'])) {
            $this->error = "Veuillez entrer un prénom valide pour l'adresse de ". $string . ". <br>";
        }

        // Validation du nom :
        if(empty($data['last_name']) || !preg_match("/^[A-zÀ-ú\s-]*$/", $data['last_name'])) {
            $this->error = "Veuillez entrer un nom valide pour l'adresse de ". $string . ". <br>";
        }

        // Validation de la rue :
        if(strlen($data['street']) < 6) {
            $this->error = "L'adresse de ". $string . " doit contenir au moins 6 caractères. <br>";
        }

        // Validation du code postal :
        if(empty($data['zipcode']) || !preg_match("/^\d{5}$/", $data['zipcode'])) {
            $this->error = "Veuillez entrer un code postal valide pour l'adresse de ". $string . ". <br>";
        }
        
        // S'il n'y aucune erreur :
        if(!isset($this->error)) {
            $address = $this->loadModel('Address');
            // Je cherche l'adresse rentrée :
            $query = "SELECT * FROM address WHERE user_id = :user_id AND first_name = :first_name AND last_name = :last_name AND street = :street AND zipcode = :zipcode AND country = :country";
            $address_data = $address->read($query, $data);

            // Si $address_data est un array, alors l'adresse existe déjà dans la base de données :
            if(is_array($address_data)) {
                return $address_data[0]->id_address; // Je return l'id de l'adresse de facturation
            }
            // Sinon, j''ajoute l'adresse dans la base de données :
            $data['uuid']   = get_random_string_max(60);
            $data['title']  = trim($POST['billing-title'] ?? 'Mon adresse');

            $query = "INSERT INTO address (uuid, user_id, title, first_name, last_name, street, zipcode, country) VALUES (:uuid, :user_id, :title, :first_name, :last_name, :street, :zipcode, :country)";
            $address_result = $address->write($query, $data);

            if($address_result) {
                unset($address_data);
                $address_data = $address->findOne('uuid', $data['uuid']);
                return $address_data->id_address; // Je return l'id de l'adresse de facturation
            }
        }

        $_SESSION['error'] = $this->error;
        header("Location: " . ROOT . "checkout");
        die;
    }

    /*
    * Créer la commande dans la base de données :
    * @ return l'id de la commande créée
    */
    private function createOrder($billing_address_id, $shipping_address_id)
    {
        // * (1) Calcul du montant total de la commande :
        $total = 0;
        foreach($_SESSION['cart'] as $product) { 
            $total += (float)$product->price * $product->quantity;
        }

        // * (2) Récupération des données de la commande :
        $data['uuid']                = get_random_string_max(60);
        $data['user_id']             = intval($this->user->id_user);
        $data['total']               = $total;
        $data['billing_address_id']  = intval($billing_address_id);
        $data['shipping_address_id'] = intval($shipping_address_id);
        // $data['createdAt']           = strtotime(date("Y-m-d H:i:s"));
        // $data['status']              = 'pending';


        // * (3) Ajout de la commande dans la table ORDERS :
        $order = $this->loadModel('Order');

        $query = "INSERT INTO orders (uuid, user_id, total, billing_address_id, shipping_address_id) VALUES (:uuid, :user_id, :total, :billing_address_id, :shipping_address_id)";
        $result = $order->write($query, $data);

        // Si l'insertion échoue :
        if(!$result) {
            $this->error = "Une erreur est survenue lors de la création de votre commande. <br>";
            $_SESSION['error'] = $this->error;
            header("Location: " . ROOT . "checkout");
            die;
        }

        // * (4) Ajout des produits dans la table ORDER_DETAIL :
        $order_data = $order->findOne('uuid', $data['uuid']);
        $order_id = $order_data->id_order;

        foreach($_SESSION['cart'] as $product) { 
            unset($data); // !important
            $data['order_id'] = $order_id;
            $data['product_id'] = $product->id_product;
            $data['quantity'] = $product->quantity;
            $data['price'] = $product->price;

            $query = "INSERT INTO order_detail (order_id, product_id, quantity, price) VALUES (:order_id, :product_id, :quantity, :price)";
            $result = $order->write($query, $data);

            // Si l'insertion échoue :
            if(!$result) {
                $this->error = "Une erreur est survenue lors de la création des détails de votre commande. <br>";
                $_SESSION['error'] = $this->error;
                header("Location: " . ROOT . "checkout");
                die;
            }
        }
        // * (5) Mise à jour du stock des produits :
        $product_model = $this->loadModel('Product');
        foreach($_SESSION['cart'] as $product) { 
            unset($data);

            $product_data = $product_model->findOne('id_product', $product->id_product);
            $old_stock = (int)$product_data->stock;
            $new_stock = $old_stock - (int)$product->quantity;

            $data['stock'] = $new_stock;
            $data['id_product'] = $product->id_product;
            $query = "UPDATE product SET stock = :stock WHERE id_product = :id_product";
            $result = $order->write($query, $data);
        }
        return $order_id;
    }

    /*
    * Ajoute le paiement dans la base de données :
    * @return true
    */
    private function processPayment($paypal_data, $order_id)
    {
        $paypal_data = json_decode(html_entity_decode($paypal_data), true); // array

        $payment = $this->loadModel('Payment');
        $query = "INSERT INTO payment (id_payment, order_id, payer_id, payer_name, email_address, status, createdAt, link) VALUES (:id_payment, :order_id, :payer_id, :payer_name, :email_address, :status, :createdAt, :link)";
        
        $data['id_payment'] = $paypal_data['id'];
        $data['order_id'] = $order_id;
        $data['payer_id'] = $paypal_data['payer']['payer_id'];
        $data['payer_name'] = $paypal_data['payer']['name']['given_name'] . ' ' . $paypal_data['payer']['name']['surname'];
        $data['email_address'] = $paypal_data['payer']['email_address'];
        $data['status'] = $paypal_data['status'];
        $data['createdAt'] = $paypal_data['create_time'];
        $data['link'] = $paypal_data['links'][0]['href'];

        $payment_result = $payment->write($query, $data);

        if($payment_result) {
            $order = $this->loadModel('Order');
            $order_result = $order->findAndUpdate('status', 'confirmed', 'id_order', $order_id); // Je mets à jour le statut de la commande
            if($order_result) {
                return true;
            }
        }

        $this->error = "Une erreur est survenue lors de l'enregistrement du paiement.";
        $_SESSION['error'] = $this->error;
        header("Location: " . ROOT . "checkout");
        die;
    }
}