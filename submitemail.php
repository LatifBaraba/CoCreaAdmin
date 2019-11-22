<?php 
session_start();

if( isset($_SESSION["login"]) ) {
	header("Location: index-admin.php");
	exit;
}

require 'function.php';

if(isset($_POST["kirim"])){

    kirimemail($_POST);

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
                <h4 class="tittle-login" style="color: white;">Submit Email Address</h4>

                <?php 
                if( isset($_SESSION["emailisinvalid"]) == 1 ) : ?>
                <div class="alert alert-danger fade in" role="alert">Email invalid</div>
                <?php
                endif; 
                unset($_SESSION['emailisinvalid']);
                ?>

                <?php 
                if( isset($_SESSION["emailberhasil"]) == 1 ) : ?>
                <div class="alert alert-success fade in" role="alert">Email sent success
                </div>
                <?php
                endif; 
                unset($_SESSION['emailberhasil']);
                ?>

                <?php 
                if( isset($_SESSION["emailgagal"]) == 1 ) : ?>
                <div class="alert alert-danger fade in" role="alert">Something Wrong !
                </div>
                <?php
                endif; 
                unset($_SESSION['emailgagal']);
                ?>

            </div>

                
        </div>
         <div class="row">
               
                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                           
                            <div class="panel-body">
                                <form role="form" action="" method="post" enctype="multipart/form-data">
                                       <br/>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                            <input type="text" class="form-control" name="email" id="email" placeholder="Your Email Address .."/>
                                        </div>
                                        <button class="btn btn-success" type="submit" name="kirim" value="kirim">Send Email</button>
                                        <a href="login.php"><i class="fa fa-arrow-left" aria-hidden="true"></i> login</a>
                                    </form>
                            </div>
                        </div>
        </div>
    </div>

</body>
</html>
