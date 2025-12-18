<?php
/**
 * Category Seeder
 * Seeds sample categories
 */

return function (PDO $pdo) {
    // Clear existing data
    $pdo->exec("DELETE FROM tbl_category");

    $categories = [
        [
            'catName' => 'Electronics',
            'slug' => 'electronics',
            'description' => 'Smartphones, laptops, tablets, and electronic gadgets.',
            'status' => 1
        ],
        [
            'catName' => 'Clothing',
            'slug' => 'clothing',
            'description' => 'Fashion apparel for men, women, and kids.',
            'status' => 1
        ],
        [
            'catName' => 'Accessories',
            'slug' => 'accessories',
            'description' => 'Watches, bags, jewelry, and fashion accessories.',
            'status' => 1
        ],
        [
            'catName' => 'Home & Living',
            'slug' => 'home-living',
            'description' => 'Furniture, decor, and home essentials.',
            'status' => 1
        ],
        [
            'catName' => 'Sports',
            'slug' => 'sports',
            'description' => 'Sports equipment, activewear, and fitness gear.',
            'status' => 1
        ]
    ];

    $stmt = $pdo->prepare("
        INSERT INTO tbl_category 
        (catName, slug, description, status) 
        VALUES 
        (:catName, :slug, :description, :status)
    ");

    foreach ($categories as $category) {
        $stmt->execute($category);
    }

    echo "   Inserted " . count($categories) . " categories\n";
};
