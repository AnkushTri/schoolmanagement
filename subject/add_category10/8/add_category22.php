<?php
require "header.php";
?>
<main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs" data-aos="fade-in">
        <div class="container">
            <h2>Add Category</h2>

        </div>
    </div><!-- End Breadcrumbs -->
    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">

            <div class="row">
                <?php
                if (isset($_POST['submit'])) {
                    //print_r($_FILES);
                    include "../config.php";
                    $name = $_POST['name'];
                    $description = $_POST['description'];
                    $image = $_FILES['pic']['name'];
                    $location = $_FILES['pic']['tmp_name'];
                    //$_FILES ->>> Used for multimedia files like image, audio, video, pdf, doc, etc
                    $q = "Insert into `category` (`name`,`image`,`description`) values ('$name','$image','$description')";
                    $result = mysqli_query($con, $q);
                    if ($result > 0) {
                        move_uploaded_file($location,'../upload/'.$image);//used to save image from temporary folder to our project folder
                        echo "<div class='col-12 alert alert-success'>Category Inserted!!!</div>";
                        //echo "<script>window.location.assign('form.php?msg');</script>";
                    } else {
                        echo "No";
                        //echo mysqli_error($conn);
                        //echo "<script>window.location.assign('form.php?err');</script>";
                    }
                }
                ?>
                <div class="col-lg-12 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
                    <form method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Description</label>
                            <textarea class="form-control" name="description"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Image</label>
                            <input class="form-control" type="file" id="formFile" name="pic">
                            <!-- <input class="form-control" type="text" id="formFile" name="image"> -->
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
