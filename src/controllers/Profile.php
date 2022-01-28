<?php

use App\Services\Controller;

Class Profile extends Controller
{
    protected $page_title = "Mon compte";

    public function index($option)
    {
        // Redirection si non-connecté :
        if(!isset($this->user)) {
            header("Location: " . ROOT . "home");
            die;
        }
        $data['collections'] = $this->collections;
        $data['user'] = $this->user;
        $data['cart'] = $this->cart;
        $data['wishlist'] = $this->wishlist;

        switch($option) {
            case "mes-commandes":
                $this->page_title = "Mes commandes";
                $data['orders'] = $this->displayOrders();
                break;
            case "mes-favoris":
                $this->page_title = "Mes favoris";
                $data['wishlist'] = $this->displayWishlist();
                break;
            case "mes-adresses":
                $this->page_title = "Mes adresses";
                // $data['addresses'] = $this->displayAddresses();
                break;
            case "parametres-du-compte":
                $this->page_title = "Paramètres du compte";
                break;
        }
        $data['page_title'] = $this->page_title;

        // show($data['orders']);
        // die;
        $this->view('profile', $data);
    }

    public function displayOrders()
    {
        $product_model = $this->loadModel('Product');
        $order_model = $this->loadModel('Order');

        $orders = $order_model->find('user_id', $this->user->id_user);
        if(!is_array($orders)) {
            return array();
        }
        foreach($orders as $order) {
            if(is_object($order)) {
                $query = 'SELECT * FROM order_detail WHERE order_id = :order_id';
                $param['order_id'] = $order->id_order;
                $order_detail = $order_model->read($query, $param); // array d'objets
                if(is_array($order_detail)) {
                    foreach($order_detail as $detail) {
                        $product_data = $product_model->findOne('id_product', $detail->product_id);
                        $detail->title = $product_data->title;
                        $detail->author = $product_data->author;
                        $detail->image = $product_data->image;
                        $detail->slug = $product_data->slug;
                        $detail->total = $order->total;
                        $detail->createdAt = $order->createdAt;
                    }
                    $data[$order->id_order] = $order_detail;
                }
            }
        }
        return $data;
    }

    public function displayWishlist()
    {
        $result = array();

        if(isset($this->wishlist)) {
            $product = $this->loadModel('Product');
            foreach($this->wishlist as $row) {
                $product_data = $product->findOne('id_product', $row->product_id);
                if(is_object($product_data)) {
                    array_push($result, $product_data);
                }
            }
        }
        return array_reverse($result); // Pour les avoir du plus récent au plus ancien
    }





    public function displayAddresses()
    {
        $address = $this->loadModel('Address');
        $addresses = $address->find('user_id', $this->user->id_user);
        if(is_array($addresses)) {
            return $addresses;
        }
        return array();
    }

}