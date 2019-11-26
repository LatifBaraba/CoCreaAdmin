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

$g = query("SELECT * FROM logo ORDER BY id DESC LIMIT 1");

if (isset($_POST["submit"])){


        // cek apakah data ditambahkan atau tidak
        adduser($_POST);
        //if(adduser($_POST)> 0){
            // echo "<script>
            //      alert('data added success!');
            // document.location.href = 'index-admin.php';
            //       </script>";
                //  $_SESSION['berhasiltambah']= 1;
        // }else{
        //     // echo "<script>
        //     //      alert('data added failed!');
        //     //      document.location.href = 'index-admin.php';
        //     //       </script>";
        //     $_SESSION['gagaltambah']= 1;
        //     // return false;
        // } 
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
                            <!-- <li>
                               <a href="profilepicture.html"><i class="fa fa-user"></i>Update Your Profile Picture</a> 

                            </li>  -->
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

        <div class="adduser">
        <div id="page-wrapper">
            <div id="page-inner">
            <div class="row ">
                    <div class="col-md-12">
                        <!-- <h1 class="page-head-line">CO CREATIVE ADMIN SITE</h1> -->
                        <h3 class="page-head-line">ADD USER</h3>
                    </div>
                </div> 

                <!-- CONTENT DI SINI BANGKE -->
                <?php 
                // var_dump($_SESSION["edited"]);  
                if( isset($_SESSION["berhasiltambah"]) == 1 ) : ?>
                <div class="alert alert-success fade in" role="alert">Succses data added <a href="index-admin.php" class="alert-link">back to Dashboard</a> </div>
                <?php
                //$_SESSION["edited"] = 0; 
                endif; 
                unset($_SESSION['berhasiltambah']);
                ?>

                <?php 
                if( isset($_SESSION["gagaltambah"]) == 1 ) : ?>
                <div class="alert alert-danger fade in" role="alert">Failed add data</div>
                <?php
                endif; 
                unset($_SESSION['gagaltambah']);
                ?>

                <?php 
                if( isset($_SESSION["emailinvalid"]) == 1 ) : ?>
                <div class="alert alert-danger fade in" role="alert">Email invalid
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <?php
                endif; 
                unset($_SESSION['emailinvalid']);
                ?>

                <?php 
                if( isset($_SESSION["usernamesama"]) == 1 ) : ?>
                <div class="alert alert-danger fade in" role="alert">Username invalid
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>    
                </div>
                <?php
                endif; 
                unset($_SESSION['usernamesama']);
                ?>

            <div class="filler-user">
                <form action="" enctype="multipart/form-data" method="post">
                <div class="col-md-4">
                <div class="row">
                        <div class="form-group">
                        <label for="username">Username </label>
                    </div>
                    <input type="text" size="30" name="username" id="username" placeholder="Adi Rayana ..." required>
                </div>   

                <div class="row">
                        <div class="form-group">
                        <label for="email">Email </label>
                        </div>
                        <input type="text" size="30" name="email" id="email" placeholder="adiRaya@gmail.com ..." required>
                </div>  

                <div class="row">
                        <div class="form-group">
                        <label for="alamat">Address </label>
                    </div>
                    <input type="text" size="30" name="alamat" id="alamat" placeholder="Jl. Sang Pejuang" required>
                </div>                
                </div>
                
                <div class="col-md-6">

                <div class="row  add-user">
                        <div class="form-group">
                        <label for="telepon">Phone Number </label>
                        </div>
                        <input type="text" name="telepon" id="telepon" placeholder="0821348709">
                </div> 
                <div class="row  add-user">
                        <div class="form-group">
                        <label for="password">Password </label>
                        </div>
                        <input type="password" name="password" id="password" placeholder="Password" minlength="6" required>
                </div>                    

                <div class="row add-user">
                        <div class="form-group">
                        <label for="password2">Confirm Password </label>
                    </div>
                    <input type="password" name="password2" id="password2" placeholder="Confirm Password" minlength="6" required >
                </div>                    
            </div>
            <div class="col-md-6">
            <button class="btn btn-success" type="submit" name="submit">Input Data</button>
            </div>
        </form>
        </div>
        </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    </div>
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