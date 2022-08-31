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
            <h2>Add Class</h2>
        </div>
    </div><!-- End Breadcrumbs -->
    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">

            <div class="row">
                <div class="col-lg-6 order-1 order-lg-2 mx-auto" data-aos="fade-left" data-aos-delay="100">
                    <?php                    
                    include "config.php";
                    if (isset($_GET['submit'])) {
                        echo "<div class='col-12 alert alert-success'>Form Submitted!!!</div>";
                    }
                    if (isset($_GET['err'])) {
                        echo "<div class='col-12 alert alert-danger'>Error!!!</div>";
                    }
                    if (isset($_POST['submit'])) {
                        $name = $_POST['name'];
                        $q = "insert into `classes` (`name`)value('$name')";
                        $result = mysqli_query($conn, $q);
                        if ($result > 0) {
                            echo "<script>window.location.assign('add_classes.php?submit=Data Inserted ');</script>";
                        } else {
                            echo "<script>window.location.assign('add_classes.php?err');</script>";
                            // echo mysqli_error($conn);
                        }
                    }
                    ?>
                    <form method="post">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>

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