<?php

namespace App\Models;

use App\Services\Model;

Class Product extends Model
{
    /*
    * Méthode renvoyant tous les produits :
    * @return array;
    */
    public function findAll()
    {
        $query = "SELECT * FROM product";
        $result = $this->read($query);
        if(is_array($result)) {
            return $result; // array d'objets (stdClass)
        }
        return false;
    }

    /*
    * Méthode renvoyant un array d'un ou plusieurs produits en fonction de la valeur d'une colonne (key) :
    * @return array;
    */
    public function find($key, $value)
    {
        $data[$key] = $value;
        $query = "SELECT * FROM product WHERE {$key} = :{$key}";
        $result = $this->read($query, $data);
        if(is_array($result)) {
            return $result; // array d'objets (stdClass)
        }
        return false;
    }

    /*
    * Méthode renvoyant un seul produit (objet stdClass) en fonction de la valeur d'une colonne (key) :
    * @return objet stdClass;
    */
    public function findOne($key, $value)
    {
        $data[$key] = $value;
        $query = "SELECT * FROM product WHERE {$key} = :{$key} LIMIT 1";
        $result = $this->read($query, $data);
        if(is_array($result)) {
            return $result[0]; // un objet (stdClass)
        }
        return false;
    }

    /*
    * Méthodes pour la partie Admin :
    */
    public function admin_product_delete($id_product)
    {
        $data['id_product'] = $id_product;
        $query = "DELETE FROM product WHERE id_product = :id_product";
        $result = $this->write($query, $data);
        return $result;

    }
    public function admin_product_modif($id_product, $title, $author, $description, $price, $stock, $weight, $collection_id, $slug)
    {
        $data['id_product'] = $id_product;
        $data['title'] = $title;
        $data['author'] = $author;
        $data['description'] = $description;
        $data['price'] = $price;
        $data['stock'] = $stock;
        $data['weight'] = $weight;
        $data['collection_id'] = (int)$collection_id;
        $data['slug'] = $slug;
        $query = "UPDATE product SET title = :title, author = :author, description = :description, price = :price, stock = :stock, weight = :weight, collection_id = :collection_id, slug = :slug WHERE id_product = :id_product";
        $result = $this->write($query, $data);
        return $result;

    }
    public function admin_product_create($title, $author, $description, $price, $stock, $weight, $collection_id, $slug)
    {
        $data['title'] = $title;
        $data['author'] = $author;
        $data['description'] = $description;
        $data['price'] = $price;
        $data['stock'] = $stock;
        $data['weight'] = $weight;
        $data['collection_id'] = (int)$collection_id;
        $data['slug'] = $slug;

        $query = "INSERT INTO product (title, author, description, price, stock, weight, collection_id, slug) VALUES (:title, :author, :description, :price, :stock, :weight, :collection_id, :slug)";
        $result = $this->write($query, $data);
        return $result;
    }

    public static function slugify($text, string $divider = '-')
    {
        // replace non letter or digits by divider
        $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, $divider);

        // remove duplicate divider
        $text = preg_replace('~-+~', $divider, $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }
}