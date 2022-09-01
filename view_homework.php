<?php
require "header.php";
if(!isset($_SESSION['user_name'])){
    echo "<script>window.location.assign('login.php');</script>";
  }
?>
<main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs" data-aos="fade-in">
        <div class="container">
            <h2>View Homework</h2>
        </div>
    </div><!-- End Breadcrumbs -->
    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">

            <div class="row">
                <?php
                    if(isset($_GET['msg'])){
                        echo "<div class='col-12 alert alert-info'>".$_GET['msg']."</div>";
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
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include "admin/config.php";
                            $q = "SELECT homework.*,subject.name as s_name FROM `homework` LEFT JOIN student ON homework.class_id=student.class_id AND homework.section=student.section LEFT JOIN subject on homework.subject_id=subject.id WHERE student.id='".$_SESSION['user_id']."'";
                            $result = mysqli_query($conn,$q);
                            $i = 1;
                            foreach($result as $data){
                            ?>
                            <tr>
                                        <td><?php echo $i;?></td>
                                        <td><?php echo $data['title'];?></td>
                                        <td><?php echo $data['description'];?></td>
                                        <td><?php echo $data['s_name'];?></td>
                                        <td><a target="_blank" href="upload/<?php echo $data['file'];?>">View File</a></td>
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