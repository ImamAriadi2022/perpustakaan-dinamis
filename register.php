<?php
    include "services/database.php";

    $regist_result = "";
    $regex_pass = '/[\s\W_]/';

    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $regis_query = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";
        $check_query = "SELECT username FROM users WHERE username = '$username'";

        $regist_result = validateRegistration($username, $password, $db, $regis_query, $check_query);
    }

    function validateRegistration($username, $password, $db, $regis_query, $check_query) {
        if (isEmpty($username) && isEmpty($password)) {
            return "Username atau password tidak boleh kosong";
        }
    
        if (isEmpty($username)) {
            return "Username tidak boleh kosong";
        }
    
        if (isEmpty($password)) {
            return "Password tidak boleh kosong";
        }
    
        if (hasInvalidCharacters($username)) {
            return "Username tidak boleh mengandung karakter khusus, spasi, atau underscore";
        }
    
        if ($db->query($check_query)->num_rows > 0) {
            return "Username sudah terdaftar";
        }
    
        if (strlen($username) > 255) {
            return "Username terlalu panjang";
        }
    
        if (strlen($password) > 255) {
            return "Password terlalu panjang";
        }
    
        try {
            $password = removeWhiteSpace($password);
            $db->query($regis_query);
            return "Register berhasil";
        } catch (Exception $e) {
            return "Gagal mendaftar karena: " . $e->getMessage();
        }
    }
    
    function isEmpty($value) {
        return empty($value);
    }
    
    function hasInvalidCharacters($username) {
        return preg_match('/[\s\W_]/', $username);
    }

    function removeWhiteSpace($string) {
        return preg_replace('/\s+/', '', $string);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan ts0ra</title>
</head>
<body>
    <div>
        <h1>Selamat datang di Perpustakaan ts0ra</h1>

        <p>Sign up</p>
        
        <form action="register.php" method="POST">
            <input type="text" name="username" placeholder="username"><br>
            <input type="password" name="password" placeholder="password"><br>
            <button type="submit" name="submit">Submit</button>
        </form>

        <p><?= $regist_result ?></p>

        <p>Sudah punya akun? <a href="index.php">Sign in</a></p>
    </div>
</body>
</html>