<div class="section-title">
    <h2><?php echo htmlspecialchars($news['Title']); ?></h2>
</div>
<p><em>Posted by <?php echo htmlspecialchars($news['Fname'] . ' ' . $news['Lname']); ?></em></p>
<p><strong><?php echo htmlspecialchars($news['Description']); ?></strong></p>
<div class="news-content">
    <?php echo nl2br(htmlspecialchars($news['Content'])); ?>
</div>
<p><a href="/shoesWebsite/index.php?controller=news&action=index" class="btn">Back to News</a></p>

<?php require_once 'views/components/footer.php'; ?>