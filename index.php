<?php
session_start();

require(__DIR__ . "/vendor/autoload.php");

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

require_once '../backend/controllers/ControllerProduit.php';
require_once '../backend/controllers/CartController.php';
require_once '../backend/controllers/ControllerUser.php';

// ROUTAGE TRÈS SIMPLE PAR GET
$page = $_GET['page'] ?? 'home';
$id = $_GET['id'] ?? null;

switch ($page) {
    case 'product':
        if ($id) {
            (new ProductController())->show($id);
        } else {
            header("Location: index.php");
        }
        break;

    /*case 'cart':
        //(new CartController())->showCart();
        break;*/

    default:
        // Page d'accueil : liste de tous les produits
        (new ProductController())->index();
        break;
}
