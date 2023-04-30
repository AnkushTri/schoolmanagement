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
                                <th scope="col">Subject</th>
                                <th scope="col">File</th>
                                <th scope="col">Total Marks</th>
                                <th scope="col">Answers</th>
                                <th scope="col">Marks Obtained</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include "admin/config.php";
                            $q = "SELECT assignment.*,subject.name as s_name FROM `assignment` LEFT JOIN student ON assignment.class_id=student.class_id AND assignment.section=student.section LEFT JOIN subject on assignment.subject_id=subject.id WHERE student.id='".$_SESSION['user_id']."'";
                            $result = mysqli_query($conn, $q);
                            $i = 1;
                            foreach ($result as $data) {
                            ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $data['title']; ?></td>
                                    <td><?php echo $data['description']; ?></td>
                                    <td><?php echo $data['s_name']; ?></td>
                                    <td><a target="_blank" href="../upload/<?php echo $data['file'];?>">View File</a></td>    
                                    <td><?php echo $data['marks']; ?></td>
                                    <?php
                                            $s = "SELECT * FROM `answer_assignment` WHERE assignment_id='".$data['id']."' and student_id='".$_SESSION['user_id']."'";
                                            $ress = mysqli_query($conn,$s);
                                            $answer = mysqli_fetch_assoc($ress);
                                            if(mysqli_num_rows($ress) > 0){
                                                ?>
                                                <td><a href="upload/<?php echo $answer['file'];?>" target="_blank">View Answer</a></td>
                                                <td>
                                                    <?php
                                                        if($answer['status'] == 'PENDING'){
                                                            echo "PENDING";
                                                        }else{
                                                            echo $answer['total_marks'];
                                                        }
                                                    ?>
                                                </td>
                                                <?php
                                            }else{
                                                echo "<td colspan='2'><a href='upload_answer.php?id=".$data['id']."' class='btn btn-success w-100'>Upload Answer</a></td>";
                                            }
                                    ?>
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