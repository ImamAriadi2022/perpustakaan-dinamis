<?php
session_start();
header('Content-Type: application/json');
require '../db.php';

// Mendapatkan data dari request
$email = $_POST['email'];
$password = $_POST['password'];

try {
    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        echo json_encode(['success' => true, 'role' => $user['role']]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Username atau password salah']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Terjadi kesalahan pada server']);
}
?>
