<?php

use App\Services\Controller;

Class Cart extends Controller
{
    protected $page_title = "BLUEBEARD | Mon panier";
    
    /*
    * Afficher la page "Mon panier" :
    */
    public function index()
    {
        $data['page_title'] = $this->page_title;
        $data['collections'] = $this->collections;
        $data['user'] = $this->user;
        $data['cart'] = $this->cart;
        $data['wishlist'] = $this->wishlist;

        $this->view('cart', $data);
    }

    /*
    * Ajouter un produit au panier :
    */
    public function add($redirect = "home")
    {
        if(!isset($redirect) || $redirect == '') {
            $redirect = 'home';
        }

        if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['id_product'])) {
            $id_product = $_POST['id_product'];
            $qty = $_POST['qty'] ?? 1;

            // Charge le model Cart :
            $cart = $this->loadModel("Cart");

            // Si l'utilisateur est connecté :
            if(isset($this->user)) {
                $user_cart = $cart->find('user_id', $this->user->id_user); // Je récupère le(s) panier(s) de l'utilisateur (s'il en a un)
            }

            // Récupère le produit dont l'id est $id :
            $product = $this->loadModel("Product");
            $product_data = $product->findOne('id_product', $id_product);
            
            // Si $id_product renvoit bien un produit (et que le produit est disponible en stock) :
            if(is_object($product_data) && $product_data->stock > 0) {
                // Si le produit existe déjà dans le panier :
                if(isset($_SESSION['cart'][$id_product])) {
                    // Si la quantité du panier est inférieure au stock disponible du produit :
                    if($_SESSION['cart'][$id_product]->quantity < $product_data->stock) {
                        $_SESSION['cart'][$id_product]->quantity += $qty; // J'incrémente la quantité du produit
                    }
                }
                else {
                    // Je crée un object $item :
                    $item = (object) ['id_product' => $id_product, 
                                    'title' => $product_data->title, 
                                    'author' => $product_data->author, 
                                    'price' => $product_data->price, 
                                    'image' => $product_data->image, 
                                    'stock' => $product_data->stock,
                                    'slug' => $product_data->slug,
                                    'quantity' => $qty];
                    // Je push l'objet $item dans l'array $_SESSION['cart] avec l'id comme clé de l'array :
                    $_SESSION['cart'][$id_product] = $item;
                }
            }
        }
        header("Location: " . ROOT . $redirect); // Redirection vers la page Accueil
        die;
    }

    /*
    * Supprimer un produit du panier :
    */
    public function remove($id_product)
    {
        // Si le produit existe bien dans le panier, je le supprime :
        if(isset($_SESSION['cart'][$id_product])) {
            unset($_SESSION['cart'][$id_product]);
        }

        // Si le panier est désormais vide, je le unset :
        if(empty($_SESSION['cart'])) {
            unset($_SESSION['cart']);
        }
        header("Location: " . ROOT . "cart"); // Redirection vers la page Panier
        die; 
    }

    /*
    * Mettre à jour le panier :
    */
    public function update()
    {
        if($_SERVER['REQUEST_METHOD'] == "POST") {
            /* $_POST est de la forme :
            *
            * array:
            *    '{id-du-livre}' => 'quantité-du-livre'
            *    '{id-du-livre}' => 'quantité-du-livre'
            *     etc.
            */

            foreach($_SESSION['cart'] as $product) {
                foreach($_POST as $id => $qty) {
                    if($product->id_product == $id) {
                        $product->quantity = $qty;
                    }
                }
            }
            header("Location: " . ROOT . "cart"); // Redirection vers la page Panier
            die; 
        }
    }
}