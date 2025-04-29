<?php
class CheckoutController {
    public function index() {
        // Redirect nếu giỏ hàng rỗng
        if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
            header('Location: index.php?controller=cart&action=index');
            exit;
        }

        $success = '';
        $error = '';

        // Tính tổng giỏ hàng
        $subtotal = 0;
        foreach ($_SESSION['cart'] as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $shipping = 10.00; // Chi phí vận chuyển cố định
        $total = $subtotal + $shipping;

        if (isset($_POST['place_order'])) {
            // Xác thực đơn giản
            $name = isset($_POST['name']) ? trim($_POST['name']) : '';
            $email = isset($_POST['email']) ? trim($_POST['email']) : '';
            $address = isset($_POST['address']) ? trim($_POST['address']) : '';
            $city = isset($_POST['city']) ? trim($_POST['city']) : '';
            $zip = isset($_POST['zip']) ? trim($_POST['zip']) : '';
            $card_number = isset($_POST['card_number']) ? trim($_POST['card_number']) : '';

            if (empty($name) || empty($email) || empty($address) || empty($city) || empty($zip) || empty($card_number)) {
                $error = 'All fields are required';
            } else {
                // Trong ứng dụng thực tế, bạn sẽ lưu đơn hàng vào cơ sở dữ liệu
                // Đây chỉ là ví dụ đơn giản
                $success = 'Order placed successfully! Thank you for your purchase.';

                // Xóa giỏ hàng
                $_SESSION['cart'] = [];

                // Chuyển hướng về trang chủ sau 3 giây
                header('Refresh: 3; URL=index.php?controller=home&action=index');
            }
        }

        require_once 'views/components/header.php';
        require_once 'views/pages/checkout.php';
    }
}