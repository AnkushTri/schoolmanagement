<?php
require "header.php";
if(!isset($_SESSION['admin_name'])){
    echo "<script>window.location.assign('login.php');</script>";
  }
?>
<main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs" data-aos="fade-in">
        <div class="container">
            <h2>View Assigned Teacher</h2>
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
                                <th scope="col">Teacher</th>
                                <th scope="col">Class</th>
                                <th scope="col">Section</th>                             
                                <th scope="col">Subject</th>                             
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include "config.php";
                            $q = "select * from `assign_teacher`";
                            $result = mysqli_query($conn,$q);
                            $i = 1;
                            foreach($result as $data){
                            ?>
                            <tr>
                                        <td><?php echo $i;?></td>
                                        <td><?php 
                                        $id = $data['teacher_id'];
                                            $c = "select * from `teacher` where `id`='$id'";
                                            $res = mysqli_query($conn,$c);
                                            $class = mysqli_fetch_assoc($res);
                                            echo $class['name']; 
                                        ?></td>
                                        <td><?php 
                                        $id = $data['class_id'];
                                            $c = "select * from `classes` where `id`='$id'";
                                            $res = mysqli_query($conn,$c);
                                            $class = mysqli_fetch_assoc($res);
                                            // print_r($class);
                                            echo $class['name']; //Error
                                        ?></td>
                                        <td><?php echo $data['section'];?></td>   
                                        <td><?php 
                                        $id = $data['subject_id'];
                                            $c = "select * from `subject` where `id`='$id'";
                                            $res = mysqli_query($conn,$c);
                                            $class = mysqli_fetch_assoc($res);
                                            echo $class['name']; 
                                        ?></td>                                                                                                                                              
                                        <td><a href="edit_assign_teacher.php?id=<?php echo $data['id'];?>" class="text-success fw-bold"><i class="bi bi-pencil-square"></i></a></td>
                                        <td><a href="delete_assign_teacher.php?id=<?php echo $data['id'];?>"><i class="bi bi-trash"></i></a></td>
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