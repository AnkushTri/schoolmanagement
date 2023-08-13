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
            <h2>Add Teacher</h2>

        </div>
    </div><!-- End Breadcrumbs -->
    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">

            <div class="row">
                <?php
                if (isset($_GET['msg'])) {
                    echo "<div class='col-12 alert alert-success'>Form Submitted!!!</div>";
                }
                if (isset($_GET['err'])) {
                    echo "<div class='col-12 alert alert-danger'>Error!!!</div>";
                }
                if (isset($_POST['submit'])) {
                    //print_r($_FILES);
                    include "config.php";
                    $name = $_POST['name'];
                    $email = $_POST['email'];
                    $password = md5($_POST['password']);
                    $contact = $_POST['contact'];
                    $qualification = $_POST['qualification'];
                    $experience = $_POST['experience'];
                    $gender = $_POST['gender'];
                    $dob = $_POST['dob'];                   
                    $image = rand().$_FILES['pic']['name'];
                    $location = $_FILES['pic']['tmp_name'];                    
                    $q = "insert into `teacher`(`name`,`email`,`password`,`contact`,`qualification`,`experience`,`gender`,`dob`,`id_proof`) value('$name','$email','$password','$contact','$qualification','$experience','$gender','$dob','$image')";
                    $result = mysqli_query($conn, $q);
                    if ($result > 0) {
                        move_uploaded_file($location,'../upload/'.$image);//used to save image from temporary folder to our project folder
                        echo "<script>window.location.assign('add_teacher.php?msg');</script>";
                        
                    } else {
                        echo "No";
                        //echo mysqli_error($conn);
                        echo "<script>window.location.assign('add_teacher.php?err');</script>";
                    }
                }
                ?>
                <div class="col-lg-12 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
                    <form method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="exampleInputName" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="exampleInputName" aria-describedby="emailHelp" required>

                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" required>

                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword" aria-describedby="emailHelp" required>

                        </div>
                        <div class="mb-3">
                            <label for="exampleInputContact" class="form-label">Contact</label>
                            <input type="tel" name="contact" class="form-control" id="exampleInputContact" aria-describedby="emailHelp" required>

                        </div>
                        <div class="mb-3">
                            <label for="exampleInputQualification" class="form-label">Qualification</label>
                            <input type="text" name="qualification" class="form-control" id="exampleInputQualification" aria-describedby="emailHelp" required>

                        </div>
                        <div class="mb-3">
                            <label for="exampleInputExperience" class="form-label">Experience</label>
                            <input type="text" name="experience" class="form-control" id="exampleInputExperience" aria-describedby="emailHelp" required>

                        </div>
                        <div class="mb-3">
                            <label>Gender</label><br>
                            <input type="radio"  name="gender" value="male" checked>Male<br>
                            <input type="radio"  name="gender" value="female">Female<br>
                            <input type="radio"  name="gender" value="other">Other
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputDOB" class="form-label">D.O.B.</label>
                            <input type="date" name="dob" class="form-control" id="exampleInputDOB" aria-describedby="emailHelp" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputID" class="form-label">Id-Proof</label>
                            <input class="form-control" type="file" id="exampleInputID" name="pic" required>
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