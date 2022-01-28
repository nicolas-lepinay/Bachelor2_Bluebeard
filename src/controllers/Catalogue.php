<?php

use App\Services\Controller;

Class Catalogue extends Controller
{
    protected $page_title = "Collections";

    /*
    * Accéder au catalogue (principal ou celui d'une collection, selon $slug) :
    */
    public function index($slug)
    {
        $data['collections'] = $this->collections;
        $data['user'] = $this->user;
        $data['cart'] = $this->cart;
        $data['wishlist'] = $this->wishlist;

        $product = $this->loadModel("Product");

        if(!isset($slug) || $slug == '') {
            $products = $product->findAll(); // Si aucun slug (pas de collection particulière), je charge tous les produits
        } else {
            $collection = $this->loadModel("Collection");
            $collection_data = $collection->findOne('slug', $slug);
            // Si le slug ne renvoit aucune collection --> page 404 :
            if(!is_object($collection_data)) {
                $data['page_title'] = "Page introuvable";
                $this->view('404', $data);
                die;
            }
            $products = $product->find('collection_id', $collection_data->id_collection);
            $this->page_title = $collection_data->name;
        }

        $data['page_title'] = $this->page_title;
        $data['products'] = $products;

        $this->view('catalogue', $data);
    }

    /*
    * Accéder au catalogue d'un auteur (selon $slug) :
    */
    public function author($slug)
    {
        $data['collections'] = $this->collections;
        $data['user'] = $this->user;
        $data['cart'] = $this->cart;

        $product = $this->loadModel("Product");

        if(!isset($slug) || $slug == '') {
            header("Location: " . ROOT . "catalogue"); // Redirection vers la page Catalogue
            die;     
        } else {
            $param['author'] = '%' . $slug;
            $query = "SELECT * FROM product WHERE author LIKE :author";
            $products = $product->read($query, $param);
            // Si la requête ne renvoit aucun livre :
            if(!is_array($products)) {
                header("Location: " . ROOT . "catalogue"); // Redirection vers la page Catalogue
                die;   
            }
            $this->page_title = $products[0]->author;
        }
        $data['page_title'] = $this->page_title;
        $data['products'] = $products;

        $this->view('catalogue', $data);
    }
    
    /*
    * Accéder au résultat d'une recherche :
    */
    public function search()
    {
        $data['page_title'] = 'Votre recherche';
        $data['collections'] = $this->collections;
        $data['user'] = $this->user;
        $data['cart'] = $this->cart;
        $data['products'] = array();

        if($_SERVER['REQUEST_METHOD'] == "GET") {
            $product = $this->loadModel("Product");

            // Je split la recherche par espace ou tiret :
            $keywords = preg_split('/[\s-]/', $_GET['keywords']);
            $results = array();
            foreach($keywords as $keyword) {
                $param['keyword'] = '%' . $keyword . '%';
                $query = "SELECT * FROM product WHERE title LIKE :keyword OR author LIKE :keyword";
                $products = $product->read($query, $param);
                if(is_array($products)) {
                    array_push($results, $products);
                }
            }
            $result = array();
            foreach($results as $array) {
                foreach($array as $object) {
                    array_push($result, $object);
                }
            }

            if(!empty($result)) {
                $result = array_map('json_encode', $result);
                $result = array_unique($result);
                $result = array_map('json_decode', $result);
                $data['products'] = $result;
            }
            
            $this->view('catalogue', $data);
        }
    }


}