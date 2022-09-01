<?php
    $id = $_GET['id'];
    include "config.php";
    $q = "SELECT assign_teacher.*,subject.name FROM assign_teacher LEFT JOIN subject ON assign_teacher.subject_id=subject.id WHERE assign_teacher.class_id='$id' GROUP BY assign_teacher.subject_id";
    $result = mysqli_query($conn,$q);
    echo '<option value="">Select Subject</option>';
    foreach($result as $data){
        //echo "<option value='".$data['id']."'>".$data['name']."</option>";
        ?>
        <option value="<?php echo $data['subject_id'];?>"><?php echo $data['name'];?></option>
        <?php
    }
?>
