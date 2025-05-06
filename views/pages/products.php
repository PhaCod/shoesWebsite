<?php require_once 'views/components/header.php'; ?>

<div class="section-title">
    <h2>All Products</h2>
</div>

<!-- Form tìm kiếm với CSS inline -->
<div class="search-form" style="margin: 20px 0; text-align: left;">
    <form action="/shoesWebsite/index.php?controller=products&action=index" method="get" style="display: inline-block;">
        <input type="hidden" name="controller" value="products">
        <input type="hidden" name="action" value="index">
        <input type="text" name="keyword" placeholder="Search products..." 
               value="<?php echo isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : ''; ?>" 
               style="padding: 10px; width: 300px; border: 1px solid #ccc; border-radius: 4px;">
        <button type="submit" 
                style="padding: 10px 20px; background-color: #ff6b6b; color: white; border: none; border-radius: 4px; cursor: pointer;"
                onmouseover="this.style.backgroundColor='#ff5252'"
                onmouseout="this.style.backgroundColor='#ff6b6b'">Search</button>
    </form>
</div>

<div class="products">
    <?php
    $category = isset($_GET['category']) ? $_GET['category'] : '';
    $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
    if (empty($products)) {
        echo '<p>No products found.</p>';
    } else {
        foreach ($products as $product) {
            echo '<div class="product-card">';
            echo '<div class="product-img">';
            $imageUrl = !empty($product['image']) && filter_var($product['image'], FILTER_VALIDATE_URL) ? htmlspecialchars($product['image']) : '/shoesWebsite/public/placeholder.jpg';
            echo '<img src="' . $imageUrl . '" alt="' . htmlspecialchars($product['name']) . '" loading="lazy">';
            echo '</div>';
            echo '<div class="product-info">';
            echo '<h3>' . htmlspecialchars($product['name']) . '</h3>';
            if (isset($product['final_price']) && $product['final_price'] != $product['price']) {
                echo '<div class="price"><s>$' . number_format($product['price'], 2) . '</s><br>$' . number_format($product['final_price'], 2) . '</div>';
            } else {
                echo '<div class="price">$' . number_format($product['price'], 2) . '</div>';
            }
            echo '<a href="/shoesWebsite/index.php?controller=products&action=detail&id=' . $product['id'] . '" class="btn">View Details</a>';
            echo '</div>';
            echo '</div>';
        }
    }
    ?>

    <!-- Phân trang với CSS inline -->
    <?php if (!empty($products) && $totalPages > 1): ?>
        <div class="pagination" style="margin: 20px 0; text-align: center;">
            <?php
            $baseUrl = '/shoesWebsite/index.php?controller=products&action=index';
            if (!empty($keyword)) $baseUrl .= '&keyword=' . urlencode($keyword);
            if (!empty($category)) $baseUrl .= '&category=' . urlencode($category);

            // Nút Previous
            $prevPage = $currentPage > 1 ? $currentPage - 1 : 1;
            echo '<a href="' . $baseUrl . '&page=' . $prevPage . '" 
                     style="display: inline-block; padding: 8px 12px; margin: 0 5px; text-decoration: none; color: #ff6b6b; border: 1px solid #ddd; border-radius: 4px; ' . ($currentPage === 1 ? 'color: #ccc; pointer-events: none; border-color: #ccc;' : '') . '"
                     onmouseover="' . ($currentPage === 1 ? '' : 'this.style.backgroundColor=\'#f5f5f5\'') . '"
                     onmouseout="' . ($currentPage === 1 ? '' : 'this.style.backgroundColor=\'\'') . '">Previous</a>';

            // Các số trang
            for ($i = 1; $i <= $totalPages; $i++) {
                echo '<a href="' . $baseUrl . '&page=' . $i . '" 
                         style="display: inline-block; padding: 8px 12px; margin: 0 5px; text-decoration: none; color: #ff6b6b; border: 1px solid #ddd; border-radius: 4px; ' . ($currentPage === $i ? 'background-color: #ff6b6b; color: white; border-color: #ff6b6b;' : '') . '"
                         onmouseover="' . ($currentPage === $i ? '' : 'this.style.backgroundColor=\'#f5f5f5\'') . '"
                         onmouseout="' . ($currentPage === $i ? '' : 'this.style.backgroundColor=\'\'') . '">' . $i . '</a>';
            }

            // Nút Next
            $nextPage = $currentPage < $totalPages ? $currentPage + 1 : $totalPages;
            echo '<a href="' . $baseUrl . '&page=' . $nextPage . '" 
                     style="display: inline-block; padding: 8px 12px; margin: 0 5px; text-decoration: none; color: #ff6b6b; border: 1px solid #ddd; border-radius: 4px; ' . ($currentPage === $totalPages ? 'color: #ccc; pointer-events: none; border-color: #ccc;' : '') . '"
                     onmouseover="' . ($currentPage === $totalPages ? '' : 'this.style.backgroundColor=\'#f5f5f5\'') . '"
                     onmouseout="' . ($currentPage === $totalPages ? '' : 'this.style.backgroundColor=\'\'') . '">Next</a>';
            ?>
        </div>
    <?php endif; ?>
</div>

<?php require_once 'views/components/footer.php'; ?>