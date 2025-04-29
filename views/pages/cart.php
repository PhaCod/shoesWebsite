

<div class="section-title">
    <h2>Your Shopping Cart</h2>
</div>

<?php if (empty($cartItems)): ?>
    <div class="empty-cart">
        <p>Your cart is empty.</p>
        <a href="/shoesWebsite/index.php?controller=products&action=index" class="btn">Continue Shopping</a>
    </div>
<?php else: ?>
    <form method="post" action="/shoesWebsite/index.php?controller=cart&action=update">
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
                <?php foreach ($cartItems as $item): ?>
                    <tr>
                        <td>
                            <div class="cart-product">
                                <img src="/shoesWebsite/<?php echo htmlspecialchars($item['product']['image']); ?>" alt="<?php echo htmlspecialchars($item['product']['name']); ?>">
                                <div>
                                    <h4><?php echo htmlspecialchars($item['product']['name']); ?></h4>
                                </div>
                            </div>
                        </td>
                        <td>$<?php echo number_format($item['product']['price'], 2); ?></td>
                        <td>
                            <input type="number" name="quantity[<?php echo $item['product']['id']; ?>]" value="<?php echo $item['quantity']; ?>" min="1" class="cart-quantity">
                        </td>
                        <td>$<?php echo number_format($item['subtotal'], 2); ?></td>
                        <td>
                            <a href="/shoesWebsite/index.php?controller=cart&action=remove&id=<?php echo $item['product']['id']; ?>" class="btn-remove" onclick="return confirm('Are you sure you want to remove this item?')">Remove</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        
        <div class="cart-actions">
            <div>
                <button type="submit" name="update_cart" class="btn">Update Cart</button>
                <a href="/shoesWebsite/index.php?controller=products&action=index" class="btn btn-secondary">Continue Shopping</a>
            </div>
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
        <a href="/shoesWebsite/index.php?controller=checkout&action=index" class="btn">Proceed to Checkout</a>
    </div>
<?php endif; ?>

<?php require_once 'views/components/footer.php'; ?>