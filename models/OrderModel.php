<?php
class OrderModel {
    private $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO("mysql:host=127.0.0.1;dbname=shoes;charset=utf8mb4", "root", "");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    // Lấy danh sách đơn hàng
    public function getOrders() {
        $stmt = $this->pdo->query("
            SELECT o.OrderID, o.Total_price, o.Quantity, o.Date, o.Status, m.Name AS customer_name, m.Email
            FROM `order` o
            JOIN member m ON o.MemberID = m.MemberID
            ORDER BY o.Date DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy chi tiết đơn hàng theo ID
    public function getOrderById($orderId) {
        $stmt = $this->pdo->prepare("
            SELECT o.*, m.Name AS customer_name, m.Email, m.Phone
            FROM `order` o
            JOIN member m ON o.MemberID = m.MemberID
            WHERE o.OrderID = ?
        ");
        $stmt->execute([$orderId]);
        $order = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($order) {
            $stmt = $this->pdo->prepare("
                SELECT os.ShoesID, s.Name AS product_name, s.Price, os.OrderID
                FROM order_shoes os
                JOIN shoes s ON os.ShoesID = s.ShoesID
                WHERE os.OrderID = ?
            ");
            $stmt->execute([$orderId]);
            $order['items'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        return $order;
    }

    // Cập nhật trạng thái đơn hàng
    public function updateOrderStatus($orderId, $status) {
        $validStatuses = ['Pending', 'Processing', 'Shipped', 'Delivered', 'Cancelled'];
        if (!in_array($status, $validStatuses)) {
            return false;
        }

        $stmt = $this->pdo->prepare("UPDATE `order` SET Status = ? WHERE OrderID = ?");
        return $stmt->execute([$status, $orderId]);
    }
}