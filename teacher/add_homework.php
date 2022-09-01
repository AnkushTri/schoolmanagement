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
            <h2>Add homework</h2>

        </div>
    </div><!-- End Breadcrumbs -->
    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">

            <div class="row">
                <?php
                include "config.php";
                if (isset($_GET['msg'])) {
                    echo "<div class='col-12 alert alert-success'>Form Submitted!!!</div>";
                }
                if (isset($_GET['err'])) {
                    echo "<div class='col-12 alert alert-danger'>Error!!!</div>";
                }
                if (isset($_POST['submit'])) {
                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    $class_id = $_POST['class_id'];
                    $subject_id = $_POST['subject_id'];
                    $section = strtoupper($_POST['section']);
                    $teacher_id = $_SESSION['teacher_id'];
                    $file = rand().$_FILES['pic']['name'];
                    $location = $_FILES['pic']['tmp_name'];
                    $q = "Insert into `homework`(`title`,`description`,`class_id`,`subject_id`,`section`,`teacher_id`,`file`) value('$title','$description','$class_id','$subject_id','$section','$teacher_id','$file')";
                    $result = mysqli_query($conn, $q);
                    if ($result > 0) {
                        move_uploaded_file($location, '../upload/' . $file);
                        echo "<script>window.location.assign('add_homework.php?msg');</script>";
                    } else {
                        echo "<script>window.location.assign('add_homework.php?err');</script>";
                    }
                }
                ?>
                <div class="col-lg-12 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
                    <form method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label>Class</label>
                            <select class="form-control" id="class_id" name="class_id" onchange="getSubject()" required>
                                <option value="">Select Class</option>
                                <?php
                                $q = "SELECT assign_teacher.*,classes.name FROM `assign_teacher` LEFT JOIN classes on assign_teacher.class_id=classes.id where assign_teacher.teacher_id='" . $_SESSION['teacher_id'] . "' GROUP BY assign_teacher.class_id";
                                $result = mysqli_query($conn, $q);
                                foreach ($result as $data) {
                                ?>
                                    <option value="<?php echo $data['class_id']; ?>"><?php echo $data['name']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Subject</label>
                            <select class="form-control" name="subject_id" id="subject_id" required onchange="getSection()">
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Section</label>
                            <select class="form-control" name="section" id="section" required>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputName" class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" id="exampleInputName" aria-describedby="emailHelp" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputDescription" class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="exampleInputDescription" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="formFile" class="form-label">File Or Output</label>
                            <input class="form-control" type="file" id="formFile" name="pic" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section><!-- End About Section -->
</main>
<script>
    function getSubject() {
        var data = document.getElementById('class_id').value;
        //ajax code
        var obj;
        var url = "subjectajax.php?id=" + data;
        // alert(url);
        if (window.XMLHttpRequest) {
            obj = new XMLHttpRequest();
        } else {
            obj = new ActiveXObject("Microsoft.XMLHTTP");
        }
        //send request
        obj.open("GET", url, true);
        obj.send();
        obj.onreadystatechange = function() {
            if (obj.readyState == 4 && obj.status == 200) {
                var res = obj.responseText;
                // alert(res);
                document.getElementById("subject_id").innerHTML = res;
                document.getElementById("section").innerHTML = '';
            }
        };
    }

    function getSection() {
        var data = document.getElementById('class_id').value;
        var sub = document.getElementById('subject_id').value;
        //ajax code
        var obj;
        var url = "sectionajax.php?id=" + data+"&sub=" + sub;
        // alert(url);
        if (window.XMLHttpRequest) {
            obj = new XMLHttpRequest();
        } else {
            obj = new ActiveXObject("Microsoft.XMLHTTP");
        }
        //send request
        obj.open("GET", url, true);
        obj.send();
        obj.onreadystatechange = function() {
            if (obj.readyState == 4 && obj.status == 200) {
                var res = obj.responseText;
                // alert(res);
                document.getElementById("section").innerHTML = res;
            }
        };
    }
</script>
<?php
require "footer.php";
?>