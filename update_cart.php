<?php
session_start();

// Vérifier si la session "cart" existe, sinon l'initialiser
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Vérifier si des quantités ont été envoyées
if (isset($_POST['quantity'])) {
    foreach ($_POST['quantity'] as $productId => $quantity) {
        // Vérifier si la quantité est un nombre valide
        if (is_numeric($quantity) && $quantity > 0) {
            // Mettre à jour la quantité dans le panier en session
            $_SESSION['cart'][$productId]['quantity'] = $quantity;
        }
    }
}

// Rediriger l'utilisateur vers la page du panier
header("Location: cart.php");
exit;
