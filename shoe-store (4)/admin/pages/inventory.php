<?php
// In a real application, this data would come from a database
// Sample data for demonstration purposes

// Inventory data
$inventory = [
    [
        'id' => 1,
        'name' => 'Classic Sneakers',
        'sku' => 'SNK-CLS-001',
        'category' => 'Men',
        'stock' => 45,
        'reorder_level' => 20,
        'status' => 'In Stock'
    ],
    [
        'id' => 2,
        'name' => 'Running Shoes',
        'sku' => 'RUN-PRO-002',
        'category' => 'Sports',
        'stock' => 32,
        'reorder_level' => 15,
        'status' => 'In Stock'
    ],
    [
        'id' => 3,
        'name' => 'Casual Loafers',
        'sku' => 'LOF-CAS-003',
        'category' => 'Men',
        'stock' => 18,
        'reorder_level' => 20,
        'status' => 'Low Stock'
    ],
    [
        'id' => 4,
        'name' => 'Formal Oxfords',
        'sku' => 'OXF-FRM-004',
        'category' => 'Men',
        'stock' => 27,
        'reorder_level' => 15,
        'status' => 'In Stock'
    ],
    [
        'id' => 5,
        'name' => 'Women\'s Flats',
        'sku' => 'FLT-WMN-005',
        'category' => 'Women',
        'stock' => 12,
        'reorder_level' => 15,
        'status' => 'Low Stock'
    ],
    [
        'id' => 6,
        'name' => 'High Heels',
        'sku' => 'HEL-WMN-006',
        'category' => 'Women',
        'stock' => 23,
        'reorder_level' => 15,
        'status' => 'In Stock'
    ],
    [
        'id' => 7,
        'name' => 'Kids\' Sneakers',
        'sku' => 'SNK-KID-007',
        'category' => 'Kids',
        'stock' => 8,
        'reorder_level' => 10,
        'status' => 'Low Stock'
    ],
    [
        'id' => 8,
        'name' => 'Basketball Shoes',
        'sku' => 'BSK-SPT-008',
        'category' => 'Sports',
        'stock' => 0,
        'reorder_level' => 10,
        'status' => 'Out of Stock'
    ],
    [
        'id' => 9,
        'name' => 'Hiking Boots',
        'sku' => 'HIK-OUT-009',
        'category' => 'Sports',
        'stock' => 14,
        'reorder_level' => 10,
        'status' => 'In Stock'
    ],
    [
        'id' => 10,
        'name' => 'Slip-on Shoes',
        'sku' => 'SLP-CAS-010',
        'category' => 'Men',
        'stock' => 19,
        'reorder_level' => 15,
        'status' => 'In Stock'
    ]
];

// Filter by category if specified
$category_filter = isset($_GET['category']) ? $_GET['category'] : '';
$status_filter = isset($_GET['status']) ? $_GET['status'] : '';

// Apply filters
$filtered_inventory = $inventory;
if (!empty($category_filter)) {
    $filtered_inventory = array_filter($filtered_inventory, function($item) use ($category_filter) {
        return $item['category'] === $category_filter;
    });
}
if (!empty($status_filter)) {
    $filtered_inventory = array_filter($filtered_inventory, function($item) use ($status_filter) {
        return $item['status'] === $status_filter;
    });
}

// Get unique categories and statuses for filter dropdowns
$categories = array_unique(array_column($inventory, 'category'));
$statuses = array_unique(array_column($inventory, 'status'));
?>

<div class="admin-header">
    <h1>Inventory Management</h1>
    <a href="#" class="btn" onclick="document.getElementById('import-modal').style.display='block'">Import Inventory</a>
</div>

<div class="inventory-filters">
    <form method="get" action="">
        <input type="hidden" name="page" value="inventory">
        <div class="filter-group">
            <label for="category">Category:</label>
            <select name="category" id="category">
                <option value="">All Categories</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?php echo $category; ?>" <?php echo $category_filter === $category ? 'selected' : ''; ?>><?php echo $category; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="filter-group">
            <label for="status">Status:</label>
            <select name="status" id="status">
                <option value="">All Statuses</option>
                <?php foreach ($statuses as $status): ?>
                    <option value="<?php echo $status; ?>" <?php echo $status_filter === $status ? 'selected' : ''; ?>><?php echo $status; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn-filter">Apply Filters</button>
        <a href="index.php?page=inventory" class="btn-reset">Reset</a>
    </form>
</div>

