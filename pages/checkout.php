<?php
// Redirect if cart is empty
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header('Location: index.php?page=cart');
    exit;
}

$success = '';
$error = '';

// Calculate cart totals
$subtotal = 0;
foreach ($_SESSION['cart'] as $item) {
    $subtotal += $item['price'] * $item['quantity'];
}

$shipping = 10.00; // Fixed shipping cost for simplicity
$total = $subtotal + $shipping;

if (isset($_POST['place_order'])) {
    // Simple validation
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $address = isset($_POST['address']) ? trim($_POST['address']) : '';
    $city = isset($_POST['city']) ? trim($_POST['city']) : '';
    $zip = isset($_POST['zip']) ? trim($_POST['zip']) : '';
    $card_number = isset($_POST['card_number']) ? trim($_POST['card_number']) : '';
    
    if (empty($name) || empty($email) || empty($address) || empty($city) || empty($zip) || empty($card_number)) {
        $error = 'All fields are required';
    } else {
        // In a real application, you would process the order and save to a database
        // This is just a simple example
        $success = 'Order placed successfully! Thank you for your purchase.';
        
        // Clear the cart
        $_SESSION['cart'] = [];
        
        // Redirect to confirmation page after a delay
        header('Refresh: 3; URL=index.php');
    }
}
?>

<div class="section-title">
    <h2>Checkout</h2>
</div>

<?php if (!empty($error)): ?>
    <div class="alert alert-error"><?php echo $error; ?></div>
<?php endif; ?>

<?php if (!empty($success)): ?>
    <div class="alert alert-success"><?php echo $success; ?></div>
<?php else: ?>
    <div class="checkout-container">
        <div class="checkout-form">
            <h3>Shipping Information</h3>
            <form method="post" action="">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address" required>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" id="city" name="city" required>
                    </div>
                    <div class="form-group">
                        <label for="zip">ZIP Code</label>
                        <input type="text" id="zip" name="zip" required>
                    </div>
                </div>
                
                <h3>Payment Information</h3>
                <div class="form-group">
                    <label for="card_number">Card Number</label>
                    <input type="text" id="card_number" name="card_number" required>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="expiry">Expiry Date</label>
                        <input type="text" id="expiry" name="expiry" placeholder="MM/YY" required>
                    </div>
                    <div class="form-group">
                        <label for="cvv">CVV</label>
                        <input type="text" id="cvv" name="cvv" required>
                    </div>
                </div>
                
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
                </div>
                
                <button type="submit" name="place_order" class="form-btn">Place Order</button>
            </form>
        </div>
    </div>
<?php endif; ?>

