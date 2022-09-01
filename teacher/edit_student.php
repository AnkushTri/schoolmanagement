<?php
require "header.php";
if (!isset($_SESSION['teacher_name'])) {
    echo "<script>window.location.assign('login.php');</script>";
}
?>
<main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs" data-aos="fade-in">
        <div class="container">
            <h2>Edit Student</h2>

        </div>
    </div><!-- End Breadcrumbs -->
    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">

            <div class="row">
                <?php
                include "config.php";
                $id = $_GET['id'];
                $q = "select * from student where id = '$id'";
                $res = mysqli_query($conn,$q);
                $data = mysqli_fetch_assoc($res);
                if (isset($_GET['msg'])) {
                    echo "<div class='col-12 alert alert-success'>Form Submitted!!!</div>";
                }
                if (isset($_GET['err'])) {
                    echo "<div class='col-12 alert alert-danger'>Error!!!</div>";
                }
                if (isset($_POST['submit'])) {
                    //print_r($_FILES);
                    
                    $name = $_POST['name'];
                    $email = $_POST['email'];
                    if($_POST['password'] != ''){
                        $password = md5($_POST['password']);
                    }else{
                        $password = $data['password'];
                    }
                    $contact = $_POST['contact'];
                    $gender = $_POST['gender'];
                    $father_name = $_POST['father_name'];
                    $mother_name = $_POST['mother_name'];
                    $roll_no = $_POST['roll_no'];
                    $parent_contact = $_POST['parent_contact'];
                    $address = $_POST['address'];
                    $class_id = $_POST['class_id'];
                    $section = strtoupper($_POST['section']);
                    $q = "update `student` set `name`='$name',`email`='$email',`password`='$password',`contact`='$contact',`father_name`='$father_name',`mother_name`='$mother_name',`gender`='$gender',`roll_no`='$roll_no',`parent_contact`='$parent_contact',`address`='$address',`class_id`='$class_id',`section`='$section' where id='$id'";
                    $result = mysqli_query($conn, $q);
                    if ($result > 0) {
                        echo "<script>window.location.assign('view_student.php?msg');</script>";
                    } else {
                        echo "<script>window.location.assign('view_student.php?err');</script>";
                    }
                }
                ?>
                <div class="col-lg-12 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
                    <form method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="roll_no" class="form-label">Roll Number</label>
                            <input type="number" name="roll_no" class="form-control" id="roll_no" aria-describedby="emailHelp" required value="<?php echo $data['roll_no'];?>">
                        </div>
                        <div class="mb-3">
                            <label>Class</label>
                            <select class="form-control" name="class_id" required>
                                <?php
                                    $q = "SELECT assign_teacher.*,classes.name FROM `assign_teacher` LEFT JOIN classes on assign_teacher.class_id=classes.id where assign_teacher.teacher_id='".$_SESSION['teacher_id']."' GROUP BY assign_teacher.class_id";
                                    $result = mysqli_query($conn,$q);
                                    foreach($result as $class){
                                        ?>
                                        <option <?php if($class['class_id'] == $data['class_id']){echo "selected";}?> value="<?php echo $class['class_id'];?>"><?php echo $class['name'];?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="section" class="form-label">Section</label>
                            <input type="text" name="section" class="form-control" id="section" aria-describedby="emailHelp" required value="<?php echo $data['section'];?>">

                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="name" aria-describedby="emailHelp" required value="<?php echo $data['name'];?>">

                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" required value="<?php echo $data['email'];?>">

                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword" aria-describedby="emailHelp">
                            <small>Enter Password if you want to update.</small>

                        </div>
                        <div class="mb-3">
                            <label for="exampleInputContact" class="form-label">Contact</label>
                            <input type="tel" name="contact" class="form-control" id="exampleInputContact" aria-describedby="emailHelp" required value="<?php echo $data['contact'];?>">

                        </div>
                        <div class="mb-3">
                            <label>Gender</label><br>
                            <input <?php if($data['gender']=='male'){echo "checked";}?> type="radio" name="gender" value="male" checked>Male<br>
                            <input <?php if($data['gender']=='female'){echo "checked";}?> type="radio" name="gender" value="female">Female<br>
                            <input <?php if($data['gender']=='other'){echo "checked";}?> type="radio" name="gender" value="other">Other
                        </div>
                        <div class="mb-3">
                            <label for="father_name" class="form-label">Father Name</label>
                            <input type="text" name="father_name" class="form-control" id="father_name" aria-describedby="emailHelp" required value="<?php echo $data['father_name'];?>">

                        </div>
                        <div class="mb-3">
                            <label for="mother_name" class="form-label">Mother Name</label>
                            <input type="text" name="mother_name" class="form-control" id="mother_name" aria-describedby="emailHelp" required value="<?php echo $data['mother_name'];?>">

                        </div>

                        <div class="mb-3">
                            <label for="parent_contact" class="form-label">Parent's Contact</label>
                            <input type="number" name="parent_contact" class="form-control" id="parent_contact" aria-describedby="parent_contact" required value="<?php echo $data['parent_contact'];?>">

                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea name="address" class="form-control" id="address" aria-describedby="address" required><?php echo $data['address'];?></textarea>
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