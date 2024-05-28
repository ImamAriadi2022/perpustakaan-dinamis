<?php
    include "services/database.php";
    include "services/function.php";
    session_start();

    $login_result = "";

    if (isset($_SESSION['is_login'])) {
        header("Location: dashboard.php");
    }

    if (isset($_POST['submit'])) 
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $login_result = validateLogin($username, $password, $db);

        $db->close();
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
                $_SESSION['username'] = $user['username'];
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['is_login'] = true;
                header("Location: dashboard.php");
                return "Login berhasil";
            } else {
                return "Username atau password salah";
            }

        } catch (Exception $e) {
            return "Gagal login karena: " . $e->getMessage();
        }
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
        <h1>Website Perpustakaan</h1>

        <p>Sign in</p>

        <form action="index.php" method="POST">
            <input type="text" name="username" placeholder="username" required><br>
            <input type="password" name="password" placeholder="password" required><br>
            <button type="submit" name="submit">Submit</button>
        </form>

        <p><?= $login_result?></p>

        <p>Belum punya akun? <a href="register.php">Sign up</a></p>
    </div>
</body>
</html>