<?php
require_once 'models/ProductModel.php';

class CartController {
    private $productModel;

    public function __construct() {
        $this->productModel = new ProductModel();
    }

    public function index() {
        // Lấy danh sách sản phẩm trong giỏ hàng từ session
        $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
        $cartItems = [];
        $totalPrice = 0;

        if (!empty($cart)) {
            // Lấy thông tin chi tiết của các sản phẩm trong giỏ hàng
            foreach ($cart as $shoesId => $quantity) {
                $product = $this->productModel->getProductById($shoesId);
                if ($product) {
                    $cartItems[] = [
                        'product' => $product,
                        'quantity' => $quantity,
                        'subtotal' => $product['Price'] * $quantity
                    ];
                    $totalPrice += $product['Price'] * $quantity;
                }
            }
        }

        require_once 'views/components/header.php';
        require_once 'views/pages/cart.php';
    }

    public function add() {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            header('Location: index.php?controller=cart&action=index');
            exit;
        }

        $shoesId = intval($_GET['id']);
        $product = $this->productModel->getProductById($shoesId);

        if (!$product) {
            header('Location: index.php?controller=cart&action=index');
            exit;
        }

        // Khởi tạo giỏ hàng nếu chưa có
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // Thêm sản phẩm vào giỏ hàng
        if (isset($_SESSION['cart'][$shoesId])) {
            $_SESSION['cart'][$shoesId]++;
        } else {
            $_SESSION['cart'][$shoesId] = 1;
        }

        header('Location: index.php?controller=cart&action=index');
        exit;
    }

    public function remove() {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            header('Location: index.php?controller=cart&action=index');
            exit;
        }

        $shoesId = intval($_GET['id']);
        if (isset($_SESSION['cart'][$shoesId])) {
            unset($_SESSION['cart'][$shoesId]);
        }

        // Nếu giỏ hàng rỗng, xóa session cart
        if (empty($_SESSION['cart'])) {
            unset($_SESSION['cart']);
        }

        header('Location: index.php?controller=cart&action=index');
        exit;
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            foreach ($_POST['quantity'] as $shoesId => $quantity) {
                $quantity = intval($quantity);
                if ($quantity <= 0) {
                    unset($_SESSION['cart'][$shoesId]);
                } else {
                    $_SESSION['cart'][$shoesId] = $quantity;
                }
            }

            // Nếu giỏ hàng rỗng, xóa session cart
            if (empty($_SESSION['cart'])) {
                unset($_SESSION['cart']);
            }
        }

        header('Location: index.php?controller=cart&action=index');
        exit;
    }
}