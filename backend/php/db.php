<?php
    $hostname = 'localhost';            // Sesuaikan dengan hostname kamu
    $username = 'root';                 // Sesuaikan dengan password kamu
    $password = '';                     // Sesuaikan dengan password database kamu
    $database = 'perpustakaan_ts0ra1';  // Sesuaikan dengan nama database kamu

    $db = mysqli_connect($hostname, $username, $password, $database);

    if ($db->connect_error)
    {
        echo "Failed to enstablish connection into database";
        die();
    }
?>