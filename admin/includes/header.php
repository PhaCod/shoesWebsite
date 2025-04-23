<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - ShoeStore</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="admin-container">
        <div class="admin-sidebar">
            <h2>ShoeStore Admin</h2>
            <ul>
                <li><a href="index.php?page=dashboard" class="<?php echo $page === 'dashboard' ? 'active' : ''; ?>">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a></li>
                <li><a href="index.php?page=products" class="<?php echo $page === 'products' || $page === 'add-product' || $page === 'edit-product' ? 'active' : ''; ?>">
                    <i class="fas fa-shoe-prints"></i> Products
                </a></li>
                <li><a href="index.php?page=orders" class="<?php echo $page === 'orders' || $page === 'order-detail' ? 'active' : ''; ?>">
                    <i class="fas fa-shopping-cart"></i> Orders
                </a></li>
                <li><a href="index.php?page=customers" class="<?php echo $page === 'customers' ? 'active' : ''; ?>">
                    <i class="fas fa-users"></i> Customers
                </a></li>
                <li><a href="index.php?page=manage_news" class="<?php echo $page === 'manage_news' ? 'active' : ''; ?>">
                    <i class="fas fa-newspaper"></i> News
                </a></li>
                <li><a href="../index.php">
                    <i class="fas fa-home"></i> Back to Site
                </a></li>
                <li><a href="../includes/logout.php">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a></li>
            </ul>
        </div>
        <div class="admin-content">