<?php
  require '../db.php';
  $conn = OpenCon();

  if(isset($_POST['submit'])){
    $id = $_REQUEST['id'];
    $nama = $_POST['nama'];
    $nip = $_POST['nip'];
    $jabatan = $_POST['jabatan'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $isAdmin = isset($_POST['isAdmin']) ? 1 : 0;
    $image = $_FILES['foto'];
    
    $sql;

    if ($image['error'] > 0) {
      $sql = "UPDATE user SET nama_lengkap='$nama', nip='$nip', jabatan='$jabatan', username='$username', password='$password', isAdmin='$isAdmin'  WHERE id='$id'";
    }else{
      $result = $conn->query("SELECT user.image FROM user WHERE id='$id'");
      $data = $result->fetch_assoc();

      if(empty($data['image'])){
        $target_dir = "../uploads/";
        $random_string = uniqid();
        $target_file = $target_dir . $random_string . '.' . pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        if (!move_uploaded_file($image["tmp_name"], $target_file)) {
          // handle the error
          die('Error moving file.');
        }
        $basename = basename($target_file);
        $imagePath = 'uploads/' . $basename;
        $sql = "UPDATE user SET nama_lengkap='$nama', nip='$nip', jabatan='$jabatan', username='$username', password='$password', isAdmin='$isAdmin', image='$imagePath' WHERE id='$id'";

      }else{
        $filename = '../' . $data['image'];
        if (file_exists($filename)) {
          unlink($filename);
        }

        $target_dir = "../uploads/";
        $random_string = uniqid();
        $target_file = $target_dir . $random_string . '.' . pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        if (!move_uploaded_file($image["tmp_name"], $target_file)) {
          // handle the error
          die('Error moving file.');
        }
        $basename = basename($target_file);
        $imagePath = 'uploads/' . $basename;
        $sql = "UPDATE user SET nama_lengkap='$nama', nip='$nip', jabatan='$jabatan', username='$username', password='$password', isAdmin='$isAdmin', image='$imagePath' WHERE id='$id'";
      }

    }

    $result = $conn->query($sql);
    if($result){
      header("Location: " . $_SERVER['HTTP_REFERER']);
      exit();
    }
  
  }
  $conn->close();
?>