<?php

use App\Services\Controller;

Class Settings extends Controller
{
    public function index()
    {
        $user = $this->loadModel("User");

        // Check login :
        if(!isset($this->user)) {
            header("Location: " . ROOT . "home");
            die;
        }

        $data['user'] = $this->user;

        if($_SERVER['REQUEST_METHOD'] == "POST") {
            $user->settings($_POST);
        }

        $data['page_title'] = "Paramètre du compte";
        $this->view('settings', $data);
    }
}