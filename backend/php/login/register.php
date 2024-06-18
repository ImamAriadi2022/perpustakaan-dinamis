<?php
require '../db.php';

// Mendapatkan data dari request
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

try {
    $stmt = $pdo->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
    $stmt->execute([$username, $password]);
    echo 'Pendaftaran berhasil.';
} catch (PDOException $e) {
    if ($e->errorInfo[1] == 1062) {
        echo 'Email sudah digunakan.';
    } else {
        echo 'Terjadi kesalahan pada server.';
    }
}
?>
