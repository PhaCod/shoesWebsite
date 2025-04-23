<?php
require 'db_connect.php';

$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$query = "SELECT * FROM news";
$params = [];

if (!empty($search)) {
    $query .= " WHERE Title LIKE ? OR Description LIKE ?";
    $params = ["%$search%", "%$search%"];
}

$stmt = $pdo->prepare($query);
$stmt->execute($params);
$news = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

    <h2>News & Updates</h2>

    <form method="get" action="">
        <div class="form-group">
            <label for="search">Search News</label>
            <input type="text" id="search" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Enter keyword...">
            <button type="submit">Search</button>
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
                    <a href="news_detail.php?id=<?php echo $item['NewsID']; ?>">Read More</a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    