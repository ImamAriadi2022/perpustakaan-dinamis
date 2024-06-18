<?php
function pdo_connect_mysql() {
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'perpustakaan_ts0ra';
    try {
    	return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
    	// If there is an error with the connection, stop the script and display the error.
    	exit('Failed to connect to database!');
    }
}
function template_header($title) {
echo <<<EOT
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>$title</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
    <nav class="navtop"
	style="
	background-color: #342801;
	"
	>
    	<div>
    		<h1>Admin side</h1>
            <a href="/perpustakaan-ts0ra/frontend/page/admin/admin.php"><i class="fas fa-home"></i>Home</a>
            <a href="/perpustakaan-ts0ra/frontend/page/admin/readUser.php"><i></i>Daftar User</a>
            <a href="/perpustakaan-ts0ra"><i></i>Logout</a>
    		<a href="/perpustakaan-ts0ra/frontend/page/admin/read.php"><i class="fas fa-address-book"></i>Tambah Buku</a>
    	</div>
    </nav>
EOT;
}
function template_footer() {
echo <<<EOT
	<body>
		<footer style="
			display: flex;
			align-items: center;
			justify-content: center;
			bottom: 0;
			left: 0;
			width: 100%;
			background-color: #342801;
			color: white;
			text-align: center;
			padding: 10px 0;
		">
			<p style="
			margin: 0;
			">&copy; 2024 by Imam Ariadi & Muhammad Azka naufal</p>
		</footer>
	</body>
EOT;
}
?>