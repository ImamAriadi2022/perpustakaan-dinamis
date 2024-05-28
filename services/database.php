<?php
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "perpustakaan_ts0ra";

    $db = mysqli_connect($hostname, $username, $password, $database);

    if ($db->connect_error)
    {
        echo "Failed to enstablish connection into database";
        die();
    }
?>