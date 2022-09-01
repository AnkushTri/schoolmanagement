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
            <h2>View Assignment</h2>
        </div>
    </div><!-- End Breadcrumbs -->
    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">

            <div class="row">
                <?php
                if (isset($_GET['msg'])) {
                    echo "<div class='col-12 alert alert-info'>" . $_GET['msg'] . "</div>";
                }
                ?>
                <div class="col-lg-12 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Class</th>
                                <th scope="col">Subject</th>
                                <th scope="col">Section</th>
                                <th scope="col">File</th>
                                <th scope="col">Marks</th>
                                <th scope="col">Answers</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include "config.php";
                            $q = "SELECT assignment.*,classes.name as c_name, subject.name as s_name FROM `assignment` LEFT JOIN classes on assignment.class_id=classes.id LEFT JOIN subject ON assignment.subject_id=subject.id where assignment.teacher_id='" . $_SESSION['teacher_id'] . "'";
                            $result = mysqli_query($conn, $q);
                            $i = 1;
                            foreach ($result as $data) {
                            ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $data['title']; ?></td>
                                    <td><?php echo $data['description']; ?></td>
                                    <td><?php echo $data['c_name']; ?></td>
                                    <td><?php echo $data['s_name']; ?></td>
                                    <td><?php echo $data['section']; ?></td>
                                    <td><a target="_blank" href="../upload/<?php echo $data['file'];?>">View File</a></td>    
                                    <td><?php echo $data['marks']; ?></td>
                                    <td><a href="view_assignment_answer.php?id=<?php echo $data['id'];?>" class="btn btn-success">View Answers</a></td>
                                    <td><a href="delete_assignment.php?id=<?php echo $data['id']; ?>"><i class="bi bi-trash"></a></td>
                                </tr>
                            <?php
                                $i++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section><!-- End About Section -->
</main>
<?php
require "footer.php";
?>