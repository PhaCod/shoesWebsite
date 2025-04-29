<?php
class CartController {
    public function index() {
        $cartItems = [];
        $subtotal = 0;
        $shipping = 10.00; // Giả định phí vận chuyển là $10, có thể thay đổi

        if (!empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $id => $item) {
                // Tính toán subtotal dựa trên final_price
                $subtotalForItem = $item['price'] * $item['quantity']; // $item['price'] đã là final_price
                $cartItems[] = [
                    'product' => [
                        'id' => $item['id'],
                        'name' => $item['name'],
                        'price' => $item['price'], // Giá gốc (có thể hiển thị nếu cần)
                        'final_price' => $item['price'], // Giá đã giảm (được lưu trong session)
                        'image' => $item['image']
                    ],
                    'quantity' => $item['quantity'],
                    'subtotal' => $subtotalForItem
                ];
                $subtotal += $subtotalForItem;
            }
        }

        $total = $subtotal + $shipping;

        require_once 'views/pages/cart.php';
    }

    public function update() {
        if (isset($_POST['update_cart']) && !empty($_POST['quantity'])) {
            foreach ($_POST['quantity'] as $id => $quantity) {
                $quantity = (int)$quantity;
                if ($quantity < 1) {
                    unset($_SESSION['cart'][$id]);
                } elseif (isset($_SESSION['cart'][$id])) {
                    $_SESSION['cart'][$id]['quantity'] = $quantity;
                }
            }
        }
        header('Location: index.php?controller=cart&action=index');
        exit;
    }

    public function remove() {
        if (isset($_GET['id']) && isset($_SESSION['cart'][$_GET['id']])) {
            unset($_SESSION['cart'][$_GET['id']]);
        }
        header('Location: index.php?controller=cart&action=index');
        exit;
    }
}