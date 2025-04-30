<?php require 'views/admin/components/header.php'; ?>

<style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f4f4f4;
    }

    .actions {
        margin-bottom: 20px;
    }

    .pagination {
        margin-top: 20px;
        text-align: center;
    }

    .pagination a {
        display: inline-block;
        padding: 8px 16px;
        margin: 0 5px;
        border: 1px solid #ddd;
        text-decoration: none;
        color: #333;
        border-radius: 5px;
    }

    .pagination a.active {
        background-color: #007bff;
        color: white;
        border-color: #007bff;
    }

    .pagination a:hover:not(.active) {
        background-color: #f1f1f1;
    }

    .status-pending {
        color: orange;
        font-weight: bold;
    }

    .status-active {
        color: green;
        font-weight: bold;
    }

    .status-expired {
        color: red;
        font-weight: bold;
    }
</style>

<div class="section-title">
    <h2>Manage Promotions</h2>
</div>

<?php if (isset($_SESSION['message'])): ?>
    <div class="alert alert-success">
        <?php echo htmlspecialchars($_SESSION['message']); ?>
        <?php unset($_SESSION['message']); ?>
    </div>
<?php endif; ?>

<?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger">
        <?php echo htmlspecialchars($_SESSION['error']); ?>
        <?php unset($_SESSION['error']); ?>
    </div>
<?php endif; ?>

<div class="promotion-list">
    <div class="actions">
        <a href="index.php?controller=adminPromotion&action=create" class="btn">Create New Promotion</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
                <th>Action</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($promotions)): ?>
                <tr>
                    <td colspan="7">No promotions found.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($promotions as $promotion): ?>
                    <tr>
                        <td><?php echo $promotion['promotion_id']; ?></td>
                        <td><?php echo htmlspecialchars($promotion['promotion_name']); ?></td>
                        <td><?php echo $promotion['start_date']; ?></td>
                        <td><?php echo $promotion['end_date']; ?></td>
                        <td>
                            <?php
                            $now = new DateTime();
                            $startDate = new DateTime($promotion['start_date']);
                            $endDate = new DateTime($promotion['end_date']);
                            if ($now < $startDate) {
                                echo '<span class="status-pending">Pending</span>';
                            } elseif ($now >= $startDate && $now <= $endDate) {
                                echo '<span class="status-active">Active</span>';
                            } else {
                                echo '<span class="status-expired">Expired</span>';
                            }
                            ?>
                        </td>
                        <td>
                            <a href="index.php?controller=adminPromotion&action=edit&promotion_id=<?php echo $promotion['promotion_id']; ?>">Edit</a> |
                            <a href="index.php?controller=adminPromotion&action=manageProducts&promotion_id=<?php echo $promotion['promotion_id']; ?>">Manage Products</a>
                        </td>
                        <td>
                            <a href="index.php?controller=adminPromotion&action=delete&promotion_id=<?php echo $promotion['promotion_id']; ?>" onclick="return confirm('Are you sure you want to delete this promotion?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="pagination">
        <?php if ($totalPages > 1): ?>
            <?php if ($page > 1): ?>
                <a href="index.php?controller=adminPromotion&action=index&page=<?php echo $page - 1; ?>">Previous</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="index.php?controller=adminPromotion&action=index&page=<?php echo $i; ?>" <?php echo $i === $page ? 'class="active"' : ''; ?>><?php echo $i; ?></a>
            <?php endfor; ?>

            <?php if ($page < $totalPages): ?>
                <a href="index.php?controller=adminPromotion&action=index&page=<?php echo $page + 1; ?>">Next</a>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>

<?php require 'views/admin/components/admin_footer.php'; ?>