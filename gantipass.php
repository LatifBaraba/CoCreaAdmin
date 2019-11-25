<?php 
session_start();

require 'function.php';

if(isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}


$email = $_GET["email"];
//var_dump($email);

// $sql = query("SELECT * FROM user WHERE email = $email");

if (isset($_POST['confirm'])) {
    # Publish-button was clicked
    if(changepassemail($_POST,$email)>0) {
        $_SESSION['rubahpass']= 1 ;
    }
}

?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CoCreative Admin</title>

    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link href="assets/css/custom.css" rel="stylesheet" />
    
</head>
<style>
.tittle {
    font-size: 50px;
}

.tittle-login {
    font-weight: 500;
}

</style>
<body style="background-color: rgb(110, 110, 110);">
    <div class="container">
        <div class="row text-center" style="padding-top:100px;">
            <div class="col-md-12">

                <h1 class="tittle" style="color: white;">CO CREATIVE</h1>
                <h4 class="tittle-login" style="color: white;">Change Password</h4>

                <?php 
                if( isset($_SESSION["passtidaksama"]) == 1 ) : ?>
                <div class="alert alert-danger fade in" role="alert">
                Password not match !
                </div>
                <?php
                endif; 
                unset($_SESSION['passtidaksama']);
                ?>

                <?php 
                if( isset($_SESSION["rubahpass"]) == 1 ) : ?>
                <div class="alert alert-success fade in" role="alert">
                    Change Success <a href="login.php" class="alert-link">back to Login</a>
                </div>
                <?php
                endif; 
                unset($_SESSION['rubahpass']);
                ?>
            </div>
        </div>
         <div class="row">
               
                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                           
                            <div class="panel-body">
                                <form role="form" action="" method="post" enctype="multipart/form-data">
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                            <input type="password" class="form-control" name="password" id="password" placeholder="Password .."/>
                                        </div>
                                            <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                            <input type="password" class="form-control" name="password2" id="password2" placeholder="Confirm Password .."/>
                                        </div>
                                        <button class="btn btn-success" type="submit" name="confirm" value="confirm">Submit</button>
                                        <a href="login.php" class="forgotpass"><i class="fa fa-arrow-left"></i> login</a>
                                    </form> 
                            </div>
                        </div>
        </div>
    </div>

</body>
</html>
