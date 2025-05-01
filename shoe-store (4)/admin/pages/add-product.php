<div class="admin-header">
    <h1>Add New Product</h1>
    <a href="index.php?page=products" class="btn btn-secondary">Back to Products</a>
</div>

<div class="admin-form">
    <form method="post" action="" enctype="multipart/form-data">
        <div class="form-group">
            <label for="product-name">Product Name</label>
            <input type="text" id="product-name" name="name" required>
        </div>
        
        <div class="form-group">
            <label for="product-price">Price</label>
            <input type="number" id="product-price" name="price" step="0.01" required>
        </div>
        
        <div class="form-group">
            <label for="product-category">Category</label>
            <select id="product-category" name="category" required>
                <option value="">Select Category</option>
                <option value="men">Men</option>
                <option value="women">Women</option>
                <option value="kids">Kids</option>
                <option value="sports">Sports</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="product-description">Description</label>
            <textarea id="product-description" name="description" required></textarea>
        </div>
        
        <div class="form-group">
            <label for="product-image">Product Image</label>
            <input type="file" id="product-image" name="image" accept="image/*" required>
            <div class="image-preview">
                <img id="image-preview" src="/placeholder.svg" alt="Image Preview" style="display: none; max-width: 200px; margin-top: 10px;">
            </div>
        </div>
        
        <button type="submit" name="add_product" class="btn">Add Product</button>
    </form>
</div>
