<?php
/**
 * Simple API Test Endpoint
 * Tests basic functionality and routing
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Content-Type');

// Start session
session_start();

$response = [
    'success' => true,
    'message' => 'OneStore API is working!',
    'timestamp' => date('Y-m-d H:i:s'),
    'method' => $_SERVER['REQUEST_METHOD'],
    'path' => $_SERVER['REQUEST_URI'] ?? 'unknown',
    'session_id' => session_id(),
    'server' => [
        'host' => $_SERVER['HTTP_HOST'] ?? 'unknown',
        'addr' => $_SERVER['SERVER_ADDR'] ?? 'unknown'
    ]
];

// Test database if available
try {
    if (file_exists('config/app.php')) {
        require_once 'config/app.php';
        $pdo = connectToDatabase();
        $stmt = $pdo->query("SELECT 'Database connected!' as message");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $response['database'] = $result['message'];
    }
} catch (Exception $e) {
    $response['database'] = 'Database connection failed: ' . $e->getMessage();
}

echo json_encode($response, JSON_PRETTY_PRINT);
?> 