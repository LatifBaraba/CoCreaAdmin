<?php

session_start();

if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}

require 'function.php';

$g = query("SELECT * FROM logo ORDER BY id DESC LIMIT 1");

$gambar = query("SELECT * FROM gallery");
// var_dump($gambar);


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
        <nav class="navbar navbar-default navbar-cls-top" role="navigation" style="margin-bottom: 0">
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


        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Our Space Gallery Section</h1>
                    </div>
                </div>
                <!-- /. ISI DISINI.ROW  -->
<!--                 
                <img src="assets/img/update gallery section.png" class="img-fluid" alt="Responsive image">

            <div class="UpdateJudulDeskripsi">
                 <h1 class="page-head-line">Coworking Space</h1> -->
                <!-- <h1 class="page-subhead-line">Silahkan isi/ganti sesi Coworking Space. </h1>-->


<!-- <div class="input-group mb-3"> -->
                    <!-- class="custom-select" -->
  <!-- <div class="panel panel-success"> -->
    <!-- <input type="text" readonly="readonly" id="txtresults"/> -->
            <!-- <div class="panel-heading">
               <h5>Update here</h5>
            </div>  
            <div class="panel-body">
                <form role="form" class="form-group">
                    <select id="inputGroupSelect02" class="custom-select my-1 mr-sm-2">
                        <option selected>Choose...</option>
                        <option value="1">Coworking Space</option>
                        <option value="2">Our Space </option>
                        <option value="3">Event Space</option>
                        <option value="4">Meeting Rooms</option>
                        <option value="5">Amenities</option>
                        <option value="6">Office Space</option>
                    </select>
                            <div class="form-group">
                                <label id="jg">Tittle</label>
                                <br />
                                <div id="divResult"></div>
                                 <input type="text" readonly="readonly" id="txtresults"/>  -->
                                 <!-- <input class="form-control" type="text"> --> 
                            <!-- </div>
                     <div class="form-group">
                                <label>Description</label>
                                <input class="form-control" type="text">
                            </div>
                                <div class="form-group"> -->
                                <!-- <label>Text area</label>
                                <textarea class="form-control" rows="3"></textarea> -->

                                <!-- <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                     <span class="input-group-text">Upload</span>
                                    </div>
                                <div class="custom-file">
                                     <input type="file" class="custom-file-input file-input" id="inputGroupFile01">
                                </div>
                                </div>
                            </div>

                     
                            <button type="submit" class="btn btn-success">Update </button>

                        </form>
                </div>
            </div> -->
  <!-- <div id="divResult"></div> -->


  <!-- <div class="input-group-append">
    <label class="input-group-text" for="inputGroupSelect02">Options</label>
  </div> -->
<!-- </div> -->

<div class="row">
    <div class="col-md-4">
        <div class="card text-center card-d" style="width: 100%;">
            <img class="card-img-top" src="assets/img/gallery/<?= $gambar[0]['gambar'];?>" alt="Card image cap">
                <div class="card-body">
                    <h4 class="card-title"><?= $gambar[0]['judul'];?></h4>
                    <h5><?= $gambar[0]['ketjudul'];?></h5>
                    <p class="card-text"><?= $gambar[0]['paragraf'];?></p>
                    <button class="btn btn-success btn-edit" onclick="location.href='editgallery.php?id=<?php echo $gambar[0]['id'];?>'" type="button">Edit</button>
                </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center card-d" style="width: 100%;">
            <img class="card-img-top" src="assets/img/gallery/<?= $gambar[1]['gambar'];?>" alt="Card image cap" style="width: 200px;">
                <div class="card-body">
                    <h4 class="card-title"><?= $gambar[1]['judul'];?></h4>
                    <h5><?= $gambar[1]['ketjudul'];?></h5>
                    <p class="card-text"><?= $gambar[1]['paragraf'];?></p>
                    <button class="btn btn-success btn-edit" onclick="location.href='editgallery.php?id=<?php echo $gambar[1]['id'];?>'" type="button">Edit</button>
                </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center card-d" style="width: 100%;">
            <img class="card-img-top" src="assets/img/gallery/<?= $gambar[2]['gambar'];?>" alt="Card image cap" style="width: 200px;">
                <div class="card-body">
                    <h4 class="card-title"><?= $gambar[2]['judul'];?></h4>
                    <h5><?= $gambar[2]['ketjudul'];?></h5>
                    <p class="card-text"><?= $gambar[2]['paragraf'];?></p>
                    <button class="btn btn-success btn-edit" onclick="location.href='editgallery.php?id=<?php echo $gambar[2]['id'];?>'" type="button">Edit</button>
                </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="card text-center card-d" style="width: 100%;">
            <img class="card-img-top" src="assets/img/gallery/<?= $gambar[3]['gambar'];?>" alt="Card image cap" style="width: 200px;">
                <div class="card-body">
                    <h4 class="card-title"><?= $gambar[3]['judul'];?></h4>
                    <h5><?= $gambar[3]['ketjudul'];?></h5>
                    <p class="card-text"><?= $gambar[3]['paragraf'];?></p>
                    <button class="btn btn-success btn-edit" onclick="location.href='editgallery.php?id=<?php echo $gambar[3]['id'];?>'" type="button">Edit</button>
                </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center card-d" style="width: 100%;">
            <img class="card-img-top" src="assets/img/gallery/<?= $gambar[4]['gambar'];?>" alt="Card image cap" style="width: 200px;">
                <div class="card-body">
                    <h4 class="card-title"><?= $gambar[4]['judul'];?></h4>
                    <h5><?= $gambar[4]['ketjudul'];?></h5>
                    <p class="card-text"><?= $gambar[4]['paragraf'];?></p>
                    <button class="btn btn-success btn-edit" onclick="location.href='editgallery.php?id=<?php echo $gambar[4]['id'];?>'" type="button">Edit</button>
                </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center card-d" style="width: 100%;">
            <img class="card-img-top" src="assets/img/gallery/<?= $gambar[5]['gambar'];?>" alt="Card image cap" style="width: 200px;">
                <div class="card-body">
                    <h4 class="card-title"><?= $gambar[5]['judul'];?></h4>
                    <h5><?= $gambar[5]['ketjudul'];?></h5>
                    <p class="card-text"><?= $gambar[5]['paragraf'];?></p>
                    <button class="btn btn-success btn-edit" onclick="location.href='editgallery.php?id=<?php echo $gambar[5]['id'];?>'" type="button">Edit</button>
                </div>
        </div>
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
