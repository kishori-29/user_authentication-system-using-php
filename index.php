<?php
$passwordAlert=true;
$emptyData=false;
$ue=0;
if($_SERVER["REQUEST_METHOD"]=="POST"){
    include 'dbconnect.php';
    $username=$_POST["username"];
    $email=$_POST["email"];
    $password=$_POST["password"];
    $cpassword=$_POST["cpassword"];
    if (!empty($username) && !empty($password) && !empty($email) && !empty($cpassword) && !is_numeric($username)){
        
        $existsql="Select * from `users1` where username='$username' or email='$email';";
        $result=mysqli_query($conn, $existsql);
        $num=mysqli_num_rows($result);
        if($num>0){
            ++$ue;
        }
        
        if(($password==$cpassword) && $ue==0){
            $hashedpwd=password_hash($password, PASSWORD_DEFAULT);
            $sql="INSERT INTO `users1` (`username`, `email`, `password`, `dt`) VALUES ('$username', '$email','$hashedpwd', CURRENT_TIMESTAMP);";
            $result=mysqli_query($conn,$sql);
            if($result){
                header("location: login.php");
            }
        }
        else{
            $passwordAlert="Password do not match!";
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
    <title>SignUp</title>
</head>

<body>
    <?php include 'nav.php';?>
    <div class="container main">

        <?php
            if($emptyData){
                echo '<div class="alert alert-success" role="alert">
                    Plesae Enter Valid Information
                </div>';
            }
            
            if($ue==1){
                echo '<div class="alert alert-success" role="alert">
                    Username or password already exists!!
                </div>';
            }
             if($passwordAlert!==true && $ue==0){
                 echo '<div class="alert alert-success" role="alert">
                 <strong>'.$passwordAlert.'</strong>
                 </div>';
             }
            ?>
        <div class="container">
            <h1 class="text-center">Signup To Our Website</h1>
            <form action="index.php" method="POST">
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
                    <label for="password" class="form-label">Password</label>
                    <input type="password" maxlength="10" class="form-control" id="password" name="password">
                </div>
                <div class="mb-3">
                    <label for="cpassword" class="form-label">Confirm Password</label>
                    <input type="password" maxlength="10" class="form-control" id="cpassword" name="cpassword">
                </div>

                <button type="submit" class="btn btn-primary text-center signup-btn" name="submit">SignUp</button>
            </form>
        </div>
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