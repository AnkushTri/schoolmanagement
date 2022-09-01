<?php
require "header.php";
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
                if(isset($_GET['err'])){
                    echo "<div class='col-12 alert alert-danger'>Please Login First.</div>";
                }
                    if(isset($_POST['submit'])){
                        include "admin/config.php";
                        $email = $_POST['email'];
                        $password = md5($_POST['password']);
                        //echo $email.' '.$password;
                        $q = "select * from `student` where `email`='$email' and `password`='$password'";
                        $result = mysqli_query($conn,$q);
                        if(mysqli_num_rows($result) > 0){
                            //login
                            $data = mysqli_fetch_assoc($result);
                            $_SESSION['user_name'] = $data['name'];
                            $_SESSION['user_email'] = $data['email'];
                            $_SESSION['user_id'] = $data['id'];
                            echo "<script>window.location.assign('index.php');</script>";
                        }else{
                          echo mysqli_error($conn);
                            //invalid
                            echo "<div class='col-12 alert alert-danger'>Invalid Email/Password.</div>";
                        }
                    }
                ?>
                <div class="col-lg-12 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
                    <form method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Password</label>
                            <input class="form-control" type="password" id="formFile" name="password">
                            <!-- <input class="form-control" type="text" id="formFile" name="image"> -->
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    </form>
                </div>
            </div>

        </div>
    </section><!-- End About Section -->
</main>
<?php
require "footer.php";
?>