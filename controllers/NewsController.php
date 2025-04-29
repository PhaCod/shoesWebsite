<?php
require_once 'models/NewsModel.php';
require_once 'models/PromotionModel.php';

class NewsController {
    private $newsModel;
    private $promotionModel;

    public function __construct() {
        $this->newsModel = new NewsModel();
        $this->promotionModel = new PromotionModel();
    }

    public function index() {
        $search = isset($_GET['search']) ? trim($_GET['search']) : '';
        $limit = 6;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $page = max(1, $page);
        $offset = ($page - 1) * $limit;

        $news = $this->newsModel->getAllNews($search, $limit, $offset);
        $totalNews = $this->newsModel->getPublicNewsCount($search);
        $totalPages = ceil($totalNews / $limit);

        require_once 'views/components/header.php';
        require_once 'views/pages/news.php';
        
    }

    public function detail() {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            header('Location: index.php?controller=news&action=index');
            exit;
        }

        $news_id = intval($_GET['id']);
        $news = $this->newsModel->getNewsById($news_id);

        if (!$news) {
            header('Location: index.php?controller=news&action=index');
            exit;
        }
        require_once 'views/components/header.php';
        require_once 'views/pages/news_detail.php';
    }

    // public function promotion() {
    //     if (!isset($_GET['promotion_id']) || !is_numeric($_GET['promotion_id'])) {
    //         header('Location: index.php?controller=news&action=index');
    //         exit;
    //     }

    //     $promotion_id = intval($_GET['promotion_id']);
    //     $promotion = $this->promotionModel->getPromotionById($promotion_id);

    //     if (!$promotion) {
    //         header('Location: index.php?controller=news&action=index');
    //         exit;
    //     }

    //     $limit = 6;
    //     $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    //     $page = max(1, $page);
    //     $offset = ($page - 1) * $limit;

    //     $shoes = $this->promotionModel->getShoesByPromotion($promotion_id, $limit, $offset);
    //     $totalShoes = $this->promotionModel->getShoesCountByPromotion($promotion_id);
    //     $totalPages = ceil($totalShoes / $limit);

    //     require_once 'views/components/header.php';
    //     require_once 'views/pages/promotion_shoes.php';
    // }
}