<?php
// In a real application, this data would come from a database
// Sample data for demonstration purposes

// Monthly sales data
$monthly_sales = [
    'Jan' => 3200,
    'Feb' => 4100,
    'Mar' => 3800,
    'Apr' => 4600,
    'May' => 5200,
    'Jun' => 4800,
    'Jul' => 5500,
    'Aug' => 6100,
    'Sep' => 5800,
    'Oct' => 6300,
    'Nov' => 7200,
    'Dec' => 8500
];

// Category sales data
$category_sales = [
    'Men' => 42,
    'Women' => 28,
    'Kids' => 15,
    'Sports' => 15
];

// Top selling products
$top_products = [
    [
        'id' => 4,
        'name' => 'Formal Oxfords',
        'price' => 129.99,
        'sold' => 87,
        'revenue' => 11309.13
    ],
    [
        'id' => 2,
        'name' => 'Running Shoes',
        'price' => 99.99,
        'sold' => 76,
        'revenue' => 7599.24
    ],
    [
        'id' => 8,
        'name' => 'Basketball Shoes',
        'price' => 119.99,
        'sold' => 62,
        'revenue' => 7439.38
    ],
    [
        'id' => 6,
        'name' => 'High Heels',
        'price' => 89.99,
        'sold' => 58,
        'revenue' => 5219.42
    ],
    [
        'id' => 1,
        'name' => 'Classic Sneakers',
        'price' => 79.99,
        'sold' => 54,
        'revenue' => 4319.46
    ]
];

// Calculate total revenue
$total_revenue = array_sum($monthly_sales);
$total_orders = 542;
$average_order_value = number_format($total_revenue / $total_orders, 2);

// Current month vs previous month
$current_month = $monthly_sales['Dec'];
$previous_month = $monthly_sales['Nov'];
$growth_percentage = number_format((($current_month - $previous_month) / $previous_month) * 100, 1);

// Date range filter (in a real application, this would filter the data)
$date_range = isset($_GET['date_range']) ? $_GET['date_range'] : 'year';
?>

<div class="admin-header">
    <h1>Sales Analytics</h1>
    <div class="date-filter">
        <form method="get" action="">
            <select name="date_range" onchange="this.form.submit()">
                <option value="week" <?php echo $date_range === 'week' ? 'selected' : ''; ?>>Last Week</option>
                <option value="month" <?php echo $date_range === 'month' ? 'selected' : ''; ?>>Last Month</option>
                <option value="quarter" <?php echo $date_range === 'quarter' ? 'selected' : ''; ?>>Last Quarter</option>
                <option value="year" <?php echo $date_range === 'year' ? 'selected' : ''; ?>>Last Year</option>
            </select>
        </form>
    </div>
</div>

<div class="admin-stats">
    <div class="stat-card">
        <h3>$<?php echo number_format($total_revenue); ?></h3>
        <p>Total Revenue</p>
    </div>
    <div class="stat-card">
        <h3><?php echo $total_orders; ?></h3>
        <p>Total Orders</p>
    </div>
    <div class="stat-card">
        <h3>$<?php echo $average_order_value; ?></h3>
        <p>Average Order Value</p>
    </div>
    <div class="stat-card">
        <h3><?php echo $growth_percentage; ?>%</h3>
        <p>Monthly Growth</p>
        <div class="growth-indicator <?php echo $growth_percentage >= 0 ? 'positive' : 'negative'; ?>">
            <i class="fas <?php echo $growth_percentage >= 0 ? 'fa-arrow-up' : 'fa-arrow-down'; ?>"></i>
        </div>
    </div>
</div>

