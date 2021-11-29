<?php

session_start();
include 'nav.php';
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true || $_SESSION['adminloggedin']!=true || !isset($_SESSION['adminloggedin'])){
    header("location: login.php");
    exit;
}
$_SESSION['atadminpage']=true;
include 'dbconnect.php';

            echo'<div class="container">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- links for datatables -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
    </script>
    <style>
    .text-head{
        
    }
    
    </style>
    <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    
    <h2 class="text-primary text-center text-head my-4 p-4">Student Details</h2>

                    <table class="table" id="myTable">
                        <thead>
                            <tr>
                                <th scope="col">Sr.No</th>
                                <th scope="col">Username</th>
                                <th scope="col">Email ID:</th>
                            </tr>
                        </thead>
                        <tbody>';
                        $printsql="SELECT * FROM `users1`";
                        $result2=mysqli_query($conn, $printsql);
                        $sno=0;
                        while($row=mysqli_fetch_assoc($result2)){
                            $sno=$sno+1;
                            echo " <tr>
                            <th scope='row'>$sno</th>
                            <td>".$row['username']."</td>
                            <td>".$row['email']."</td>
                            </tr>";
                        };
                        echo"</tbody>
                        </table>
                        <script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    })
    </script>";

    // for table of feedback
    echo'
    <h2 class="text-primary text-center text-head my-4 p-4">Student Feedback Details</h2>
    <table class="table" id="myTable2">
    <thead>
        <tr>
            <th scope="col">Sr.No</th>
            <th scope="col">Username</th>
            <th scope="col">Branch</th>
            <th scope="col">Roll No.</th>
            <th scope="col">Feedback</th>
        </tr>
    </thead>
    <tbody>';
    $feedbacksql="SELECT * FROM `feedback_details`";
                        $result2=mysqli_query($conn, $feedbacksql);
                        $sno2=0;
                        while($row2=mysqli_fetch_assoc($result2)){
                            $sno2=$sno2+1;
                            echo " <tr>
                            <th scope='row'>$sno2</th>
                            <td>".$row2['username']."</td>
                            <td>".$row2['branch']."</td>
                            <td>".$row2['rollno']."</td>
                            <td>".$row2['feedback']."</td>
                            </tr>";
                        };
                        echo"</tbody>
                        </table>
                        <script>
    $(document).ready(function() {
        $('#myTable2').DataTable();
    })++
    </script>
    <h2 class='text-center'><a href='admin_message.php'>Click Here To Message User</a></h2>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js'
        integrity='sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p' crossorigin='anonymous'>
    </script>
    ";
?>