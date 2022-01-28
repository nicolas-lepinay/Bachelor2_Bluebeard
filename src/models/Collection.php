<?php

namespace App\Models;

use App\Services\Model;

Class Collection extends Model
{
    /*
    * Méthode renvoyant toutes les collections :
    * @return array;
    */
    public function findAll()
    {
        $query = "SELECT * FROM collection";
        $result = $this->read($query);
        if(is_array($result)) {
            return $result; // array d'objets (stdClass)
        }
        return false;
    }

    /*
    * Méthode renvoyant une seul collection (objet stdClass) en fonction de la valeur d'une colonne (key) :
    * @return objet stdClass;
    */
    public function findOne($key, $value)
    {
        $data[$key] = $value;
        $query = "SELECT * FROM collection WHERE {$key} = :{$key} LIMIT 1";
        $result = $this->read($query, $data);
        if(is_array($result)) {
            return $result[0]; // un objet (stdClass)
        }
        return false;
    }

    /*
    * Méthodes pour la partie Admin :
    */
    public function admin_collection_delete($id_collection)
    {
        $data['id_collection'] = $id_collection;
        $query = "DELETE FROM collection WHERE id_collection = :id_collection LIMIT 1";
        $result = $this->write($query, $data);
        return $result;

    }
    public function admin_collection_modif($id_collection, $name, $image, $slug)
    {
        $data['id_collection'] = $id_collection;
        $data['name'] = $name;
        $data['image'] = $image;
        $data['slug'] = $slug;
        $query = "UPDATE collection SET name = :name, image = :image, slug = :slug WHERE id_collection = :id_collection";
        $result = $this->write($query, $data);
        return $result;

    }
    public function admin_collection_create($name, $slug)
    {
        $data['name'] = $name;
        $data['slug'] = $slug;
        $query = "INSERT INTO collection (name, slug) VALUES (:name, :slug)";
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