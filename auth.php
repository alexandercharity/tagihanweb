<?php
session_start();

// Include database configuration from db.php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'login') {
            // Logika login
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            // Cek pengguna di database
            $stmt = $pdo->prepare("SELECT * FROM user WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch();
            
            if ($user && password_verify($password, $user['password'])) {
                // Buat session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['name'] = $user['name'];
                echo json_encode(["status" => "success", "message" => "Login successful"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Invalid credentials"]);
            }
        } elseif ($_POST['action'] === 'register') {
            // Logika register
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            
            try {
                // Simpan pengguna baru
                $stmt = $pdo->prepare("INSERT INTO user (name, email, password, created_at) VALUES (?, ?, ?, NOW())");
                $stmt->execute([$name, $email, $password]);
                
                echo json_encode(["status" => "success", "message" => "Registration successful"]);
            } catch (PDOException $e) {
                echo json_encode(["status" => "error", "message" => "Registration failed: " . $e->getMessage()]);
            }
        }
    }
}
?>