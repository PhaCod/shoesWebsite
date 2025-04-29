<?php
require_once 'models/PromotionalProductModel.php';
require_once 'models/ProductModel.php';

class AdminPromotionController {
    private $promotionModel;
    private $productModel;

    public function __construct() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header('Location: index.php?controller=auth&action=login');
            exit;
        }

        $this->promotionModel = new PromotionalProductModel();
        $this->productModel = new ProductModel();
    }

    public function index() {
        // Lấy danh sách tất cả chương trình khuyến mãi
        $promotions = $this->promotionModel->getAllPromotions();

        require_once 'views/admin/pages/promotion-list.php';
    }

    public function manageProducts() {
        if (!isset($_GET['promotion_id']) || !is_numeric($_GET['promotion_id'])) {
            header('Location: index.php?controller=adminPromotion&action=index');
            exit;
        }

        $promotionId = (int)$_GET['promotion_id'];
        $promotion = $this->promotionModel->getPromotionById($promotionId);

        if (!$promotion) {
            header('Location: index.php?controller=adminPromotion&action=index');
            exit;
        }

        // Lấy danh sách tất cả sản phẩm
        $products = $this->productModel->getAllProducts();

        // Lấy danh sách sản phẩm đã gán vào chương trình khuyến mãi
        $assignedProducts = $this->promotionModel->getProductsByPromotionId($promotionId);

        // Xử lý gán/tháo gán sản phẩm
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $selectedProducts = isset($_POST['products']) ? $_POST['products'] : [];

            // Xóa tất cả sản phẩm hiện tại của chương trình khuyến mãi
            $this->promotionModel->removeAllProductsFromPromotion($promotionId);

            // Gán lại các sản phẩm được chọn
            foreach ($selectedProducts as $productId) {
                $this->promotionModel->assignProductToPromotion($promotionId, $productId);
            }

            header('Location: index.php?controller=adminPromotion&action=manageProducts&promotion_id=' . $promotionId);
            exit;
        }

        require_once 'views/admin/pages/promotion-manage-products.php';
    }
}