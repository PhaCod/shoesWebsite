<?php require 'views/admin/components/header.php'; ?>

<div class="section-title">
    <h2>Manage Promotions</h2>
</div>

<?php if (isset($_SESSION['message'])): ?>
    <div class="alert alert-success">
        <?php echo htmlspecialchars($_SESSION['message']); ?>
        <?php unset($_SESSION['message']); ?>
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
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($promotions as $promotion): ?>
                <tr>
                    <td><?php echo $promotion['promotion_id']; ?></td>
                    <td><?php echo htmlspecialchars($promotion['promotion_name']); ?></td>
                    <td><?php echo $promotion['start_date']; ?></td>
                    <td><?php echo $promotion['end_date']; ?></td>
                    <td>
                        <a href="index.php?controller=adminPromotion&action=edit&promotion_id=<?php echo $promotion['promotion_id']; ?>">Edit</a> |
                        <a href="index.php?controller=adminPromotion&action=manageProducts&promotion_id=<?php echo $promotion['promotion_id']; ?>">Manage Products</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


<?php require 'views/admin/components/admin_footer.php'; ?>