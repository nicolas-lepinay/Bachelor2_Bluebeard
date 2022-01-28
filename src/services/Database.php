<?php

namespace App\Services;

use \PDO;
use \PDOException;

Class Database
{
    private static $con;

    /*
    * Connexion à la base de données :
    */
    public static function getConnection()
    {
        if(!self::$con) {
            try {
                $string = DB_TYPE . ": host=" . DB_HOST . "; dbname=" . DB_NAME;
                self::$con = new PDO($string, DB_USER, DB_PASSWORD);
            } catch(PDOException $e) {
                die($e->getMessage());
            }
        }
        return self::$con;
    }
}
