<?php
require 'db_connect.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: news.php');
    exit;
}

$news_id = intval($_GET['id']);
$stmt = $pdo->prepare("SELECT news.*, admin.Fname, admin.Lname 
                       FROM news 
                       JOIN admin ON news.AdminID = admin.AdminID 
                       WHERE NewsID = ?");
$stmt->execute([$news_id]);
$news = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$news) {
    header('Location: news.php');
    exit;
}
?>


    <?php include '../includes/header.php'; ?>

    <h2><?php echo htmlspecialchars($news['Title']); ?></h2>
    <p><em>Posted by <?php echo htmlspecialchars($news['Fname'] . ' ' . $news['Lname']); ?></em></p>
    <p><strong><?php echo htmlspecialchars($news['Description']); ?></strong></p>
    <div class="news-content">
        <?php echo nl2br(htmlspecialchars($news['Content'])); ?>
    </div>
    <a href="news.php">Back to News</a>

    