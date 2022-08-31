<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Mentor Bootstrap Template - Index</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Mentor - v4.8.1
  * Template URL: https://bootstrapmade.com/mentor-free-education-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="index.php">Mentor</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.php" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
        <?php
          if (isset($_SESSION['admin_name'])) {
          ?>
          <li><a href="index.php">Home</a></li>
          <li class="dropdown"><a href="#"><span>Class</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="add_classes.php">Add</a></li>                           
              <li><a href="view_classes.php">View</a></li>
            </ul>
          </li>
          <li class="dropdown"><a href="#"><span>Holiday</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="add_holidays.php">Add</a></li>                           
              <li><a href="view_holidays.php">View</a></li>
            </ul>
          </li>
          <li class="dropdown"><a href="#"><span>Teacher</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="add_teacher.php">Add</a></li>                           
              <li><a href="view_teacher.php">View</a></li>
            </ul>
          </li>
          <li class="dropdown"><a href="#"><span>Subject</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="add_subject.php">Add</a></li>                           
              <li><a href="view_subject.php">View</a></li>
            </ul>
          </li>
          <li class="dropdown"><a href="#"><span>Assign_Teacher</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="add_assign_teacher.php">Add</a></li>                           
              <li><a href="view_assign_teacher.php">View</a></li>
            </ul>
          </li>
          <li><a class="active" href="logout.php">Logout</a></li>
          <?php
          }
          ?>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->