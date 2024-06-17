<?php
include 'functions.php';
// Your PHP code here.

// Home Page template below.
?>

<?=template_header('Home')?>

<!DOCTYPE html>
<html>
<head>
  <title>Website CRUD Saya</title>
  <style>
    body {
      font-family: 'Poppins', sans-serif; /* Font modern */
      margin: 0;
      background-color: #f0f5f9; /* Warna latar belakang lembut */
    }

    .hero {
      text-align: center;
      padding: 100px 0;
      background-image: url('path/to/your/background.jpg'); /* Ganti dengan path foto latar belakang */
      background-size: cover;
      color: white; /* Warna teks agar terlihat di atas latar belakang */
    }

    h1 {
      font-size: 3em;
      margin-bottom: 20px;
	  color: #333333;
    }

    .profile-photo {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      object-fit: cover;
      margin-bottom: 10px;
    }

	span {
		font-size: 1em;
      	margin-bottom: 20px;
		color: #FF8826;
	}
  </style>
</head>
<body>
  <section class="hero">
    <h1>WELLCOME TO MY WEB<span>SITE</span> CRUD</h1>
    <img src="profil.png" alt="Foto Saya" class="profile-photo">
    <p>Nama Saya</p>
  </section>
</body>
</html>


<?=template_footer()?>