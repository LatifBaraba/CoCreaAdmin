<?php

session_start();

if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}

require 'function.php';

$g = query("SELECT * FROM logo ORDER BY id DESC LIMIT 1");

$id = $_GET["id"];

$sql = query("SELECT * FROM memberprice WHERE id = $id")[0];
var_dump($sql);

// var_dump($_POST);
if (isset($_POST["submit"])){
    
    $id = $_POST['id'];
    
    // cek apakah data diedit atau tidak
    if(editmemberprice()> 0){
        echo "<script>
             alert('Changes Succsess');
             document.location.href = 'memberprice.php';
             </script>";
        // $_SESSION['berhasileditgambar']= 1 ;
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
                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-tags "></i>Products <span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">
                            <li>
                                <a href="memberprice.php"><i class="fa fa-money"></i>Member & Price</a>
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
                        <h3 class="page-head-line">Membership & Price</h3>
                    </div>
                </div> 
            
                <!-- /. PAGE INNER  -->
                <div class="filler-member">
                        <form action="" enctype="multipart/form-data" method="post">
        <input type="hidden" name="id" value="<?= $sql["id"];?>">
        <div class="col-md-5">
                <div class="row">
                        <div class="form-group">
                        <label for="username">Header </label>
                    </div>
                    <input type="text" size="40" name="judul" id="judul" required value="<?= $sql["judul"];?>">
                </div>   

                <div class="row">
                        <div class="form-group">
                        <label for="email">Price </label>
                        </div>
                        <input type="text" size="40" name="harga" id="harga" required value="<?= $sql["harga"];?>">

                </div>  

                <!-- <button class="btn btn-info" type="submit" id="more"><i class='fa fa-tag'></i>  Discount</button> -->
                
                <div id="moreField" style="display:none;">
                <div class="form-group">
                <div class="row">
                        <div class="form-group">
                        <label for="diskon">Discount </label>
                    </div>
                    <input type="text" size="5" name="diskon" id="diskon" placeholder="7.5">
                </div>
                </div>
                    <!-- <button class="btn btn-success btn-confirmpass" type="submit" name="confirm" value="confirm">Confirm Change</button> -->
                </div>
                </div>
                
                <div class="col-md-5">

                <div class="row  add-user">
                        <div class="form-group">
                        <label for="fitur1">Feature </label>
                        <label>1</label>
                    </div>
                    <input type="text" size="40" name="fitur1" id="fitur1" required value="<?= $sql["fitur1"];?>">
                </div>              
                <div class="row  add-user">
                        <div class="form-group">
                        <label for="fitur1">Feature </label>
                        <label>2</label>
                    </div>
                    <input type="text" size="40" name="fitur2" id="fitur2" required value="<?= $sql["fitur2"];?>">
                </div>              
                <div class="row  add-user">
                        <div class="form-group">
                        <label for="fitur1">Feature </label>
                        <label>3</label>
                    </div>
                    <input type="text" size="40" name="fitur3" id="fitur3" required value="<?= $sql["fitur3"];?>">
                </div>              
                <div class="row  add-user">
                        <div class="form-group">
                        <label for="fitur1">Feature </label>
                        <label>4</label>
                    </div>
                    <input type="text" size="40" name="fitur4" id="fitur4" value="<?= $sql["fitur4"];?>">
                </div>              
                <div class="row  add-user">
                        <div class="form-group">
                        <label for="fitur1">Feature </label>
                        <label>5</label>
                    </div>
                    <input type="text" size="40" name="fitur5" id="fitur5" value="<?= $sql["fitur5"];?>">
                </div>              
            </div>
            <div class="btnsubmit-member">
                <div class="col-md-12">
                    <button class="btn btn-success" type="submit" name="submit">Input Data</button>
                </div>
            </div>
            <!-- <button type="submit" formmethod="post">Input</button> -->

        </form>
        </div>

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
