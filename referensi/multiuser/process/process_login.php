<?php
require_once("../function/helper.php");
require_once("../function/koneksi.php");

session_start();

// menangkap request user
$username = $_POST['username'];
$password = md5($_POST['password']);

$query = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username' AND password = '$password'");

// mengecek pengguna
if (mysqli_num_rows($query) != 0) {
    $row = mysqli_fetch_array($query);

    $_SESSION['id'] = $row['id'];
    $_SESSION['role'] = $row['role'];
    if ($row['role'] == 'admin') {
        header("location: " . BASE_URL . 'dashboard.php?page-admin');
    } else if ($row['role'] == 'user'){
        header("location: " . BASE_URL . 'dashboard.php?page-user');
    }
} else {
    $_SESSION['error_message'] = "Username atau password salah!";
    header("location: ../index.php");
    exit;
}
?>
