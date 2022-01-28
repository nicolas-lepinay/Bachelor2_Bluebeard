<?php

use App\Services\Controller;

Class Admin extends Controller
{
    public function index()
    {
        // Redirection si l'utilisateur n'est pas admin :
        if(!isset($this->user) || $this->user->role < 1) {
            header("Location: " . ROOT . "home");
            die;
        }

        $user = $this->loadModel("User");
        $allUsers = $user->findAll();

        $product = $this->loadModel("Product");
        $products = $product->findAll();

        $data['page_title'] = "Admin";
        $data['user'] = $this->user;
        $data['collections'] = $this->collections;
        $data['cart'] = $this->cart;
        $data['wishlist'] = $this->wishlist;

        $data['allUsers'] = $allUsers;
        $data['products'] = $products;

        $this->view('admin', $data);
    }

    public function modifUser()
    {
        $user = $this->loadModel("User");

        // Check login :
        if(isset($_SESSION['user_uuid'])) {
            $user_data = $user->findOne('uuid', $_SESSION['user_uuid']);
            if(is_object($user_data)) {
                $data['user'] = $user_data;
            }
        }        
        $allUsers = $user->findAll();

        $url = $_SERVER['REQUEST_URI']; 
        $components = parse_url($url);
        parse_str($components['query'], $results);
        $user->admin_user_modif($results['uuid'], $_POST['firstName'], $_POST['lastName'], $_POST['username']);
        header('Location: ' . $_SERVER['HTTP_REFERER']);

        $data['page_title'] = "Admin";
        $data['allUsers'] = $allUsers;
        if($data['user']->role == 1){
            $this->view('admin', $data);
        }else{
            header('Location: index');
            exit();
        }
    }

    public function deleteUser()
    {
        $user = $this->loadModel("User");

        // Check login :
        if(isset($_SESSION['user_uuid'])) {
            $user_data = $user->findOne('uuid', $_SESSION['user_uuid']);
            if(is_object($user_data)) {
                $data['user'] = $user_data;
            }
        }
        $url = $_SERVER['REQUEST_URI']; 
        $components = parse_url($url);
        parse_str($components['query'], $results);
        $user->admin_user_delete($results['uuid']);
        $allUsers = $user->findAll();
        header('Location: ' . $_SERVER['HTTP_REFERER']);

        $data['page_title'] = "Admin";
        $data['allUsers'] = $allUsers;
        if($data['user']->role == 1){
            $this->view('admin', $data);
        }else{
            header('Location: index');
            exit();
        }
    }
    public function deleteCollection()
    {
        $user = $this->loadModel("User");

        // Check login :
        if(isset($_SESSION['user_uuid'])) {
            $user_data = $user->findOne('uuid', $_SESSION['user_uuid']);
            if(is_object($user_data)) {
                $data['user'] = $user_data;
            }
        }        
        $allUsers = $user->findAll();

        $collection = $this->loadModel("Collection");
        $collections = $collection->findAll();

        $url = $_SERVER['REQUEST_URI']; 
        $components = parse_url($url);
        parse_str($components['query'], $results);
        $collection->admin_collection_delete($results['id']);
        header('Location: ' . $_SERVER['HTTP_REFERER']);

        $data['page_title'] = "Admin";
        $data['allUsers'] = $allUsers;
        $data['collections'] = $collections;
        if($data['user']->role == 1){
            $this->view('admin', $data);
        }else{
            header('Location: index');
            exit();
        }
    }
    public function modifCollection()
    {
        $user = $this->loadModel("User");

        // Check login :
        if(isset($_SESSION['user_uuid'])) {
            $user_data = $user->findOne('uuid', $_SESSION['user_uuid']);
            if(is_object($user_data)) {
                $data['user'] = $user_data;
            }
        }        
        $allUsers = $user->findAll();

        $collection = $this->loadModel("Collection");
        $collections = $collection->findAll();

        $url = $_SERVER['REQUEST_URI']; 
        $components = parse_url($url);
        parse_str($components['query'], $results);
        $slug = $collection->slugify($_POST['name']);
        $collection->admin_collection_modif($results['id'], $_POST['name'], $_POST['image'], $slug);
        header('Location: ' . $_SERVER['HTTP_REFERER']);

        $data['page_title'] = "Admin";
        $data['allUsers'] = $allUsers;
        $data['collections'] = $collections;
        if($data['user']->role == 1){
            $this->view('admin', $data);
        }else{
            header('Location: index');
            exit();
        }
    }
    public function createCollection()
    {
        $user = $this->loadModel("User");

        // Check login :
        if(isset($_SESSION['user_uuid'])) {
            $user_data = $user->findOne('uuid', $_SESSION['user_uuid']);
            if(is_object($user_data)) {
                $data['user'] = $user_data;
            }
        }        
        $allUsers = $user->findAll();

        $collection = $this->loadModel("Collection");
        $collections = $collection->findAll();

        $url = $_SERVER['REQUEST_URI']; 
        $components = parse_url($url);
        parse_str($components['query'], $results);
        $slug = $collection->slugify($_POST['name']);
        $collection->admin_collection_create($_POST['name'], $slug);
        header('Location: ' . $_SERVER['HTTP_REFERER']);

        $data['page_title'] = "Admin";
        $data['allUsers'] = $allUsers;
        $data['collections'] = $collections;
        if($data['user']->role == 1){
            $this->view('admin', $data);
        }else{
            header('Location: index');
            exit();
        }
    }
    public function deleteProduct()
    {
        $user = $this->loadModel("User");

        // Check login :
        if(isset($_SESSION['user_uuid'])) {
            $user_data = $user->findOne('uuid', $_SESSION['user_uuid']);
            if(is_object($user_data)) {
                $data['user'] = $user_data;
            }
        }        
        $allUsers = $user->findAll();

        $product = $this->loadModel("Product");
        $products = $product->findAll();

        $url = $_SERVER['REQUEST_URI']; 
        $components = parse_url($url);
        parse_str($components['query'], $results);
        $product->admin_product_delete($results['id']);
        header('Location: ' . $_SERVER['HTTP_REFERER']);

        $data['page_title'] = "Admin";
        $data['allUsers'] = $allUsers;
        $data['products'] = $products;
        if($data['user']->role == 1){
            $this->view('admin', $data);
        }else{
            header('Location: index');
            exit();
        }
    }
    public function modifProduct()
    {
        $user = $this->loadModel("User");

        // Check login :
        if(isset($_SESSION['user_uuid'])) {
            $user_data = $user->findOne('uuid', $_SESSION['user_uuid']);
            if(is_object($user_data)) {
                $data['user'] = $user_data;
            }
        }        
        $allUsers = $user->findAll();

        $product = $this->loadModel("Product");
        $products = $product->findAll();

        $url = $_SERVER['REQUEST_URI']; 
        $components = parse_url($url);
        parse_str($components['query'], $results);
        $slug = $product->slugify($_POST['title']);
        $product->admin_product_modif($results['id'], $_POST['title'], $_POST['author'], $_POST['description'], $_POST['price'], $_POST['stock'], $_POST['weight'], $_POST['collectionId'], $slug);
        header('Location: ' . $_SERVER['HTTP_REFERER']);

        $data['page_title'] = "Admin";
        $data['allUsers'] = $allUsers;
        $data['products'] = $products;
        if($data['user']->role == 1){
            $this->view('admin', $data);
        }else{
            header('Location: index');
            exit();
        }
    }
    public function collectionPage()
    {
        // Redirection si l'utilisateur n'est pas admin :
        if(!isset($this->user) || $this->user->role < 1) {
            header("Location: " . ROOT . "home");
            die;
        }

        $user = $this->loadModel("User");
        $allUsers = $user->findAll();

        $data['page_title'] = "Admin";
        $data['user'] = $this->user;
        $data['collections'] = $this->collections;
        $data['cart'] = $this->cart;
        $data['wishlist'] = $this->wishlist;
        $data['allUsers'] = $allUsers;

        $this->view('admin_collections', $data);
    }
    public function productPage()
    {
        // Redirection si l'utilisateur n'est pas admin :
        if(!isset($this->user) || $this->user->role < 1) {
            header("Location: " . ROOT . "home");
            die;
        }

        $user = $this->loadModel("User");
        $allUsers = $user->findAll();

        $product = $this->loadModel("Product");
        $products = $product->findAll();

        $data['page_title'] = "Admin";
        $data['user'] = $this->user;
        $data['collections'] = $this->collections;
        $data['cart'] = $this->cart;
        $data['wishlist'] = $this->wishlist;

        $data['allUsers'] = $allUsers;
        $data['products'] = $products;

        $this->view('admin_products', $data);
    }
    public function createProduct()
    {
        $user = $this->loadModel("User");

        // Check login :
        if(isset($_SESSION['user_uuid'])) {
            $user_data = $user->findOne('uuid', $_SESSION['user_uuid']);
            if(is_object($user_data)) {
                $data['user'] = $user_data;
            }
        }        
        $allUsers = $user->findAll();

        $product = $this->loadModel("Product");
        $products = $product->findAll(); 

        $url = $_SERVER['REQUEST_URI']; 
        $components = parse_url($url);
        parse_str($components['query'], $results);
        $slug = $product->slugify($_POST['title']);
        $product->admin_product_create($_POST['title'], $_POST['author'], $_POST['description'], $_POST['price'], $_POST['stock'], $_POST['weight'], $_POST['collectionId'], $slug);
        header('Location: ' . $_SERVER['HTTP_REFERER']);

        $data['page_title'] = "Admin";
        $data['allUsers'] = $allUsers;
        $data['products'] = $products;
        if($data['user']->role == 1){
            $this->view('admin', $data);
        }else{
            header('Location: index');
            exit();
        }
    }
}