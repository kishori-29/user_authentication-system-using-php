<?php
$server="localhost";
$username="root";
$password="";
$database="users1";
$conn=mysqli_connect($server, $username, $password, $database);
// if($conn){
//      echo "success";
// }
if(!$conn){
    die("error");
}
?>