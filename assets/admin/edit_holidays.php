<?php
require "header.php";
$id = $_GET['id'];
include "config.php";
$q = "select * from `holidays` where id='$id'";
$result = mysqli_query($conn, $q);
$data = mysqli_fetch_assoc($result);
// /print_r($data);
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    //File upload
    //check if file is uploaded by user
    if ($_FILES['pic']['error'] > 0) {
        //user has not uploaded any file
        $image = $data['image'];
    } else {
        //user has uploaded a file        
        $image = rand() . $_FILES['pic']['name'];
        $location = $_FILES['pic']['tmp_name'];
        move_uploaded_file($location,'../upload/'.$image);
    }
    $q = "update `holidays` set `name`='$name',`description`='$description',`image`='$image', `date`='$date' where `id`='$id'";
    $result = mysqli_query($conn,$q);
    if($result > 0){
        echo "<script>window.location.assign('view_holidays.php?msg=Record Updated.');</script>";
    }else{
        echo "<script>window.location.assign('view_holidays.php?msg=Try Again.');</script>";
    }
}
?>
<main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs" data-aos="fade-in">
        <div class="container">
            <h2>Edit Holidays</h2>

        </div>
    </div><!-- End Breadcrumbs -->
    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">

            <div class="row">
                <div class="col-lg-12 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
                    <form method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                            <label for="exampleInputName" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="exampleInputName" aria-describedby="emailHelp"; value="<?php echo $data['name']; ?>" required>                                          
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputDescription" class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="exampleInputDescription" required><?php echo $data['description']; ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Image</label>
                            <input class="form-control" type="file" id="formFile" name="pic">
                            <img class="img img-fluid" style="height:50px ;" src="../upload/<?php echo $data['image']; ?>">
                        </div>    
                        <div class="mb-3">
                            <label for="exampleInputDate" class="form-label">Date</label>
                            <input type="date" name="date" class="form-control" id="exampleInputDate" aria-describedby="emailHelp"  value="<?php echo $data['date'];?>" required>                                          
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