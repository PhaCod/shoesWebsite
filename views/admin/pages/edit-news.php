<style>
    .news-form .form-group {
        margin-bottom: 15px;
    }

    .news-form .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .news-form .form-group input,
    .news-form .form-group textarea,
    .news-form .form-group select {
        width: 100%;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .news-form .form-group textarea {
        resize: vertical;
    }

    .news-form .form-group img {
        max-width: 200px;
        border-radius: 5px;
        margin-bottom: 10px;
    }

    .news-form .form-group small {
        display: block;
        margin-top: 5px;
        color: #666;
    }

    .news-form button {
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .news-form button:hover {
        background-color: #0056b3;
    }
</style>

<div class="admin-header">
    <h1>Sửa Bài Viết</h1>
    <a href="/shoesWebsite/index.php?controller=adminNews&action=manage" class="btn btn-secondary">Quay Lại</a>
</div>

<?php if (isset($error)): ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>
<?php if (isset($success)): ?>
    <div class="alert alert-success"><?php echo $success; ?></div>
<?php endif; ?>

<form method="post" class="news-form" enctype="multipart/form-data">
    <input type="hidden" name="news_id" value="<?php echo $edit_news['NewsID']; ?>">
    <div class="form-group">
        <label for="title">Tiêu Đề</label>
        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($edit_news['Title']); ?>" required>
    </div>
    <div class="form-group">
        <label for="description">Mô Tả</label>
        <textarea id="description" name="description" required><?php echo htmlspecialchars($edit_news['Description']); ?></textarea>
    </div>
    <div class="form-group">
        <label for="content">Nội Dung</label>
        <textarea id="content" name="content" rows="10" required><?php echo htmlspecialchars($edit_news['Content']); ?></textarea>
    </div>
    <div class="form-group">
        <label for="news_type">Loại Tin Tức</label>
        <select id="news_type" name="news_type" required>
            <option value="general" <?php echo $edit_news['news_type'] === 'general' ? 'selected' : ''; ?>>Tin Tức Thông Thường</option>
            <option value="flash_sale" <?php echo $edit_news['news_type'] === 'flash_sale' ? 'selected' : ''; ?>>Sale sập sàn</option>
            <option value="fixed_price" <?php echo $edit_news['news_type'] === 'fixed_price' ? 'selected' : ''; ?>>Rẻ Vô Địch</option>
        </select>
    </div>
    <div class="form-group">
        <label for="promotion_id">Chương Trình Khuyến Mãi (nếu có)</label>
        <select id="promotion_id" name="promotion_id">
            <option value="">Không có</option>
            <?php foreach ($promotions as $promotion): ?>
                <option value="<?php echo $promotion['promotion_id']; ?>" <?php echo $edit_news['promotion_id'] == $promotion['promotion_id'] ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($promotion['promotion_name']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="thumbnail">Ảnh Thumbnail</label>
        <?php if ($edit_news['thumbnail'] && file_exists($edit_news['thumbnail'])): ?>
            <div>
                <img src="/shoesWebsite/<?php echo htmlspecialchars($edit_news['thumbnail']); ?>" alt="Thumbnail">
                <p>Ảnh hiện tại</p>
            </div>
        <?php endif; ?>
        <input type="file" id="thumbnail" name="thumbnail" accept="image/*">
        <small>Chỉ chấp nhận file ảnh (JPEG, PNG, GIF), tối đa 5MB. Nếu không chọn ảnh mới, ảnh cũ sẽ được giữ lại.</small>
    </div>
    <button type="submit" name="edit_news">Cập Nhật Bài Viết</button>
</form>