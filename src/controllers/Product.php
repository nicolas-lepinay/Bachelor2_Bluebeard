<?php

use App\Services\Controller;

/*
* Controller pour la page Product (la page de chaque produit)
*/

Class Product extends Controller
{
    /*
    * Affiche la page d'un produit :
    */
    public function index($slug)
    {
        $data['collections'] = $this->collections;
        $data['user'] = $this->user;
        $data['cart'] = $this->cart;
        $data['wishlist'] = $this->wishlist;

        // Récupère le produit dont le slug est $slug :
        $product = $this->loadModel("Product");
        $product_data = $product->findOne('slug', $slug);

        // Si le slug ne renvoit aucun produit --> page 404 :
        if(!is_object($product_data)) {
            $data['page_title'] = "Page introuvable";
            $this->view('404', $data);
            die;
        }

        $feedback = $product->findFeedback('product_id', $product_data->id_product);

        $user = $this->loadModel("User");
        if(!empty($feedback)) {
            foreach($feedback as $review) {
                $user_data = $user->findOne('id_user', $review->user_id);
                $review->username = $user_data->username;
            }
        }

        // Récupère les produits de la même collection que $product_data :
        $collection = $this->loadModel("Collection");
        $collection_data = $collection->findOne('id_collection', $product_data->collection_id);
        $products = $product->find('collection_id', $collection_data->id_collection);

        $data['page_title'] = $product_data->title . " | " . $product_data->author;
        $data['product'] = $product_data;
        $data['feedback'] = $feedback;
        $data['products'] = $products;

        $this->view('product', $data);
    }

    /*
    * Ajoute ou supprime un produit de la wishlist dans la base de données :
    */
    public function wishlist($product_id)
    {
        if(isset($product_id) && $product_id != '') {
            // Si l'utilisateur est connecté :
            if(isset($this->user)) {
                $product = $this->loadModel("Product");

                $query = "SELECT * FROM wishlist WHERE user_id = :user_id AND product_id = :product_id";
                $data['user_id'] = $this->user->id_user;
                $data['product_id'] = $product_id;

                $product_data = $product->read($query, $data);
                // Si le produit est déjà dans la table wishlist, on le supprime :
                if(is_array($product_data)) {
                    $query = "DELETE FROM wishlist WHERE user_id = :user_id AND product_id = :product_id";
                    $deletion = $product->write($query, $data);
                    echo "Le produit #" . $product_id . " a été supprimé de vos favoris";
                    die;
                // Sinon, on l'ajoute :
                } else {
                    $query = "INSERT INTO wishlist (user_id, product_id) VALUES (:user_id, :product_id)";
                    $addition = $product->write($query, $data);
                    echo "Le produit #" . $product_id . " a été ajouté à vos favoris";
                    die;
                }
            }
        }
        echo "Vous devez être connecté pour ajouter un produit à vos favoris.";
    }

    /*
    * Laisser un avis sur le produit :
    */
    public function feedback($redirect = 'home') 
    {
        if($_SERVER['REQUEST_METHOD'] == "POST") {
            if(isset($this->user)) {
                $product = $this->loadModel("Product");

                $data['user_id'] = $this->user->id_user;
                $data['product_id'] = $_POST['product_id'];
                $data['story_rating'] = $_POST['rating-story'];
                $data['price_rating'] = $_POST['rating-price'];
                $data['quality_rating'] = $_POST['rating-quality'];
                $data['summary'] = $_POST['summary'];
                $data['review'] = $_POST['review'];

                $query = "INSERT INTO feedback (user_id, product_id, story_rating, price_rating, quality_rating, summary, review) VALUES (:user_id, :product_id, :story_rating, :price_rating, :quality_rating, :summary, :review)";
                $result = $product->write($query, $data);
            }
        }
        header("Location: " . ROOT . "product/" . $redirect);
        die;    
    }
}