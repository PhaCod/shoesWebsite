<?php
// In a real application, this would come from a database
$order_id = isset($_GET['id']) ? $_GET['id'] : '';

// Sample order data
$order = [
    'id' => $order_id,
    'customer' => 'John Doe',
    'email' => 'john@example.com',
    'date' => 'Jun 12, 2023',
    'status' => 'Delivered',
    'address' => '123 Main St, Anytown, CA 12345',
    'payment_method' => 'Credit Card',
    'items' => [
        [
            'name' => 'Classic Sneakers',
            'price' => 79.99,
            'quantity' => 1
        ],
        [
            'name' => 'Running Shoes',
            'price' => 99.99,
            'quantity' => 2
        ]
    ]
];

// Calculate totals
$subtotal = 0;
foreach ($order['items'] as $item) {
    $subtotal += $item['price'] * $item['quantity'];
}
$shipping = 10.00;
$total = $subtotal + $shipping;

// Handle status update
if (isset($_POST['update_status'])) {
    $new_status = $_POST['status'];
    // In a real application, you would update the database
    $order['status'] = $new_status;
}
?>

<div class="admin-header">
    <h1>Order #<?php echo $order_id; ?></h1>
    <a href="index.php?page=orders" class="btn btn-secondary">Back to Orders</a>
</div>

<div class="order-detail">
    <div class="order-info">
        <h2>Order Information</h2>
        <div class="info-group">
            <div class="info-label">Customer:</div>
            <div class="info-value"><?php echo $order['customer']; ?></div>
        </div>
        <div class="info-group">
            <div class="info-label">Email:</div>
            <div class="info-value"><?php echo $order['email']; ?></div>
        </div>
        <div class="info-group">
            <div class="info-label">Date:</div>
            <div class="info-value"><?php echo $order['date']; ?></div>
        </div>
        <div class="info-group">
            <div class="info-label">Status:</div>
            <div class="info-value">
                <form method="post" action="" class="status-form">
                    <select name="status" onchange="this.form.submit()">
                        <option value="Processing" <?php echo $order['status'] === 'Processing' ? 'selected' : ''; ?>>Processing</option>
                        <option value="Shipped" <?php echo $order['status'] === 'Shipped' ? 'selected' : ''; ?>>Shipped</option>
                        <option value="Delivered" <?php echo $order['status'] === 'Delivered' ? 'selected' : ''; ?>>Delivered</option>
                        <option value="Cancelled" <?php echo $order['status'] === 'Cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                    </select>
                    <input type="hidden" name="update_status" value="1">
                </form>
            </div>
        </div>
        <div class="info-group">
            <div class="info-label">Address:</div>
            <div class="info-value"><?php echo $order['address']; ?></div>
        </div>
        <div class="info-group">
            <div class="info-label">Payment Method:</div>
            <div class="info-value"><?php echo $order['payment_method']; ?></div>
        </div>
    </div>
    
    <h2>Order Items</h2>
    <table class="admin-table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($order['items'] as $item): ?>
                <tr>
                    <td><?php echo $item['name']; ?></td>
                    <td>$<?php echo number_format($item['price'], 2); ?></td>
                    <td><?php echo $item['quantity']; ?></td>
                    <td>$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="text-right">Subtotal</td>
                <td>$<?php echo number_format($subtotal, 2); ?></td>
            </tr>
            <tr>
                <td colspan="3" class="text-right">Shipping</td>
                <td>$<?php echo number_format($shipping, 2); ?></td>
            </tr>
            <tr>
                <td colspan="3" class="text-right"><strong>Total</strong></td>
                <td><strong>$<?php echo number_format($total, 2); ?></strong></td>
            </tr>
        </tfoot>
    </table>
</div>
