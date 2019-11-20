<?php
session_start();

if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}

if(isset($_SESSION["userlogin"])){
    header("Location: index-user.php");
    exit;
}

require 'function.php';

$id = $_GET["id"];
// --
// global $conn;   
// --
$sql = query("SELECT * FROM user WHERE id = $id")[0];
$g = query("SELECT * FROM logo ORDER BY id DESC LIMIT 1");

        // var_dump($sql);

if (isset($_POST["submit"])){

        // cek email validation
        $id = $_POST['id'];
        $email  = $_POST['email'];
        $emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
        
        if (filter_var($emailB, FILTER_VALIDATE_EMAIL) === false ||
            $emailB != $email
        ) {
            // echo "<script>
            //      alert('Email is invalid!');
            //      document.location.href = 'edituser.php?id='".$id.";
            //      </script>";
            
            $_SESSION["edited"] = 1;
            header('Location: edituser.php?id='.$id);
            exit();
        }  
    
        // cek apakah data diedit atau tidak
        if(edituser($_POST)> 0){
            // echo "<script>
            //      alert('Changes Succsess');
            //      document.location.href = 'index-admin.php';
            //      </script>";
            $_SESSION['edituserberhasil'] = 1 ;
        }else{
            $_SESSION["edited"] = 1;
            header('Location: edituser.php?id='.$id);
            // echo "<script>
            //      alert('Changes Failed');
            //      document.location.href = 'edituser.php?id='.$id);
            //       </script>";
        } 
    }

