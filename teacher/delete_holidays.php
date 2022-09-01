<?php
    include "config.php";
    $id = $_GET['id'];
    $q = "delete from `holidays` where id='$id'";
    $result = mysqli_query($conn, $q);
    if($result>0){
        echo "<script>window.location.assign('view_holidays.php?msg=Record Deleted.');</script>";
    }else{
        echo "<script>window.location.assign('view_holidays.php?msg=Try Again.');</script>";
    }
?>