<?php

$hostname="localhost";
$username="root";
$password="";
$dbname="rad";
$db_port = 8889;
$conn= mysqli_connect($hostname,$username,$password,$dbname,$db_port);
// echo"";
if($conn){
    echo"";
}
else{
    die(mysqli_connect_error());
}

?>