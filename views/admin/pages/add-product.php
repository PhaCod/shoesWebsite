<div class="admin-header">
    <h1>Thêm Sản Phẩm Mới</h1>
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
            <input type="text" id="product-name" name="name" required>
        </div>
        
        <div class="form-group">
            <label for="product-price">Giá</label>
            <input type="number" id="product-price" name="price" step="0.01" required>
        </div>

        <div class="form-group">
            <label for="stock">Số Lượng Tồn Kho</label>
            <input type="number" id="stock" name="stock" required>
        </div>
        
        <div class="form-group">
            <label for="product-category">Danh Mục</label>
            <select id="product-category" name="category_id" required>
                <option value="">Chọn Danh Mục</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?php echo $category['CategoryID']; ?>"><?php echo htmlspecialchars($category['Name']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="form-group">
            <label for="shoes_size">Kích Cỡ</label>
            <input type="number" id="shoes_size" name="shoes_size" step="0.01" required>
        </div>

        <div class="form-group">
            <label for="product-description">Mô Tả</label>
            <textarea id="product-description" name="description" required></textarea>
        </div>
        
        <div class="form-group">
            <label for="product-image">Hình Ảnh Sản Phẩm</label>
            <input type="file" id="product-image" name="image" accept="image/*" required>
            <div class="image-preview">
                <img id="image-preview" src="/placeholder.svg" alt="Image Preview" style="display: none; max-width: 200px; margin-top: 10px;">
            </div>
        </div>
        
        <button type="submit" class="btn">Thêm Sản Phẩm</button>
    </form>
</div>

<?php require_once 'views/admin/components/admin_footer.php'; ?>