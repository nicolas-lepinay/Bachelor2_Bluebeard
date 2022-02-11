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

    /*
    * Partie modification de compte :
    */
    public function settings($POST)
    {
        if(empty($POST)) {
            return;
        }
        // Récupération des nouvelles données
        $data = array();

        if(empty($POST['new_username'])) {
            $sql = "SELECT `username` FROM users WHERE uuid = :uuid LIMIT 1";
            $arr['uuid'] = $_SESSION['user_uuid'];
            $check = $this->db->read($sql, $arr);
            unset($arr);
            if(is_array($check)) {
                $data['new_username'] = trim($check[0]->username);
            }
        } else {
            $data['new_username']   = trim($POST['new_username']);
        }
        
        if(empty($POST['new_last_name'])) {
            $sql = "SELECT `last_name` FROM users WHERE uuid = :uuid LIMIT 1";
            $arr['uuid'] = $_SESSION['user_uuid'];
            $check = $this->db->read($sql, $arr);
            unset($arr);
            if(is_array($check)) {
                $data['new_last_name'] = trim($check[0]->last_name);
            }
        } else {
            $data['new_last_name']   = trim($POST['new_last_name']);
        }

        if(empty($POST['new_first_name'])) {
            $sql = "SELECT `first_name` FROM users WHERE uuid = :uuid LIMIT 1";
            $arr['uuid'] = $_SESSION['user_uuid'];
            $check = $this->db->read($sql, $arr);
            unset($arr);
            if(is_array($check)) {
                $data['new_first_name'] = trim($check[0]->first_name);
            }
        } else {
            $data['new_first_name']   = trim($POST['new_first_name']);
        }

        if(empty($POST['new_email'])) {
            $sql = "SELECT `email` FROM users WHERE uuid = :uuid LIMIT 1";
            $arr['uuid'] = $_SESSION['user_uuid'];
            $check = $this->db->read($sql, $arr);
            unset($arr);
            if(is_array($check)) {
                $data['new_email'] = trim($check[0]->email);
            }
        } else {
            $data['new_email']   = trim($POST['new_email']);
        }

        $sql = "SELECT `username` FROM users WHERE uuid = :uuid";
        $arr['uuid'] = $_SESSION['user_uuid'];
        $check = $this->db->read($sql, $arr);
        unset($arr);
        if(!$check[0] == $data['new_username'])
        {

            // Vérification que le pseudo n'existe pas déjà (un utilisateur ne peut donc pas entrer son pseudo actuel)
            $sql = "SELECT * FROM users WHERE username = :username LIMIT 1";
            $arr['username'] = $data['new_username'];
            $check = $this->db->read($sql, $arr);
            unset($arr);
            if(is_array($check)) {
                $this->error .= "Ce Pseudo n'est pas disponible ou est déjà votre. <br>";
            }
        }

        $sql = "SELECT `email` FROM users WHERE uuid = :uuid";
        $arr['uuid'] = $_SESSION['user_uuid'];
        $check = $this->db->read($sql, $arr);
        unset($arr);
        if(!$check[0] == $data['new_email'])
        {
            // Vérification que l'adresse mail n'existe pas déjà
            $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
            $arr['email'] = $data['new_email'];
            $check = $this->db->read($sql, $arr);
            unset($arr);
            if(is_array($check)) {
                $this->error .= "Cette adresse mail n'est pas disponible ou est déjà votre. <br>";
            }
        }

        if(!isset($this->error)) {
            // Modification des données dans la base de données
            $data['uuid']   = $_SESSION['user_uuid'];
            $work = false;

            if(!empty($data['new_username'])) 
            {
                $query = "UPDATE users SET username = :username WHERE uuid = :uuid";
                $arr['username'] = $data['new_username'];
                $arr['uuid'] = $data['uuid'];
                $result = $this->db->write($query, $arr);
                if($result) {
                    $work = true;
                }
                unset($arr);
            }

            if(!empty($data['new_first_name'])) {
                
                $query = "UPDATE users SET first_name = :first_name WHERE uuid = :uuid";
                $arr['first_name'] = $data['new_first_name'];
                $arr['uuid'] = $data['uuid'];
                $result = $this->db->write($query, $arr);
                if($result) {
                    $work = true;
                }
                unset($arr);
                
            }

            if(!empty($data['new_last_name'])) {
                
                $query = "UPDATE users SET last_name = :last_name WHERE uuid = :uuid";
                $arr['last_name'] = $data['new_last_name'];
                $arr['uuid'] = $data['uuid'];
                $result = $this->db->write($query, $arr);
                if($result) {
                    $work = true;
                }
                unset($arr);

            }

            if(!empty($data['new_email'])) {
                
                $query = "UPDATE users SET email = :email WHERE uuid = :uuid";
                $arr['email'] = $data['new_email'];
                $arr['uuid'] = $data['uuid'];
                $result = $this->db->write($query, $arr);
                if($result) {
                    $work = true;
                }
                unset($arr);

            }

            if($work) {
                header("Location: " . ROOT . "settings");
                die;
            }

        }

        $_SESSION['error'] = $this->error;

    }


}