<div class="analytics-grid">
    <div class="analytics-card">
        <h2>Monthly Sales</h2>
        <div class="chart-container">
            <canvas id="monthlySalesChart"></canvas>
        </div>
    </div>
    
    <div class="analytics-card">
        <h2>Sales by Category</h2>
        <div class="chart-container">
            <canvas id="categorySalesChart"></canvas>
        </div>
    </div>
    
    <div class="analytics-card full-width">
        <h2>Top Selling Products</h2>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Units Sold</th>
                    <th>Revenue</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($top_products as $product): ?>
                    <tr>
                        <td><?php echo $product['name']; ?></td>
                        <td>$<?php echo number_format($product['price'], 2); ?></td>
                        <td><?php echo $product['sold']; ?></td>
                        <td>$<?php echo number_format($product['revenue'], 2); ?></td>
                        <td><a href="index.php?page=edit-product&id=<?php echo $product['id']; ?>" class="btn-view">View</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <div class="analytics-card">
        <h2>Recent Sales</h2>
        <div class="recent-sales">
            <div class="sale-item">
                <div class="sale-info">
                    <h4>Order #1012</h4>
                    <p>John Doe</p>
                </div>
                <div class="sale-amount">$249.98</div>
                <div class="sale-time">2 hours ago</div>
            </div>
            <div class="sale-item">
                <div class="sale-info">
                    <h4>Order #1011</h4>
                    <p>Jane Smith</p>
                </div>
                <div class="sale-amount">$129.99</div>
                <div class="sale-time">5 hours ago</div>
            </div>
            <div class="sale-item">
                <div class="sale-info">
                    <h4>Order #1010</h4>
                    <p>Robert Johnson</p>
                </div>
                <div class="sale-amount">$89.99</div>
                <div class="sale-time">8 hours ago</div>
            </div>
            <div class="sale-item">
                <div class="sale-info">
                    <h4>Order #1009</h4>
                    <p>Emily Davis</p>
                </div>
                <div class="sale-amount">$199.98</div>
                <div class="sale-time">12 hours ago</div>
            </div>
            <div class="sale-item">
                <div class="sale-info">
                    <h4>Order #1008</h4>
                    <p>Michael Wilson</p>
                </div>
                <div class="sale-amount">$159.99</div>
                <div class="sale-time">1 day ago</div>
            </div>
        </div>
    </div>
    
    <div class="analytics-card">
        <h2>Customer Demographics</h2>
        <div class="chart-container">
            <canvas id="customerDemographicsChart"></canvas>
        </div>
        <div class="demographics-info">
            <div class="demo-item">
                <h4>Age Groups</h4>
                <p>18-24: 22%</p>
                <p>25-34: 38%</p>
                <p>35-44: 25%</p>
                <p>45+: 15%</p>
            </div>
            <div class="demo-item">
                <h4>Gender</h4>
                <p>Male: 55%</p>
                <p>Female: 45%</p>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Monthly Sales Chart
    const monthlySalesCtx = document.getElementById('monthlySalesChart').getContext('2d');
    const monthlySalesChart = new Chart(monthlySalesCtx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode(array_keys($monthly_sales)); ?>,
            datasets: [{
                label: 'Monthly Sales ($)',
                data: <?php echo json_encode(array_values($monthly_sales)); ?>,
                backgroundColor: 'rgba(255, 107, 107, 0.2)',
                borderColor: 'rgba(255, 107, 107, 1)',
                borderWidth: 2,
                tension: 0.3,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
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
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    // Category Sales Chart
    const categorySalesCtx = document.getElementById('categorySalesChart').getContext('2d');
    const categorySalesChart = new Chart(categorySalesCtx, {
        type: 'doughnut',
        data: {
            labels: <?php echo json_encode(array_keys($category_sales)); ?>,
            datasets: [{
                data: <?php echo json_encode(array_values($category_sales)); ?>,
                backgroundColor: [
                    'rgba(255, 107, 107, 0.8)',
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(255, 206, 86, 0.8)',
                    'rgba(75, 192, 192, 0.8)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'right'
                }
            }
        }
    });

    // Customer Demographics Chart
    const customerDemographicsCtx = document.getElementById('customerDemographicsChart').getContext('2d');
    const customerDemographicsChart = new Chart(customerDemographicsCtx, {
        type: 'bar',
        data: {
            labels: ['18-24', '25-34', '35-44', '45+'],
            datasets: [{
                label: 'Age Distribution (%)',
                data: [22, 38, 25, 15],
                backgroundColor: 'rgba(255, 107, 107, 0.8)'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    max: 50,
                    grid: {
                        drawBorder: false
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
});
</script>
