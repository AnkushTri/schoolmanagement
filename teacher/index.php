<?php
require "header.php";
if (!isset($_SESSION['teacher_name'])) {
  echo "<script>window.location.assign('login.php');</script>";
}
?>
<main id="main">
  <section id="about" class="about">
    <div class="container-fluid" data-aos="fade-up">
      <div class="row  pt-5">
        <div class="jumbotron text-bg-success col-12">
          <h1 class="display-4 text-center">Welcome <?php echo $_SESSION['teacher_name']; ?>!</h1>
        </div>
      </div>
    </div>
  </section>
  <section id="events" class="events pt-0">
    <div class="container aos-init aos-animate" data-aos="fade-up">
      <div class="row">
        <div class="col-md-6 d-flex align-items-stretch">
          <div class="card">
            <div class="card-img">
              <img src="assets/img/events-1.jpg" alt="...">
            </div>
            <div class="card-body">
              <h5 class="card-title"><a href="view_assignment.php">Total Pending Assignment</a></h5>
              <p class="fst-italic text-center">
                <?php
                include_once "config.php";
                $a = "select count(*) as count from answer_assignment LEFT JOIN assignment on answer_assignment.assignment_id=assignment.id WHERE assignment.teacher_id='" . $_SESSION['teacher_id'] . "' and answer_assignment.status='PENDING'";
                $resa = mysqli_query($conn, $a);
                $course = mysqli_fetch_assoc($resa);
                echo $course['count'];
                ?>
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-6 d-flex align-items-stretch">
          <div class="card">
            <div class="card-img">
              <img src="assets/img/course-3.jpg" alt="...">
            </div>
            <div class="card-body">
              <h5 class="card-title"><a href="view_student.php">Total Students</a></h5>
              <p class="fst-italic text-center">
                <?php
                include_once "config.php";
                $l = "SELECT count(*) as count FROM student where class_id IN (SELECT GROUP_CONCAT(class_id) AS site_list from (SELECT * FROM `assign_teacher` where teacher_id='" . $_SESSION['teacher_id'] . "' GROUP BY class_id)as data)";
                $resl = mysqli_query($conn, $l);
                $level = mysqli_fetch_assoc($resl);
                echo $level['count'];
                ?>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
<?php
require "footer.php";
?>