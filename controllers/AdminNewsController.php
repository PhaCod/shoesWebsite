<?php
require_once 'models/NewsModel.php';

class AdminNewsController {
    private $newsModel;

    public function __construct() {
        $this->newsModel = new NewsModel();
    }

    public function manage() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header('Location: index.php?controller=auth&action=login');
            exit;
        }

        $search = isset($_GET['search']) ? trim($_GET['search']) : '';
        $limit = 5;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        $news = $this->newsModel->getNewsWithAdmin($search, $limit, $offset);
        $totalNews = $this->newsModel->getNewsCount($search);
        $totalPages = ceil($totalNews / $limit);

        require_once 'views/admin/components/header.php';
        require_once 'views/admin/pages/manage-news.php';
        require_once 'views/admin/components/admin_footer.php';
    }

    public function addNews() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header('Location: index.php?controller=auth&action=login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title']);
            $description = trim($_POST['description']);
            $content = trim($_POST['content']);
            $admin_id = $_SESSION['user_id'];
            $thumbnail = null;

            // Xử lý upload ảnh
            if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] === UPLOAD_ERR_OK) {
                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                $maxFileSize = 5 * 1024 * 1024; // 5MB

                $fileType = $_FILES['thumbnail']['type'];
                $fileSize = $_FILES['thumbnail']['size'];
                $fileTmp = $_FILES['thumbnail']['tmp_name'];

                // Kiểm tra loại file và kích thước
                if (!in_array($fileType, $allowedTypes)) {
                    $error = 'Chỉ cho phép upload file ảnh (JPEG, PNG, GIF).';
                } elseif ($fileSize > $maxFileSize) {
                    $error = 'Kích thước file không được vượt quá 5MB.';
                } else {
                    // Đổi tên file để tránh trùng lặp
                    $fileExt = pathinfo($_FILES['thumbnail']['name'], PATHINFO_EXTENSION);
                    $fileName = 'news_' . time() . '.' . $fileExt;
                    $uploadPath = 'assets/images/news/' . $fileName;

                    // Di chuyển file vào thư mục lưu trữ
                    if (move_uploaded_file($fileTmp, $uploadPath)) {
                        $thumbnail = $uploadPath;
                    } else {
                        $error = 'Không thể upload ảnh. Vui lòng thử lại.';
                    }
                }
            }

            if (empty($title) || empty($description) || empty($content)) {
                $error = 'Vui lòng điền đầy đủ các trường bắt buộc.';
            } else {
                if ($this->newsModel->addNews($title, $description, $content, $admin_id, $thumbnail)) {
                    $success = 'Thêm bài viết thành công!';
                } else {
                    $error = 'Không thể thêm bài viết. Vui lòng thử lại.';
                }
            }
        }

        require_once 'views/admin/components/header.php';
        require_once 'views/admin/pages/add-news.php';
        require_once 'views/admin/components/admin_footer.php';
    }

    public function editNews() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header('Location: index.php?controller=auth&action=login');
            exit;
        }

        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            header('Location: index.php?controller=adminNews&action=manage');
            exit;
        }

        $news_id = intval($_GET['id']);
        $edit_news = $this->newsModel->getNewsById($news_id);

        if (!$edit_news) {
            header('Location: index.php?controller=adminNews&action=manage');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title']);
            $description = trim($_POST['description']);
            $content = trim($_POST['content']);
            $thumbnail = $edit_news['thumbnail'];

            // Xử lý upload ảnh mới (nếu có)
            if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] === UPLOAD_ERR_OK) {
                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                $maxFileSize = 5 * 1024 * 1024; // 5MB

                $fileType = $_FILES['thumbnail']['type'];
                $fileSize = $_FILES['thumbnail']['size'];
                $fileTmp = $_FILES['thumbnail']['tmp_name'];

                if (!in_array($fileType, $allowedTypes)) {
                    $error = 'Chỉ cho phép upload file ảnh (JPEG, PNG, GIF).';
                } elseif ($fileSize > $maxFileSize) {
                    $error = 'Kích thước file không được vượt quá 5MB.';
                } else {
                    // Đổi tên file
                    $fileExt = pathinfo($_FILES['thumbnail']['name'], PATHINFO_EXTENSION);
                    $fileName = 'news_' . $news_id . '_' . time() . '.' . $fileExt;
                    $uploadPath = 'assets/images/news/' . $fileName;

                    // Xóa ảnh cũ nếu tồn tại
                    if ($thumbnail && file_exists($thumbnail)) {
                        unlink($thumbnail);
                    }

                    // Di chuyển file mới
                    if (move_uploaded_file($fileTmp, $uploadPath)) {
                        $thumbnail = $uploadPath;
                    } else {
                        $error = 'Không thể upload ảnh. Vui lòng thử lại.';
                    }
                }
            }

            if (empty($title) || empty($description) || empty($content)) {
                $error = 'Vui lòng điền đầy đủ các trường bắt buộc.';
            } else {
                if ($this->newsModel->updateNews($news_id, $title, $description, $content, $thumbnail)) {
                    $success = 'Cập nhật bài viết thành công!';
                    $edit_news = $this->newsModel->getNewsById($news_id); // Cập nhật lại dữ liệu sau khi sửa
                } else {
                    $error = 'Không thể cập nhật bài viết. Vui lòng thử lại.';
                }
            }
        }

        require_once 'views/admin/components/header.php';
        require_once 'views/admin/pages/edit-news.php';
        require_once 'views/admin/components/admin_footer.php';
    }

    public function deleteNews() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header('Location: index.php?controller=auth&action=login');
            exit;
        }

        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            header('Location: index.php?controller=adminNews&action=manage');
            exit;
        }

        $news_id = intval($_GET['id']);
        $news = $this->newsModel->getNewsById($news_id);

        // Xóa ảnh thumbnail nếu tồn tại
        if ($news && $news['thumbnail'] && file_exists($news['thumbnail'])) {
            unlink($news['thumbnail']);
        }

        if ($this->newsModel->deleteNews($news_id)) {
            $success = 'Xóa bài viết thành công!';
        } else {
            $error = 'Không thể xóa bài viết. Vui lòng thử lại.';
        }

        header('Location: index.php?controller=adminNews&action=manage');
        exit;
    }
}