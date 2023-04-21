<?php
  require './db.php';

  $conn = OpenCon();
  session_start();

  $user;

  if(isset($_SESSION['user-id'])){
    $id = $_SESSION['user-id'];
    $query = "SELECT * FROM user WHERE id='$id'";
    $result = $conn->query($query);
    $user = mysqli_fetch_assoc($result);
  }else{
    header('Location: login.php');
    exit;
  }
  

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="./src/style.css">
  <script src='./src/index.js'></script>
  <script src='./bootstrap/js/bootstrap.bundle.js'></script>
  <title>Document</title>
</head>
<body>
  <div class="full-width">
    <div class="sidebar">
      <div class="sidebar-wraper gap-3">
        <img src="src/images/iconmonstr-x-mark-lined-240.png" alt="close" id='close'/>
        <a href="index.php">Dashboard</a>
        <a href="absen.php">Absen</a>
        <a href="profil-sekolah.php">Profil Sekolah</a>
        <a href="daftar-guru-pegawai.php">Daftar Guru dan Pegawai</a>
        <?php if(isset($_SESSION['user-id'])):?>
          <a href="controllers/logout.php">Log Out</a>
        <?php endif?>
      </div>
    </div>
    <div class="full-width wraper">
      <div class="header">
        <div>
          <img src='src/images/iconmonstr-menu-left-lined-240.png' alt='menu' id='menu'/>
        </div>
        <?php if(isset($_SESSION['user-id'])):?>
          <div class="btn-group">
            <button class='avatar-container bg-transparent btn border-0 dropdown-toggle' data-bs-toggle="dropdown" aria-expanded="false">
              <div class='avatar'>
                <img src="<?= $user['image'] ?? 'src/images/iconmonstr-user-19-240.png'?>" style="object-fit: cover; height: 100%; width: 100%;" alt="user"/>
              </div>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a href="controllers/logout.php" class="dropdown-item" type="button">Log Out</a></li>
            </ul>
          </div>
      <?php else:?>
        <a class='btn btn-light' href="login.php">Login</a>
      <?php endif ?>
      </div>
      <div class='main bg-body'>
        