<?php
session_start();
require '../koneksi.php';

if (!isset($_SESSION['vendor_id'])) {
  header("Location: login_vendor.php");
  exit;
}

$vendor_id = $_SESSION['vendor_id'];
$query = mysqli_query($conn, "SELECT * FROM vendor_users WHERE id = $vendor_id");

if (!$query || mysqli_num_rows($query) == 0) {
  die("Data vendor tidak ditemukan.");
}

$data = mysqli_fetch_assoc($query);

// Proses update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama = $_POST['nama_toko'];
  $deskripsi = $_POST['deskripsi'];
  $lokasi = $_POST['lokasi'];

  $gambar = $data['gambar'];
  if ($_FILES['gambar']['name']) {
    $gambar = $_FILES['gambar']['name'];
    move_uploaded_file($_FILES['gambar']['tmp_name'], '../img/' . $gambar);
  }

  $update = "UPDATE vendor_users SET nama_toko='$nama', deskripsi='$deskripsi', lokasi='$lokasi', gambar='img/$gambar' WHERE id=$vendor_id";
  mysqli_query($conn, $update);

  // Redirect setelah update
  header("Location: dashboard_vendor.php");
  exit;
}
?>