if (isset($_POST['confirm'])) {
    # Publish-button was clicked
    if(changepass($_POST)>0) {
        $_SESSION['rubahpass']= 1 ;
    }
}
?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CcCreative Admin</title>

    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
       <!--CUSTOM BASIC STYLES-->
    <link href="assets/css/basic.css" rel="stylesheet" />
    <!--CUSTOM MAIN STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <?php if(isset($_SESSION['userlogin'])){ ?>
                    <a class='navbar-brand' href='index-user.php'><img src='./assets/img/<?php echo $g[0]['gambar']?>' id='logo' width='50'></a>
                <?php }?> 

                <?php if(!isset($_SESSION['userlogin'])){ ?>
                    <a class='navbar-brand' href='index-admin.php'><img src='./assets/img/<?php echo $g[0]['gambar']?>' id='logo' width='50'></a>
                <?php }?>
                
            </div>

            <div class="header-right">
                <h1 class="header-right-tittle">CO CREATIVE ADMIN SITE</h1>
            </div>
        </nav>


        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">

                    <?php if(isset($_SESSION['userlogin']))
                    echo "<li>
                    <a class='active-menu' href='index-user.php'><i class='fa fa-dashboard'></i>Dashboard</a>
                    </li>"; ?>

                    <?php if(!isset($_SESSION['userlogin']))
                    echo "<li>
                    <a class='active-menu' href='index-admin.php'><i class='fa fa-dashboard'></i>Dashboard</a>
                    </li>"; ?>

                    <li>
                        <a href="#"><i class="fa fa-slideshare "></i>Slider Screen<span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">
                            <li>
                                <a href="imageslider.php"><i class="fa fa-file-image-o"></i>Image Slider</a>
                            </li>
                        </ul>
                    </li>
                     <li>
                        <a href="#"><i class="fa fa-yelp "></i>Logo Section <span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">
                            <li>
                                <a href="logo.php"><i class="fa fa-upload"></i>Update Logo</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-camera "></i>Gallery <span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">
                            <li>
                                <a href="gallery.php"><i class="fa fa-picture-o"></i>Update Album</a>
                            </li>
                            <li>
                               <a href="profilepicture.html"><i class="far fa-user-circle"></i>Update Your Profile Picture</a> 

                            </li> 
                        </ul>
                    </li>
                    <?php if(!isset($_SESSION['login']))
                    echo " <li>
                    <a href='login.php'><i class='fa fa-sign-in'></i>Login Page</a>
                    </li>"; ?>
                    
                    
                    <?php if(isset($_SESSION['login']))
                    echo "<li>
                    <a href='logout.php'><i class='fa fa-sign-out'></i>Log out</a>
                    </li>"; ?>
                </ul>
            </div>
        </nav>
       
       
        <!-- /. NAV SIDE  -->


        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row ">
                    <div class="col-md-12">
                        <!-- <h1 class="page-head-line">CO CREATIVE ADMIN SITE</h1> -->
                        <h3 class="page-head-line">EDIT USER</h3>
                
                <?php 
                if( isset($_SESSION["edituserberhasil"]) == 1 ) : ?>
                <div class="alert alert-success fade in" role="alert">Edit Data Success <a href="index-admin.php" class="alert-link"> back to Dashboard</a>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>    
                </div>
                <?php
                endif; 
                unset($_SESSION['edituserberhasil']);
                ?>

                    </div>
                </div> 
                <!-- CONTENT DI SINI CUY -->

                <?php 
                // var_dump($_SESSION["edited"]);  
                if( isset($_SESSION["edited"]) == 1 ) : ?>
                <div class="alert alert-danger fade in" role="alert">
                Email Is Invalid !
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                
                <?php
                //$_SESSION["edited"] = 0; 
                 endif; 
                 unset($_SESSION['edited']);
                ?>

                <?php 
                if( isset($_SESSION["passtidaksama"]) == 1 ) : ?>
                <div class="alert alert-danger fade in" role="alert">
                Password not match !
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <?php
                endif; 
                unset($_SESSION['passtidaksama']);
                ?>

                <?php 
                if( isset($_SESSION["rubahpass"]) == 1 ) : ?>
                <div class="alert alert-success fade in" role="alert">
                    Change Success <a href="index-admin.php" class="alert-link">back to Dashboard</a>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <?php
                endif; 
                unset($_SESSION['rubahpass']);
                ?>
                
            <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $sql["id"];?>">
            <div class="row">
                <div class="col-xs-1">
                <div class="form-group">
                    <label for="username">Username  </label>
                </div>
                </div>
                <div class="col-xs-1">
                    <input type="text" size="30" name="username" id="username" required value="<?= $sql["username"];?>">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-1">
                    <div class="form-group">
                        <label for="email">Email  </label>
                    </div>
                </div>
                <div class="col-xs-1">
                    <input type="text" size="40" name="email" id="email" required value="<?= $sql["email"];?>">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-1">
                    <div class="form-group">
                        <label for="alamat">Address  </label>
                    </div>
                </div>
                <div class="col-xs-1">
                    <input type="text" size="40" name="alamat" id="alamat" required value="<?= $sql["alamat"];?>">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-2">
                    <div class="form-group">
                        <label for="telepon">Number Phone  </label>
                    </div>
                </div>
                <div class="col-xs-1">
                <input type="text" size="30" name="telepon" id="telepon" required value="<?= $sql["telepon"];?>">
                </div>
            </div>
            <button class="btn btn-success" type="submit" name="submit">Edit Data</button>
            
            <button id="more" class="btn btn-info">Change Password</button>
            
            <div class="formpass">
            <div id="moreField" style="display:none;">
                <div class="form-group">
                    <div class="row">
                            <div class="col-xs-2">
                                    <label for="password">New Password : </label>
                            </div>
                            <div class="col-xs-1">
                            <input type="password" size="30" name="password" id="password" placeholder="New Password" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-2">
                                    <label for="password">Confirm Password : </label>
                            </div>
                            <div class="col-xs-1">
                            <input type="password" size="30" name="password2" id="password2" placeholder="Confirm Password" >
                            </div>
                        </div>
                    <button class="btn btn-success btn-confirmpass" type="submit" name="confirm" value="confirm">Confirm Change</button>
                </div>
            
        </div>
      </div>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->

    <div id="footer-sec">
        &copy; 2014 YourCompany | Design By : <a href="http://www.binarytheme.com/" target="_blank">BinaryTheme.com</a>
    </div>
    <!-- /. FOOTER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
       <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>

</body>
</html>