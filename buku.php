<?php
require './config/koneksi.php';
cek_login();

// deklarasi variable pesan
$message = false;
$message_status = false;
if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $result = mysqli_query($conn, "DELETE FROM buku WHERE id = '$id'");
  // buat pesan untuk menandakan query berhasil atau tidak
  $message = $result ? "Data berhasil dihapus" : "Data gagal dihapus";
  $message_status = $result;
}
?>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Buku | CRUD Perpustakaan</title>
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
          <label class="h6">Data Buku</label>
          <a href="./buku-form.php" class="btn btn-sm btn-info">Tambah</a>
        </div>
      </div>
      <div class="card-body">
        <table class="table table-responsive-md table-striped table-hover">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Nama</th>
              <th scope="col">Penulis</th>
              <th scope="col">Penerbit</th>
              <th scope="col">Tahun</th>
              <th scope="col">Deskripsi</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            <?php
            $query = "SELECT
                          bu.*, pt.nama as penerbit, ps.nama as penulis
                      FROM
                          buku AS bu
                      Left JOIN penerbit AS pt
                      ON
                          bu.penerbit_id = pt.id
                      Left JOIN penulis AS ps
                      ON
                          bu.penulis_id = ps.id
            ";

            $result = mysqli_query($conn, $query);
            $counter = 0;
            while ($row = mysqli_fetch_assoc($result)) {
              $counter++;
              $row = (object)$row;

              $btn_edit =  '<a href="./buku-form.php?edit=' . $row->id . '" class="btn btn-sm btn-primary">Edit</a>';
              $btn_delete =  '<a href="./buku.php?delete=' . $row->id . '" onclick="return confirm(\'Apakah anda yakin?\')" class="btn btn-sm btn-danger">Hapus</a>';
              echo "<tr>
              <th>$counter</th>
              <td>{$row->nama}</td>
              <td>{$row->penulis}</td>
              <td>{$row->penerbit}</td>
              <td>{$row->tahun}</td>
              <td>{$row->deskripsi}</td>
              <td>$btn_edit  $btn_delete</td>
            </tr>";
            }
            ?>

          </tbody>
        </table>
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