<?php
session_start();
require '../koneksi.php';

// Cek login
if (!isset($_SESSION['vendor_id'])) {
  header("Location: login_vendor.php");
  exit;
}

// Proses simpan produk
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama = $_POST['nama_produk'];
  $harga = $_POST['harga'];
  $kategori = $_POST['kategori'];
  $is_new = isset($_POST['is_new']) ? 1 : 0;
  $is_sale = isset($_POST['is_sale']) ? 1 : 0;
  $vendor_id = $_SESSION['vendor_id'];

  $gambar = $_FILES['gambar']['name'];
  $tmp = $_FILES['gambar']['tmp_name'];
  $upload_path = 'img/' . $gambar;
  move_uploaded_file($tmp, '../' . $upload_path);

  $query = "INSERT INTO products (nama_produk, harga, kategori, gambar, is_new, is_sale, vendor_id)
            VALUES ('$nama', '$harga', '$kategori', '$upload_path', '$is_new', '$is_sale', '$vendor_id')";

  if (mysqli_query($conn, $query)) {
    header("Location: dashboard_vendor.php");
  } else {
    $error = "Gagal tambah produk";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Tambah Produk - Dashboard Vendor</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap & Google Fonts -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Montserrat', sans-serif;
      background-color: #f8f9fc;
    }

    .sidebar {
      height: 100vh;
      background-color: #1c1f26;
      color: #fff;
      padding-top: 20px;
    }

    .sidebar a {
      color: #ccc;
      display: block;
      padding: 10px 20px;
      text-decoration: none;
    }

    .sidebar a:hover,
    .sidebar a.active {
      background-color: #D10024;
      color: #fff;
    }

    .form-container {
      padding: 30px;
    }

    h3 {
      font-weight: 600;
      color: #1c1f26;
    }

    .btn-danger {
      background-color: #D10024;
      border: none;
    }

    .btn-danger:hover {
      background-color: #a8001c;
    }
  </style>
</head>
<body>

<div class="container-fluid">
  <div class="row">
    <!-- Sidebar -->
    <div class="col-md-2 sidebar">
      <div class="text-center mb-4">
        <a href="../index.php" class="d-block">
          <img src="../img/logo.png" alt="Logo" width="100">
        </a>
      </div>
      <a href="tambah_produk.php" class="active">Tambah Produk</a>
    </div>

    <!-- Form Tambah Produk -->
    <div class="col-md-10 form-container">
      <h3>Tambah Produk Baru</h3>

      <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= $error; ?></div>
      <?php endif; ?>

      <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
          <label>Nama Produk</label>
          <input type="text" name="nama_produk" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Harga</label>
          <input type="number" name="harga" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Kategori</label>
          <input type="text" name="kategori" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Gambar</label>
          <input type="file" name="gambar" class="form-control" required>
        </div>
        <div class="form-check">
          <input type="checkbox" name="is_new" class="form-check-input" id="new">
          <label class="form-check-label" for="new">Produk Baru</label>
        </div>
        <div class="form-check mb-3">
          <input type="checkbox" name="is_sale" class="form-check-input" id="sale">
          <label class="form-check-label" for="sale">Sedang Diskon</label>
        </div>
        <button type="submit" class="btn btn-danger">Simpan</button>
        <a href="dashboard_vendor.php" class="btn btn-secondary">Kembali</a>
      </form>
    </div>
  </div>
</div>

</body>
</html>
