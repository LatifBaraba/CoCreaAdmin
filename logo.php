<?php

session_start();

if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}

require 'function.php';

$g = query("SELECT * FROM logo ORDER BY id DESC LIMIT 1");
if (isset($_POST["submit"])){

        // cek apakah data ditambahkan atau tidak
        if(tambah($_POST)> 0){
            // echo "<script>
            //      alert('data berhasil ditambahkan!');
            //      document.location.href = 'index-admin.php';
            //      </script>";
            $_SESSION["logoberhasil"] = 1;
        }else{
            // echo "<script>
            //      alert('data gagal ditambahkan!');
            //      document.location.href = 'index-admin.php';
            //       </script>";
            // $_SESSION["logogagal"] = 1;
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
                
                <!-- <img src="assets/img/logonew.png" alt="..." class="img-thumbnail"> -->
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
                                <a href="gallery.php"><i class="fa fa-picture-o"></i>Update Album 'Our Space'</a>
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


        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">UPDATE LOGO SECTION </h1>
                    </div>
                </div>
                <!-- /. ROW  -->
                <!-- UPDATE LOGO -->

            <div class="container">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">

                    <?php 
                    if( isset($_SESSION["logoberhasil"]) == 1 ) : ?>
                        <div class="alert alert-success" role="alert">Success added logo <a href="index-admin.php" class="alert-link">back to Dashboard</a>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>    
                        </div>
                <?php
                endif; 
                    unset($_SESSION['logoberhasil']);
                ?>
                
                <?php 
                    if( isset($_SESSION["logogagal"]) == 1 ) : ?>
                        <div class="alert alert-danger" role="alert">Failed added logo
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>    
                        </div>
                <?php
                endif; 
                    unset($_SESSION['logogagal']);
                ?>

                <?php 
                    if( isset($_SESSION["uploadbukangambar"]) == 1 ) : ?>
                        <div class="alert alert-danger" role="alert"><strong>Please upload a picture</strong> format (jpg, jpeg or png)
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>    
                        </div>
                <?php
                endif; 
                    unset($_SESSION['uploadbukangambar']);
                ?>
                

                <?php 
                    if( isset($_SESSION["uploadgambardulu"]) == 1 ) : ?>
                        <div class="alert alert-danger" role="alert"><strong>Please upload a picture</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>    
                        </div>
                <?php
                endif; 
                    unset($_SESSION['uploadgambardulu']);
                ?>

                <?php 
                    if( isset($_SESSION["logoterlalubesar"]) == 1 ) : ?>
                        <div class="alert alert-danger" role="alert"><strong>Picture size to large</strong> | under 2mb
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>    
                        </div>
                <?php
                endif; 
                    unset($_SESSION['logoterlalubesar']);
                ?>
                        
                        <span class="input-group-text"></span>
                  
                    </div>    
                
                <form action="" enctype="multipart/form-data" method="post">

                <!-- <div class="fileUpload btn btn-info"> -->
                    <div class="upload-btn">
                        <label><span>Choose file</span>            
                            <input type="file" name="gambar" id="gambar" class="upload-btn" required>
                        <!-- <label for="file">Choose a file</label> -->
                        </label>
                <!-- </label> -->
                    </div>
                    <button class="btn btn-success btn-logosubmit" type="submit" name="submit">Upload Data</button>
                </div>
                <br>
                <p style="font-style: italic; color: gray;">Picture size : under 2mb</p>
                </form>

         <!-- SAMPE SINI -->
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
