<?php
require_once("../function/koneksi.php");
require_once("../function/helper.php");

if (isset($_POST['daftar'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = 'user'; // Default role

    // Cek apakah username sudah digunakan
    $query_check = "SELECT * FROM user WHERE username = '$username'";
    $result_check = mysqli_query($koneksi, $query_check);

    if (mysqli_num_rows($result_check) > 0) {
        header("Location: " . BASE_URL . "register.php?error=Username sudah digunakan. Silakan gunakan username lain.");
    } else {
        // Hash password untuk keamanan
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Query untuk memasukkan data pengguna baru
        $query = "INSERT INTO user (username, password, role) VALUES ('$username', '$hashed_password', '$role')";

        if (mysqli_query($koneksi, $query)) {
            header("Location: " . BASE_URL . "register.php?success=Registrasi berhasil. Silakan login.");
            exit();
        } else {
            header("Location: " . BASE_URL . "register.php?error=Error: " . mysqli_error($koneksi));
        }
    }
}
?>
