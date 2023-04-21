<?php require './partial/header.php';

  

  $sql = "SELECT * FROM user";
  $result = $conn->query($sql);
  $data = $result->fetch_all();
?>

<div style="max-width: 500px; margin: 20px auto;">
    <h3>Daftar Guru dan Pegawai</h3>
    <?php if(isset($_SESSION['is-admin'])):?>
    <?php if($_SESSION['is-admin']):?>
      <div class="mb-3 d-flex justify-content-between align-items-baseline">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahGuru">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#fff" class="bi bi-plus" viewBox="0 0 16 16">
        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
      </svg>
        Tambah Guru
      </button>
    <a href="riwayat-absen.php">Riwayat Absen</a>
    </div>
    <?php endif?>
    <?php endif?>
    <div class="d-flex flex-column gap-3">
      <?php foreach($data as $row):?>
        <div class="d-flex w-100 gap-3 shadow-lg rounded-3 p-3 position-relative">
          <div class="rounded-2" style="width: 100px; height: 100px;">
            <img src="<?=$row[7]?>" alt="" style="object-fit: cover; width: 100px; height: 100px;"></div>
          <div>
            <p>Nama : <span><?=$row[3]?></span></p>
            <p>NIP : <span><?=$row[5]?></span></p>
            <p>Jabatan : <span><?=$row[6]?></span></p>
          </div>
        <?php if(isset($_SESSION['is-admin']) and $_SESSION['is-admin']):?>
          <button class="position-absolute border-0 bg-transparent p-1" data-bs-toggle="dropdown" aria-expanded="false" style="top: 10px; right: 10px;">
            <img src="src/images/three-dots.svg" alt="">
          </button>
          <ul class="dropdown-menu dropdown-menu-end">
            <li>
              <button id='editGuruBtn' class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editGuru" data-guru='{"id":"<?=$row[0]?>","username":"<?=$row[1]?>","password":"<?=$row[2]?>","nama":"<?=$row[3]?>","isAdmin":"<?=$row[4]?>","nip":"<?=$row[5]?>","jabatan":"<?=$row[6]?>","foto":"<?=$row[7]?>"}'>Edit</button>
            </li>
            <li>
              <a href="./controllers/hapusGuru.php?id=<?=$row[0]?>" class="dropdown-item">Hapus</a>
            </li>
          </ul>

        <?php endif?>
        </div>
      <?php endforeach?>
    </div>
  </div>

  <div class="modal fade" id="tambahGuru" tabindex="-1" aria-labelledby="tambahGuruLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="tambahGuruLabel">Tambah Guru</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="d-flex flex-column gap-3" action="./controllers/tambahGuru.php" method="POST" enctype="multipart/form-data">
          <div>
            <label class="form-label" for="foto">Foto</label>
            <input id='sda' type="file" accept="image/*" class="form-control" name="foto" id="foto">
          </div>
          <div>
            <label class="form-label" for="nama">Nama</label>
            <input type="text" class="form-control" name="nama" id="nama">
          </div>
          <div>
            <label class="form-label" for="nip">NIP</label>
            <input type="number" class="form-control" name="nip" id="nip">
          </div>
          <div>
            <label class="form-label" for="jabatan">Jabatan</label>
            <input type="text" class="form-control" name="jabatan" id="jabatan">
          </div>
          <div>
            <label class="form-label" for="username">Username</label>
            <input type="text" class="form-control" name="username" id="username">
          </div>
          <div>
            <label class="form-label" for="password">Password</label>
            <input type="text" class="form-control" name="password" id="password">
          </div>
          <button type="submit" name="submit" class="btn btn-success w-100">Tambah Guru</button>
        </form>
      </div>
    </div>
  </div>
  </div>

  <div class="modal fade" id="editGuru" tabindex="-1" aria-labelledby="editGuruLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="editGuruLabel">Edit Guru</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="formEditGuru" class="d-flex flex-column gap-3" action="./controllers/editGuru.php" method="POST" enctype="multipart/form-data">
            <div>
              <label class="form-label" for="foto">Foto</label>
              <input type="file" accept="image/*" class="form-control" name="foto" id="foto">
            </div>
            <div>
              <label class="form-label" for="nama">Nama</label>
              <input type="text" class="form-control" name="nama" id="nama">
            </div>
            <div>
              <label class="form-label" for="nip">NIP</label>
              <input type="number" class="form-control" name="nip" id="nip">
            </div>
            <div>
              <label class="form-label" for="jabatan">Jabatan</label>
              <input type="text" class="form-control" name="jabatan" id="jabatan">
            </div>
            <div>
              <label class="form-label" for="username">Username</label>
              <input type="text" class="form-control" name="username" id="username">
            </div>
            <div>
              <label class="form-label" for="password">Password</label>
              <input type="text" class="form-control" name="password" id="password">
            </div>
            <div class="form-check form-switch">
              <label class="form-check-label" for="flexSwitchCheckDefault">Admin</label>
              <input name='isAdmin' value="" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
            </div>
            <button type="submit" name="submit" class="btn btn-warning w-100">Edit Guru</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  
<?php require './partial/footer.php'?>