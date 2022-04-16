<?php
$id=$_GET['id'];
include'../connect.php';
$query=mysqli_query($conn,"UPDATE patients SET status ='Completed' WHERE id='$id'");
if($query){
    header("location:index.php");
}else{
    echo"<h1>Some error occured </h1>";
}

?>