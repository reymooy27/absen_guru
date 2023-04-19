<?php require './partial/header.php';

  

  $sql = "SELECT * FROM user";
  $result = $conn->query($sql);
  $data = $result->fetch_all();
?>
  <h1>Daftar Guru dan Pegawai</h1>

  <div class="mt-4">
    <div class="mb-3">
      <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahGuru">Tambah Guru</button>
    </div>
    <?php foreach($data as $row):?>
      <div class="d-flex w-100 gap-3 shadow-lg rounded-3 p-3 position-relative">
        <div class="bg-secondary rounded-2" style="width: 100px; height: 100px;"></div>
        <div>
          <p>Nama : <span><?=$row[3]?></span></p>
          <p>NIP</p>
          <p>Jabatan</p>
        </div>
        <button class="position-absolute border-0 bg-transparent p-1" data-bs-toggle="dropdown" aria-expanded="false" style="top: 10px; right: 10px;">
          <img src="src/images/three-dots.svg" alt="">
        </button>
        <ul class="dropdown-menu dropdown-menu-end">
          <li>
            <button class="dropdown-item">Edit</button>
          </li>
          <li>
            <a href="" class="dropdown-item">Hapus</a>
          </li>
        </ul>
      </div>
    <?php endforeach?>
  </div>

  <div class="modal fade" id="tambahGuru" tabindex="-1" aria-labelledby="tambahGuruLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="tambahGuruLabel">Tambah Guru</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="d-flex flex-column gap-3" action="">
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
          <button type="submit" class="btn btn-success w-100">Tambah Guru</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php require './partial/footer.php'?>