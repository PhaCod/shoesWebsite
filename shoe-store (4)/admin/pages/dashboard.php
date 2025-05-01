<div class="admin-header">
    <h1>Dashboard</h1>
    <div class="admin-header-actions">
        <button class="btn btn-secondary">
            <i class="fas fa-calendar"></i> <?php echo date('F d, Y'); ?>
        </button>
        <button class="btn btn-primary">
            <i class="fas fa-plus"></i> New Product
        </button>
    </div>
</div>

<div class="admin-stats">
    <div class="stat-card">
        <div class="stat-card-icon revenue">
            <i class="fas fa-dollar-sign"></i>
        </div>
        <p>Total Revenue</p>
        <h3>$3,240</h3>
        <div class="stat-card-trend trend-up">
            <i class="fas fa-arrow-up"></i> 12.5% from last month
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-card-icon orders">
            <i class="fas fa-shopping-bag"></i>
        </div>
        <p>Total Orders</p>
        <h3>42</h3>
        <div class="stat-card-trend trend-up">
            <i class="fas fa-arrow-up"></i> 8.2% from last month
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-card-icon customers">
            <i class="fas fa-users"></i>
        </div>
        <p>Total Customers</p>
        <h3>128</h3>
        <div class="stat-card-trend trend-up">
            <i class="fas fa-arrow-up"></i> 5.3% from last month
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-card-icon products">
            <i class="fas fa-box"></i>
        </div>
        <p>Total Products</p>
        <h3>24</h3>
        <div class="stat-card-trend trend-down">
            <i class="fas fa-arrow-down"></i> 2.1% from last month
        </div>
    </div>
</div>

