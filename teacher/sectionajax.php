<?php
    $id = $_GET['id'];
    $sub = $_GET['sub'];
    include "config.php";
    $q = "SELECT assign_teacher.*,subject.name FROM assign_teacher LEFT JOIN subject ON assign_teacher.subject_id=subject.id WHERE assign_teacher.class_id='$id' and assign_teacher.subject_id='$sub'";
    $result = mysqli_query($conn,$q);
    echo '<option value="">Select Section</option>';
    foreach($result as $data){
        //echo "<option value='".$data['id']."'>".$data['name']."</option>";
        ?>
        <option value="<?php echo $data['section'];?>"><?php echo $data['section'];?></option>
        <?php
    }
?>
