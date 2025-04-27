<?php
// In a real application, this would come from a database
$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Sample product data
$products = [
    1 => [
        'id' => 1,
        'name' => 'Classic Sneakers',
        'price' => 79.99,
        'image' => '/shoesWebsite/assets/images/product1.jpg',
        'description' => 'These classic sneakers offer both style and comfort. Perfect for casual everyday wear, they feature a durable rubber sole and breathable upper material. Available in multiple colors to match any outfit.',
        'category' => 'men'
    ],
    2 => [
        'id' => 2,
        'name' => 'Running Shoes',
        'price' => 99.99,
        'image' => '/shoesWebsite/assets/images/product2.jpg',
        'description' => 'Designed for performance and comfort, these running shoes feature advanced cushioning technology and breathable mesh. Perfect for both serious runners and casual joggers.',
        'category' => 'sports'
    ]
];

// Check if product exists
if (!isset($products[$product_id])) {
    echo '<div class="alert-error">Sản phẩm không tồn tại!</div>';
    exit;
}

$product = $products[$product_id];
?>

<div class="admin-header">
    <h1>Sửa Sản Phẩm</h1>
    <a href="/shoesWebsite/admin/index.php?controller=admin&action=products" class="btn btn-secondary">Quay Lại Danh Sách Sản Phẩm</a>
</div>

<?php if (isset($error)): ?>
    <div class="alert-error"><?php echo htmlspecialchars($error); ?></div>
<?php endif; ?>
<?php if (isset($success)): ?>
    <div class="alert-success"><?php echo htmlspecialchars($success); ?></div>
<?php endif; ?>

<div class="admin-form">
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="product-name">Tên Sản Phẩm</label>
            <input type="text" id="product-name" name="name" value="<?php echo $product['name']; ?>" required>
        </div>
        
        <div class="form-group">
            <label for="product-price">Giá</label>
            <input type="number" id="product-price" name="price" step="0.01" value="<?php echo $product['price']; ?>" required>
        </div>

        <div class="form-group">
            <label for="stock">Số Lượng Tồn Kho</label>
            <input type="number" id="stock" name="stock" value="<?php echo isset($product['Stock']) ? htmlspecialchars($product['Stock']) : '0'; ?>" required>
        </div>
        
        <div class="form-group">
            <label for="product-category">Danh Mục</label>
            <select id="product-category" name="category_id" required>
                <option value="">Chọn Danh Mục</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?php echo $category['CategoryID']; ?>" <?php echo $category['Name'] == $product['category'] ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($category['Name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="form-group">
            <label for="shoes_size">Kích Cỡ</label>
            <input type="number" id="shoes_size" name="shoes_size" step="0.01" value="<?php echo isset($product['shoes_size']) ? htmlspecialchars($product['shoes_size']) : '0'; ?>" required>
        </div>

        <div class="form-group">
            <label for="product-description">Mô Tả</label>
            <textarea id="product-description" name="description" required><?php echo $product['description']; ?></textarea>
        </div>
        
        <div class="form-group">
            <label for="product-image">Hình Ảnh Sản Phẩm</label>
            <input type="file" id="product-image" name="image" accept="image/*">
            <div class="image-preview">
                <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" style="max-width: 200px; margin-top: 10px;">
            </div>
            <p class="help-text">Để trống nếu không muốn thay đổi hình ảnh</p>
        </div>
        
        <button type="submit" class="btn">Cập Nhật Sản Phẩm</button>
    </form>
</div>

<?php require_once 'views/admin/components/admin_footer.php'; ?>