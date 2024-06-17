<?php
require_once("function/helper.php");
require_once("function/koneksi.php");

session_start();
$error_message = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : "";
unset($_SESSION['error_message']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= BASE_URL . 'assets/style01.css' ?>">
    <script src="<?= BASE_URL . 'function/validasi_login.js' ?>"></script>
    <script>
        window.onload = function() {
            var errorMessage = "<?= $error_message ?>";
            if (errorMessage) {
                showPopup(errorMessage, "error");
            }
        }
    </script>
</head>
<body>
    <div class="topbar">
        <h3 class="text-topbar">Login sederhana</h3>
    </div>

    <div class="content">
        <div class="card-login">
            <div class="card-main">
                <div class="card-header">Form Login</div>
                <div class="card-body">
                    <form id="loginForm" method="POST" action="<?= BASE_URL . 'process/process_login.php' ?>">
                        <label for="username" class="form-label">Username</label><br>
                        <input type="text" id="username" name="username" class="form-input"><br>
                        <label for="password" class="form-label">Password</label><br>
                        <input type="password" id="password" name="password" class="form-input"><br>
                        <button type="submit" class="btn btn-login">Login</button>
                    </form>
                </div>
                <p class="caption">Belum Memiliki akun? <a href="<?= BASE_URL . 'register.php' ?>">Daftar</a></p>
            </div>
        </div>
    </div>
</body>
</html>
