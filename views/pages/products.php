

<div class="section-title">
    <h2>All Products</h2>
</div>

<div class="products">
    <?php
    // Lọc theo danh mục nếu có
    $category = isset($_GET['category']) ? $_GET['category'] : '';

    if (!empty($category)) {
        $filtered_products = array_filter($products, function($product) use ($category) {
            return $product['category'] === $category;
        });
    } else {
        $filtered_products = $products;
    }

    if (empty($filtered_products)) {
        echo '<p>No products found in this category.</p>';
    } else {
        foreach ($filtered_products as $product) {
            echo '<div class="product-card">';
            echo '<div class="product-img">';
            echo '<img src="' . (file_exists($_SERVER['DOCUMENT_ROOT'] . '/shoesWebsite/' . $product['image']) ? '/shoesWebsite/' . htmlspecialchars($product['image']) : '/shoesWebsite/assets/images/placeholder.png') . '" alt="' . htmlspecialchars($product['name']) . '" loading="lazy">';
            echo '</div>';
            echo '<div class="product-info">';
            echo '<h3>' . htmlspecialchars($product['name']) . '</h3>';
            echo '<div class="price">$' . number_format($product['price'], 2) . '</div>';
            echo '<a href="/shoesWebsite/index.php?controller=products&action=detail&id=' . $product['id'] . '" class="btn">View Details</a>';
            echo '</div>';
            echo '</div>';
        }
    }
    ?>
</div>

<?php require_once 'views/components/footer.php'; ?>