<?php
 require_once('function/helper.php');

 
 if ($_SESSION['role'] != 'user') {
    header("Location: " . BASE_URL . 'dashboard-php?page-user');
    exit();
 }
?>


<div class="card">
    <h1>halaman Pengguna</h1>
</div>