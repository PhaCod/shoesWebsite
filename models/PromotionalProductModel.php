<?php
require_once 'config/db_connect.php';
require_once 'models/ProductModel.php';

class PromotionalProductModel {
    private $productModel;
    private $db;

    public function __construct() {
        $this->productModel = new ProductModel();
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function getAllProducts() {
        $products = $this->productModel->getAllProducts();
        // Lấy thông tin khuyến mãi cho từng sản phẩm
        foreach ($products as &$product) {
            $product['promotion'] = $this->getPromotionForProduct($product['id']);
            $product['final_price'] = $this->calculateDiscountedPrice($product, $product['promotion']);
        }
        return $products;
    }

    public function getProductById($id) {
        $product = $this->productModel->getProductById($id);
        if ($product) {
            $product['promotion'] = $this->getPromotionForProduct($id);
            $product['final_price'] = $this->calculateDiscountedPrice($product, $product['promotion']);
        }
        return $product;
    }

    private function getPromotionForProduct($product_id) {
        // Ánh xạ ID sản phẩm hardcode với ShoesID trong cơ sở dữ liệu
        $current_date = date('Y-m-d H:i:s');
        $query = "SELECT p.* 
                  FROM promotions p 
                  JOIN promotion_shoes ps ON p.promotion_id = ps.promotion_id 
                  WHERE ps.shoe_id = ? 
                  AND p.start_date <= ? 
                  AND p.end_date >= ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$product_id, $current_date, $current_date]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    private function calculateDiscountedPrice($product, $promotion) {
        if (!empty($promotion)) {
            if ($promotion['discount_percentage']) {
                return $product['price'] * (1 - $promotion['discount_percentage'] / 100);
            } elseif ($promotion['fixed_price']) {
                return $promotion['fixed_price'];
            }
        }
        return $product['price'];
    }

    // Lấy tất cả chương trình khuyến mãi
    public function getAllPromotions() {
        $query = "SELECT * FROM promotions";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy chương trình khuyến mãi theo ID
    public function getPromotionById($promotionId) {
        $query = "SELECT * FROM promotions WHERE promotion_id = :promotion_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':promotion_id', (int)$promotionId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Lấy danh sách sản phẩm đã gán vào chương trình khuyến mãi
    public function getProductsByPromotionId($promotionId) {
        $query = "SELECT shoe_id FROM promotion_shoes WHERE promotion_id = :promotion_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':promotion_id', (int)$promotionId, PDO::PARAM_INT);
        $stmt->execute();
        return array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'shoe_id');
    }

    // Xóa tất cả sản phẩm khỏi chương trình khuyến mãi
    public function removeAllProductsFromPromotion($promotionId) {
        $query = "DELETE FROM promotion_shoes WHERE promotion_id = :promotion_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':promotion_id', (int)$promotionId, PDO::PARAM_INT);
        $stmt->execute();
    }

    // Gán sản phẩm vào chương trình khuyến mãi
    public function assignProductToPromotion($promotionId, $productId) {
        $query = "INSERT INTO promotion_shoes (promotion_id, shoe_id) VALUES (:promotion_id, :shoe_id)";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':promotion_id', (int)$promotionId, PDO::PARAM_INT);
        $stmt->bindValue(':shoe_id', (int)$productId, PDO::PARAM_INT);
        $stmt->execute();
    }

}