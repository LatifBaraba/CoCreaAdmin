<?php 
require 'function.php';
$id = $_GET["id"];

if(hapus($id) > 0){

    // echo "<script>
    // alert('Data Deleted !');
    // document.location.href = 'index-admin.php';
    // </script>";
    header("Location: index-admin.php");
    $_SESSION['deleteuserberhasil'] = 1 ;
    return false;
} else {
    // echo "<script>
    // alert('Failed Delete Data !');
    // document.location.href = 'index-admin.php';
    // </script>";
    $_SESSION['deleteusergagal'] = 1 ;

}
?>