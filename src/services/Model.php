<?php

namespace App\Services;

use App\Services\Database;
use \PDO;

Class Model
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    /*
    * Lecture de la base de données (SELECT) :
    * @return array ou false;
    */
    public function read($query, $values = array())
    {
        $statement = $this->db->prepare($query);
        $result = $statement->execute($values);

        if($result) {
            $data = $statement->fetchAll(PDO::FETCH_OBJ); // $data est un array d'objets (stdClass)
            if(is_array($data) && count($data) > 0) {
                return $data;
            }
        }
        return false;
    }

    /*
    * Ecriture dans la base de données (INSERT, DELETE, UPDATE) :
    * @return boolean;
    */    
    public function write($query, $values = array())
    {
        $statement = $this->db->prepare($query);
        $result = $statement->execute($values);

        return $result; // Boolean
    }
}