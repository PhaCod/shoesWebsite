<style>
    .news-list {
        margin-top: 20px;
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 20px;
    }

    .news-item {
        text-align: center;
    }

    .news-thumbnail {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 8px;
        transition: transform 0.3s ease;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .news-thumbnail:hover {
        transform: scale(1.05);
    }

    .pagination {
        margin-top: 30px;
        text-align: center;
    }

    .pagination a {
        display: inline-block;
        padding: 10px 18px;
        margin: 0 5px;
        border: 1px solid #ddd;
        text-decoration: none;
        color: #333;
        border-radius: 5px;
        transition: background-color 0.3s ease;
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

<div class="section-title">
    <h2>News & Updates</h2>
</div>

<form method="get" action="" class="form-container">
    <div class="form-group">
        <label for="search">Search News</label>
        <input type="text" id="search" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Enter keyword...">
        <input type="hidden" name="controller" value="news">
        <input type="hidden" name="action" value="index">
        <button type="submit" class="form-btn">Search</button>
    </div>
</form>

<div class="news-list">
    <?php if (empty($news)): ?>
        <p>No news found.</p>
    <?php else: ?>
        <?php foreach ($news as $item): ?>
            <div class="news-item">
                <?php if ($item['thumbnail'] && file_exists($item['thumbnail'])): ?>
                    <a href="/shoesWebsite/index.php?controller=news&action=detail&id=<?php echo $item['NewsID']; ?>">
                        <img src="/shoesWebsite/<?php echo htmlspecialchars($item['thumbnail']); ?>" alt="Thumbnail" class="news-thumbnail" title="<?php echo htmlspecialchars($item['Title']); ?>">
                    </a>
                <?php else: ?>
                    <a href="/shoesWebsite/index.php?controller=news&action=detail&id=<?php echo $item['NewsID']; ?>">
                        <img src="/shoesWebsite/assets/images/placeholder.png" alt="No Thumbnail" class="news-thumbnail" loading="lazy" title="<?php echo htmlspecialchars($item['Title']); ?>">
                    </a>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<div class="pagination">
    <?php if ($totalPages > 1): ?>
        <?php if ($page > 1): ?>
            <a href="/shoesWebsite/index.php?controller=news&action=index&search=<?php echo urlencode($search); ?>&page=<?php echo $page - 1; ?>">Trang trước</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="/shoesWebsite/index.php?controller=news&action=index&search=<?php echo urlencode($search); ?>&page=<?php echo $i; ?>" <?php echo $i === $page ? 'class="active"' : ''; ?>><?php echo $i; ?></a>
        <?php endfor; ?>

        <?php if ($page < $totalPages): ?>
            <a href="/shoesWebsite/index.php?controller=news&action=index&search=<?php echo urlencode($search); ?>&page=<?php echo $page + 1; ?>">Trang sau</a>
        <?php endif; ?>
    <?php endif; ?>
</div>

<?php require_once 'views/components/footer.php'; ?>