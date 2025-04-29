<?php
require 'views/admin/components/header.php';
?>

<div class="section-title">
    <h2>Manage Products for Promotion: <?php echo htmlspecialchars($promotion['promotion_name']); ?></h2>
</div>

<div class="promotion-manage-products">
    <form method="post" action="">
        <table>
            <thead>
                <tr>
                    <th>Select</th>
                    <th>Product ID</th>
                    <th>Product Name</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td>
                            <input type="checkbox" name="products[]" value="<?php echo $product['id']; ?>"
                                <?php echo in_array($product['id'], $assignedProducts) ? 'checked' : ''; ?>>
                        </td>
                        <td><?php echo $product['id']; ?></td>
                        <td><?php echo htmlspecialchars($product['name']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <button type="submit" class="btn">Save Changes</button>
    </form>
</div>

<?php
require 'views/admin/components/admin_footer.php';
?>