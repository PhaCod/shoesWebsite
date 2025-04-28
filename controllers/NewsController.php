<?php
require_once 'models/NewsModel.php';

class NewsController {
    private $newsModel;

    public function __construct() {
        $this->newsModel = new NewsModel();
    }

    public function index() {
        $search = isset($_GET['search']) ? trim($_GET['search']) : '';
        $limit = 8; 
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $page = max(1, $page); // Đảm bảo page không nhỏ hơn 1
        $offset = ($page - 1) * $limit;

        // Lấy danh sách bài viết với phân trang
        $news = $this->newsModel->getAllNews($search, $limit, $offset);

        // Tính tổng số bài viết và số trang
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

        $id = intval($_GET['id']);
        $news = $this->newsModel->getNewsById($id);

        if (!$news) {
            header('Location: index.php?controller=news&action=index');
            exit;
        }

        require_once 'views/components/header.php';
        require_once 'views/pages/news_detail.php';
    }
}