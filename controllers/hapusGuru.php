<?php
  require '../db.php';
  $conn = OpenCon();
  session_start();

    $id = $_REQUEST['id'];
    $sql1 = "SELECT image FROM user WHERE id = $id";
    $result1 = $conn->query($sql1);
    $row = $result1->fetch_assoc();
    $filename = '../' . $row['image'];

    // Delete the file from the server
    if (file_exists($filename)) {
        unlink($filename);
    }

    $sql = "DELETE FROM user WHERE id='$id'";
    try {
      $result = $conn->query($sql);
      header("Location: ../daftar-guru-pegawai.php");
      exit();
    } catch (\Throwable $th) {
      $_SESSION['error'] = 'Tidak bisa menghapus siswa';
      header("Location: " . $_SERVER['HTTP_REFERER']);
      exit();
    }

    $conn->close();
    
    
?>