<div class="widget-grid">
    <div class="widget two-thirds">
        <div class="widget-header">
            <h3 class="widget-title">Sales Overview</h3>
            <div class="widget-more">
                <i class="fas fa-ellipsis-v"></i>
            </div>
        </div>
        <div class="chart-container">
            <canvas id="salesChart"></canvas>
        </div>
    </div>
    
    <div class="widget">
        <div class="widget-header">
            <h3 class="widget-title">Top Selling Categories</h3>
            <div class="widget-more">
                <i class="fas fa-ellipsis-v"></i>
            </div>
        </div>
        <div class="chart-container">
            <canvas id="categoriesChart"></canvas>
        </div>
    </div>
    
    <div class="widget">
        <div class="widget-header">
            <h3 class="widget-title">Recent Activity</h3>
            <div class="widget-more">
                <i class="fas fa-ellipsis-v"></i>
            </div>
        </div>
        <div class="activity-feed">
            <div class="activity-item">
                <div class="activity-icon order">
                    <i class="fas fa-shopping-bag"></i>
                </div>
                <div class="activity-content">
                    <p class="activity-title">New order #1012 from John Doe</p>
                    <p class="activity-time">2 hours ago</p>
                </div>
            </div>
            <div class="activity-item">
                <div class="activity-icon user">
                    <i class="fas fa-user"></i>
                </div>
                <div class="activity-content">
                    <p class="activity-title">New customer registered: Jane Smith</p>
                    <p class="activity-time">5 hours ago</p>
                </div>
            </div>
            <div class="activity-item">
                <div class="activity-icon product">
                    <i class="fas fa-box"></i>
                </div>
                <div class="activity-content">
                    <p class="activity-title">Product "Running Shoes" is low on stock</p>
                    <p class="activity-time">8 hours ago</p>
                </div>
            </div>
            <div class="activity-item">
                <div class="activity-icon order">
                    <i class="fas fa-shopping-bag"></i>
                </div>
                <div class="activity-content">
                    <p class="activity-title">Order #1011 has been shipped</p>
                    <p class="activity-time">1 day ago</p>
                </div>
            </div>
            <div class="activity-item">
                <div class="activity-icon user">
                    <i class="fas fa-user"></i>
                </div>
                <div class="activity-content">
                    <p class="activity-title">New customer registered: Robert Johnson</p>
                    <p class="activity-time">1 day ago</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="widget">
        <div class="widget-header">
            <h3 class="widget-title">Top Selling Products</h3>
            <div class="widget-more">
                <i class="fas fa-ellipsis-v"></i>
            </div>
        </div>
        <div class="progress-container">
            <div class="progress-label">
                <p class="progress-title">Formal Oxfords</p>
                <p class="progress-value">87 sold</p>
            </div>
            <div class="progress-bar">
                <div class="progress-fill primary" style="width: 87%;"></div>
            </div>
        </div>
        <div class="progress-container">
            <div class="progress-label">
                <p class="progress-title">Running Shoes</p>
                <p class="progress-value">76 sold</p>
            </div>
            <div class="progress-bar">
                <div class="progress-fill success" style="width: 76%;"></div>
            </div>
        </div>
        <div class="progress-container">
            <div class="progress-label">
                <p class="progress-title">Basketball Shoes</p>
                <p class="progress-value">62 sold</p>
            </div>
            <div class="progress-bar">
                <div class="progress-fill warning" style="width: 62%;"></div>
            </div>
        </div>
        <div class="progress-container">
            <div class="progress-label">
                <p class="progress-title">High Heels</p>
                <p class="progress-value">58 sold</p>
            </div>
            <div class="progress-bar">
                <div class="progress-fill danger" style="width: 58%;"></div>
            </div>
        </div>
    </div>
    
    <div class="widget two-thirds">
        <div class="widget-header">
            <h3 class="widget-title">Recent Orders</h3>
            <div class="widget-more">
                <i class="fas fa-ellipsis-v"></i>
            </div>
        </div>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>#1001</td>
                    <td>John Doe</td>
                    <td>Jun 12, 2023</td>
                    <td>$129.99</td>
                    <td><span class="status-badge status-delivered">Delivered</span></td>
                    <td><a href="index.php?page=order-detail&id=1001" class="btn-view">View</a></td>
                </tr>
                <tr>
                    <td>#1002</td>
                    <td>Jane Smith</td>
                    <td>Jun 11, 2023</td>
                    <td>$89.99</td>
                    <td><span class="status-badge status-shipped">Shipped</span></td>
                    <td><a href="index.php?page=order-detail&id=1002" class="btn-view">View</a></td>
                </tr>
                <tr>
                    <td>#1003</td>
                    <td>Robert Johnson</td>
                    <td>Jun 10, 2023</td>
                    <td>$199.99</td>
                    <td><span class="status-badge status-processing">Processing</span></td>
                    <td><a href="index.php?page=order-detail&id=1003" class="btn-view">View</a></td>
                </tr>
                <tr>
                    <td>#1004</td>
                    <td>Emily Davis</td>
                    <td>Jun 9, 2023</td>
                    <td>$149.99</td>
                    <td><span class="status-badge status-delivered">Delivered</span></td>
                    <td><a href="index.php?page=order-detail&id=1004" class="btn-view">View</a></td>
                </tr>
                <tr>
                    <td>#1005</td>
                    <td>Michael Wilson</td>
                    <td>Jun 8, 2023</td>
                    <td>$79.99</td>
                    <td><span class="status-badge status-cancelled">Cancelled</span></td>
                    <td><a href="index.php?page=order-detail&id=1005" class="btn-view">View</a></td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <div class="widget">
        <div class="widget-header">
            <h3 class="widget-title">Inventory Status</h3>
            <div class="widget-more">
                <i class="fas fa-ellipsis-v"></i>
            </div>
        </div>
        <div class="quick-stats">
            <div class="quick-stat">
                <p class="quick-stat-value">24</p>
                <p class="quick-stat-label">Total</p>
            </div>
            <div class="quick-stat">
                <p class="quick-stat-value">18</p>
                <p class="quick-stat-label">In Stock</p>
            </div>
            <div class="quick-stat">
                <p class="quick-stat-value">4</p>
                <p class="quick-stat-label">Low Stock</p>
            </div>
            <div class="quick-stat">
                <p class="quick-stat-value">2</p>
                <p class="quick-stat-label">Out of Stock</p>
            </div>
        </div>
        <div class="chart-container">
            <canvas id="inventoryChart"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Sales Chart
    const salesCtx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(salesCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Sales',
                data: [3200, 4100, 3800, 4600, 5200, 4800, 5500, 6100, 5800, 6300, 7200, 8500],
                backgroundColor: 'rgba(79, 70, 229, 0.1)',
                borderColor: '#4f46e5',
                borderWidth: 2,
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        drawBorder: false
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });

    // Categories Chart
    const categoriesCtx = document.getElementById('categoriesChart').getContext('2d');
    const categoriesChart = new Chart(categoriesCtx, {
        type: 'doughnut',
        data: {
            labels: ['Men', 'Women', 'Kids', 'Sports'],
            datasets: [{
                data: [42, 28, 15, 15],
                backgroundColor: [
                    '#4f46e5',
                    '#10b981',
                    '#f59e0b',
                    '#ef4444'
                ],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            },
            cutout: '70%'
        }
    });

    // Inventory Chart
    const inventoryCtx = document.getElementById('inventoryChart').getContext('2d');
    const inventoryChart = new Chart(inventoryCtx, {
        type: 'bar',
        data: {
            labels: ['In Stock', 'Low Stock', 'Out of Stock'],
            datasets: [{
                data: [18, 4, 2],
                backgroundColor: [
                    '#10b981',
                    '#f59e0b',
                    '#ef4444'
                ],
                borderWidth: 0,
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        drawBorder: false
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
});
</script>
