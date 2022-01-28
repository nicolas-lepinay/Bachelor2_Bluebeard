<?php

namespace App\Services;

Class Controller
{
    protected $model_namespace = "\\App\Models\\";
    protected $user;
    protected $collections;
    protected $cart;
    protected $wishlist;

    public function __construct()
    {
        // Récupère l'utilisateur (s'il est connecté) :
        $user = $this->loadModel("User");
        if(isset($_SESSION['user_uuid'])) {
            $data = $user->findOne('uuid', $_SESSION['user_uuid']);
            if(is_object($data)) {
                $this->user = $data;
            }
        }
        // Récupère la liste des collections :
        $collection = $this->loadModel("Collection");
        $this->collections = $collection->findAll();

        // Récupère le panier (s'il existe) :
        if(isset($_SESSION['cart'])) {
            $this->cart = $_SESSION['cart'];
        }

        // Récupère la wishlist de l'utilisateur (s'il est connecté):
        if(isset($this->user)) {
            $wishlist_data = $user->findWishlist('user_id', $this->user->id_user);
            if(is_array($wishlist_data)) {
                $this->wishlist = $wishlist_data;
            }
        }
    }

    public function view($path, $data = [])
    {
        if(file_exists("../src/views/" . THEME . strtolower($path) . ".php")) {
            include "../src/views/" . THEME . strtolower($path) . ".php";
        } 
        else {
            include "../src/views/" . THEME . "404.php";
        }
    }

    public function loadModel($model)
    {
        if(file_exists("../src/models/" . ucfirst($model) . ".php")) {
            include_once "../src/models/" . ucfirst($model) . ".php";
            $full_model = $this->model_namespace . ucfirst($model);
            return new $full_model;
        }
        return false;
    }

}