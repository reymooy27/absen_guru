<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en" style="overflow: auto;">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="./bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="./src/style.css">
  <script src='./src/index.js'></script>
  <script src='./bootstrap/js/bootstrap.bundle.js'></script>
</head>
<body class="login-page" style="overflow: auto;">
  <div class="container mt-3 p-3 d-flex flex-column align-items-center rounded-2 shadow-lg bg-blur">
    <img src="src/images/logo.png" style="width: 100px; height: 100px;" alt="">
    <h4 class="text-center mt-3 shadow-2">Absensi SMA Negeri 1 Amanuban Selatan</h4>
    <?php if(isset($_SESSION['login-error'])):?>
      <span style="color: red;"><?= $_SESSION['login-error']; unset($_SESSION['login-error'])?></span>
    <?php endif?>
    <form style="max-width: 700px; margin: 0 auto;" class="p-3 d-flex flex-column gap-3" action="./controllers/login.php" method="POST">
      <div>
        <label for="username" class="form-label">Username</label>
        <input class="form-control" id="username" type="text" autofocus value="<?= $_SESSION['login-data']['username'] ?? null; unset($_SESSION['login-data']['username'])?>" name="username">
      </div>
      <div>
        <label class="form-label" for="password">Password</label>
        <input class="form-control" id="password" type="password" value="<?= $_SESSION['login-data']['password'] ?? null; unset($_SESSION['login-data']['password'])?>" name="password">
      </div>
      <button class="btn btn-primary w-100 p-2" type="submit" name="submit">Log In</button>
    </form>
  </div>
</body>
</html>