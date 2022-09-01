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
            <h2>View Assignment Answers</h2>
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
                                <th scope="col">Student</th>
                                <th scope="col">Answer</th>
                                <th scope="col">Status</th>
                                <th scope="col">Date</th>
                                <th scope="col">Marks</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include "config.php";
                            $id = $_GET['id'];
                            $q = "SELECT answer_assignment.*,student.name as s_name FROM `answer_assignment` LEFT JOIN student on answer_assignment.student_id=student.id where answer_assignment.assignment_id='$id'";
                            $result = mysqli_query($conn, $q);
                            $i = 1;
                            foreach ($result as $data) {
                            ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $data['s_name']; ?></td>
                                    <td><a href="../upload/<?php echo $data['file'];?>" target="_blank">View Answer</a></td> 
                                    <td><?php echo $data['status']; ?></td>
                                    <td><?php echo $data['createdat']; ?></td>
                                    <td><?php if($data['status']=='PENDING'){echo "<a href='assign_marks.php?id=".$data['id']."' class='btn btn-success'>Assign Marks</a>";}else{
                                        echo $data['total_marks'];
                                    } ?></td> 
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