<?php
class ProductModel {
    private $products = [
        1 => [
            'id' => 1,
            'name' => 'Classic Sneakers',
            'price' => 79.99,
            'image' => 'assets/images/product1.jpg',
            'description' => 'These classic sneakers offer both style and comfort. Perfect for casual everyday wear, they feature a durable rubber sole and breathable upper material. Available in multiple colors to match any outfit.',
            'category' => 'men'
        ],
        2 => [
            'id' => 2,
            'name' => 'Running Shoes',
            'price' => 99.99,
            'image' => 'assets/images/product2.jpg',
            'description' => 'Designed for performance and comfort, these running shoes feature advanced cushioning technology and breathable mesh. Perfect for both serious runners and casual joggers.',
            'category' => 'sports'
        ],
        3 => [
            'id' => 3,
            'name' => 'Casual Loafers',
            'price' => 69.99,
            'image' => 'assets/images/product3.jpg',
            'description' => 'Slip into comfort with these stylish loafers. Made with premium materials and featuring a cushioned insole, they\'re perfect for both work and casual occasions.',
            'category' => 'men'
        ],
        4 => [
            'id' => 4,
            'name' => 'Formal Oxfords',
            'price' => 129.99,
            'image' => 'assets/images/product4.jpg',
            'description' => 'These classic oxford shoes are crafted from genuine leather with a polished finish. Perfect for formal events, business meetings, or any occasion that calls for sophisticated footwear.',
            'category' => 'men'
        ],
        5 => [
            'id' => 5,
            'name' => 'Women\'s Flats',
            'price' => 59.99,
            'image' => 'assets/images/product5.jpg',
            'description' => 'Elegant and comfortable, these women\'s flats are perfect for everyday wear. Made with soft materials and a cushioned sole, they offer all-day comfort.',
            'category' => 'women'
        ],
        6 => [
            'id' => 6,
            'name' => 'High Heels',
            'price' => 89.99,
            'image' => 'assets/images/product6.jpg',
            'description' => 'Step up your style with these stunning high heels. Perfect for special occasions, they feature a sleek design and a comfortable fit.',
            'category' => 'women'
        ],
        7 => [
            'id' => 7,
            'name' => 'Kids\' Sneakers',
            'price' => 49.99,
            'image' => 'assets/images/product7.jpg',
            'description' => 'Durable and fun, these kids\' sneakers are perfect for active children. They feature a sturdy sole and bright colors that kids will love.',
            'category' => 'kids'
        ],
        8 => [
            'id' => 8,
            'name' => 'Basketball Shoes',
            'price' => 119.99,
            'image' => 'assets/images/product8.jpg',
            'description' => 'Designed for the court, these basketball shoes offer superior grip and support. Perfect for players who need performance and style.',
            'category' => 'sports'
        ]
    ];

    public function getAllProducts() {
        return $this->products;
    }

    public function getProductById($id) {
        return isset($this->products[$id]) ? $this->products[$id] : null;
    }
}