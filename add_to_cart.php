<?php
session_start();

require(__DIR__ . "/vendor/autoload.php");

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

require_once 'classes/panier.php'; // Assure-toi que le chemin vers ta classe Cart est correct
$cart = new Cart();

require_once 'classes/Produit.php'; // Assure-toi d'inclure ton modèle Produit
$productModel = new Product();

if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    // Récupérer les informations du produit depuis la base de données
    $product = $productModel->getById($productId);

    if ($product) {
        // Vérifier si le produit est déjà dans le panier
        if (isset($_SESSION['cart'][$productId])) {
            // Si oui, augmenter la quantité
            $_SESSION['cart'][$productId]['quantity']++;
        } else {
            // Sinon, ajouter le produit avec la quantité 1
            $_SESSION['cart'][$productId] = [
                'id' => $productId,
                'nom_produit' => $product['nom_produit'],
                'prix_produit' => $product['prix_produit'],
                'quantity' => 1
            ];
        }

        // Rediriger vers la page du panier
        header("Location: cart.php");
        exit;
    } else {
        echo "Produit introuvable.";
    }
} else {
    echo "ID du produit manquant.";
}
?>
