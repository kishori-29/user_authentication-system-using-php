<?php
$adminloggedin=false;
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
    $loggedin=true;
    if(isset($_SESSION['adminloggedin']) && $_SESSION['adminloggedin']==true){
        $adminloggedin=true;
    }
}
else{
    $loggedin=false;
}

echo '<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">PHP login system</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="welcome.php">Home</a>
                </li>';
                if(!$loggedin){
                    echo '<li class="nav-item">
                        <a class="nav-link" href="login.php">LogIn</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="index.php">SignUp</a>
                        </li>';
                }
                if($loggedin){
                    echo '<li class="nav-item">
                        <a class="nav-link" href="logout.php">LogOut</a>
                        </li>';
                }
                if($adminloggedin){
                echo '<li class="nav-item">
                        <a class="nav-link" href="admin.php">Admin</a>
                        </li>';
                }
            echo '
            </ul>
        </div>
    </div>
</nav>';
?>