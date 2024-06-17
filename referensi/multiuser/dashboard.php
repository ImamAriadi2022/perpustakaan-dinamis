<?php
 require_once('function/helper.php');

 session_start();

 $page = isset($_GET['page']) ? $_GET['page'] : false;
 if ($_SESSION['id'] == null) {
    header("Location: " . BASE_URL);
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Dashboard</title>
   <link rel="stylesheet" href="assets/style01.css">
</head>
<body>
   <nav class="navbar">
      <div class="container">
         <a class="navbar-brand" href="#">Multi User login</a>
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
               <li class="navbar-item">
                  <a class="nav-link active" aria-current="page" href="#">Home</a>
               </li>
               <li class="navbar-item">
                  <a href="process/proses_logout.php" class="nav-link">Logout</a>
               </li>
            </ul>
         </div>
      </div>
   </nav>

   <div class="content">
      <div class="container">
         <div class="sub-content">
            <?php
             if ($_SESSION['role'] == 'admin') {
               $page = 'admin';
             } else if ($_SESSION['role'] == 'user'){
               $page = 'user';
             }

            $filename = "page/$page.php";

            if (file_exists($filename)) {
               include_once($filename);
            } else {
               echo "Page not found";
            }
          ?>
         </div>
      </div>
   </div>
</body>
</html>


