<?php
  require '../db.php';
  $conn = OpenCon();

  if(isset($_POST['submit'])){
    $nama = $_POST['nama'];
    $nip = $_POST['nip'];
    $jabatan = $_POST['jabatan'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $image = $_FILES['foto'];

    $sql;

    if ($image['error'] !== UPLOAD_ERR_OK) {
      // handle the error
      $sql = "INSERT INTO user (nama_lengkap, username, password, nip, jabatan) VALUES('$nama', '$username', '$password', '$nip', '$jabatan')";
    }else{

      $target_dir = "../uploads/";
      $random_string = uniqid();
      $target_file = $target_dir . $random_string . '.' . pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
      if (!move_uploaded_file($image["tmp_name"], $target_file)) {
        // handle the error
        die('Error moving file.');
      }
  
      $basename = basename($target_file);
      $imagePath = 'uploads/' . $basename;
  
      $sql = "INSERT INTO user (nama_lengkap, username, password, nip, jabatan, image) VALUES('$nama', '$username', '$password', '$nip', '$jabatan', '$imagePath')";
    }

  
    // Move the uploaded image to a permanent location on the server
    try{
      $result = $conn->query($sql);
      header("Location: ../daftar-guru-pegawai.php");
      exit();
    }catch(PDOException $e){
      header("Location: " . $_SERVER['HTTP_REFERER']);
      exit();
    }
  }
  

  $conn->close();
?>