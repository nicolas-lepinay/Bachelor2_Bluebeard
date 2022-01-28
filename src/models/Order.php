<?php

namespace App\Models;

use App\Services\Model;

Class Order extends Model
{
    /*
    * Méthode renvoyant un array d'une ou plusieurs commande en fonction de la valeur d'une colonne (key) :
    * @return array;
    */
    public function find($key, $value)
    {
        $data[$key] = $value;
        $query = "SELECT * FROM orders WHERE {$key} = :{$key}";
        $result = $this->read($query, $data);
        if(is_array($result)) {
            return $result; // array d'objets (stdClass)
        }
        return false;
    }

    /*
    * Méthode renvoyant une seule commande (objet stdClass) en fonction de la valeur d'une colonne (key) :
    * @return objet (stdClass);
    */
    public function findOne($key, $value)
    {
        $data[$key] = $value;
        $query = "SELECT * FROM orders WHERE {$key} = :{$key} LIMIT 1";
        $result = $this->read($query, $data);
        if(is_array($result)) {
            return $result[0]; // un objet (stdClass)
        }
        return false;
    }

    /*
    * Méthode mettant un jour une commande dans la base de données (le statut, par exemple) :
    * @return boolean;
    */
    public function findAndUpdate($key1, $value1, $key2, $value2)
    {
        $data[$key1] = $value1;
        $data[$key2] = $value2;

        $query = "UPDATE orders SET {$key1} = :{$key1} WHERE {$key2} = :{$key2}";
        $result = $this->write($query, $data);
        
        return $result; // Boolean
    }

}