<?php
$host = 'localhost';
$dbname = 'perpustakaan_ts0ra';
$username = 'root';  // Ganti dengan username database Anda
$password = '';      // Ganti dengan password database Anda

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>