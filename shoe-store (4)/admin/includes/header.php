<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - ShoeStore</title>
    <link rel="stylesheet" href="../assets/css/admin-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <button class="mobile-menu-btn">
        <i class="fas fa-bars"></i>
    </button>
    <div class="admin-container">
        <div class="admin-sidebar">
            <div class="sidebar-header">
                <h2><i class="fas fa-shoe-prints"></i> ShoeStore</h2>
            </div>
            
            <div class="sidebar-nav">
                <div class="sidebar-nav-group">
                    <div class="sidebar-nav-group-title">Dashboard</div>
                    <ul class="sidebar-nav-items">
                        <li class="sidebar-nav-item">
                            <a href="index.php?page=dashboard" class="sidebar-nav-link <?php echo $page === 'dashboard' ? 'active' : ''; ?>">
                                <i class="fas fa-tachometer-alt"></i>
                                <span>Overview</span>
                            </a>
                        </li>
                        <li class="sidebar-nav-item">
                            <a href="index.php?page=analytics" class="sidebar-nav-link <?php echo $page === 'analytics' ? 'active' : ''; ?>">
                                <i class="fas fa-chart-line"></i>
                                <span>Analytics</span>
                            </a>
                        </li>
                    </ul>
                </div>
                
                <div class="sidebar-nav-group">
                    <div class="sidebar-nav-group-title">Catalog</div>
                    <ul class="sidebar-nav-items">
                        <li class="sidebar-nav-item">
                            <a href="index.php?page=products" class="sidebar-nav-link <?php echo $page === 'products' || $page === 'add-product' || $page === 'edit-product' ? 'active' : ''; ?>">
                                <i class="fas fa-box"></i>
                                <span>Products</span>
                            </a>
                        </li>
                        <li class="sidebar-nav-item">
                            <a href="index.php?page=inventory" class="sidebar-nav-link <?php echo $page === 'inventory' ? 'active' : ''; ?>">
                                <i class="fas fa-warehouse"></i>
                                <span>Inventory</span>
                            </a>
                        </li>
                        <li class="sidebar-nav-item">
                            <a href="index.php?page=categories" class="sidebar-nav-link <?php echo $page === 'categories' ? 'active' : ''; ?>">
                                <i class="fas fa-tags"></i>
                                <span>Categories</span>
                            </a>
                        </li>
                    </ul>
                </div>
                
                <div class="sidebar-nav-group">
                    <div class="sidebar-nav-group-title">Sales</div>
                    <ul class="sidebar-nav-items">
                        <li class="sidebar-nav-item">
                            <a href="index.php?page=orders" class="sidebar-nav-link <?php echo $page === 'orders' || $page === 'order-detail' ? 'active' : ''; ?>">
                                <i class="fas fa-shopping-cart"></i>
                                <span>Orders</span>
                            </a>
                        </li>
                        <li class="sidebar-nav-item">
                            <a href="index.php?page=customers" class="sidebar-nav-link <?php echo $page === 'customers' ? 'active' : ''; ?>">
                                <i class="fas fa-users"></i>
                                <span>Customers</span>
                            </a>
                        </li>
                    </ul>
                </div>
                
                <div class="sidebar-nav-group">
                    <div class="sidebar-nav-group-title">Settings</div>
                    <ul class="sidebar-nav-items">
                        <li class="sidebar-nav-item">
                            <a href="index.php?page=settings" class="sidebar-nav-link <?php echo $page === 'settings' ? 'active' : ''; ?>">
                                <i class="fas fa-cog"></i>
                                <span>General</span>
                            </a>
                        </li>
                        <li class="sidebar-nav-item">
                            <a href="../index.php" class="sidebar-nav-link">
                                <i class="fas fa-home"></i>
                                <span>Back to Site</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="sidebar-footer">
                <div class="user-info">
                    <div class="user-avatar">
                        A
                    </div>
                    <div class="user-details">
                        <div class="user-name">Admin User</div>
                        <div class="user-role">Administrator</div>
                    </div>
                </div>
                <a href="../includes/logout.php" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </div>
        
        <div class="admin-content">
