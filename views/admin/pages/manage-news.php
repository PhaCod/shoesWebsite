<style>
    .admin-actions1{
        margin-top: 5px;
    }
    .admin-table img {
        max-width: 50px;
        border-radius: 5px;
    }

    .pagination {
        margin-top: 20px;
        text-align: center;
    }

    .pagination a {
        display: inline-block;
        padding: 8px 16px;
        margin: 0 4px;
        border: 1px solid #ddd;
        text-decoration: none;
        color: #333;
    }

    .pagination a.active {
        background-color: #007bff;
        color: white;
        border-color: #007bff;
    }

    .pagination a:hover:not(.active) {
        background-color: #f1f1f1;
    }
</style>

<div class="admin-header">
    <h1>Quản Lý Tin Tức</h1>
    <a href="/shoesWebsite/index.php?controller=adminDashboard&action=dashboard" class="btn btn-secondary">Quay Lại Dashboard</a>
</div>

<?php if (isset($error)): ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>
<?php if (isset($success)): ?>
    <div class="alert alert-success"><?php echo $success; ?></div>
<?php endif; ?>

<div class="admin-actions">
    <a href="/shoesWebsite/index.php?controller=adminNews&action=addNews" class="btn btn-primary">Thêm Bài Viết Mới</a>
</div>

<div class="admin-actions1">
    <a href="/shoesWebsite/index.php?controller=adminPromotion&action=index" class="btn btn-primary">Chỉnh sửa khuyến mãi</a>
</div>

<form method="get" class="search-form">
    <input type="hidden" name="controller" value="adminNews">
    <input type="hidden" name="action" value="manage">
    <input type="text" name="search" placeholder="Tìm kiếm bài viết..." value="<?php echo htmlspecialchars($search); ?>">
    <button type="submit">Tìm Kiếm</button>
</form>

<table class="admin-table">
    <thead>
        <tr>
            <th>Thumbnail</th>
            <th>Tiêu Đề</th>
            <th>Mô Tả</th>
            <th>Loại Tin Tức</th>
            <th>Khuyến Mãi</th>
            <th>Người Đăng</th>
            <th>Ngày Đăng</th>
            <th>Hành Động</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($news)): ?>
            <tr>
                <td colspan="8">Không tìm thấy bài viết nào.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($news as $item): ?>
                <tr>
                    <td>
                        <?php if ($item['thumbnail'] && file_exists($item['thumbnail'])): ?>
                            <img src="/shoesWebsite/<?php echo htmlspecialchars($item['thumbnail']); ?>" alt="Thumbnail">
                        <?php else: ?>
                            Không có ảnh
                        <?php endif; ?>
                    </td>
                    <td><?php echo htmlspecialchars($item['Title']); ?></td>
                    <td><?php echo htmlspecialchars($item['Description']); ?></td>
                    <td>
                        <?php
                        $news_types = [
                            'general' => 'Tin Tức Thông Thường',
                            'flash_sale_50' => 'Flash Sale 50%',
                            'fixed_price_100k' => 'Rẻ Vô Địch 100k',
                            'buy_2_get_1' => 'Mua 2 Tặng 1'
                        ];
                        echo $news_types[$item['news_type']] ?? 'Không xác định';
                        ?>
                    </td>
                    <td><?php echo htmlspecialchars($item['promotion_name'] ?? 'Không có'); ?></td>
                    <td><?php echo htmlspecialchars($item['AdminName'] ?? 'Unknown'); ?></td>
                    <td><?php echo date('d/m/Y H:i', strtotime($item['DateCreated'])); ?></td>
                    <td>
                        <a href="/shoesWebsite/index.php?controller=adminNews&action=editNews&id=<?php echo $item['NewsID']; ?>" class="btn btn-primary">Sửa</a>
                        <a href="/shoesWebsite/index.php?controller=adminNews&action=deleteNews&id=<?php echo $item['NewsID']; ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa bài viết này?')">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>

<div class="pagination">
    <?php if ($totalPages > 1): ?>
        <?php if ($page > 1): ?>
            <a href="/shoesWebsite/index.php?controller=adminNews&action=manage&search=<?php echo urlencode($search); ?>&page=<?php echo $page - 1; ?>" class="btn btn-secondary">Trang trước</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="/shoesWebsite/index.php?controller=adminNews&action=manage&search=<?php echo urlencode($search); ?>&page=<?php echo $i; ?>" class="btn btn-secondary <?php echo $i === $page ? 'active' : ''; ?>"><?php echo $i; ?></a>
        <?php endfor; ?>

        <?php if ($page < $totalPages): ?>
            <a href="/shoesWebsite/index.php?controller=adminNews&action=manage&search=<?php echo urlencode($search); ?>&page=<?php echo $page + 1; ?>" class="btn btn-secondary">Trang sau</a>
        <?php endif; ?>
    <?php endif; ?>
</div>