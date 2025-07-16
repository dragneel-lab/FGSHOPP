<?php
require '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama_toko  = $_POST['nama_toko'];
  $email      = $_POST['email'];
  $password   = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $lokasi     = $_POST['lokasi'];
  $deskripsi  = $_POST['deskripsi'];

  // Proses upload gambar
  $gambar = null;
  if (!empty($_FILES['gambar']['name'])) {
    $gambar = 'img/' . time() . '_' . $_FILES['gambar']['name'];
    move_uploaded_file($_FILES['gambar']['tmp_name'], '../' . $gambar);
  }

  // Cek apakah email sudah digunakan
  $cek = mysqli_query($conn, "SELECT * FROM vendor_users WHERE email = '$email'");
  if (mysqli_num_rows($cek) > 0) {
    $error = "Email sudah digunakan.";
  } else {
    $insert = "INSERT INTO vendor_users (nama_toko, email, password, lokasi, deskripsi, gambar)
               VALUES ('$nama_toko', '$email', '$password', '$lokasi', '$deskripsi', '$gambar')";
    if (mysqli_query($conn, $insert)) {
      header("Location: login_vendor.php");
      exit;
    } else {
      $error = "Pendaftaran gagal. Silakan coba lagi.";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>FGSHOP | Daftar Vendor</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSS -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
  <link rel="stylesheet" href="../css/bootstrap.min.css"/>
  <link rel="stylesheet" href="../css/font-awesome.min.css"/>
  <link rel="stylesheet" href="../css/style.css"/>

  <style>
    body {
      background: #f5f5f5;
      font-family: 'Montserrat', sans-serif;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .register-card {
      background: #fff;
      padding: 40px 30px;
      border-radius: 12px;
      max-width: 500px;
      width: 100%;
      box-shadow: 0 10px 40px rgba(0,0,0,0.1);
    }

    .register-card h2 {
      text-align: center;
      font-weight: 700;
      margin-bottom: 30px;
      color: #D10024;
    }

    .form-group label {
      font-weight: 500;
      margin-top: 10px;
    }

    .btn-daftar {
      background-color: #D10024;
      color: #fff;
      font-weight: 500;
      border-radius: 30px;
      padding: 10px;
      width: 100%;
      margin-top: 20px;
      transition: 0.3s;
    }

    .btn-daftar:hover {
      background-color: #a8001c;
    }

    .alert {
      font-size: 14px;
    }
  </style>
</head>
<body>

<div class="register-card">
  <h2>Daftar Vendor</h2>

  <?php if (isset($error)): ?>
    <div class="alert alert-danger"><?= $error; ?></div>
  <?php endif; ?>

  <form method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <label>Nama Toko</label>
      <input type="text" name="nama_toko" class="form-control" required>
    </div>
    <div class="form-group">
      <label>Alamat Email</label>
      <input type="email" name="email" class="form-control" required>
    </div>
    <div class="form-group">
      <label>Kata Sandi</label>
      <input type="password" name="password" class="form-control" required minlength="6">
    </div>
    <div class="form-group">
      <label>Lokasi</label>
      <input type="text" name="lokasi" class="form-control" required>
    </div>
    <div class="form-group">
      <label>Deskripsi Toko</label>
      <textarea name="deskripsi" class="form-control" rows="4" required></textarea>
    </div>
    <div class="form-group">
      <label>Logo/Gambar Toko</label>
      <input type="file" name="gambar" class="form-control">
    </div>
    <button type="submit" class="btn btn-daftar">Daftar Sekarang</button>
  </form>
</div>

</body>
</html>
