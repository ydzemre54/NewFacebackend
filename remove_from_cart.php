<?php
session_start();
require(__DIR__ . "/vendor/autoload.php");

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

require_once '../backend/controllers/CartController.php';

$controller = new CartController();
if (isset($_GET['id'])) {
    $controller->remove($_GET['id']);
    header('Location: cart.php');
exit;

}
