<?php 
session_start();

if( isset($_SESSION["login"]) ) {
	header("Location: index-admin.php");
	exit;
}

require 'function.php';

if( isset($_POST["login"]) ) {
    $username = $_POST["username"];
	$password = $_POST["password"];
    
    $result = mysqli_query($conn, "SELECT * FROM superadmin WHERE username = '$username'");
	// cek username
	if( mysqli_num_rows($result) === 1 ) {
		// cek password
        $row = mysqli_fetch_assoc($result);
        // var_dump($row);
		if( password_verify($password, $row["password"]) ) {
			// set session
			$_SESSION["login"] = true;
			header("Location: index-admin.php");
			exit;
		}
	}
	$error = true;
}

if( isset($_POST["login"]) ) {
    $username = $_POST["username"];
	$password = $_POST["password"];
    
    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
	// cek username
	if( mysqli_num_rows($result) === 1 ) {
		// cek password
        $row = mysqli_fetch_assoc($result);
        // var_dump($row);
		if( password_verify($password, $row["password"]) ) {
			// set session
            $_SESSION["login"] = true;
            $_SESSION["userlogin"]= true;
			header("Location: index-user.php");
			exit;
		}
	}
	$error = true;
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
    font-weight: 300;
}

</style>
<body style="background-color: rgb(110, 110, 110);">
    <div class="container">
        <div class="row text-center" style="padding-top:100px;">
            <div class="col-md-12">

                <h1 class="tittle" style="color: white;">CO CREATIVE</h1>
                <h4 class="tittle-login" style="color: white;">LOGIN</h4>
                <!-- <img src="assets/img/"/> -->
            </div>
        </div>
         <div class="row">
               
                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                           
                            <div class="panel-body">
                                <form role="form" action="" method="post" enctype="multipart/form-data">
                                       <br/>
                                       <?php if( isset($error) ) : ?>
                                                <h4 style="color: #5CB85C ; text-align: center;" >Username / Password invalid</h4>
                                                <?php endif; ?>
                                        <div class="form-group input-group">
                                              
                                            <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                                            <input type="text" class="form-control" name="username" id="username" placeholder="Your Username "/>
                                            
                                        </div>
                                            <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                            <input type="password" class="form-control" name="password" id="password" placeholder="Your Password"/>
                                        </div>
                                        <button class="btn btn-success" type="submit" name="login">Login</button>
                                        <a href="submitemail.php" class="forgotpass">Forgot Password</a>
                                    </form>
                            </div>
                        </div>
        </div>
    </div>

</body>
</html>
