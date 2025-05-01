<?php
session_start();

// Kiểm tra xem người dùng đã đăng nhập với quyền admin chưa
if (!isset($_SESSION['user_id']) || !isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    // Nếu không phải admin, chuyển hướng về trang đăng nhập
    header('Location: ../index.php?page=login');
    exit;
}

// Định tuyến đơn giản
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

// Bao gồm header
include 'includes/header.php';

// Nội dung
switch ($page) {
    case 'dashboard':
        include 'pages/dashboard.php';
        break;
    case 'analytics':
        include 'pages/analytics.php';
        break;
    case 'products':
        include 'pages/products.php';
        break;
    case 'add-product':
        include 'pages/add-product.php';
        break;
    case 'edit-product':
        include 'pages/edit-product.php';
        break;
    case 'inventory':
        include 'pages/inventory.php';
        break;
    case 'categories':
        include 'pages/categories.php';
        break;
    case 'orders':
        include 'pages/orders.php';
        break;
    case 'order-detail':
        include 'pages/order-detail.php';
        break;
    case 'customers':
        include 'pages/customers.php';
        break;
    case 'settings':
        include 'pages/settings.php';
        break;
    default:
        include 'pages/dashboard.php';
        break;
}

// Bao gồm footer
include 'includes/footer.php';
?>
