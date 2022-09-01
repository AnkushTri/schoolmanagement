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
            <h2>View Class</h2>
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
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>                             
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include "config.php";
                            $q = "select * from `classes`";
                            $result = mysqli_query($conn,$q);
                            $i = 1;
                            foreach($result as $data){
                            ?>
                            <tr>
                                        <td><?php echo $i;?></td>
                                        <td><?php echo $data['class_name'];?></td>                                                                          
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