<?php

use App\Services\Controller;

Class Auth extends Controller
{
    public function index($action)
    {
        // Redirection si déjà connecté :
        if(isset($this->user) && $action != "se-deconnecter") {
            header("Location: " . ROOT . "home");
            die;
        }

        switch($action) {
            case "se-connecter":
                $this->login();
                break;
            case "se-deconnecter":
                $this->logout();
                break;
            case "creer-un-compte":
                $this->signup();
                break;
            default:
                header("Location: " . ROOT . "home"); // Redirection vers la page Accueil
                die;
        }
    }
    
    public function login($redirect = 'home')
    {
        // Redirection si déjà connecté :
        if(isset($this->user)) {
            header("Location: " . ROOT . "home"); // Redirection vers la page Accueil
            die;
        }

        // Effectue le login en cas de méthode POST :
        if($_SERVER['REQUEST_METHOD'] == "POST") {
            $user = $this->loadModel('User');
            $data['identifier'] = trim($_POST['identifier']);
            $data['password']   = hash('sha1', trim($_POST['password']));
    
            // Recherche de l'utilisateur :
            $query = "SELECT * FROM users WHERE (email = :identifier OR username = :identifier) AND password = :password LIMIT 1";
            $result = $user->read($query, $data);
            if(is_array($result)) {
                $this->user = $result[0];
                $_SESSION['user_uuid'] = $result[0]->uuid;
                header("Location: " . ROOT . $redirect); // Redirection vers la page {$redirect} ('Home' par défaut)
                die;
            }
            $this->error = "Ce compte n'existe pas. <br>";
            $_SESSION['error'] = $this->error;
            unset($data);
        }
        
        $data['page_title'] = "BLUEBEARD | Se connecter";
        $data['collections'] = $this->collections;
        $data['cart'] = $this->cart;

        // Génère la vue 'login.php' :
        $this->view('login', $data);
    }

    public function signup()
    {        
        if($_SERVER['REQUEST_METHOD'] == "POST") {
            $user = $this->loadModel('User');
            $data['username']   = trim($_POST['username']);
            $data['last_name']  = trim($_POST['last_name']);
            $data['first_name'] = trim($_POST['first_name']);
            $data['email']      = trim($_POST['email']);
            $data['password']   = trim($_POST['password']);
            $password2          = trim($_POST['password2']);
    
            // Validation du nom d"utilisateur :
            if(empty($data['username']) || !preg_match("/^[A-zÀ-ú0-9_.\-\s]*$/", $data['username'])) {
                $this->error = "Veuillez entrer un nom d'utilisateur valide. <br>";
            }
    
            // Validation du nom :
            if(empty($data['last_name']) || !preg_match("/^[A-zÀ-ú\s-]*$/", $data['last_name'])) {
                $this->error = "Veuillez entrer un nom valide. <br>";
            }
            
            // Validation du prénom :
            if(empty($data['first_name']) || !preg_match("/^[A-zÀ-ú\s-]*$/", $data['first_name'])) {
                $this->error = "Veuillez entrer un prénom valide. <br>";
            }
            
            // Validation de l'email :
            if(empty($data['email']) || !preg_match("/^[a-zA-Z0-9_.-]+@[a-zA-Z]+.[a-zA-Z]+$/", $data['email'])) {
                $this->error = "Veuillez entrer une adresse email valide. <br>";
            }
    
            // Validation du mot de passe :
            if(strlen($data['password']) < 6) {
                $this->error = "Le mot de passe doit contenir au moins 6 caractères. <br>";
            }
            if($data['password'] != $password2) {
                $this->error = "Les mots de passe ne correspondent pas. <br>";
            }
    
            // Vérification que l'email n'existe pas déjà :
            $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
            $arr['email'] = $data['email'];
            $check = $user->read($sql, $arr);
            unset($arr);
            if(is_array($check)) {
                $this->error = "Cette adresse email est déjà enregistrée. <br>";
            }
    
            // Vérification que le username n'existe pas déjà :
            $sql = "SELECT * FROM users WHERE username = :username LIMIT 1";
            $arr['username'] = $data['username'];
            $check = $user->read($sql, $arr);
            unset($arr);
            if(is_array($check)) {
                $this->error = "Ce nom d'utilisateur n'est pas disponible. <br>";
            }
    
            if(!isset($this->error)) {
                // Ajout des données dans la base de données :
                $data['uuid']       = get_random_string_max(60);
                $data['password']   = hash('sha1', $data['password']);
                $data['role']       = 0;
                $data['createdAt']  = date("Y-m-d H:i:s");
    
                $query = "INSERT INTO USERS (uuid, first_name, last_name, username, email, password, createdAt, role) VALUES (:uuid, :first_name, :last_name, :username, :email, :password, :createdAt, :role)";
                $result = $user->write($query, $data);
    
                if($result) {
                    header("Location: " . ROOT . "auth/se-connecter"); // Redirection vers la page de connexion
                    die;
                }
            }

            $_SESSION['error'] = $this->error;
            unset($data);
        }

        $data['page_title'] = "BLUEBEARD | S'inscrire";
        $data['collections'] = $this->collections;
        $data['cart'] = $this->cart;

        $this->view('signup', $data);
    }

    public function logout()
    {        
        if(isset($_SESSION['user_uuid'])) {
            unset($_SESSION['user_uuid']);
            $this->user = null;
        }
        header("Location: " . ROOT . "home"); // Redirection vers la page Accueil
        die; 
    }

    /*
    * Crée un compte lors du checkout :
    * @return le user créé (ou false)
    */
    public function signupCheckout($POST)
    {        
        $user = $this->loadModel('User');
        
        $data['title']      = trim($POST['billing-title'] ?? 'Mon adresse');
        $data['first_name'] = trim($POST['billing-first_name']);
        $data['last_name']  = trim($POST['billing-last_name']);
        $data['street']    = trim($POST['billing-street']);
        $data['zipcode']    = trim($POST['billing-zipcode']);
        $data['country']    = trim($POST['billing-country'] ?? 'France');
        $data['email']      = trim($POST['signup-email']);
        $data['username']   = trim($POST['signup-username']);
        $data['password']   = trim($POST['signup-password']);
    
        // Validation du nom d"utilisateur :
        if(empty($data['username']) || !preg_match("/^[A-zÀ-ú0-9_.\-\s]*$/", $data['username'])) {
            $this->error = "Veuillez entrer un nom d'utilisateur valide. <br>";
        }

        // Validation du nom :
        if(empty($data['last_name']) || !preg_match("/^[A-zÀ-ú\s-]*$/", $data['last_name'])) {
            $this->error = "Veuillez entrer un nom valide pour l'adresse de facturation. <br>";
        }
        
        // Validation du prénom :
        if(empty($data['first_name']) || !preg_match("/^[A-zÀ-ú\s-]*$/", $data['first_name'])) {
            $this->error = "Veuillez entrer un prénom valide pour l'adresse de facturation. <br>";
        }
        
        // Validation de l'email :
        if(empty($data['email']) || !preg_match("/^[a-zA-Z0-9_.-]+@[a-zA-Z]+.[a-zA-Z]+$/", $data['email'])) {
            $this->error = "Veuillez entrer une adresse email valide. <br>";
        }

        // Validation du code postal :
        if(empty($data['zipcode']) || !preg_match("/^\d{5}$/", $data['zipcode'])) {
            $this->error = "Veuillez entrer un code postal valide pour l'adresse de facturation. <br>";
        }

        // Validation du mot de passe :
        if(strlen($data['password']) < 6) {
            $this->error = "Le mot de passe doit contenir au moins 6 caractères. <br>";
        }

        // Vérification que l'email n'existe pas déjà :
        $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $arr['email'] = $data['email'];
        $check = $user->read($sql, $arr);
        unset($arr);
        if(is_array($check)) {
            $this->error = "Cette adresse email est déjà enregistrée. <br>";
        }

        // Vérification que le username n'existe pas déjà :
        $sql = "SELECT * FROM users WHERE username = :username LIMIT 1";
        $arr['username'] = $data['username'];
        $check = $user->read($sql, $arr);
        unset($arr);
        if(is_array($check)) {
            $this->error = "Ce nom d'utilisateur n'est pas disponible. <br>";
        }

        // S'il n'y a pas d'erreur...
        if(!isset($this->error)) {
            // Ajout des données dans la base de données :
            $data['uuid']       = get_random_string_max(60);
            $data['password']   = hash('sha1', $data['password']);
            $data['role']       = 0;
            $data['createdAt']  = date("Y-m-d H:i:s");

            // Ajout dans la table USERS :
            $query = "INSERT INTO users (uuid, first_name, last_name, username, email, password, createdAt, role) VALUES (:uuid, :first_name, :last_name, :username, :email, :password, :createdAt, :role)";
            $params['uuid']         = $data['uuid'];
            $params['first_name']   = $data['first_name'];
            $params['last_name']    = $data['last_name'];
            $params['username']     = $data['username'];
            $params['email']        = $data['email'];
            $params['password']     = $data['password'];
            $params['role']         = $data['role'];
            $params['createdAt']    = $data['createdAt'];
            $result_user = $user->write($query, $params);
            unset($params);

            // Ajout dans la table ADDRESS :
            $user_data = $user->findOne('uuid', $data['uuid']);
            $params['uuid']         = get_random_string_max(60);
            $params['user_id']      = $user_data->id_user;
            $params['title']        = $data['title'];
            $params['first_name']   = $data['first_name'];
            $params['last_name']    = $data['last_name'];
            $params['street']       = $data['street'];
            $params['zipcode']      = $data['zipcode'];
            $params['country']      = $data['country'];

            $query = "INSERT INTO address (uuid, user_id, title, first_name, last_name, street, zipcode, country) VALUES (:uuid, :user_id, :title, :first_name, :last_name, :street, :zipcode, :country)";
            $result_address = $user->write($query, $params);

            if($result_user && $result_address) {
                $_SESSION['user_uuid'] = $user_data->uuid;
                return $user_data;
            }
        }

        $_SESSION['error'] = $this->error;
        return false;
    }
}