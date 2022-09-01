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
            <h2>Assign Marks</h2>

        </div>
    </div><!-- End Breadcrumbs -->
    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">

            <div class="row">
                <?php
                include "config.php";
                $id = $_GET['id'];
                $q = "SELECT answer_assignment.*,student.name as s_name, assignment.marks, assignment.title FROM `answer_assignment` LEFT JOIN assignment ON answer_assignment.assignment_id=assignment.id LEFT JOIN student ON answer_assignment.student_id=student.id WHERE answer_assignment.id='$id'";
                $res = mysqli_query($conn, $q);
                $data = mysqli_fetch_assoc($res);
                if (isset($_GET['msg'])) {
                    echo "<div class='col-12 alert alert-success'>Form Submitted!!!</div>";
                }
                if (isset($_GET['err'])) {
                    echo "<div class='col-12 alert alert-danger'>Error!!!</div>";
                }
                if (isset($_POST['submit'])) {
                    $total_marks = $_POST['total_marks'];
                    $q = "update `answer_assignment` set `total_marks`='$total_marks', `status`='CHECKED' where id='$id'";
                    $result = mysqli_query($conn, $q);
                    if ($result > 0) {
                        move_uploaded_file($location, '../upload/' . $file);
                        echo "<script>window.location.assign('view_assignment_answer.php?id=".$data['assignment_id']."');</script>";
                    } else {
                        echo "<script>window.location.assign('view_assignment_answer.php?id=".$data['assignment_id']."');</script>";
                    }
                }
                ?>
                <div class="col-lg-12 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
                    <form method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="title" class="form-label">Student</label>
                            <input type="text" name="title" class="form-control" id="title" aria-describedby="title" readonly value="<?php echo $data['s_name']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Assignment Title</label>
                            <input type="text" name="title" class="form-control" id="title" aria-describedby="title" readonly value="<?php echo $data['title']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="marks" class="form-label">Total Marks</label>
                            <input type="number" name="marks" class="form-control" id="marks" aria-describedby="marks" readonly value="<?php echo $data['marks']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="total_marks" class="form-label">Alloted Marks</label>
                            <input type="number" name="total_marks" class="form-control" id="total_marks" aria-describedby="total_marks" required max="<?php echo $data['marks']; ?>">
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