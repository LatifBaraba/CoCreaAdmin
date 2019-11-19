<?php
// Koneksi ke Database
$conn = mysqli_connect("localhost","root","","admin");

function query($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

function register($data) {
    global $conn;
    
	$username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);
    
	// cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
    
	if( mysqli_fetch_assoc($result) ) {
		echo "<script>
				alert('username sudah terdaftar!')
		      </script>";
		return false;
    }

	// cek konfirmasi password
	if( $password !== $password2 ) {
		echo "<script>
				alert('konfirmasi password tidak sesuai!');
		      </script>";
        return false;
        // var_dump($password);
    }
    
	// enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);
    
	// tambahkan userbaru ke database
    mysqli_query($conn, "INSERT INTO user VALUES('', '$username','$password')");
    
	return mysqli_affected_rows($conn);
}

// -------------- ADD USER ---------------
//----------------------------------------
function adduser($data){

    global $conn;
  // ambil data dari tiap elemen dalam form
  $username = htmlspecialchars($data["username"]);
  $email = htmlspecialchars($data["email"]);
  $alamat = htmlspecialchars($data["alamat"]);
  $telepon = htmlspecialchars($data["telepon"]);
  $password = mysqli_real_escape_string($conn, $data["password"]);
  $password2 = mysqli_real_escape_string($conn, $data["password2"]);
  
  $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
    
	if( mysqli_fetch_assoc($result) ) {
		// echo "<script>
        //         alert('Username is not available !')
        //         document.location.href = 'adduser.php';
        //       </script>";
        //       exit();
            $_SESSION['usernamesama']=1;
            return false;
    }

    // cek konfirmasi password
	if( $password !== $password2 ) {
		echo "<script>
				alert('konfirmasi password tidak sesuai!');
		      </script>";
        return false;
        // var_dump($password);
    }
    
	// enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);
    
	// tambahkan userbaru ke database
    // mysqli_query($conn, "INSERT INTO user VALUES('', '$username','$password')");
    // $id = $_POST['id'];
    // cek email validation
    $email  = $_POST['email'];
    // $emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
    // var_dump($email);
    // var_dump($emailB);
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)       
    ) {
        // echo "<script>
        //      alert('Email is invalid!');
        //      document.location.href = 'adduser.php';
        //      </script>";
        $_SESSION['emailinvalid']=1;
        // var_dump('dalam');
        //exit();
        // header('Location: adduser.php?id='.$id);
        return false;
    }

  // query insert data
  $query = "INSERT INTO user VALUES 
  ('','$username','$email','$alamat','$telepon','$password')";
  $simpan = mysqli_query($conn,$query);
  if (!$simpan){        
    $_SESSION['gagaltambah']= 1;    
  }else {
    $_SESSION['berhasiltambah']= 1;
  }

  return mysqli_affected_rows($conn);
}

function hapus($id){
    global $conn ;
    mysqli_query($conn, "DELETE FROM user WHERE id=$id");

    return mysqli_affected_rows($conn);
}

