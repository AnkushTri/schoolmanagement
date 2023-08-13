<?php
    include "config.php";
    $id = $_GET['id'];
    $q = "delete from `student` where id='$id'";
    $result = mysqli_query($conn, $q);
    if($result>0){
        echo "<script>window.location.assign('view_student.php?msg=Record Deleted.');</script>";
    }else{
        echo "<script>window.location.assign('view_student.php?msg=Try Again.');</script>";
    }
?>