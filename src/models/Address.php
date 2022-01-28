<?php

namespace App\Models;

use App\Services\Model;

Class Address extends Model
{
    /*
    * Méthode renvoyant un array d'une ou plusieurs adresses en fonction de la valeur d'une colonne (key) :
    * @return array;
    */
    public function find($key, $value)
    {
        $data[$key] = $value;
        $query = "SELECT * FROM address WHERE {$key} = :{$key} ORDER BY 'createdAt' DESC"; // Des plus récentes au plus anciennes
        $result = $this->read($query, $data);
        if(is_array($result)) {
            return $result; // array d'objets (stdClass)
        }
        return false;
    }

    /*
    * Méthode renvoyant une seule adresse (objet stdClass) en fonction de la valeur d'une colonne (key) :
    * @return objet stdClass;
    */
    public function findOne($key, $value)
    {
        $data[$key] = $value;
        $query = "SELECT * FROM address WHERE {$key} = :{$key} ORDER BY 'createdAt' DESC LIMIT 1"; // La plus récente
        $result = $this->read($query, $data);
        if(is_array($result)) {
            return $result[0]; // un objet (stdClass)
        }
        return false;
    }
}