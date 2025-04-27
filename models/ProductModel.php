<?php
require_once 'config/db_connect.php';

class ProductModel {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function getAllProducts() {
        $stmt = $this->db->prepare("SELECT * FROM shoes");
        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error in getAllProducts: " . $e->getMessage());
            return [];
        }
    }

    public function getProductById($id) {
        $stmt = $this->db->prepare("SELECT * FROM shoes WHERE ShoesID = ?");
        try {
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error in getProductById: " . $e->getMessage());
            return null;
        }
    }
}