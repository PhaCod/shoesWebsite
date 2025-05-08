<?php
class OrderModel {
    private $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO("mysql:host=127.0.0.1;dbname=shoe;charset=utf8mb4", "root", "123456789");
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

    // Thêm đơn hàng mới
    public function addOrder($memberId, $totalPrice, $quantity) {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO `order` (MemberID, Total_price, Quantity, Date, Status) 
                                         VALUES (?, ?, ?, NOW(), 'Pending')");
            $stmt->execute([$memberId, $totalPrice, $quantity]);
            return $this->pdo->lastInsertId(); // Trả về OrderID
        } catch (PDOException $e) {
            return false;
        }
    }

    // Thêm chi tiết đơn hàng vào bảng order_shoes
    public function addOrderShoes($orderId, $shoesId) {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO order_shoes (OrderID, ShoesID) VALUES (?, ?)");
            return $stmt->execute([$orderId, $shoesId]);
        } catch (PDOException $e) {
            return false;
        }
    }
}