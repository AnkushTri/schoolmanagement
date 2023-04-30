<?php
require "header.php";
if (!isset($_SESSION['user_name'])) {
    echo "<script>window.location.assign('login.php');</script>";
}
?>
<main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs" data-aos="fade-in">
        <div class="container">
            <h2>Upload Answer</h2>

        </div>
    </div><!-- End Breadcrumbs -->
    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">

            <div class="row">
                <?php
                include "admin/config.php";
                $id = $_GET['id'];
                $q = "SELECT * FROM `assignment` WHERE assignment.id='$id'";
                $res = mysqli_query($conn, $q);
                $data = mysqli_fetch_assoc($res);
                if (isset($_GET['msg'])) {
                    echo "<div class='col-12 alert alert-success'>Form Submitted!!!</div>";
                }
                if (isset($_GET['err'])) {
                    echo "<div class='col-12 alert alert-danger'>Error!!!</div>";
                }
                if (isset($_POST['submit'])) {
                    $file = rand().$_FILES['file']['name'];
                    $location = $_FILES['file']['tmp_name'];
                    $user_id = $_SESSION['user_id'];
                    $q = "INSERT INTO `answer_assignment`(`student_id`, `assignment_id`, `file`) VALUES ('$user_id', '$id', '$file')";
                    $result = mysqli_query($conn, $q);
                    if ($result > 0) {
                        move_uploaded_file($location, 'upload/' . $file);
                        echo "<script>window.location.assign('view_assignment.php?msg=Answer Submitted.');</script>";
                    } else {
                        echo "<script>window.location.assign('view_assignment.php?msg=Error');</script>";
                    }
                }
                ?>
                <div class="col-lg-12 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
                    <form method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="title" class="form-label">Assignment Title</label>
                            <input type="text" name="title" class="form-control" id="title" aria-describedby="title" readonly value="<?php echo $data['title']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="file" class="form-label">Upload Answer</label>
                            <input type="file" name="file" class="form-control" id="file" aria-describedby="file" required>
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