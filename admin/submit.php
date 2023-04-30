<?php
$n=$_POST['name'];
echo "name is ".$n;
$conn=mysqli_connect("localhost","root","","dummy");
if(!$conn){
    echo "Error...";
}
$name=$_POST['name'];
$q="Insert into `classes`(`name`)value('$name')";
$result=mysqli_query($conn,$q);
// if($result>0){
//     echo "<br> Data Inserted";
// }else {
//     echo "Data not Inserted";
// }
if($result>0){
    echo"<script>window.location.assign('add_classes.php?submit');</script>";
}else{
    echo"<script>window.location.assign('add_classes.php?err');</script>";
}
?>