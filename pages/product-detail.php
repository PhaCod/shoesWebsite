<?php
// In a real application, this would come from a database
$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Sample product data
$products = [
    1 => [
        'id' => 1,
        'name' => 'Classic Sneakers',
        'price' => 79.99,
        'image' => 'assets/images/product1.jpg',
        'description' => 'These classic sneakers offer both style and comfort. Perfect for casual everyday wear, they feature  => 'These classic sneakers offer both style and comfort. Perfect for casual everyday wear, they feature a durable rubber sole and breathable upper material. Available in multiple colors to match any outfit.',
        'category' => 'men'
    ],
    2 => [
        'id' => 2,
        'name' => 'Running Shoes',
        'price' => 99.99,
        'image' => 'assets/images/product2.jpg',
        'description' => 'Designed for performance and comfort, these running shoes feature advanced cushioning technology and breathable mesh. Perfect for both serious runners and casual joggers.',
        'category' => 'sports'
    ],
    3 => [
        'id' => 3,
        'name' => 'Casual Loafers',
        'price' => 69.99,
        'image' => 'assets/images/product3.jpg',
        'description' => 'Slip into comfort with these stylish loafers. Made with premium materials and featuring a cushioned insole, they\'re perfect for both work and casual occasions.',
        'category' => 'men'
    ],
    4 => [
        'id' => 4,
        'name' => 'Formal Oxfords',
        'price' => 129.99,
        'image' => 'assets/images/product4.jpg',
        'description' => 'These classic oxford shoes are crafted from genuine leather with a polished finish. Perfect for formal events, business meetings, or any occasion that calls for sophisticated footwear.',
        'category' => 'men'
    ]
];

// Check if product exists
if (!isset($products[$product_id])) {
    echo '<div class="alert">Product not found!</div>';
    exit;
}

$product = $products[$product_id];

// Handle add to cart action
if (isset($_POST['add_to_cart'])) {
    $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
    
    if ($quantity < 1) {
        $quantity = 1;
    }
    
    // Initialize cart if it doesn't exist
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    
    // Add to cart or update quantity if already in cart
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['quantity'] += $quantity;
    } else {
        $_SESSION['cart'][$product_id] = [
            'id' => $product['id'],
            'name' => $product['name'],
            'price' => $product['price'],
            'image' => $product['image'],
            'quantity' => $quantity
        ];
    }
    
    // Redirect to prevent form resubmission
    header('Location: index.php?page=cart');
    exit;
}
?>

<div class="product-detail">
    <div class="product-detail-img">
        <img src="/placeholder.svg?height=400&width=400" alt="<?php echo $product['name']; ?>">
    </div>
    <div class="product-detail-info">
        <h1><?php echo $product['name']; ?></h1>
        <div class="price">$<?php echo number_format($product['price'], 2); ?></div>
        <div class="description"><?php echo $product['description']; ?></div>
        
        <form method="post" action="">
            <div class="quantity-selector">
                <button type="button" class="quantity-minus">-</button>
                <input type="number" name="quantity" value="1" min="1" class="quantity-input">
                <button type="button" class="quantity-plus">+</button>
            </div>
            <button type="submit" name="add_to_cart" class="btn">Add to Cart</button>
        </form>
    </div>
</div>

