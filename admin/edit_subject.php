<?php
require "header.php";
if (!isset($_SESSION['admin_name'])) {
    echo "<script>window.location.assign('login.php');</script>";
}
?>
<main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs" data-aos="fade-in">
        <div class="container">
            <h2>Edit Subject</h2>
        </div>
    </div><!-- End Breadcrumbs -->
    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">

            <div class="row">
                <?php
                include "config.php";
                $id = $_GET['id'];
                $q = "select * from `subject` where id='$id'";
                $result = mysqli_query($conn, $q);
                $data = mysqli_fetch_assoc($result);
                if (isset($_GET['submit'])) {
                    echo "<div class='col-12 alert alert-success'>Form Submitted!!!</div>";
                }
                if (isset($_GET['err'])) {
                    echo "Error";
                }
                if (isset($_POST['submit'])) {
                    $name = $_POST['name'];
                    $class_id = $_POST['class_id'];
                    $q = "update `subject` set `name`='$name',`class_id`='$class_id' where id='$id'";
                    $result = mysqli_query($conn, $q);
                    if($result > 0){
                        echo "<script>window.location.assign('view_subject.php?msg=Record Updated.');</script>";
                    }else{
                        echo "<script>window.location.assign('view_subject.php?msg=Try Again.');</script>";
                    }
                }
                ?>
                <div class="col-lg-6 order-1 order-lg-2 mx-auto" data-aos="fade-left" data-aos-delay="100">
                    <form method="post">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Subject Name</label>
                            <input value="<?php echo $data['name'];?>" type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                        </div>
                        <div class="mb-3">
                            <label>Class</label>
                            <select class="form-control" name="class_id" required>
                                <?php
                                $q = "select * from `classes`";
                                $result = mysqli_query($conn, $q);
                                foreach ($result as $class) {
                                ?>
                                    <option <?php if($class['id']==$data['class_id']){echo "selected";}?> value="<?php echo $class['id']; ?>"><?php echo $class['name']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success" name="submit">Submit</button>
                    </form>
                </div>
            </div>

        </div>
    </section><!-- End About Section -->
</main>

<?php
require "footer.php";
?>