<div class="section-title">
    <h2>All Products</h2>
</div>

<div class="products">
    <?php
    // In a real application, this would come from a database
    // and would include filtering by category if specified in the URL
    $category = isset($_GET['category']) ? $_GET['category'] : '';
    
    $all_products = [
        [
            'id' => 1,
            'name' => 'Classic Sneakers',
            'price' => 79.99,
            'image' => 'assets/images/product1.jpg',
            'category' => 'men'
        ],
        [
            'id' => 2,
            'name' => 'Running Shoes',
            'price' => 99.99,
            'image' => 'assets/images/product2.jpg',
            'category' => 'sports'
        ],
        [
            'id' => 3,
            'name' => 'Casual Loafers',
            'price' => 69.99,
            'image' => 'assets/images/product3.jpg',
            'category' => 'men'
        ],
        [
            'id' => 4,
            'name' => 'Formal Oxfords',
            'price' => 129.99,
            'image' => 'assets/images/product4.jpg',
            'category' => 'men'
        ],
        [
            'id' => 5,
            'name' => 'Women\'s Flats',
            'price' => 59.99,
            'image' => 'assets/images/product5.jpg',
            'category' => 'women'
        ],
        [
            'id' => 6,
            'name' => 'High Heels',
            'price' => 89.99,
            'image' => 'assets/images/product6.jpg',
            'category' => 'women'
        ],
        [
            'id' => 7,
            'name' => 'Kids\' Sneakers',
            'price' => 49.99,
            'image' => 'assets/images/product7.jpg',
            'category' => 'kids'
        ],
        [
            'id' => 8,
            'name' => 'Basketball Shoes',
            'price' => 119.99,
            'image' => 'assets/images/product8.jpg',
            'category' => 'sports'
        ]
    ];
    
    // Filter by category if specified
    if (!empty($category)) {
        $filtered_products = array_filter($all_products, function($product) use ($category) {
            return $product['category'] === $category;
        });
    } else {
        $filtered_products = $all_products;
    }
    
    if (empty($filtered_products)) {
        echo '<p>No products found in this category.</p>';
    } else {
        foreach ($filtered_products as $product) {
            echo '<div class="product-card">';
            echo '<div class="product-img">';
            echo '<img src="/placeholder.svg?height=200&width=300" alt="' . $product['name'] . '">';
            echo '</div>';
            echo '<div class="product-info">';
            echo '<h3>' . $product['name'] . '</h3>';
            echo '<div class="price">$' . number_format($product['price'], 2) . '</div>';
            echo '<a href="index.php?page=product-detail&id=' . $product['id'] . '" class="btn">View Details</a>';
            echo '</div>';
            echo '</div>';
        }
    }
    ?>
</div>
