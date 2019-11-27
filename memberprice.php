<?php

session_start();

if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}

require 'function.php';

$g = query("SELECT * FROM logo ORDER BY id DESC LIMIT 1");

$a = query("SELECT * FROM memberprice");
// var_dump($a);

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
        <!-- <form action="" enctype="multipart/form-data" method="post"> -->
         <div class="col-md-12">   
        <div class="col-md-6">
            <table class="table table-striped table-member">
                <thead class="thead-user">
                    <th>Member & Price 1</th>
                </thead>
                        <tr>    <td><?php echo $a[0]['judul'];?></td>     </tr>
                        <tr>    <td><?php echo $a[0]['harga'];?></td>     </tr>
                        <tr>    <td><?php echo $a[0]['fitur1'];?></td>     </tr>
                        <tr>    <td><?php echo $a[0]['fitur2'];?></td>     </tr>
                        <tr>    <td><?php echo $a[0]['fitur3'];?></td>     </tr>
                        <tr>    <td><?php echo $a[0]['fitur4'];?></td>     </tr>
                        <tr>    <td><?php echo $a[0]['fitur5'];?></td>     </tr>
            </table>
            <a href="editmemberprice.php?id=<?php echo $a[0]["id"];?>"><button class="btn btn-info"><i class="fa fa-edit"></i> edit</button></a>
        </div>

        <div class="col-md-6">
            <table class="table table-striped table-member">
                <thead class="thead-user">
                    <th>Member & Price 2</th>
                </thead>
                        <tr>    <td><?php echo $a[1]['judul'];?></td>     </tr>
                        <tr>    <td><?php echo $a[1]['harga'];?></td>     </tr>
                        <tr>    <td><?php echo $a[1]['fitur1'];?></td>     </tr>
                        <tr>    <td><?php echo $a[1]['fitur2'];?></td>     </tr>
                        <tr>    <td><?php echo $a[1]['fitur3'];?></td>     </tr>
                        <tr>    <td><?php echo $a[1]['fitur4'];?></td>     </tr>
                        <tr>    <td><?php echo $a[1]['fitur5'];?></td>     </tr>
            </table>
            <a href="editmemberprice.php?id=<?php echo $a[1]["id"];?>"><button class="btn btn-info"><i class="fa fa-edit"></i> edit</button></a>
        </div>
        </div>
        <div class="col-md-12">
        <div class="col-md-6">
            <table class="table table-striped table-member">
                <thead class="thead-user">
                    <th>Member & Price 3</th>
                </thead>
                        <tr>    <td><?php echo $a[2]['judul'];?></td>     </tr>
                        <tr>    <td><?php echo $a[2]['harga'];?></td>     </tr>
                        <tr>    <td><?php echo $a[2]['fitur1'];?></td>     </tr>
                        <tr>    <td><?php echo $a[2]['fitur2'];?></td>     </tr>
                        <tr>    <td><?php echo $a[2]['fitur3'];?></td>     </tr>
                        <tr>    <td><?php echo $a[2]['fitur4'];?></td>     </tr>
                        <tr>    <td><?php echo $a[2]['fitur5'];?></td>     </tr>
            </table>
            <a href="editmemberprice.php?id=<?php echo $a[2]["id"];?>"><button class="btn btn-info"><i class="fa fa-edit"></i> edit</button></a>
        </div>
            
        <div class="col-md-6">
            <table class="table table-striped table-member">
                <thead class="thead-user">
                    <th>Member & Price 4</th>
                </thead>
                        <tr>    <td><?php echo $a[3]['judul'];?></td>     </tr>
                        <tr>    <td><?php echo $a[3]['harga'];?></td>     </tr>
                        <tr>    <td><?php echo $a[3]['fitur1'];?></td>     </tr>
                        <tr>    <td><?php echo $a[3]['fitur2'];?></td>     </tr>
                        <tr>    <td><?php echo $a[3]['fitur3'];?></td>     </tr>
                        <tr>    <td><?php echo $a[3]['fitur4'];?></td>     </tr>
                        <tr>    <td><?php echo $a[3]['fitur5'];?></td>     </tr>
            </table>
            <a href="editmemberprice.php?id=<?php echo $a[3]["id"];?>"><button class="btn btn-info"><i class="fa fa-edit"></i> edit</button></a>
        </div>
        </div>
        <!-- </form> -->
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
