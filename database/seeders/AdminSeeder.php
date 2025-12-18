<?php
/**
 * Admin Seeder
 * Seeds default admin users
 */

return function (PDO $pdo) {
    // Clear existing data
    $pdo->exec("DELETE FROM tbl_admin");

    // Default password: admin123 (hashed)
    $password = password_hash('admin123', PASSWORD_DEFAULT);

    $admins = [
        [
            'username' => 'admin',
            'email' => 'admin@onestore.com',
            'password' => $password,
            'firstName' => 'Admin',
            'lastName' => 'User',
            'role' => 'super_admin',
            'status' => 1
        ],
        [
            'username' => 'manager',
            'email' => 'manager@onestore.com',
            'password' => $password,
            'firstName' => 'Manager',
            'lastName' => 'User',
            'role' => 'manager',
            'status' => 1
        ]
    ];

    $stmt = $pdo->prepare("
        INSERT INTO tbl_admin 
        (username, email, password, firstName, lastName, role, status) 
        VALUES 
        (:username, :email, :password, :firstName, :lastName, :role, :status)
    ");

    foreach ($admins as $admin) {
        $stmt->execute($admin);
    }

    echo "   Inserted " . count($admins) . " admin users\n";
};
