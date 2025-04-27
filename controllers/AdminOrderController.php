<?php
class AdminOrderController {
    public function orders() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header('Location: index.php?controller=auth&action=login');
            exit;
        }

        require_once 'views/admin/components/header.php';
        require_once 'views/admin/pages/orders.php';
    }

    public function orderDetail() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header('Location: index.php?controller=auth&action=login');
            exit;
        }
    
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            header('Location: index.php?controller=adminOrder&action=orders');
            exit;
        }
    
        $order_id = intval($_GET['id']);
        // Dữ liệu hardcode
        $order = [
            'id' => $order_id,
            'customer' => 'John Doe',
            'email' => 'john@example.com',
            'date' => 'Jun 12, 2023',
            'status' => 'Delivered',
            'address' => '123 Main St, Anytown, CA 12345',
            'payment_method' => 'Credit Card',
            'items' => [
                [
                    'name' => 'Classic Sneakers',
                    'price' => 79.99,
                    'quantity' => 1
                ],
                [
                    'name' => 'Running Shoes',
                    'price' => 99.99,
                    'quantity' => 2
                ]
            ]
        ];
    
        // Tính toán tổng tiền
        $subtotal = 0;
        foreach ($order['items'] as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        $shipping = 10.00;
        $total = $subtotal + $shipping;
    
        // Xử lý cập nhật trạng thái
        if (isset($_POST['update_status'])) {
            $new_status = $_POST['status'];
            $order['status'] = $new_status;
        }
    
        require_once 'views/admin/components/header.php';
        require_once 'views/admin/pages/order-detail.php';
    }
}