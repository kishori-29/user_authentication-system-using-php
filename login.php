<?php
$loginError=false;
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        include 'dbconnect.php';
        $username=$_POST['username'];
        $password=$_POST['password'];
        $sql="Select * from users1 where username='$username';";
        $result=mysqli_query($conn, $sql);
        if($result && mysqli_num_rows($result)>0){
            $user_data= mysqli_fetch_assoc($result);
            // if($user_data['password']===$password){
            if(password_verify($password, $user_data['password'])){
                session_start();
                $_SESSION['loggedin']=true;
                $_SESSION['username']=$username;
                if($username=="kishori" && password_verify('kishori12', $user_data['password'])){
                    session_start();
                    $_SESSION['adminloggedin']=true;
                }
                header("location: welcome.php");
            }
        }
        $loginError=true;      
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
    <title>Login</title>
</head>

<body>
    <?php include 'nav.php';?>
    <?php
         if($loginError){
            echo '<div class="alert alert-success text-center" role="alert">
            Please Enter Some Valid Information!!
            </div>';  
         }
    ?>
    <div class="container main-login">
        <h1 class="text-center my-4">Login To Our Website</h1>
        <form action="login.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" maxlength="20" class="form-control" id="username" name="username"
                    aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" maxlength="10" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary login-btn" name="submit">Login</button>
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