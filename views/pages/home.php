<div class="hero">
    <div class="hero-content">
        <h1>Step into Style</h1>
        <p>Discover the perfect pair of shoes for every occasion. From casual to formal, we've got you covered.</p>
        <a href="index.php?page=products" class="btn">Shop Now</a>
    </div>
</div>
<section class="featured-products">
    <div class="section-title">
        <h2>Featured Products</h2>
    </div>
    <div class="products">
        <?php
        // In a real application, this would come from a database
        $featured_products = [
            [
                'id' => 1,
                'name' => 'Classic Sneakers',
                'price' => 79.99,
                'image' => 'assets/images/product1.jpg'
            ],
            [
                'id' => 2,
                'name' => 'Running Shoes',
                'price' => 99.99,
                'image' => 'assets/images/product2.jpg'
            ],
            [
                'id' => 3,
                'name' => 'Casual Loafers',
                'price' => 69.99,
                'image' => 'assets/images/product3.jpg'
            ],
            [
                'id' => 4,
                'name' => 'Formal Oxfords',
                'price' => 129.99,
                'image' => 'assets/images/product4.jpg'
            ]
        ];

        foreach ($featured_products as $product) {
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
        ?>
    </div>
</section>

<section class="categories">
    <div class="section-title">
        <h2>Shop by Category</h2>
    </div>
    <div class="products">
        <div class="product-card">
            <div class="product-img">
                <img src="/placeholder.svg?height=200&width=300" alt="Men's Shoes">
            </div>
            <div class="product-info">
                <h3>Men's Shoes</h3>
                <a href="index.php?page=products&category=men" class="btn">Shop Now</a>
            </div>
        </div>
        <div class="product-card">
            <div class="product-img">
                <img src="/placeholder.svg?height=200&width=300" alt="Women's Shoes">
            </div>
            <div class="product-info">
                <h3>Women's Shoes</h3>
                <a href="index.php?page=products&category=women" class="btn">Shop Now</a>
            </div>
        </div>
        <div class="product-card">
            <div class="product-img">
                <img src="/placeholder.svg?height=200&width=300" alt="Kids' Shoes">
            </div>
            <div class="product-info">
                <h3>Kids' Shoes</h3>
                <a href="index.php?page=products&category=kids" class="btn">Shop Now</a>
            </div>
        </div>
        <div class="product-card">
            <div class="product-img">
                <img src="/placeholder.svg?height=200&width=300" alt="Sports Shoes">
            </div>
            <div class="product-info">
                <h3>Sports Shoes</h3>
                <a href="index.php?page=products&category=sports" class="btn">Shop Now</a>
            </div>
        </div>
    </div>
</section>

<?php require_once 'views/components/footer.php'; ?>