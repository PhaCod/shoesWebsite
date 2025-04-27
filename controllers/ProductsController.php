<?php
require_once 'models/ProductModel.php';

class ProductsController {
    private $productModel;

    public function __construct() {
        $this->productModel = new ProductModel();
    }

    public function index() {
        $products = $this->productModel->getAllProducts();
        require_once 'views/components/header.php';
        require_once 'views/pages/products.php';
    }

    public function detail() {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            header('Location: index.php?controller=products&action=index');
            exit;
        }

        $id = intval($_GET['id']);
        $product = $this->productModel->getProductById($id);

        if (!$product) {
            header('Location: index.php?controller=products&action=index');
            exit;
        }

        require_once 'views/components/header.php';
        require_once 'views/pages/product-detail.php';
    }
}