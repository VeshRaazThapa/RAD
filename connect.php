<?php

$hostname="localhost";
$username="root";
$password="root";
$dbname="rad";
$db_port = 3306;
$conn= mysqli_connect($hostname,$username,$password,$dbname,$db_port);
// echo"";
if($conn){
    echo"";
}
else{
    die(mysqli_connect_error());
}

?>