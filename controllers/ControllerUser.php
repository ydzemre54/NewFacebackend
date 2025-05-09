<?php
require_once 'classes/User.php';

class UserController
{
    private $model;

    public function __construct()
    {
        $this->model = new User();
    }

    public function login($username, $password)
    {
        if ($this->model->login($username, $password)) {
            header("Location: index.php");
            exit;
        } else {
            // On envoie l'erreur via une variable
            $error = "Identifiants incorrects.";
            include 'views/header.php';
            include 'views/login.php'; // $error est visible ici
            include 'views/footer.php';
        }
    }

    public function showLogin()
    {
        $success = isset($_GET['success']) ? "Inscription réussie. Connectez-vous." : null;

        include 'views/header.php';
        include 'views/login.php';
        include 'views/footer.php';
    }

    public function register($username, $password)
    {
        $error = null;

        // Expression régulière pour mot de passe fort
        $regex = '/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[^\w\d\s:])([^\s]){12,}$/';

        if (!preg_match($regex, $password)) {
            $error = "Mot de passe invalide. Il doit contenir au moins 12 caractères, avec au moins une majuscule, une minuscule, un chiffre, un caractère spécial, et sans espace.";
        } elseif ($this->model->userExists($username)) {
            $error = "Nom d'utilisateur déjà pris.";
        }

        if ($error) {
            include 'views/header.php';
            include 'views/register.php'; // la variable $error est visible dans la vue
            include 'views/footer.php';
        } else {

            $this->model->register($username, $password);
            header("Location: login.php?success=1");
            exit;
        }
    }


    public function showRegister()
    {
        include 'views/header.php';
        include 'views/register.php';
        include 'views/footer.php';
    }


    public function logout()
    {
        $this->model->logout();
        header("Location: login.php");
        exit;
    }
}
