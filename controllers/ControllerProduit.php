<?php
require_once 'classes/Produit.php';

class ProductController {
    private $model;

    public function __construct() {
        $this->model = new Product();
    }

    public function index() {
        $products = $this->model->getAll();
        include 'views/header.php';
        include 'views/produit.php';
        include 'views/footer.php';
    }

    public function show($id) {
        $product = $this->model->getById($id);
        include 'views/header.php';
        include 'views/footer.php';
    }
}
