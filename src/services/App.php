<?php

namespace App\Services;

Class App 
{
    protected $controller = "Home";
    protected $method = "index";
    protected $params;

    public function __construct()
    {
        $url = $this->parseURL();

        if(file_exists("../src/controllers/" . ucfirst($url[0]) . ".php"))
        {
            $this->controller = ucfirst($url[0]);
            unset($url[0]);
        }
        require "../src/controllers/" . $this->controller . ".php";
        $this->controller = new $this->controller;

        if(isset($url[1]))
        {
            if(method_exists($this->controller, strtolower($url[1])))
            {
                $this->method = $url[1];
                unset($url[1]);
            }
        }
        $this->params = count($url) > 0 ? $url : [""];

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    private function parseURL()
    {
        $url = isset($_GET['url']) ? $_GET['url'] : "home";
        return explode("/", filter_var(trim($url, "/"), FILTER_SANITIZE_URL));
    }
}