<?php
session_start();
$_SESSION['feedback_submitted']=false;
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login.php");
    exit;
}
$usernameExists=0;
$usernameAlert=false;
$emptyData=false;
if($_SERVER["REQUEST_METHOD"]=="POST"){
    include 'dbconnect.php';
    $username=$_SESSION['username'];
    $rollno=$_POST["rollno"];
    $feedback=$_POST["feedback"];
    $branch=$_POST["branch"];
    if (!empty($branch) && !empty($rollno) && !empty($feedback)
    ){  
            $sql="INSERT INTO `feedback_details` (`username`, `branch`, `rollno`, `feedback`, `feedback_date`) VALUES ('$username', '$branch', '$rollno', '$feedback', current_timestamp())";
            $result=mysqli_query($conn,$sql);
            if($result){
                $_SESSION['feedback_submitted']='set';
                
        }
    }
    else{
           $emptyData=true; 
    }
}

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
    <?php include 'nav.php'?>
    <div class="alert alert-success" role="alert">
        <h2 class="text-center"> Welcome To Feedback Section!!</h2>
    </div>
    <div class="student-feedback" id="student-feedback">
        <?php 
            if($emptyData){
                echo '<div class="alert alert-success" role="alert">
                Plesae Enter Valid Information
            </div>';
            }
            if($_SESSION['feedback_submitted']=='set'){
                echo '<div class="alert alert-success" role="alert">
                    Thanks for submitting your feedback!!
                    </div>';
            }
        ?>

        <form action="feedback.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" maxlength="20" class="form-control" id="username" name="username"
                    aria-describedby="emailHelp" disabled="disabled" value="<?php echo $_SESSION['username'];?>">
            </div>
            <div class="mb-3">
                <label for="branch" class="form-label">Branch</label>
                <input type="text" maxlength="50" class="form-control" id="branch" name="branch"
                    aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="rollno" class="form-label">Roll No.</label>
                <input type="number" maxlength="8" class="form-control" id="rollno" name="rollno">
            </div>
            <div class="mb-3">
                <label for="feedback" class="form-label">Your Feedback</label>
                <textarea type="text" class="form-control" id="feedback" name="feedback"></textarea>
            </div>
            <button type="submit" class="btn btn-primary login-btn" name="submit">Submit</button>
        </form>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>