<?php 
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login.php");
    exit;
}
include "dbconnect.php";
$message_username=$_SESSION['username'];
$msgsql="SELECT * FROM `admin-message` where username='$message_username';";
$result_msg=mysqli_query($conn, $msgsql);


?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <!-- <title>Welcome! <?php echo $_SESSION['username'];?></title> -->
</head>

<body>
    <?php include 'nav.php';
    
        
    echo'
    <div class="alert alert-success mb-4 p-2" role="alert">
        <h2 class="text-center"> Welcome To Message Section!!</h2>
    </div>
    <table class="table m-2 p-4" id="myTable">
    <thead>
        <tr>
            <th scope="col">Sr.No</th>
            <th scope="col">Message</th>
            <th scope="col">Date & Time</th>
        </tr>
    </thead>
    <tbody>';
    $sno=0;
        while($row=mysqli_fetch_assoc($result_msg)){
            $sno=$sno+1;
            echo " <tr>
            <th scope='row'>$sno</th>
            <td>".$row['message']."</td>
            <td>".$row['date_of_msg']."</td>
            </tr>";
        };

        echo"</tbody>
        </table>
        <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js'
        integrity='sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p' crossorigin='anonymous'>
    </script>
        ";
    ?>

</body>

</html>