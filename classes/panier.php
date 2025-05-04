<?php
require_once 'Produit.php';

class Cart {
    private $db;
    private $product;

    public function __construct() {
        if (!isset($_SESSION)) {
            session_start();
        }

        $this->db = Database::getInstance()->getConnection();
        $this->product = new Product();
    }

    public function addToCart($id) {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // Vérifier si le produit existe déjà dans le panier
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['quantity'] += 1;
        } else {
            $product = $this->product->getById($id);

            if ($product) {
                $_SESSION['cart'][$id] = [
                    'id' => $product['id'],
                    'nom_produit' => $product['nom_produit'],
                    'prix_produit' => $product['prix_produit'],
                    'quantity' => 1
                ];
            }
        }
    }

    public function removeFromCart($id) {
        if (isset($_SESSION['cart'][$id])) {
            unset($_SESSION['cart'][$id]);
        }
    }

    public function getCartProducts() {
        return $_SESSION['cart'] ?? [];
    }

    public function clearCart() {
        unset($_SESSION['cart']);
    }
}