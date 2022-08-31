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
            <h2>Add homework</h2>

        </div>
    </div><!-- End Breadcrumbs -->
    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">

            <div class="row">
                <?php
                if (isset($_POST['submit'])) {                   
                    include "config.php";
                    $title = $_POST['title'];
                    $description = $_POST['description'];   
                    $class_id = $_POST['class_id'];          
                    $subject_id = $_POST['subject_id']; 
                    $section = $_POST['section']; 
                    $teacher_id = $_POST['teacher_id'];        
                    $file = $_FILES['pic']['name'];
                    $location = $_FILES['pic']['tmp_name'];               
                    $q = "Insert into `homework`(`title`,`description`,`class_id`,`subject_id`,`section`,`teacher_id`,`file`) value('$title','$description','$class_id','$subject_id','$section','$teacher_id','$file')";
                    $result = mysqli_query($conn, $q);
                    if ($result > 0) {
                        move_uploaded_file($location,'../upload/'.$file);
                        echo "<div class='col-12 alert alert-success'>Homework Uploaded!!!</div>";                      
                    } else {
                        echo "Not added";                       
                    }
                    if($result>0){
                        echo"<script>window.location.assign('add_homework.php?submit');</script>";
                    }else{
                        echo"<script>window.location.assign('add_homework.php?err');</script>";
                    }
                }
                ?>
                <div class="col-lg-12 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
                    <form method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="exampleInputName" class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" id="exampleInputName" aria-describedby="emailHelp">                                          
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputDescription" class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="exampleInputDescription"></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Class</label>
                            <select class="form-control" name="class_id">
                                <?php
                                    $q = "select * from `classes`";
                                    include "config.php"; //whyyyyyy 
                                    $result = mysqli_query($conn,$q);
                                    foreach($result as $data){
                                        ?>
                                        <option value="<?php echo $data['id'];?>"><?php echo $data['class_name'];?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="InputSection" class="form-label">Section</label>
                            <input type="text" name="section" class="form-control" id="InputSection" aria-describedby="emailHelp">                                          
                        </div>
                        </div>
                        <div class="mb-3">
                            <label>Subject</label>
                            <select class="form-control" name="subject_id">
                                <?php
                                    $q = "select * from `subject`";
                                    $result = mysqli_query($conn,$q);
                                    foreach($result as $data){
                                        ?>
                                        <option value="<?php echo $data['id'];?>"><?php echo $data['name'];?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                        </div>
                        </div>
                        <div class="mb-3">
                            <label>Teacher</label>
                            <select class="form-control" name="teacher_id">
                                <?php
                                    $q = "select * from `teacher`";
                                    $result = mysqli_query($conn,$q);
                                    foreach($result as $data){
                                        ?>
                                        <option value="<?php echo $data['id'];?>"><?php echo $data['name'];?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">File</label>
                            <input class="form-control" type="file" id="formFile" name="pic">
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