<?php
require './config/koneksi.php';
cek_login();

// deklarasi variable pesan
$message = false;
$message_status = false;

// cek apakah ada data yang di submit
if (isset($_POST['submit'])) {
  // ambil data dan simpan ke dalam variable
  $nama = $_POST['nama'];
  $tahun = $_POST['tahun'];
  $deskripsi = $_POST['deskripsi'];
  $penerbit = $_POST['penerbit'];
  $penulis = $_POST['penulis'];
  $query = "";


  // cek apakah datanya di tambah atau di update dengan mengecek deskripsi url
  if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $query = "UPDATE buku SET nama='$nama', deskripsi='$deskripsi', penerbit_id='$penerbit', penulis_id='$penulis', tahun='$tahun' WHERE id='$id'";
  }
  // jika tidak ada data yang di kirim di url maka data di tambah
  else {
    $query = "INSERT INTO `buku` (`id`, `penulis_id`, `penerbit_id`, `nama`, `tahun`, `deskripsi`) VALUES
    (NULL, '$penulis', '$penerbit', '$nama', '$tahun', '$deskripsi')";
  }
  $result = mysqli_query($conn, $query);

  // buat pesan untuk menandakan query berhasil atau tidak
  $message = $result ? "Data berhasil disimpan" : "Data gagal disimpan";
  $message_status = $result;
}

$id = '';
$nama = '';
$deskripsi = '';
$penerbit = '';
$penulis = '';
$tahun = '';
$title = 'Tambah';
// cek jika halaman ini untuk edit data
if (isset($_GET['edit'])) {
  $id = $_GET['edit'];
  $title = 'Ubah';

  // mengambil data dari database
  $result = mysqli_query($conn, "SELECT * FROM buku WHERE id='$id'");
  $data = mysqli_fetch_assoc($result);
  // jika data di temukan maka simpan ke dalam variable yang sudah ada.
  if ($data) {
    $nama = $data['nama'];
    $deskripsi = $data['deskripsi'];
    $tahun = $data['tahun'];
    $penerbit = $data['penerbit_id'];
    $penulis = $data['penulis_id'];
  }
}
?>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?= $title ?> Data Buku | CRUD Perpustakaan</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- bootstrap template -->

  <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="./index.php">CRUD Perpustakaan</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="./index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./penulis.php">Penulis</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./penerbit.php">Penerbit</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="./buku.php">Buku</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </nav>

  <main class="container">
    <?php if ($message) : ?>
      <div class="alert alert-<?= $message_status ? 'success' : 'danger' ?> alert-dismissible fade show mt-2" role="alert">
        <strong><?= $message_status ? 'Berhasil' : 'Gagal' ?></strong> <?= $message ?>
      </div>
    <?php endif; ?>
    <div class="card shadow mt-3">
      <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
          <label class="h6"><?= $title ?> Data Buku</label>
          <a href="./buku.php" class="btn btn-sm btn-secondary">Kembali</a>
        </div>
      </div>
      <div class="card-body">
        <form method="POST">
          <div class="form-group">
            <label for="nama">Nama Buku</label>
            <input type="text" class="form-control" name="nama" id="nama" value="<?= $nama ?>" placeholder="Nama Buku" required>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="penulis">Penulis</label>
                <select class="form-control" name="penulis" id="penulis">
                  <?php
                  $result = mysqli_query($conn, "SELECT * FROM penulis");
                  while ($row = mysqli_fetch_assoc($result)) {
                    $selected = $row['id'] == $penulis ? 'selected' : '';
                    echo "<option value='{$row['id']}' {$selected}>{$row['nama']}</option>";
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="penerbit">Penerbit</label>
                <select class="form-control" name="penerbit" id="penerbit">
                  <?php
                  $result = mysqli_query($conn, "SELECT * FROM penerbit");
                  while ($row = mysqli_fetch_assoc($result)) {
                    $selected = $row['id'] == $penerbit ? 'selected' : '';
                    echo "<option value='{$row['id']}' {$selected}>{$row['nama']}</option>";
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="tahun">Tahun Terbit</label>
            <input type="number" class="form-control" name="tahun" id="tahun" value="<?= $tahun ?>" placeholder="Tahun Terbit" required>
          </div>
          <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3"><?= $deskripsi ?></textarea>
          </div>
          <button type="submit" name="submit" class="btn btn-primary" title="Simpan data">Simpan</button>
        </form>
      </div>
    </div>
  </main>

  <div class="footer bg-dark text-light py-3 mt-3">
    <div class="container">
      <p class="m-0">Copyright &copy 2024 | Muhamad Bayu Yusuf (220312611693)</p>
    </div>
  </div>

  <script src="./bootstrap/jquery-3.6.0.js"></script>
  <script src="./bootstrap/js/bootstrap.min.js"></script>
</body>

</html>