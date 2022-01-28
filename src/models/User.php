<?php

namespace App\Models;

use App\Services\Model;

Class User extends Model
{
    /*
    * Méthode renvoyant un array d'un ou plusieurs utilisateurs en fonction de la valeur d'une colonne (key) :
    * @return array;
    */
    public function find($key, $value)
    {
        $data[$key] = $value;
        $query = "SELECT * FROM users WHERE {$key} = :{$key}";
        $result = $this->read($query, $data);
        if(is_array($result)) {
            return $result; // array d'objets (stdClass)
        }
        return false;
    }

    /*
    * Méthode renvoyant un seul utilisateur (objet stdClass) en fonction de la valeur d'une colonne (key) :
    * @return objet (stdClass);
    */
    public function findOne($key, $value)
    {
        $data[$key] = $value;
        $query = "SELECT * FROM users WHERE {$key} = :{$key} LIMIT 1";
        $result = $this->read($query, $data);
        if(is_array($result)) {
            return $result[0]; // un objet (stdClass)
        }
        return false;
    }

    /*
    * Méthode renvoyant tous les utilisateurs (pour la partie Admin) :
    * @return array;
    */
    public function findAll()
    {
        $query = "SELECT * FROM users";
        $result = $this->read($query);
        if(is_array($result)) {
            return $result; // array d'objets (stdClass)
        }
        return false;
    }

    /*
    * Méthode renvoyant un array de favoris en fonction de la valeur d'une colonne (l'id de l'utilisateur) :
    * @return array;
    */
    public function findWishlist($key, $value)
    {
        $data[$key] = $value;
        $query = "SELECT * FROM wishlist WHERE {$key} = :{$key}";
        $result = $this->read($query, $data);
        if(is_array($result)) {
            return $result; // array d'objets (stdClass)
        }
        return false;
    }

    /*
    * Méthodes pour la partie Admin :
    */
    public function admin_user_modif($uuid, $first_name, $last_name, $username)
    {
        $data['uuid'] = $uuid;
        $data['first_name'] = $first_name;
        $data['last_name'] = $last_name;
        $data['username'] = $username;
        $query = "UPDATE users SET first_name = :first_name, last_name = :last_name, username = :username WHERE uuid = :uuid";
        $result = $this->read($query, $data);
        if(is_array($result)) {
            return $result[0];
        }
        return false;
    }

    public function admin_user_delete($uuid)
    {
        $data['uuid'] = $uuid;
        $query = "DELETE FROM users WHERE uuid = :uuid LIMIT 1";
        $result = $this->read($query, $data);
        if(is_array($result)) {
            return $result[0];
        }
        return false;
    }
}