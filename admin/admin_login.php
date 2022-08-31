<?php
require "header.php";
if(!isset($_SESSION['admin_name'])){
    echo "<script>window.location.assign('login.php');</script>";
  }
?>
<main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs" data-aos="fade-in">
        <div class="container">
            <h2>Login</h2>

        </div>
    </div><!-- End Breadcrumbs -->
    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">

            <div class="row">
                <?php
                if (isset($_POST['submit'])) {
                    include "config.php";
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    $q = "insert into `teacher`(`email`,`password`)value('$email','$password')";
                    $result = mysqli_query($conn, $q);
                }