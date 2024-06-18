<?php
require '../db.php';

// Mendapatkan data dari request
$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
$role_id = '2'; // Default role for new users

try {
    $stmt = $pdo->prepare('INSERT INTO users (username, password) VALUES (?, ?, ?)');
    $stmt->execute([$username, $password, $role_id]);
    echo 'Pendaftaran berhasil.';
} catch (PDOException $e) {
    if ($e->errorInfo[1] == 1062) {
        echo 'Email sudah digunakan.';
    } else {
        echo 'Terjadi kesalahan pada server.';
    }
}
?>
