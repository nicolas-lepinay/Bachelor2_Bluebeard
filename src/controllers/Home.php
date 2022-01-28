<?php

use App\Services\Controller;

Class Home extends Controller
{
    protected $page_title = "BLUEBEARD | Accueil";

    public function index($checkout_message)
    {
        // Récupère les produits :
        $product = $this->loadModel("Product");
        $products = $product->findAll();

        $data['page_title'] = $this->page_title;
        $data['collections'] = $this->collections;
        $data['user'] = $this->user;
        $data['cart'] = $this->cart;
        $data['wishlist'] = $this->wishlist;
        $data['products'] = $products;

        // Après avoir passé une commande :
        if(isset($checkout_message) && $checkout_message != '') {
            $data['checkout_message'] = $checkout_message;
        }

        // show($data['wishlist']);
        // die;
        $this->view('index', $data);
    }
}