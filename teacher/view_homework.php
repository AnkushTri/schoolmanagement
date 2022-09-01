<?php
require "header.php";
if(!isset($_SESSION['teacher_name'])){
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
                                <th scope="col">Class</th>                             
                                <th scope="col">Subject</th>                             
                                <th scope="col">Section</th>                            
                                <th scope="col">File</th>                             
                                <!-- <th scope="col">Edit</th> -->
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include "config.php";
                            $q = "SELECT homework.*,classes.name as c_name, subject.name as s_name FROM `homework` LEFT JOIN classes on homework.class_id=classes.id LEFT JOIN subject ON homework.subject_id=subject.id where homework.teacher_id='".$_SESSION['teacher_id']."'";
                            $result = mysqli_query($conn,$q);
                            $i = 1;
                            foreach($result as $data){
                            ?>
                            <tr>
                                        <td><?php echo $i;?></td>
                                        <td><?php echo $data['title'];?></td>                                                                          
                                        <td><?php echo $data['description'];?></td>                                                                          
                                        <td><?php echo $data['c_name'];?></td>                                                                          
                                        <td><?php echo $data['s_name'];?></td>                                                                          
                                        <td><?php echo $data['section'];?></td>                                                                        
                                        <td><a target="_blank" href="../upload/<?php echo $data['file'];?>">View File</a></td>                                                                          
                                        <!-- <td><a href="edit_homework.php?id=<?php //echo $data['id'];?>" class="text-success fw-bold"><i class="bi bi-pencil-square"></i></a></td> -->
                                        <td><a href="delete_homework.php?id=<?php echo $data['id'];?>"><i class="bi bi-trash"></a></td>
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