<?php
  require '../db.php';
  $conn = OpenCon();

  $id = $_REQUEST['id'];

  $sql = "INSERT INTO absen (userId, status) VALUES('$id', 'Keluar')";

  $result = $conn->query($sql);
  header('Location: ' . $_SERVER['HTTP_REFERER']);
  exit;