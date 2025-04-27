<h2>Quản Lý Tin Tức</h2>
<p>
    <a href="/shoesWebsite/admin/index.php?controller=admin&action=dashboard">Quay Lại Dashboard</a> | 
    <a href="/shoesWebsite/index.php?controller=auth&action=logout">Đăng Xuất</a>
</p>

<?php if (isset($error)): ?>
    <div class="alert-error"><?php echo htmlspecialchars($error); ?></div>
<?php endif; ?>
<?php if (isset($success)): ?>
    <div class="alert-success"><?php echo htmlspecialchars($success); ?></div>
<?php endif; ?>

<h3><?php echo $edit_news ? 'Sửa Tin Tức' : 'Thêm Tin Tức Mới'; ?></h3>
<form method="post" class="admin-form">
    <?php if ($edit_news): ?>
        <input type="hidden" name="news_id" value="<?php echo $edit_news['NewsID']; ?>">
    <?php endif; ?>
    <div class="form-group">
        <label for="title">Tiêu Đề</label>
        <input type="text" id="title" name="title" value="<?php echo $edit_news ? htmlspecialchars($edit_news['Title']) : ''; ?>" required>
    </div>
    <div class="form-group">
        <label for="description">Mô Tả</label>
        <input type="text" id="description" name="description" value="<?php echo $edit_news ? htmlspecialchars($edit_news['Description']) : ''; ?>" required>
    </div>
    <div class="form-group">
        <label for="content">Nội Dung</label>
        <textarea id="content" name="content" rows="5" required><?php echo $edit_news ? htmlspecialchars($edit_news['Content']) : ''; ?></textarea>
    </div>
    <button type="submit" name="<?php echo $edit_news ? 'edit_news' : 'add_news'; ?>" class="btn">
        <?php echo $edit_news ? 'Cập Nhật Tin Tức' : 'Thêm Tin Tức'; ?>
    </button>
</form>

<h3>Danh Sách Tin Tức</h3>
<form method="get" action="" class="admin-form">
    <div class="form-group">
        <label for="search">Tìm Kiếm Tin Tức</label>
        <input type="text" id="search" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Nhập từ khóa...">
        <input type="hidden" name="controller" value="news">
        <input type="hidden" name="action" value="manage">
        <button type="submit" class="btn">Tìm Kiếm</button>
    </div>
</form>

<table class="admin-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tiêu Đề</th>
            <th>Mô Tả</th>
            <th>Đăng Bởi</th>
            <th>Hành Động</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($news)): ?>
            <tr>
                <td colspan="5">Không tìm thấy tin tức.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($news as $item): ?>
                <tr>
                    <td><?php echo $item['NewsID']; ?></td>
                    <td><?php echo htmlspecialchars($item['Title']); ?></td>
                    <td><?php echo htmlspecialchars($item['Description']); ?></td>
                    <td><?php echo htmlspecialchars($item['Fname'] . ' ' . $item['Lname']); ?></td>
                    <td>
                        <a href="/shoesWebsite/admin/index.php?controller=news&action=manage&action=edit&id=<?php echo $item['NewsID']; ?>" class="btn">Sửa</a>
                        <a href="/shoesWebsite/admin/index.php?controller=news&action=manage&action=delete&id=<?php echo $item['NewsID']; ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa tin tức này?')">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>

<?php require_once 'views/admin/components/admin_footer.php'; ?>