<?php 
session_start();
if(!isset($_SESSION['adminloggedin']) || $_SESSION['adminloggedin']!=true){
    header("location: login.php");
    exit;
}

$userAlert=false;
$userExists=0;
$emptyData=false;
if($_SERVER["REQUEST_METHOD"]=="POST"){
    include 'dbconnect.php';
    $username=$_POST["username"];
    $email=$_POST["email"];
    $message=$_POST["message"];
    echo" inside php1";
    if (!empty($username) && !empty($email) && !empty($message) && !is_numeric($username)){
        
        $existsql="Select * from `users1` where username='$username';";
        $result=mysqli_query($conn, $existsql);
        $num=mysqli_num_rows($result);
        if($num>0){
            ++$userExists;
        }
        if($userExists>0){
            $feedback_sql="INSERT INTO `admin-message` (`username`, `message`, `date_of_msg`) VALUES ('$username', '$message', current_timestamp());";
            $result2=mysqli_query($conn,$feedback_sql);
            if($result2){
                header("location: admin.php");
            }
        }
        else{
            $userAlert=true;
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
    <div class="student-feedback" id="student-feedback">
        <?php 
            if($emptyData){
                echo '<div class="alert alert-success" role="alert">
                Plesae Enter required Information!!
            </div>';
            }
            if($userAlert){
                echo '<div class="alert alert-success text-center" role="alert">
                Username not exists!!
                </div>';
            }
        ?>

        <form action="admin_message.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" maxlength="20" class="form-control" id="username" name="username"
                    aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" maxlength="30" class="form-control" id="email" name="email"
                    aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea type="text" class="form-control" id="message" name="message"
                    placeholder="Enter your message here..."></textarea>
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