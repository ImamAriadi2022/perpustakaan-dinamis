<?php

$server = "localhost";
$username = "root";
$password = "";
$dbname = "multi-user-login";



$koneksi = mysqli_connect($server, $username, $password, $dbname) or die("koneksi gagal");