<?php

namespace App\Models;

use App\Services\Model;

Class Cart extends Model
{
    /*
    * Méthode renvoyant un array d'un ou plusieurs paniers en fonction de la valeur d'une colonne (key) :
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
}