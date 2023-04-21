<?php require './partial/header.php'?>
<?php 
  $id = $_SESSION['user-id'];
  $query = "SELECT user.nama_lengkap, absen.tanggal, absen.status FROM absen JOIN user ON user.id = absen.userId";
  $res = $conn->query($query);
  $data = $res->fetch_all();

  echo json_encode($data);
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
    $sheet->setCellValue('C'.$i, $d[2]);
    $sheet->setCellValue('D'.$i, $d[1]);
    $i++;
  }

  $writer = new Xlsx($spreadsheet);
  $writer->save('Data karyawan.xlsx');
?>
<div style="margin: 20px auto; max-width: 500px;">
  <h3>Riwayat Absen</h3>
  <a href="Data karyawan.xlsx">Download</a>
</div>
<?php require './partial/footer.php'?>