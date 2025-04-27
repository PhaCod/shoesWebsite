<?php
require_once 'models/NewsModel.php';

class NewsController {
    private $newsModel;

    public function __construct() {
        $this->newsModel = new NewsModel();
    }

    public function index() {
        $search = isset($_GET['search']) ? trim($_GET['search']) : '';
        $news = $this->newsModel->getAllNews($search);
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

    public function manage() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header('Location: index.php?controller=auth&action=login');
            exit;
        }

        // Xử lý thêm bài viết
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_news'])) {
            $title = trim($_POST['title']);
            $description = trim($_POST['description']);
            $content = trim($_POST['content']);
            $admin_id = $_SESSION['user_id'];

            if (empty($title) || empty($description) || empty($content)) {
                $error = 'All fields are required.';
            } else {
                if ($this->newsModel->addNews($title, $description, $content, $admin_id)) {
                    $success = 'News added successfully!';
                } else {
                    $error = 'Failed to add news.';
                }
            }
        }

        // Xử lý sửa bài viết
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_news'])) {
            $news_id = intval($_POST['news_id']);
            $title = trim($_POST['title']);
            $description = trim($_POST['description']);
            $content = trim($_POST['content']);

            if (empty($title) || empty($description) || empty($content)) {
                $error = 'All fields are required.';
            } else {
                if ($this->newsModel->updateNews($news_id, $title, $description, $content)) {
                    $success = 'News updated successfully!';
                } else {
                    $error = 'Failed to update news.';
                }
            }
        }

        // Xử lý xóa bài viết
        if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
            $news_id = intval($_GET['id']);
            if ($this->newsModel->deleteNews($news_id)) {
                $success = 'News deleted successfully!';
            } else {
                $error = 'Failed to delete news.';
            }
        }

        // Tìm kiếm bài viết
        $search = isset($_GET['search']) ? trim($_GET['search']) : '';
        $news = $this->newsModel->getNewsWithAdmin($search);

        // Lấy bài viết để sửa
        $edit_news = null;
        if (isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['id'])) {
            $news_id = intval($_GET['id']);
            $edit_news = $this->newsModel->getNewsById($news_id);
        }

        require_once 'views/admin/components/header.php';
        require_once 'views/admin/pages/manage_news.php';
    }
}