function edituser($data) {
    global $conn;

    $id = $data["id"];
    // ambil data dari tiap elemen dalam form
    $username = htmlspecialchars($data["username"]);
    $email = htmlspecialchars($data["email"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $telepon = htmlspecialchars($data["telepon"]);
    $password = mysqli_real_escape_string($conn, $data["password"]);

        // query insert data
    $query = "UPDATE user SET
                username = '$username',
                email = '$email',
                alamat = '$alamat',
                telepon = '$telepon',
                password = '$password'
            WHERE id = '$id';
    ";
    mysqli_query($conn,$query);

    return mysqli_affected_rows($conn);
}


// -------------- UPLOAD LOGO ---------------
//----------------------------------------

function upload(){
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar
    if( $error === 4){
            // echo "<script>
            //     alert('upload gambar dahulu');    
            // </script>";
            $_SESSION['uploadgambardulu']=1;
            return false;
    }   

    $ekstensiGambarValid = ['jpg','jpeg','png'];
    $ekstensiGambar = explode('.',$namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    
    if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
        //  echo "<script>
        //       alert('upload bukan gambar !');    
        //  </script>";
    $_SESSION['uploadbukangambar']=1;
    return false;
        
    }

    //cek ukuran max size
    if($ukuranFile > 2000000){
        // echo "<script>
        // alert('ukuran gambar terlalu besar !');    
        // </script>";
        $_SESSION['logoterlalubesar']=1;
        return false;
    }

    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    // beres cek siap di upload
    move_uploaded_file($tmpName, 'assets/img/' . $namaFileBaru);

    return $namaFileBaru;
}


function tambah(){
    global $conn;
     // upload gambar
     $gambar = upload();
     if( !$gambar ){
           return false;
     }

     // query insert data
     $query = "INSERT INTO logo VALUES 
     ('','$gambar')
     ";

     mysqli_query($conn,$query);

     return mysqli_affected_rows($conn);

}

function uploadgambar(){
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar
    if( $error === 4){
            // echo "<script>
            //     alert('upload gambar dahulu');    
            // </script>";
            
            $_SESSION['upload']=1;

            return false;
    }  

    $ekstensiGambarValid = ['jpg','jpeg','png'];
    $ekstensiGambar = explode('.',$namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    
    if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
        //  echo "<script>
        //       alert('upload bukan gambar !');    
        //  </script>";
         $_SESSION['bukangambar']= 1 ;
    
    return false;        
    }
    // var_dump($ukuranFile);
    //cek ukuran max size
    if($ukuranFile > 2000000){
        // $id = $_POST['id'];
        // alert('ukuran gambar terlalu besar !');   
        // echo "<script>
        // document.location.href = 'edituser.php?id='.$id); 
        // </script>";
        $_SESSION['gambarbesar']=1;
        return false;
    } 

    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    // beres cek siap di upload
    $kirim = move_uploaded_file($tmpName, 'assets/img/slider/' . $namaFileBaru);
    if ($kirim){
        $gambar = $namaFileBaru;
        editgambar($gambar);
    }else{
        $_SESSION["edited"] = 1;
    }
    return $namaFileBaru;
}


function tambahgambar(){
    global $conn;
     // upload gambar
     $gambar = uploadgambar();
     if( !$gambar ){
           return false;
     }

     // query insert data
     $query = "INSERT INTO slider VALUES 
     ('','$gambar')
     ";

     mysqli_query($conn,$query);

     return mysqli_affected_rows($conn);

}

function editgambar($dt) {
    global $conn;

    $id = $_POST["id"];
    // ambil data dari tiap elemen dalam form
    $judul = htmlspecialchars($_POST["judul"], ENT_QUOTES);
    $paragraf = htmlspecialchars($_POST["paragraf"], ENT_QUOTES);
    $gambar = htmlspecialchars($dt);

    // query insert data
    $query = "UPDATE slider SET
                judul = '$judul',
               
                paragraf = '$paragraf',
                gambar = '$gambar'
            WHERE id = '$id';
    ";
    mysqli_query($conn,$query);

    return mysqli_affected_rows($conn);
}

// ---------------------------------
// -------function gallery----------
// ---------------------------------

function uploadgallery(){
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar
    if( $error === 4){
            // echo "<script>
            //     alert('upload gambar dahulu');    
            // </script>";
            
            $_SESSION['upload']=1;

            return false;
    }  

    $ekstensiGambarValid = ['jpg','jpeg','png'];
    $ekstensiGambar = explode('.',$namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    
    if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
        //  echo "<script>
        //       alert('upload bukan gambar !');    
        //  </script>";
         $_SESSION['bukangambar']= 1 ;
    
    return false;        
    }
    // var_dump($ukuranFile);
    //cek ukuran max size
    if($ukuranFile > 2000000){
        // $id = $_POST['id'];
        // alert('ukuran gambar terlalu besar !');   
        // echo "<script>
        // document.location.href = 'edituser.php?id='.$id); 
        // </script>";
        $_SESSION['gambarbesar']=1;
        return false;
    } 

    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    // beres cek siap di upload
    $kirim = move_uploaded_file($tmpName, 'assets/img/gallery/' . $namaFileBaru);
    if ($kirim){
        $gambar = $namaFileBaru;
        editgallery($gambar);
    }else{
        $_SESSION["edited"] = 1;
    }
    return $namaFileBaru;
}


// function tambahgallery(){
//     global $conn;
//      // upload gambar
//      $gambar = uploadgallery();
//      if( !$gambar ){
//            return false;
//      }

//      // query insert data
//      $query = "INSERT INTO gallery VALUES 
//      ('','$gambar')
//      ";

//      mysqli_query($conn,$query);

//      return mysqli_affected_rows($conn);

// }

function editgallery($dt) {
    global $conn;

    $id = $_POST["id"];
    // ambil data dari tiap elemen dalam form
    $judul = htmlspecialchars($_POST["judul"], ENT_QUOTES);
    $ketjudul = htmlspecialchars($_POST["ketjudul"], ENT_QUOTES);
    $paragraf = htmlspecialchars($_POST["paragraf"], ENT_QUOTES);
    $gambar = htmlspecialchars($dt);

    // query insert data
    $query = "UPDATE gallery SET
                judul = '$judul',
                ketjudul = '$ketjudul',
                paragraf = '$paragraf',
                gambar = '$gambar'
            WHERE id = '$id';
    ";
    mysqli_query($conn,$query);

    // var_dump($judul);
    // var_dump($query);

    return mysqli_affected_rows($conn);
}

function changepass($data) {
global $conn;
$id = $_POST["id"];

$password = mysqli_real_escape_string($conn, $data["password"]);
$password2 = mysqli_real_escape_string($conn, $data["password2"]);

if( $password !== $password2 ) {
    $_SESSION['passtidaksama']= 1 ;
    return false;
    // var_dump($password);
} else {
    $password = password_hash($password, PASSWORD_DEFAULT);
    $query = "UPDATE user SET
                password = '$password'
            WHERE id = '$id';
    ";
    mysqli_query($conn,$query);

    return mysqli_affected_rows($conn);

}


}

?>