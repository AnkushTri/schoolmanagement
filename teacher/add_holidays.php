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
            <h2>Add holidays</h2>

        </div>
    </div><!-- End Breadcrumbs -->
    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">

            <div class="row">
                <?php
                if (isset($_POST['submit'])) {                   
                    include "config.php";
                    $name = $_POST['name'];
                    $description = $_POST['description'];             
                    $image = $_FILES['pic']['name'];
                    $location = $_FILES['pic']['tmp_name'];   
                    $date = $_POST['date'];              
                    $q = "Insert into `holidays`(`name`,`description`,`image`,`date`) value('$name','$description','image','date')";
                    $result = mysqli_query($conn, $q);
                    if ($result > 0) {
                        move_uploaded_file($location,'../upload/'.$image);
                        echo "<div class='col-12 alert alert-success'>Holiday Added!!!</div>";                      
                    } else {
                        echo "Not added";                       
                    }
                    if($result>0){
                        echo"<script>window.location.assign('add_holidays.php?submit');</script>";
                    }else{
                        echo"<script>window.location.assign('add_holidays.php?err');</script>";
                    }
                }
                ?>
                <div class="col-lg-12 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
                    <form method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="exampleInputName" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="exampleInputName" aria-describedby="emailHelp">                                          
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputDescription" class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="exampleInputDescription"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Image</label>
                            <input class="form-control" type="file" id="formFile" name="pic">
                        </div>    
                        <div class="mb-3">
                            <label for="exampleInputDate" class="form-label">Date</label>
                            <input type="text" name="date" class="form-control" id="exampleInputDate" aria-describedby="emailHelp">                                          
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