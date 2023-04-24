<?php require './partial/header.php'?>
<?php 
  $id = $_SESSION['user-id'];
  $query = "SELECT user.nama_lengkap, user.image, user.nip, absen.tanggal, absen.status FROM absen JOIN user ON user.id = absen.userId";
  $res = $conn->query($query);
  $data = $res->fetch_all();

  require 'vendor/autoload.php';

  use PhpOffice\PhpSpreadsheet\Spreadsheet;
  use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
   
  $spreadsheet = new Spreadsheet();
  $sheet = $spreadsheet->getActiveSheet();

  $sheet->setCellValue('A1', 'No');
  $sheet->setCellValue('B1', 'NAMA LENGKAP');
  $sheet->setCellValue('C1', 'STATUS');
  $sheet->setCellValue('D1', 'TANGGAL');
  

  
  $i = 2;
  $no = 1;
  foreach ($data as $d) {
    $sheet->setCellValue('A'.$i, $no++);
    $sheet->setCellValue('B'.$i, $d[0]);
    $sheet->setCellValue('C'.$i, $d[4]);
    $sheet->setCellValue('D'.$i, $d[3]);
    $i++;
  }

  $writer = new Xlsx($spreadsheet);
  $writer->save('Data karyawan.xlsx');
?>
<div style="margin: 20px auto; max-width: 500px;">
  <h3>Riwayat Absen</h3>
  <a class="btn btn-success" href="Data karyawan.xlsx">Download</a>
  <div class="d-flex gap-3 flex-column mt-3">
  <?php foreach($data as $row):?>
    <div class="d-flex w-100 gap-3 shadow-lg rounded-3 p-3 position-relative">
      <div class="rounded-2" style="width: 100px; height: 100px;">
        <img src="<?=$row[1]?>" alt="" style="object-fit: cover; width: 100px; height: 100px;"></div>
        <div>
        <p>Nama : <span><?=$row[0]?></span></p>
        <p>NIP : <span><?=$row[2]?></span></p>
        <p>Tanggal : <span><?=$row[3]?></span></p>
        <span class="rounded-2 <?= $row[4] === 'Masuk' ? 'bg-success-subtle' : 'bg-danger-subtle'?> p-2"><?=$row[4]?></span>
      </div>
    </div>
  <?php endforeach?>
  </div>
</div>
<?php require './partial/footer.php'?>