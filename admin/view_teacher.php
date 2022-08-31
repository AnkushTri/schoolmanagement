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
            <h2>View Teacher</h2>
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
                                <th scope="col">Name</th>                             
                                <th scope="col">email</th>                             
                                <!-- <th scope="col">password</th>                              -->
                                <th scope="col">contact</th>                             
                                <th scope="col">qualification</th>                             
                                <th scope="col">experience</th>                             
                                <th scope="col">gender</th>                             
                                <th scope="col">D.O.B</th>                             
                                <th scope="col">Id-Proof</th>                             
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include "config.php";
                            $q = "select * from `teacher`";
                            $result = mysqli_query($conn,$q);
                            $i = 1;
                            foreach($result as $data){
                            ?>
                            <tr>
                                        <td><?php echo $i;?></td>
                                        <td><?php echo $data['name'];?></td>                                                                          
                                        <td><?php echo $data['email'];?></td>                                                                          
                                        <!-- <td><?php echo $data['password'];?></td>                                                                           -->
                                        <td><?php echo $data['contact'];?></td>                                                                          
                                        <td><?php echo $data['qualification'];?></td>                                                                          
                                        <td><?php echo $data['experience'];?></td>                                                                          
                                        <td><?php echo $data['gender'];?></td>                                                                          
                                        <td><?php echo $data['dob'];?></td>                                                                          
                                        <td><img class="img img-fluid" style="height:50px;" src="../upload/<?php echo $data['id_proof'];?>"></td>                                                                       
                                        <td><a href="edit_teacher.php?id=<?php echo $data['id'];?>" class="text-success fw-bold"><i class="bi bi-pencil-square"></i></a></td>
                                        <td><a href="delete_teacher.php?id=<?php echo $data['id'];?>"><i class="bi bi-trash"></i></a></td>
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