<?php
class ProductModel {
    private $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO("mysql:host=127.0.0.1;dbname=shoes;charset=utf8mb4", "root", "");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function getAllProducts() {
        $stmt = $this->pdo->prepare("SELECT s.ShoesID AS id, s.Name AS name, s.Price AS price, s.Image AS image, s.Description AS description, 
                                           c.Name AS category, s.shoes_size, s.Stock
                                     FROM shoes s
                                     JOIN category c ON s.CategoryID = c.CategoryID");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProducts($keyword = '', $category = '', $limit = 8, $offset = 0) {
        $sql = "SELECT s.ShoesID AS id, s.Name AS name, s.Price AS price, s.Image AS image, s.Description AS description, 
                       c.Name AS category, s.shoes_size, s.Stock
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
        $stmt = $this->pdo->prepare("SELECT s.ShoesID AS id, s.Name AS name, s.Price AS price, s.Image AS image, s.Description AS description, 
                                           c.Name AS category, s.CategoryID AS category_id, s.shoes_size, s.Stock
                                     FROM shoes s
                                     JOIN category c ON s.CategoryID = c.CategoryID
                                     WHERE s.ShoesID = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Thêm sản phẩm mới
    public function addProduct($name, $price, $stock, $description, $categoryId, $shoesSize, $image) {
        $stmt = $this->pdo->prepare("INSERT INTO shoes (Name, Price, Stock, Description, DateCreate, DateUpdate, CategoryID, shoes_size, Image) 
                                     VALUES (?, ?, ?, ?, CURDATE(), CURDATE(), ?, ?, ?)");
        return $stmt->execute([$name, $price, $stock, $description, $categoryId, $shoesSize, $image]);
    }

    // Cập nhật sản phẩm
    public function updateProduct($id, $name, $price, $stock, $description, $categoryId, $shoesSize, $image) {
        $stmt = $this->pdo->prepare("UPDATE shoes 
                                     SET Name = ?, Price = ?, Stock = ?, Description = ?, DateUpdate = CURDATE(), CategoryID = ?, shoes_size = ?, Image = ? 
                                     WHERE ShoesID = ?");
        return $stmt->execute([$name, $price, $stock, $description, $categoryId, $shoesSize, $image, $id]);
    }

    // Xóa sản phẩm
    public function deleteProduct($id) {
        $stmt = $this->pdo->prepare("DELETE FROM shoes WHERE ShoesID = ?");
        return $stmt->execute([$id]);
    }

    // Lấy danh sách danh mục
    public function getCategories() {
        $stmt = $this->pdo->prepare("SELECT CategoryID AS id, Name AS name FROM category");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}