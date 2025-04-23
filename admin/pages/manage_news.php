<?php
require '../pages/db_connect.php';

// Kiểm tra quyền truy cập (chỉ admin)
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../../index.php?page=login');
    exit;
}

// Xử lý thêm bài viết
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_news'])) {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $content = trim($_POST['content']);
    $admin_id = $_SESSION['user_id'];

    if (empty($title) || empty($description) || empty($content)) {
        $error = 'All fields are required.';
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO news (Title, Description, Content, AdminID) VALUES (?, ?, ?, ?)");
            $stmt->execute([$title, $description, $content, $admin_id]);
            $success = 'News added successfully!';
        } catch (PDOException $e) {
            $error = 'Failed to add news: ' . $e->getMessage();
        }
    }
}

// Xử lý sửa bài viết
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_news'])) {
    $news_id = intval($_POST['news_id']);
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $content = trim($_POST['content']);

    if (empty($title) || empty($description) || empty($content)) {
        $error = 'All fields are required.';
    } else {
        try {
            $stmt = $pdo->prepare("UPDATE news SET Title = ?, Description = ?, Content = ? WHERE NewsID = ?");
            $stmt->execute([$title, $description, $content, $news_id]);
            $success = 'News updated successfully!';
        } catch (PDOException $e) {
            $error = 'Failed to update news: ' . $e->getMessage();
        }
    }
}

// Xử lý xóa bài viết
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $news_id = intval($_GET['id']);
    try {
        $stmt = $pdo->prepare("DELETE FROM news WHERE NewsID = ?");
        $stmt->execute([$news_id]);
        $success = 'News deleted successfully!';
    } catch (PDOException $e) {
        $error = 'Failed to delete news: ' . $e->getMessage();
    }
}

// Tìm kiếm bài viết
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$query = "SELECT news.*, admin.Fname, admin.Lname 
          FROM news 
          JOIN admin ON news.AdminID = admin.AdminID";
$params = [];

if (!empty($search)) {
    $query .= " WHERE news.Title LIKE ? OR news.Description LIKE ? OR news.Content LIKE ?";
    $params = ["%$search%", "%$search%", "%$search%"];
}

$stmt = $pdo->prepare($query);
$stmt->execute($params);
$news = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Lấy bài viết để sửa (nếu có)
$edit_news = null;
if (isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['id'])) {
    $news_id = intval($_GET['id']);
    $stmt = $pdo->prepare("SELECT * FROM news WHERE NewsID = ?");
    $stmt->execute([$news_id]);
    $edit_news = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage News</title>
    <link rel="stylesheet" href="../../styles/style.css">
</head>
<body>
    <h2>Manage News</h2>
    <a href="../index.php">Back to Dashboard</a> | <a href="../../includes/logout.php">Logout</a>

    <?php if (isset($error)): ?>
        <div class="alert-error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    <?php if (isset($success)): ?>
        <div class="alert-success"><?php echo htmlspecialchars($success); ?></div>
    <?php endif; ?>

    <h3><?php echo $edit_news ? 'Edit News' : 'Add New News'; ?></h3>
    <form method="post">
        <?php if ($edit_news): ?>
            <input type="hidden" name="news_id" value="<?php echo $edit_news['NewsID']; ?>">
        <?php endif; ?>
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" value="<?php echo $edit_news ? htmlspecialchars($edit_news['Title']) : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" id="description" name="description" value="<?php echo $edit_news ? htmlspecialchars($edit_news['Description']) : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <textarea id="content" name="content" rows="5" required><?php echo $edit_news ? htmlspecialchars($edit_news['Content']) : ''; ?></textarea>
        </div>
        <button type="submit" name="<?php echo $edit_news ? 'edit_news' : 'add_news'; ?>">
            <?php echo $edit_news ? 'Update News' : 'Add News'; ?>
        </button>
    </form>

    <h3>News List</h3>
    <form method="get" action="">
        <div class="form-group">
            <label for="search">Search News</label>
            <input type="text" id="search" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Enter keyword...">
            <button type="submit">Search</button>
        </div>
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Posted By</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($news)): ?>
                <tr>
                    <td colspan="5">No news found.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($news as $item): ?>
                    <tr>
                        <td><?php echo $item['NewsID']; ?></td>
                        <td><?php echo htmlspecialchars($item['Title']); ?></td>
                        <td><?php echo htmlspecialchars($item['Description']); ?></td>
                        <td><?php echo htmlspecialchars($item['Fname'] . ' ' . $item['Lname']); ?></td>
                        <td>
                            <a href="?page=manage_news&action=edit&id=<?php echo $item['NewsID']; ?>" class="btn">Edit</a>
                            <a href="?page=manage_news&action=delete&id=<?php echo $item['NewsID']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>