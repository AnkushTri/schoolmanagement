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
            <h2>Assign Teacher</h2>
        </div>
    </div><!-- End Breadcrumbs -->
    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">

            <div class="row">
            <?php            
                include "config.php";
                if (isset($_GET['submit'])) {
                    echo "<div class='col-12 alert alert-success'>Teacher Assigned!!!</div>";
                }
                if (isset($_GET['err'])) {
                    echo "Error";
                }
                if (isset($_POST['submit'])) {
                    $teacher_id = $_POST['teacher_id'];
                    $class_id = $_POST['class_id'];
                    $section = strtoupper($_POST['section']); 
                    $subject_id = $_POST['subject_id'];
                    $q = "insert into `assign_teacher` (`teacher_id`,`class_id`,`section`,`subject_id`) values ('$teacher_id','$class_id','$section','$subject_id')";
                    $result = mysqli_query($conn, $q);
                    if($result>0){
                        echo"<script>window.location.assign('add_assign_teacher.php?submit=Data_Inserted ');</script>";
                    }else{
                        echo"<script>window.location.assign('add_assign_teacher.php?err');</script>";
                    }
            }
            ?>    
                <div class="col-lg-6 order-1 order-lg-2 mx-auto" data-aos="fade-left" data-aos-delay="100">
                    <form method="post">
                    <div class="mb-3">
                            <label>Teacher</label>
                            <select class="form-control" name="teacher_id">
                                <?php
                                    $q = "select * from `teacher`";
                                    $result = mysqli_query($conn,$q);
                                    foreach($result as $teacher){
                                        ?>
                                        <option value="<?php echo $teacher['id'];?>"><?php echo $teacher['name'];?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Class</label>
                            <select class="form-control" name="class_id">
                                <?php
                                    $q = "select * from `classes`";
                                    $result = mysqli_query($conn,$q);
                                    foreach($result as $class){
                                        ?>
                                        <option value="<?php echo $class['id'];?>"><?php echo $class['name'];?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputSection" class="form-label">Section</label>
                            <input type="text" name="section" class="form-control" id="exampleInputSection" aria-describedby="emailHelp">       
                        </div>
                        <div class="mb-3">
                            <label>Subject</label>
                            <select class="form-control" name="subject_id">
                                <?php
                                    $q = "select * from `subject`";
                                    $result = mysqli_query($conn,$q);
                                    foreach($result as $section){
                                        ?>
                                        <option value="<?php echo $section['id'];?>"><?php echo $section['name'];?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success" name="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section><!-- End About Section -->
</main>

<?php
require "footer.php";
?>           