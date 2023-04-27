<?php require './partial/header.php'?>
<?php
  $id = $_SESSION['user-id'];
  $queryAbsenMasuk = "SELECT * FROM absen WHERE userId='$id' AND status='Masuk' AND tanggal >= DATE(NOW()) AND tanggal < DATE_ADD(DATE(NOW()), INTERVAL 1 DAY)";
  $resAbsenMasuk = $conn->query($queryAbsenMasuk);
  
  $queryAbsenKeluar = "SELECT * FROM absen WHERE userId='$id' AND status='Keluar' AND tanggal >= DATE(NOW()) AND tanggal < DATE_ADD(DATE(NOW()), INTERVAL 1 DAY)";
  $resAbsenKeluar = $conn->query($queryAbsenKeluar);

?>
<div style="max-width: 500px; margin: 20px auto;">
  <div class="d-flex justify-content-between align-items-baseline">
    <h3>Absen</h3>
    <!-- <a href="riwayat-absen.php">Riwayat Absen</a> -->
  </div>
    <?php if(isset($_SESSION['position'])):?>
      <div class="alert alert-danger" role="alert">
        <?=$_SESSION['position']; unset($_SESSION['position'])?>
      </div>
    <?php endif?>
  <div class="h-100 d-flex flex-column gap-1 mt-5">
    <a id="absenMasuk" class="btn btn-success p-3 text-center w-100 mb-3 <?php if(mysqli_num_rows($resAbsenMasuk) > 0) echo 'disabled'?>" href="./controllers/absenMasuk.php?id=<?= $_SESSION['user-id']?>">Masuk</a>
    <a id="absenKeluar" class="btn btn-danger p-3 text-center w-100 <?php if(mysqli_num_rows($resAbsenMasuk) < 1 or mysqli_num_rows($resAbsenKeluar) > 0) echo 'disabled'?>" href="./controllers/absenKeluar.php?id=<?= $_SESSION['user-id']?>">Keluar</a>
  </div>
</div>
<script>
  const absenMasuk = document.getElementById('absenMasuk')
  const absenKeluar = document.getElementById('absenKeluar')

  navigator.geolocation.getCurrentPosition(function(position) {
    console.log(position)
    absenMasuk.href = `./controllers/absenMasuk.php?id=<?= $_SESSION['user-id']?>&latitude=${position.coords.latitude}&longitude=${position.coords.longitude}`
    absenKeluar.href = `./controllers/absenKeluar.php?id=<?= $_SESSION['user-id']?>&latitude=${position.coords.latitude}&longitude=${position.coords.longitude}`
});
</script>
<?php require './partial/footer.php'?>