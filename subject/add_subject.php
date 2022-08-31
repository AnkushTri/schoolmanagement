<?php
require "header.php";
?>
<main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs" data-aos="fade-in">
        <div class="container">
            <h2>Add Subject</h2>
        </div>
    </div><!-- End Breadcrumbs -->
     <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">

            <div class="row">
                <div class="col-lg-6 order-1 order-lg-2 mx-auto" data-aos="fade-left" data-aos-delay="100">
                    <form>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Name</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            
                        </div>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>

        </div>
    </section><!-- End About Section -->
</main>

<?php
require "footer.php";
?>