<div class="inventory-summary">
    <div class="summary-card">
        <h3><?php echo count($inventory); ?></h3>
        <p>Total Products</p>
    </div>
    <div class="summary-card">
        <h3><?php echo count(array_filter($inventory, function($item) { return $item['status'] === 'In Stock'; })); ?></h3>
        <p>In Stock</p>
    </div>
    <div class="summary-card">
        <h3><?php echo count(array_filter($inventory, function($item) { return $item['status'] === 'Low Stock'; })); ?></h3>
        <p>Low Stock</p>
    </div>
    <div class="summary-card">
        <h3><?php echo count(array_filter($inventory, function($item) { return $item['status'] === 'Out of Stock'; })); ?></h3>
        <p>Out of Stock</p>
    </div>
</div>

<div class="inventory-table-container">
    <table class="admin-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>SKU</th>
                <th>Category</th>
                <th>Stock</th>
                <th>Reorder Level</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($filtered_inventory)): ?>
                <tr>
                    <td colspan="8" class="no-results">No products found matching your filters.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($filtered_inventory as $item): ?>
                    <tr class="<?php echo strtolower(str_replace(' ', '-', $item['status'])); ?>">
                        <td><?php echo $item['id']; ?></td>
                        <td><?php echo $item['name']; ?></td>
                        <td><?php echo $item['sku']; ?></td>
                        <td><?php echo $item['category']; ?></td>
                        <td><?php echo $item['stock']; ?></td>
                        <td><?php echo $item['reorder_level']; ?></td>
                        <td>
                            <span class="status-badge <?php echo strtolower(str_replace(' ', '-', $item['status'])); ?>">
                                <?php echo $item['status']; ?>
                            </span>
                        </td>
                        <td>
                            <button class="btn-update-stock" onclick="openStockModal(<?php echo $item['id']; ?>, '<?php echo $item['name']; ?>', <?php echo $item['stock']; ?>)">Update Stock</button>
                            <a href="index.php?page=edit-product&id=<?php echo $item['id']; ?>" class="btn-edit">Edit</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Update Stock Modal -->
<div id="stock-modal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="document.getElementById('stock-modal').style.display='none'">&times;</span>
        <h2>Update Stock</h2>
        <form id="update-stock-form" method="post" action="">
            <input type="hidden" id="product-id" name="product_id">
            <div class="form-group">
                <label for="product-name-display">Product:</label>
                <div id="product-name-display" class="product-name-display"></div>
            </div>
            <div class="form-group">
                <label for="current-stock">Current Stock:</label>
                <div id="current-stock" class="current-stock"></div>
            </div>
            <div class="form-group">
                <label for="stock-adjustment">Adjustment:</label>
                <div class="stock-adjustment-controls">
                    <button type="button" class="btn-adjust" onclick="adjustStock(-1)">-</button>
                    <input type="number" id="stock-adjustment" name="stock_adjustment" value="0">
                    <button type="button" class="btn-adjust" onclick="adjustStock(1)">+</button>
                </div>
            </div>
            <div class="form-group">
                <label for="adjustment-reason">Reason:</label>
                <select id="adjustment-reason" name="adjustment_reason" required>
                    <option value="">Select Reason</option>
                    <option value="new_stock">New Stock</option>
                    <option value="returned">Returned</option>
                    <option value="damaged">Damaged</option>
                    <option value="correction">Inventory Correction</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="adjustment-notes">Notes:</label>
                <textarea id="adjustment-notes" name="adjustment_notes" rows="3"></textarea>
            </div>
            <div class="form-actions">
                <button type="button" class="btn-cancel" onclick="document.getElementById('stock-modal').style.display='none'">Cancel</button>
                <button type="submit" name="update_stock" class="btn-submit">Update Stock</button>
            </div>
        </form>
    </div>
  class="btn-submit">Update Stock</button>
            </div>
        </form>
    </div>
</div>

<!-- Import Inventory Modal -->
<div id="import-modal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="document.getElementById('import-modal').style.display='none'">&times;</span>
        <h2>Import Inventory</h2>
        <form method="post" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="import-file">CSV File:</label>
                <input type="file" id="import-file" name="import_file" accept=".csv" required>
            </div>
            <div class="form-info">
                <p>Please upload a CSV file with the following columns:</p>
                <ul>
                    <li>SKU (required)</li>
                    <li>Product Name (required)</li>
                    <li>Category (required)</li>
                    <li>Stock Quantity (required)</li>
                    <li>Reorder Level</li>
                </ul>
                <p><a href="#" class="download-template">Download Template</a></p>
            </div>
            <div class="form-actions">
                <button type="button" class="btn-cancel" onclick="document.getElementById('import-modal').style.display='none'">Cancel</button>
                <button type="submit" name="import_inventory" class="btn-submit">Import</button>
            </div>
        </form>
    </div>
