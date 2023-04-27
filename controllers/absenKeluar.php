<?php
  require '../db.php';
  $conn = OpenCon();

  session_start();

  $id = $_REQUEST['id'];

  $sql = "INSERT INTO absen (userId, status) VALUES('$id', 'Keluar')";

  $target_latitude = -10.0745466;
  $target_longitude = 124.2184071;
  $radius = 6371; // Earth's radius in kilometers

  if (isset($_GET['latitude']) && isset($_GET['longitude'])) {
      $user_latitude = $_GET['latitude'];
      $user_longitude = $_GET['longitude'];
      $distance = distance($user_latitude, $user_longitude, $target_latitude, $target_longitude, $radius);
      if ($distance <= 0.1) { // If the user is within 10 kilometers of the target location
          // Do something
          $result = $conn->query($sql);
          header('Location: ' . $_SERVER['HTTP_REFERER']);
          exit;
        } else {
          $_SESSION['position'] = 'Tidak bisa absen, anda diluar area sekolah';
          header('Location: ' . $_SERVER['HTTP_REFERER']);
          exit;
      }
  } else {
    $_SESSION['position'] = 'Lokasi anda tidak terbaca';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
  }

  // Function to calculate the distance between two points on Earth's surface using the Haversine formula
  function distance($lat1, $lon1, $lat2, $lon2, $radius) {
      $dLat = deg2rad($lat2 - $lat1);
      $dLon = deg2rad($lon2 - $lon1);
      $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon / 2) * sin($dLon / 2);
      $c = 2 * asin(sqrt($a));
      $distance = $radius * $c;
      return $distance;
  }
  