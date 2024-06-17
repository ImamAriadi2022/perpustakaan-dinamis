<?php
    require_once("function/helper.php");
    require_once("function/koneksi.php");

    $error_message = isset($_GET['error']) ? $_GET['error'] : "";
    $success_message = isset($_GET['success']) ? $_GET['success'] : "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= BASE_URL . 'assets/style01.css' ?>">
</head>
<body>
    <div class="topbar">
        <h3 class="text-topbar">Halaman pendaftaran</h3>
    </div>

    <div class="content">
        <div class="card-login">
            <div class="card-main">
                <div class="card-header">Form Pendaftaran</div>
                <div class="card-body">
                    <form name="registerForm" method="POST" action="<?= BASE_URL . 'process/process_register.php' ?>" onsubmit="return validateForm()">
                    <label for="" class="form-label">Username</label><br>
                    <input type="text" name="username" class="form-input" required><br>
                    <label for="" class="form-label">Password</label><br>
                    <input type="password" name="password" class="form-input" required><br>
                    <button type="submit" name="daftar" class="btn-login">Daftar</button>
                    </form>
                </div>
                <p class="caption">Sudah Memiliki akun? <a href="<?= BASE_URL . 'index.php' ?>">Login</a></p>
            </div>
        </div>
    </div>
    <script src="function/validasi.js"></script>
    <script>
    window.onload = function() {
    var successMessage = "<?= $success_message ?>";
    var errorMessage = "<?= $error_message ?>";

    if (successMessage) {
        showPopup(successMessage, "success");
    }

    if (errorMessage) {
        showPopup(errorMessage, "error");
    }
};
    </script>
</body>
</html>
