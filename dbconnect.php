<?php
$server="sql303.epizy.com";
$username="epiz_30290581";
$password="VWMTVmwXhtPGkKq";
$database="epiz_30290581_user2";
$conn=mysqli_connect($server, $username, $password, $database);
// if($conn){
//      echo "success";
// }
if(!$conn){
    die("error");
}
?>