<?php
/**
 * Brand Seeder
 * Seeds sample brands
 */

return function (PDO $pdo) {
    // Clear existing data
    $pdo->exec("DELETE FROM tbl_brand");

    $brands = [
        [
            'brandName' => 'Apple',
            'slug' => 'apple',
            'description' => 'Think Different. Premium technology products.',
            'status' => 1
        ],
        [
            'brandName' => 'Samsung',
            'slug' => 'samsung',
            'description' => 'Do What You Can\'t. Leading electronics manufacturer.',
            'status' => 1
        ],
        [
            'brandName' => 'Nike',
            'slug' => 'nike',
            'description' => 'Just Do It. Worldwide sportswear brand.',
            'status' => 1
        ],
        [
            'brandName' => 'Sony',
            'slug' => 'sony',
            'description' => 'Be Moved. Entertainment and electronics.',
            'status' => 1
        ],
        [
            'brandName' => 'Adidas',
            'slug' => 'adidas',
            'description' => 'Impossible Is Nothing. Sports and lifestyle brand.',
            'status' => 1
        ]
    ];

    $stmt = $pdo->prepare("
        INSERT INTO tbl_brand 
        (brandName, slug, description, status) 
        VALUES 
        (:brandName, :slug, :description, :status)
    ");

    foreach ($brands as $brand) {
        $stmt->execute($brand);
    }

    echo "   Inserted " . count($brands) . " brands\n";
};
