<?php
/**
 * Customer Seeder
 * Seeds sample customers
 */

return function (PDO $pdo) {
    // Clear existing data
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 0");
    $pdo->exec("DELETE FROM tbl_customer");
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 1");

    // Default password: password123 (hashed)
    $password = password_hash('password123', PASSWORD_DEFAULT);

    $customers = [
        [
            'firstName' => 'John',
            'lastName' => 'Doe',
            'email' => 'john.doe@example.com',
            'password' => $password,
            'phone' => '+1234567890',
            'email_verified' => 1,
            'status' => 1
        ],
        [
            'firstName' => 'Jane',
            'lastName' => 'Smith',
            'email' => 'jane.smith@example.com',
            'password' => $password,
            'phone' => '+0987654321',
            'email_verified' => 1,
            'status' => 1
        ],
        [
            'firstName' => 'Michael',
            'lastName' => 'Johnson',
            'email' => 'michael.j@example.com',
            'password' => $password,
            'phone' => '+1122334455',
            'email_verified' => 0,
            'status' => 1
        ],
        [
            'firstName' => 'Emily',
            'lastName' => 'Davis',
            'email' => 'emily.davis@example.com',
            'password' => $password,
            'phone' => '+5566778899',
            'email_verified' => 1,
            'status' => 1
        ],
        [
            'firstName' => 'Test',
            'lastName' => 'User',
            'email' => 'test@example.com',
            'password' => $password,
            'phone' => '+1111111111',
            'email_verified' => 1,
            'status' => 1
        ]
    ];

    $stmt = $pdo->prepare("
        INSERT INTO tbl_customer 
        (firstName, lastName, email, password, phone, email_verified, status) 
        VALUES 
        (:firstName, :lastName, :email, :password, :phone, :email_verified, :status)
    ");

    foreach ($customers as $customer) {
        $stmt->execute($customer);
    }

    echo "   Inserted " . count($customers) . " customers\n";
};
