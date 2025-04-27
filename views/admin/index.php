<?php
session_start();

// Kiểm tra quyền truy cập
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: /shoesWebsite/index.php?controller=auth&action=login');
    exit;
}

// Autoload classes
spl_autoload_register(function ($class_name) {
    $controllerPath = '../controllers/' . $class_name . '.php';
    $modelPath = '../models/' . $class_name . '.php';

    if (file_exists($controllerPath)) {
        require_once $controllerPath;
    } elseif (file_exists($modelPath)) {
        require_once $modelPath;
    }
});

// Lấy controller và action từ URL
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'adminDashboard';
$action = isset($_GET['action']) ? $_GET['action'] : 'dashboard';

// Chuyển đổi controller thành tên lớp (ví dụ: adminDashboard → AdminDashboardController)
$controllerClass = ucfirst($controller) . 'Controller';

// Kiểm tra controller tồn tại
if (!class_exists($controllerClass)) {
    // Chuyển hướng đến trang lỗi 404 hoặc hiển thị thông báo
    header('HTTP/1.0 404 Not Found');
    require_once '../views/errors/404.php';
    exit;
}

$controllerInstance = new $controllerClass();

// Kiểm tra action tồn tại
if (!method_exists($controllerInstance, $action)) {
    // Chuyển hướng đến trang lỗi 404 hoặc hiển thị thông báo
    header('HTTP/1.0 404 Not Found');
    require_once '../views/errors/404.php';
    exit;
}

// Gọi action
$controllerInstance->$action();