</div>

<script>
function openStockModal(productId, productName, currentStock) {
    document.getElementById('product-id').value = productId;
    document.getElementById('product-name-display').textContent = productName;
    document.getElementById('current-stock').textContent = currentStock;
    document.getElementById('stock-adjustment').value = 0;
    document.getElementById('stock-modal').style.display = 'block';
}

function adjustStock(amount) {
    const input = document.getElementById('stock-adjustment');
    input.value = parseInt(input.value) + amount;
}
</script>

<style>
/* Inventory Management Styles */
.inventory-filters {
    background-color: #f8f9fa;
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 20px;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
}

.filter-group {
    margin-right: 15px;
    margin-bottom: 10px;
}

.filter-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

.filter-group select {
    padding: 8px 12px;
    border: 1px solid #ddd;
    border-radius: 4px;
    min-width: 150px;
}

.btn-filter, .btn-reset {
    padding: 8px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin-right: 10px;
}

.btn-filter {
    background-color: #ff6b6b;
    color: white;
}

.btn-reset {
    background-color: #f1f1f1;
    color: #333;
    text-decoration: none;
    display: inline-block;
}

.inventory-summary {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 15px;
    margin-bottom: 20px;
}

.summary-card {
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    padding: 15px;
    text-align: center;
}

.summary-card h3 {
    font-size: 24px;
    margin: 0 0 5px;
    color: #ff6b6b;
}

.summary-card p {
    margin: 0;
    color: #777;
}

.inventory-table-container {
    overflow-x: auto;
}

.status-badge {
    display: inline-block;
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: bold;
}

.status-badge.in-stock {
    background-color: #e6f7e6;
    color: #28a745;
}

.status-badge.low-stock {
    background-color: #fff3cd;
    color: #ffc107;
}

.status-badge.out-of-stock {
    background-color: #f8d7da;
    color: #dc3545;
}

tr.low-stock {
    background-color: rgba(255, 193, 7, 0.05);
}

tr.out-of-stock {
    background-color: rgba(220, 53, 69, 0.05);
}

.btn-update-stock {
    background-color: #6c757d;
    color: white;
    border: none;
    padding: 5px 10px;
    border-radius: 4px;
    cursor: pointer;
    margin-right: 5px;
    font-size: 12px;
}

.no-results {
    text-align: center;
    padding: 20px;
    color: #777;
}

/* Modal Styles */
.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.5);
}

.modal-content {
    background-color: white;
    margin: 10% auto;
    padding: 20px;
    border-radius: 8px;
    width: 80%;
    max-width: 500px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    position: relative;
}

.close {
    position: absolute;
    right: 20px;
    top: 15px;
    font-size: 24px;
    font-weight: bold;
    cursor: pointer;
}

.product-name-display, .current-stock {
    padding: 8px 12px;
    background-color: #f8f9fa;
    border-radius: 4px;
    border: 1px solid #ddd;
}

.stock-adjustment-controls {
    display: flex;
    align-items: center;
}

.btn-adjust {
    width: 30px;
    height: 30px;
    background-color: #f1f1f1;
    border: 1px solid #ddd;
    cursor: pointer;
    font-size: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
}

#stock-adjustment {
    width: 60px;
    text-align: center;
    margin: 0 10px;
    padding: 5px;
}

.form-info {
    background-color: #f8f9fa;
    padding: 15px;
    border-radius: 4px;
    margin: 15px 0;
}

.form-info ul {
    margin: 10px 0;
    padding-left: 20px;
}

.download-template {
    color: #ff6b6b;
    text-decoration: none;
}

.form-actions {
    display: flex;
    justify-content: flex-end;
    margin-top: 20px;
}

.btn-cancel, .btn-submit {
    padding: 8px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin-left: 10px;
}

.btn-cancel {
    background-color: #f1f1f1;
    color: #333;
}

.btn-submit {
    background-color: #ff6b6b;
    color: white;
}

@media (max-width: 768px) {
    .inventory-summary {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .filter-group {
        width: 100%;
        margin-right: 0;
    }
    
    .modal-content {
        width: 95%;
        margin: 5% auto;
    }
}
</style>
