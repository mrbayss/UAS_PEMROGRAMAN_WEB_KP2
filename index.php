<?php
require './config/koneksi.php';
cek_login();
?>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>CRUD Perpustakaan</title>
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
          <a class="nav-link active" href="./index.php">Home</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="./penulis.php">Penulis</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="./penerbit.php">Penerbit</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="./buku.php">Buku</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </nav>
  <main class="container my-3">
    <div class="card">
      <h5 class="card-header">CRUD Perpustakaan</h5>
      <div class="card-body">
        <h5 class="card-title">Aplikasi pengelolaan Perpustakaan</h5>
        <p class="card-text">Aplikasi web ini dibuat untuk Ujian Akhir Semester Mata kuliah pemrograman web KP 2, Dalam aplikasi ini terdapat fitur authentikasi, dan beberapa tabel diantaranya tabel Administrator, Penulis, Penerbit Dan tabel buku.</p>
        <p class="card-text">Aplikasi ini dibuat oleh:</p>
        <p class="card-text my-0 py-0">Muhamad Bayu Yusuf</p>
        <p class="card-text my-0 py-0">220312611693</p>
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