<?php
// Initialize cart if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle remove from cart
if (isset($_GET['remove']) && isset($_SESSION['cart'][$_GET['remove']])) {
    unset($_SESSION['cart'][$_GET['remove']]);
    // Redirect to prevent form resubmission
    header('Location: index.php?page=cart');
    exit;
}

// Handle update quantity
if (isset($_POST['update_cart'])) {
    foreach ($_POST['quantity'] as $id => $quantity) {
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['quantity'] = max(1, (int)$quantity);
        }
    }
    // Redirect to prevent form resubmission
    header('Location: index.php?page=cart');
    exit;
}

// Calculate cart totals
$subtotal = 0;
foreach ($_SESSION['cart'] as $item) {
    $subtotal += $item['price'] * $item['quantity'];
}

$shipping = 10.00; // Fixed shipping cost for simplicity
$total = $subtotal + $shipping;
?>

<div class="section-title">
    <h2>Your Shopping Cart</h2>
</div>

<?php if (empty($_SESSION['cart'])): ?>
    <div class="empty-cart">
        <p>Your cart is empty.</p>
        <a href="index.php?page=products" class="btn">Continue Shopping</a>
    </div>
<?php else: ?>
    <form method="post" action="">
        <table class="cart-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['cart'] as $id => $item): ?>
                    <tr>
                        <td>
                            <div class="cart-product">
                                <img src="/placeholder.svg?height=80&width=80" alt="<?php echo $item['name']; ?>">
                                <div>
                                    <h4><?php echo $item['name']; ?></h4>
                                </div>
                            </div>
                        </td>
                        <td>$<?php echo number_format($item['price'], 2); ?></td>
                        <td>
                            <input type="number" name="quantity[<?php echo $id; ?>]" value="<?php echo $item['quantity']; ?>" min="1" class="cart-quantity">
                        </td>
                        <td>$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                        <td>
                            <a href="index.php?page=cart&remove=<?php echo $id; ?>" class="btn-remove">Remove</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <div class="cart-actions">
            <button type="submit" name="update_cart" class="btn">Update Cart</button>
            <a href="index.php?page=products" class="btn btn-secondary">Continue Shopping</a>
        </div>
    </form>
    
    <div class="cart-summary">
        <h3>Order Summary</h3>
        <div class="summary-item">
            <span>Subtotal</span>
            <span>$<?php echo number_format($subtotal, 2); ?></span>
        </div>
        <div class="summary-item">
            <span>Shipping</span>
            <span>$<?php echo number_format($shipping, 2); ?></span>
        </div>
        <div class="summary-item summary-total">
            <span>Total</span>
            <span>$<?php echo number_format($total, 2); ?></span>
        </div>
        <a href="index.php?page=checkout" class="btn">Proceed to Checkout</a>
    </div>
<?php endif; ?>

