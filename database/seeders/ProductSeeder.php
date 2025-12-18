<?php
/**
 * Product Seeder
 * Seeds sample products
 */

return function (PDO $pdo) {
    // Clear existing data (order matters due to foreign keys)
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 0");
    $pdo->exec("DELETE FROM tbl_product");
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 1");

    // Get category and brand IDs
    $categories = $pdo->query("SELECT categoryID, slug FROM tbl_category")->fetchAll(PDO::FETCH_KEY_PAIR);
    $brands = $pdo->query("SELECT brandID, slug FROM tbl_brand")->fetchAll(PDO::FETCH_KEY_PAIR);

    // Flip arrays for easy lookup
    $catBySlug = array_flip($categories);
    $brandBySlug = array_flip($brands);

    $products = [
        [
            'categoryID' => $catBySlug['electronics'] ?? 1,
            'brandID' => $brandBySlug['apple'] ?? 1,
            'productName' => 'iPhone 15 Pro Max',
            'slug' => 'iphone-15-pro-max',
            'description' => 'The most powerful iPhone ever with A17 Pro chip.',
            'short_description' => 'Latest Apple flagship smartphone',
            'price' => 1199.99,
            'sale_price' => null,
            'sku' => 'IPHONE15PM',
            'stock_quantity' => 50,
            'featured' => 1,
            'status' => 1
        ],
        [
            'categoryID' => $catBySlug['electronics'] ?? 1,
            'brandID' => $brandBySlug['samsung'] ?? 2,
            'productName' => 'Samsung Galaxy S24 Ultra',
            'slug' => 'samsung-galaxy-s24-ultra',
            'description' => 'Ultimate Galaxy experience with built-in S Pen.',
            'short_description' => 'Samsung flagship with S Pen',
            'price' => 1299.99,
            'sale_price' => 1199.99,
            'sku' => 'SAMS24U',
            'stock_quantity' => 35,
            'featured' => 1,
            'status' => 1
        ],
        [
            'categoryID' => $catBySlug['clothing'] ?? 2,
            'brandID' => $brandBySlug['nike'] ?? 3,
            'productName' => 'Nike Dri-FIT T-Shirt',
            'slug' => 'nike-dri-fit-tshirt',
            'description' => 'Sweat-wicking technology keeps you dry and comfortable.',
            'short_description' => 'Performance training tee',
            'price' => 35.00,
            'sale_price' => 29.99,
            'sku' => 'NIKEDF01',
            'stock_quantity' => 200,
            'featured' => 0,
            'status' => 1
        ],
        [
            'categoryID' => $catBySlug['clothing'] ?? 2,
            'brandID' => $brandBySlug['adidas'] ?? 5,
            'productName' => 'Adidas Originals Hoodie',
            'slug' => 'adidas-originals-hoodie',
            'description' => 'Classic streetwear style with iconic trefoil logo.',
            'short_description' => 'Iconic Adidas hoodie',
            'price' => 80.00,
            'sale_price' => null,
            'sku' => 'ADIHOOD01',
            'stock_quantity' => 100,
            'featured' => 1,
            'status' => 1
        ],
        [
            'categoryID' => $catBySlug['accessories'] ?? 3,
            'brandID' => $brandBySlug['apple'] ?? 1,
            'productName' => 'Apple Watch Series 9',
            'slug' => 'apple-watch-series-9',
            'description' => 'Advanced health monitoring and fitness tracking.',
            'short_description' => 'Smartwatch with health features',
            'price' => 399.99,
            'sale_price' => 379.99,
            'sku' => 'AWS9',
            'stock_quantity' => 75,
            'featured' => 1,
            'status' => 1
        ],
        [
            'categoryID' => $catBySlug['electronics'] ?? 1,
            'brandID' => $brandBySlug['sony'] ?? 4,
            'productName' => 'Sony WH-1000XM5',
            'slug' => 'sony-wh-1000xm5',
            'description' => 'Industry-leading noise canceling headphones.',
            'short_description' => 'Premium wireless headphones',
            'price' => 399.99,
            'sale_price' => 349.99,
            'sku' => 'SONYWH5',
            'stock_quantity' => 60,
            'featured' => 0,
            'status' => 1
        ],
        [
            'categoryID' => $catBySlug['sports'] ?? 5,
            'brandID' => $brandBySlug['nike'] ?? 3,
            'productName' => 'Nike Air Max 270',
            'slug' => 'nike-air-max-270',
            'description' => 'Max Air unit delivers unbelievable all-day comfort.',
            'short_description' => 'Lifestyle sneakers with Air Max',
            'price' => 150.00,
            'sale_price' => null,
            'sku' => 'NIKEAM270',
            'stock_quantity' => 85,
            'featured' => 1,
            'status' => 1
        ],
        [
            'categoryID' => $catBySlug['electronics'] ?? 1,
            'brandID' => $brandBySlug['apple'] ?? 1,
            'productName' => 'MacBook Pro 14"',
            'slug' => 'macbook-pro-14',
            'description' => 'Supercharged by M3 Pro or M3 Max chip.',
            'short_description' => 'Pro laptop for demanding workflows',
            'price' => 1999.99,
            'sale_price' => null,
            'sku' => 'MBP14M3',
            'stock_quantity' => 25,
            'featured' => 1,
            'status' => 1
        ]
    ];

    $stmt = $pdo->prepare("
        INSERT INTO tbl_product 
        (categoryID, brandID, productName, slug, description, short_description, 
         price, sale_price, sku, stock_quantity, featured, status) 
        VALUES 
        (:categoryID, :brandID, :productName, :slug, :description, :short_description,
         :price, :sale_price, :sku, :stock_quantity, :featured, :status)
    ");

    foreach ($products as $product) {
        $stmt->execute($product);
    }

    echo "   Inserted " . count($products) . " products\n";
};
