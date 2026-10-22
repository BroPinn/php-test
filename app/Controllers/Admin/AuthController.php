<?php

require_once __DIR__ . '/../../Models/Admin.php';

class AuthController {
    public static function login(): void {
        $username = trim($_POST['username'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if (empty($username) || empty($password)) {
            $_SESSION['auth_error'] = 'Please enter both username and password.';
            header('Location: ' . admin_url('login'));
            exit;
        }

        $admin = Admin::findByUsername($username);

        if ($admin && password_verify($password, $admin['password'])) {
            session_regenerate_id(true);

            $_SESSION['admin'] = [
                'id'       => (int)$admin['adminID'],
                'username' => $admin['username'],
                'email'    => $admin['email'],
                'name'     => trim(($admin['firstName'] ?? '') . ' ' . ($admin['lastName'] ?? '')) ?: $admin['username'],
                'role'     => $admin['role'] ?? 'admin'
            ];

            Admin::updateLastLogin((int)$admin['adminID']);

            unset($_SESSION['auth_error']);
            header('Location: ' . admin_url('dashboard'));
            exit;
        }

        $_SESSION['auth_error'] = 'Invalid username or password.';
        header('Location: ' . admin_url('login'));
        exit;
    }

    public static function logout(): void {
        unset($_SESSION['admin']);
        header('Location: ' . admin_url('login'));
        exit;
    }
}
