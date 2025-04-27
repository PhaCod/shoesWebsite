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
                <h3><?php echo htmlspecialchars($item['Title']); ?></h3>
                <p><?php echo htmlspecialchars($item['Description']); ?></p>
                <a href="/shoesWebsite/index.php?controller=news&action=detail&id=<?php echo $item['NewsID']; ?>">Read More</a>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?php require_once 'views/components/footer.php'; ?>