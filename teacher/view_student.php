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
            <h2>View Student</h2>
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
                                <th scope="col">Roll No</th>
                                <th scope="col">Class</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Contact</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Father's Name</th>
                                <th scope="col">Mother's Name</th>
                                <th scope="col">Parent's Contact</th>
                                <th scope="col">Address</th>
                                <th scope="col">Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include "config.php";
                            $q = "SELECT student.*,classes.name as c_name FROM student left join classes on student.class_id=classes.id where student.class_id IN (SELECT GROUP_CONCAT(class_id) AS site_list from (SELECT * FROM `assign_teacher` where teacher_id='".$_SESSION['teacher_id']."' GROUP BY class_id)as data)";
                            $result = mysqli_query($conn, $q);
                            $i = 1;
                            foreach ($result as $data) {
                            ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $data['roll_no']; ?></td>
                                    <td><?php echo $data['c_name'] . '(' . $data['section'] . ')'; ?></td>
                                    <td><?php echo $data['name']; ?></td>
                                    <td><?php echo $data['email']; ?></td>
                                    <td><?php echo $data['contact']; ?></td>
                                    <td><?php echo $data['gender']; ?></td>
                                    <td><?php echo $data['father_name']; ?></td>
                                    <td><?php echo $data['mother_name']; ?></td>
                                    <td><?php echo $data['parent_contact']; ?></td>
                                    <td><?php echo $data['address']; ?></td>
                                    <td><a href="edit_student.php?id=<?php echo $data['id'];?>" class="text-success fw-bold"><i class="bi bi-pencil-square"></i></a></td>
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