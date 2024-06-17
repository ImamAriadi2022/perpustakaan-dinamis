<?php
 require_once('function/helper.php');

 
 if ($_SESSION['role'] != 'admin') {
    header("Location: " . BASE_URL . 'dashboard-php?page-admin');
    exit();
 }
?>


<div class="card">
    <h1>halaman admin</h1>
</div>