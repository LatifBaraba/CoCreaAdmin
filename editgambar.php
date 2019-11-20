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

$id = $_GET["id"];

$sql = query("SELECT * FROM slider WHERE id = $id")[0];
        // var_dump($sql);

if (isset($_POST["submit"])){

        $id = $_POST['id'];

        // cek apakah data diedit atau tidak
        if(uploadgambar()!= 0){
            // echo "<script>
            //      alert('Changes Succsess');
            //      document.location.href = 'imageslider.php';
            //      </script>";
            $_SESSION['berhasileditgambar']= 1 ;
        }else{
            // header('Location: editgambar.php?id='.$id);
            //$_SESSION["edited"] = 1;
            // var_dump($_SESSION["edited"]);
            // echo "<script>
            //      alert('Changes Failed');
            //      document.location.href = 'edituser.php?id='.$id);
            //       </script>";
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
                <a class="navbar-brand" href="index-admin.php"><img src="./assets/img/<?= $g[0]['gambar']?>" id="logo" width="50"></a>  
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
                        <h3 class="page-head-line">EDIT GAMBAR</h3>

                    </div>
                </div> 
                <!-- CONTENT DI SINI CUY -->
                <?php 
                // var_dump($_SESSION["edited"]);  
                if( isset($_SESSION["edited"]) == 1 ) : ?>
                <div class="alert alert-danger fade in" role="alert">Picture Is Invalid !
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
                // var_dump($_SESSION["edited"]);  
                if( isset($_SESSION["upload"]) == 1 ) : ?>
                <div class="alert alert-danger fade in" role="alert">Upload picture first !
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <?php
                //$_SESSION["edited"] = 0; 
                endif; 
                unset($_SESSION['upload']);
                ?>

                <?php 
                // var_dump($_SESSION["edited"]);  
                if( isset($_SESSION["gambarbesar"]) == 1 ) : ?>
                <div class="alert alert-danger fade in" role="alert">Picture size too large | under 2mb
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <?php
                //$_SESSION["edited"] = 0; 
                endif; 
                unset($_SESSION['gambarbesar']);
                ?>

                <?php 
                // var_dump($_SESSION["edited"]);  
                if( isset($_SESSION["bukangambar"]) == 1 ) : ?>
                <div class="alert alert-danger fade in" role="alert">Upload picture ( jpg, jpeg or png )
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <?php
                //$_SESSION["edited"] = 0; 
                endif; 
                unset($_SESSION['bukangambar']);
                ?>
                
                <?php 
                // var_dump($_SESSION["edited"]);  
                if( isset($_SESSION["berhasileditgambar"]) == 1 ) : ?>
                <div class="alert alert-success fade in" role="alert">Success edit data <a href="imageslider.php" class="alert-link">back to imageslider</a>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <?php
                endif; 
                // header('Location: imageslider.php');
                unset($_SESSION['berhasileditgambar']);
                ?>

                <div class="form-group row">
                    <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $sql["id"];?>">
                    <input type="hidden" name="gambar" value="<?= $sql["gambar"];?>">
         
                
                    <label class="col-sm-2" for="judul">Judul : </label>
                    <div class="col-sm-10">
                    <input class="form-control" type="text" name="judul" id="judul" required value="<?= $sql["judul"];?>">
                    </div>
                    
                    <label class="col-sm-2" for="paragraf">Paragraf : </label>
                    <div class="col-sm-10">
                    <textarea class="form-control" name="paragraf" id="paragraf" rows="10" cols="30"><?= $sql["paragraf"];?></textarea>
                    </div>
                   
                    <label class="col-sm-2" for="gambar">Gambar : </label>  
                    <div class="col-sm-5"> 
                    <input class="form-control" type="file" name="gambar" id="gambar">
                    <p style="font-style: italic;">Size : Recommended -- 1920 X 1080 --</p>
                    <p style="font-style: italic;">Or</p>
                    <p style="font-style: italic;">Aspect Rasio : -- 19 : 10 --</p>
                    </div>
            
        <button class="btn btn-success" type="submit" name="submit">SAVE</button>
        </form>
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