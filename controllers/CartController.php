<?php
require_once 'classes/panier.php';

class CartController {
    private $cart;

    public function __construct() {
        $this->cart = new Cart();
    }

    public function add($id) {
        $this->cart->addToCart($id);
    }
    public function remove($id) {
        $this->cart->removeFromCart($id);
    }

    public function getCartItems() {
        return $this->cart->getCartProducts();
    }
}
