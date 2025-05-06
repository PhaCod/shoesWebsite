<?php
class ProductModel {
    private $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO("mysql:host=127.0.0.1;dbname=shoe;charset=utf8mb4", "root", "");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function getAllProducts() {
        $stmt = $this->pdo->prepare("SELECT s.ShoesID AS id, s.Name AS name, s.Price AS price, s.Image AS image, s.Description AS description, c.Name AS category
                                     FROM shoes s
                                     JOIN category c ON s.CategoryID = c.CategoryID");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProducts($keyword = '', $category = '', $limit = 8, $offset = 0) {
        $sql = "SELECT s.ShoesID AS id, s.Name AS name, s.Price AS price, s.Image AS image, s.Description AS description, c.Name AS category
                FROM shoes s
                JOIN category c ON s.CategoryID = c.CategoryID
                WHERE 1=1";
        $params = [];
    
        // Add keyword search condition
        if (!empty($keyword)) {
            $sql .= " AND (s.Name LIKE ? OR s.Description LIKE ?)";
            $params[] = '%' . $keyword . '%';
            $params[] = '%' . $keyword . '%';
        }
    
        // Add category filter condition
        if (!empty($category)) {
            $sql .= " AND c.Name = ?";
            $params[] = $category;
        }
    
        // Add limit and offset directly
        $sql .= " LIMIT " . (int)$limit . " OFFSET " . (int)$offset;
    
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalProducts($keyword = '', $category = '') {
        $sql = "SELECT COUNT(*) as total
                FROM shoes s
                JOIN category c ON s.CategoryID = c.CategoryID
                WHERE 1=1";
        $params = [];

        if (!empty($keyword)) {
            $sql .= " AND (s.Name LIKE ? OR s.Description LIKE ?)";
            $params[] = '%' . $keyword . '%';
            $params[] = '%' . $keyword . '%';
        }

        if (!empty($category)) {
            $sql .= " AND c.Name = ?";
            $params[] = $category;
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function getProductById($id) {
        $stmt = $this->pdo->prepare("SELECT s.ShoesID AS id, s.Name AS name, s.Price AS price, s.Image AS image, s.Description AS description, c.Name AS category
                                     FROM shoes s
                                     JOIN category c ON s.CategoryID = c.CategoryID
                                     WHERE s.ShoesID = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}