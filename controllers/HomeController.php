<?php
require_once 'models/ProductModel.php';

class HomeController {
    private $productModel;

    public function __construct() {
        $this->productModel = new ProductModel();
    }

    public function index() {
        $products = $this->productModel->getAllProducts();
        require_once 'views/components/header.php';
        require_once 'views/pages/home.php';
    }
}