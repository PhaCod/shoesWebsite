<?php
// Main entry point for the website
session_start();

// Simple routing
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Header
include 'includes/header.php';

// Content
switch ($page) {
    case 'home':
        include 'pages/home.php';
        break;
    case 'products':
        include 'pages/products.php';
        break;
    case 'product-detail':
        include 'pages/product-detail.php';
        break;
    case 'cart':
        include 'pages/cart.php';
        break;
    case 'checkout':
        include 'pages/checkout.php';
        break;
    case 'login':
        include 'pages/login.php';
        break;
    case 'register':
        include 'pages/register.php';
        break;
    default:
        include 'pages/home.php';
        break;
}

// Footer
include 'includes/footer.php';
?>

