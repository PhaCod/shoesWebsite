<?php
// In a real application, this would come from a database
$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Sample product data
$products = [
    1 => [
        'id' => 1,
        'name' => 'Classic Sneakers',
        'price' => 79.99,
        'image' => '../assets/images/product1.jpg',
        'description' => 'These classic sneakers offer both style and comfort. Perfect for casual everyday wear, they feature a durable rubber sole and breathable upper material. Available in multiple colors to match any outfit.',
        'category' => 'men'
    ],
    2 => [
        'id' => 2,
        'name' => 'Running Shoes',
        'price' => 99.99,
        'image' => '../assets/images/product2.jpg',
        'description' => 'Designed for performance and comfort, these running shoes feature advanced cushioning technology and breathable mesh. Perfect for both serious runners and casual joggers.',
        'category' => 'sports'
    ]
];

// Check if product exists
if (!isset($products[$product_id])) {
    echo '<div class="alert">Product not found!</div>';
    exit;
}

$product = $products[$product_id];
?>

<div class="admin-header">
    <h1>Edit Product</h1>
    <a href="index.php?page=products" class="btn btn-secondary">Back to Products</a>
</div>

<div class="admin-form">
    <form method="post" action="" enctype="multipart/form-data">
        <div class="form-group">
            <label for="product-name">Product Name</label>
            <input type="text" id="product-name" name="name" value="<?php echo $product['name']; ?>" required>
        </div>
        
        <div class="form-group">
            <label for="product-price">Price</label>
            <input type="number" id="product-price" name="price" step="0.01" value="<?php echo $product['price']; ?>" required>
        </div>
        
        <div class="form-group">
            <label for="product-category">Category</label>
            <select id="product-category" name="category" required>
                <option value="">Select Category</option>
                <option value="men" <?php echo $product['category'] === 'men' ? 'selected' : ''; ?>>Men</option>
                <option value="women" <?php echo $product['category'] === 'women' ? 'selected' : ''; ?>>Women</option>
                <option value="kids" <?php echo $product['category'] === 'kids' ? 'selected' : ''; ?>>Kids</option>
                <option value="sports" <?php echo $product['category'] === 'sports' ? 'selected' : ''; ?>>Sports</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="product-description">Description</label>
            <textarea id="product-description" name="description" required><?php echo $product['description']; ?></textarea>
        </div>
        
        <div class="form-group">
            <label for="product-image">Product Image</label>
            <input type="file" id="product-image" name="image" accept="image/*">
            <div class="image-preview">
                <img src="/placeholder.svg?height=200&width=200" alt="<?php echo $product['name']; ?>" style="max-width: 200px; margin-top: 10px;">
            </div>
            <p class="help-text">Leave empty to keep current image</p>
        </div>
        
        <button type="submit" name="update_product" class="btn">Update Product</button>
    </form>
</div>
