<?php
require "header.php";
$id = $_GET['id'];
include "config.php";
$q = "select * from `homework` where id='$id'";
$result = mysqli_query($conn, $q);
$data = mysqli_fetch_assoc($result);
print_r($data);
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];   
    $class_id = $_POST['class_id'];          
    $subject_id = $_POST['subject_id']; 
    $section = strtoupper($_POST['section']); 
    $teacher_id = $_POST['teacher_id'];   
    //File upload
    //check if file is uploaded by user
    if ($_FILES['pic']['error'] > 0) {
        //user has not uploaded any file
        $file = $data['file'];
    } else {
        //user has uploaded a file        
        $file = rand() . $_FILES['pic']['name'];
        $location = $_FILES['pic']['tmp_name'];
        move_uploaded_file($location,'../upload/'.$file);
    }
    $q = "update `homework` set `title`='$title',`description`='$description',`class_id`='$class_id',`subject_id`='$subject_id',`section`='$section',`teacher_id`='$teacher_id',`file`='$file', where `id`='$id'";
    $result = mysqli_query($conn,$q);
    if($result > 0){
        echo "<script>window.location.assign('view_homework.php?msg=Record Updated.');</script>";
    }else{
        echo "<script>window.location.assign('view_homework.php?msg=Try Again.');</script>";
    }
}
?>
<main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs" data-aos="fade-in">
        <div class="container">
            <h2>Edit homework</h2>

        </div>
    </div><!-- End Breadcrumbs -->
    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">

            <div class="row">
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
                                    include "config.php";
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