<?php
    include "services/database.php";

    $login_result = "";

    if (isset($_POST['submit'])) 
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $login_result = validateLogin($username, $password, $db);
    }

    function validateLogin($username, $password, $db) {
        if (isEmpty($username) && isEmpty($password)) {
            return "Username atau password tidak boleh kosong";
        }
    
        if (isEmpty($username)) {
            return "Username tidak boleh kosong";
        }
    
        if (isEmpty($password)) {
            return "Password tidak boleh kosong";
        }

        if (strlen($username) > 255) {
            return "Username terlalu panjang";
        }
    
        if (strlen($password) > 255) {
            return "Password terlalu panjang";
        }

        try {
            $find_username_query = "SELECT * FROM users WHERE username = '$username'";
            $find_result = $db->query($find_username_query);

            if ($find_result->num_rows == 0) {
                return "Username atau password salah";
            }

            $user = $find_result->fetch_assoc();
            
            if (password_verify($password, $user['password'])) {
                return "Login berhasil";
            }

        } catch (Exception $e) {
            return "Gagal login karena: " . $e->getMessage();
        }
    }

    function isEmpty($value) {
        return empty($value);
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

        <p>Sign in</p>

        <form action="index.php" method="POST">
            <input type="text" name="username" placeholder="username"><br>
            <input type="password" name="password" placeholder="password"><br>
            <button type="submit" name="submit">Submit</button>
        </form>

        <p><?= $login_result?></p>

        <p>Belum punya akun? <a href="register.php">Sign up</a></p>
    </div>
</body>
</html>