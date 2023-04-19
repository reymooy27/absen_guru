<?php require './partial/header.php'?>
    
  <h3 class="">Selamat Datang <?= $user['nama_lengkap']?></h4>

  <div class="w-100" style="max-width: 500px; margin: 20px auto;">
    <div class="d-flex w-100 gap-2">
      <a style="height: 100px;" class="bg-success w-50 shadow rounded-2 p-3 d-flex justify-content-center align-items-center text-center" href="absen.php">Absen</a>
      <a style="height: 100px;" class="bg-warning w-50 shadow rounded-2 p-3 d-flex justify-content-center align-items-center text-center" href="profil-sekolah.php">Profil Sekolah</a>
    </div>
    <div class="d-flex w-100 gap-2 mt-2">
      <a style="height: 100px;" class="bg-primary w-50 shadow rounded-2 p-3 d-flex justify-content-center align-items-center text-center" href="daftar-guru-pegawai.php">Daftar Guru dan Pegawai</a>
    </div>
  </div>

<?php require './partial/footer.php'?>