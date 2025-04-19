<?php
session_start();

// Check if user is logged in as admin
// In a real application, you would check against admin credentials in a database
if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] != 1) {
    header('Location: ../index.php?page=login');
    exit;
}

// Simple routing
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

// Include header
include 'includes/header.php';

// Content
switch ($page) {
    case 'dashboard':
        include 'pages/dashboard.php';
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
    case 'orders':
        include 'pages/orders.php';
        break;
    case 'order-detail':
        include 'pages/order-detail.php';
        break;
    case 'customers':
        include 'pages/customers.php';
        break;
    default:
        include 'pages/dashboard.php';
        break;
}

// Include footer
include 'includes/footer.php';
?>

