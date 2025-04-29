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

        // Xử lý thêm vào giỏ hàng
        if (isset($_POST['add_to_cart'])) {
            $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
            
            if ($quantity < 1) {
                $quantity = 1;
            }
            
            // Khởi tạo giỏ hàng nếu chưa tồn tại
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }
            
            // Thêm vào giỏ hàng hoặc cập nhật số lượng nếu đã có
            if (isset($_SESSION['cart'][$id])) {
                $_SESSION['cart'][$id]['quantity'] += $quantity;
            } else {
                $_SESSION['cart'][$id] = [
                    'id' => $product['id'],
                    'name' => $product['name'],
                    'price' => $product['price'],
                    'image' => $product['image'],
                    'quantity' => $quantity
                ];
            }
            
            // Chuyển hướng đến trang giỏ hàng
            header('Location: index.php?controller=cart&action=index');
            exit;
        }

        require_once 'views/components/header.php';
        require_once 'views/pages/product-detail.php';
    }
}