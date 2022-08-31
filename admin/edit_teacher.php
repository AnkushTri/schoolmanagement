<?php
require "header.php";
if (!isset($_SESSION['admin_name'])) {
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
                $id = $_GET['id'];
                include "config.php";
                $q = "select * from `teacher` where id='$id'";
                $result = mysqli_query($conn, $q);
                $data = mysqli_fetch_assoc($result);
                if (isset($_POST['submit'])) {
                    //print_r($_FILES);
                    $name = $_POST['name'];
                    $email = $_POST['email'];
                    $contact = $_POST['contact'];
                    $qualification = $_POST['qualification'];
                    $experience = $_POST['experience'];
                    $gender = $_POST['gender'];
                    $dob = $_POST['dob'];
                    //File upload
                    //check if file is uploaded by user
                    if ($_FILES['pic']['error'] > 0) {
                        //user has not uploaded any file
                        $image = $data['id_proof'];
                    } else {
                        //user has uploaded a file        
                        $image = rand() . $_FILES['pic']['name'];
                        $location = $_FILES['pic']['tmp_name'];
                        move_uploaded_file($location, '../upload/' . $image);
                    }
                    if($_POST['password'] != ''){
                        $password = md5($_POST['password']);
                    }else{
                        $password = $data['password'];
                    }
                    $q = "UPDATE `teacher` SET `name`='$name',`email`='$email',`password`='$password',`contact`='$contact',`qualification`='$qualification',`experience`='$experience',`gender`='$gender',`dob`='$dob',`id_proof`='$image' WHERE id='$id'";
                    $result = mysqli_query($conn, $q);
                    if($result > 0){
                        echo "<script>window.location.assign('view_teacher.php?msg=Record Updated.');</script>";
                    }else{
                        echo "<script>window.location.assign('view_teacher.php?msg=Try Again.');</script>";
                    }
                }
                ?>
                <div class="col-lg-12 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
                    <form method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="exampleInputName" class="form-label">Name</label>
                            <input value="<?php echo $data['name']; ?>" type="text" name="name" class="form-control" id="exampleInputName" aria-describedby="emailHelp" required>

                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail" class="form-label">Email</label>
                            <input value="<?php echo $data['email']; ?>" type="email" name="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" required>

                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword" aria-describedby="emailHelp">
                            <small>Enter password if you want to update.</small>

                        </div>
                        <div class="mb-3">
                            <label for="exampleInputContact" class="form-label">Contact</label>
                            <input value="<?php echo $data['contact']; ?>" type="number" name="contact" class="form-control" id="exampleInputContact" aria-describedby="emailHelp" required>

                        </div>
                        <div class="mb-3">
                            <label for="exampleInputQualification" class="form-label">Qualification</label>
                            <input value="<?php echo $data['qualification']; ?>" type="text" name="qualification" class="form-control" id="exampleInputQualification" aria-describedby="emailHelp" required>

                        </div>
                        <div class="mb-3">
                            <label for="exampleInputExperience" class="form-label">Experience</label>
                            <input value="<?php echo $data['experience']; ?>" type="text" name="experience" class="form-control" id="exampleInputExperience" aria-describedby="emailHelp" required>

                        </div>
                        <div class="mb-3">
                            <label>Gender</label><br>
                            <input <?php if ($data['gender'] == 'male') {
                                        echo "checked";
                                    } ?> type="radio" name="gender" value="male">Male<br>
                            <input <?php if ($data['gender'] == 'female') {
                                        echo "checked";
                                    } ?> type="radio" name="gender" value="female">Female<br>
                            <input <?php if ($data['gender'] == 'other') {
                                        echo "checked";
                                    } ?> type="radio" name="gender" value="other">Other
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputDOB" class="form-label">D.O.B.</label>
                            <input value="<?php echo $data['dob']; ?>" type="date" name="dob" class="form-control" id="exampleInputDOB" aria-describedby="emailHelp" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputID" class="form-label">Id-Proof</label>
                            <input class="form-control" type="file" id="exampleInputID" name="pic">
                            <img class="img img-fluid" style="height:50px ;" src="../upload/<?php echo $data['id_proof']; ?>">
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