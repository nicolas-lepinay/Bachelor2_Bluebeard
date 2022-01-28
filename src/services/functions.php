<?php

function show($data)
{
    echo "<pre>"; 
    var_dump($data);
    echo "</pre>";
}

function check_error()
{
    if(isset($_SESSION["error"]) && $_SESSION["error"] != "") {
        echo $_SESSION["error"];
        unset($_SESSION["error"]);
    }
}

function get_random_string_max($length = 60)
{
    $array = array(0,1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
    $uuid = "";
    $length = rand(4, $length);

    for($i=0; $i<$length; $i++) {
        $random = rand(0,61);
        $uuid .= $array[$random];
    }
    // Vérification que l'UUID n'existe pas déjà :
    // $query = "SELECT * FROM users WHERE uuid = :uuid LIMIT 1";
    // $data['uuid'] = $uuid;
    // $result = $this->read($query, $data);
    // if(is_array($result)) {
    //     $this->get_random_string_max($length);
    // }

    return $uuid;
}