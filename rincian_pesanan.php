<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "fgshop");

// Redirect ke login jika belum login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$order_query = mysqli_query($conn, "SELECT * FROM orders WHERE user_id = $user_id ORDER BY created_at DESC LIMIT 1");
$order = mysqli_fetch_assoc($order_query);

if (!$order) {
    echo "<div class='container mt-5'><div class='alert alert-warning text-center'>Belum ada pesanan ditemukan.</div></div>";
    exit;
}

$order_id = $order['id'];
$items_query = mysqli_query($conn, "SELECT * FROM order_items WHERE order_id = $order_id");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Rincian Pesanan - FGSHOP</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
  <link rel="stylesheet" href="css/bootstrap.min.css"/>
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/style.css"/>
  <style>
    body {
      font-family: 'Montserrat', sans-serif;
      background-color: #f4f4f4;
    }

    .rincian-container {
      margin-top: 80px;
      background: #fff;
      padding: 40px;
      border-radius: 16px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .rincian-container h2 {
      color: #D10024;
      font-weight: 700;
      margin-bottom: 30px;
      text-align: center;
    }

    .rincian-container .info-pemesan p {
      margin: 5px 0;
    }

    .table th, .table td {
      vertical-align: middle;
    }

    .product-img {
      width: 70px;
      height: auto;
      object-fit: cover;
      border-radius: 10px;
    }

    .status-badge {
      padding: 6px 12px;
      border-radius: 20px;
      font-size: 14px;
      color: #fff;
      background-color: #2ecc71;
      display: inline-block;
    }

    .btn-fg {
      border-radius: 25px;
      padding: 10px 25px;
      font-weight: 600;
    }

    .btn-fg-primary {
      background-color: #D10024;
      color: white;
    }

    .btn-fg-primary:hover {
      background-color: #a8001c;
    }

    .btn-fg-secondary {
      background-color: #2c3e50;
      color: white;
    }

    .btn-fg-secondary:hover {
      background-color: #1a252f;
    }
  </style>
</head>
<body>

<div class="container rincian-container">
  <h2>Rincian Pesanan Anda</h2>

  <div class="info-pemesan mb-4">
    <h5><i class="fa fa-user-circle-o"></i> Informasi Pemesan</h5>
    <p><strong>Nama:</strong> <?= htmlspecialchars($order['first_name'] . ' ' . $order['last_name']) ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($order['email']) ?></p>
    <p><strong>Alamat:</strong> <?= htmlspecialchars($order['address'] . ', ' . $order['city'] . ', ' . $order['country'] . ' ' . $order['zip_code']) ?></p>
    <p><strong>Telepon:</strong> <?= htmlspecialchars($order['tel']) ?></p>
    <p><strong>Tanggal Pesan:</strong> <?= htmlspecialchars($order['created_at']) ?></p>
    <p><strong>Status Pengiriman:</strong> <span class="status-badge">Dikirim</span></p>
  </div>

  <h5><i class="fa fa-list-alt"></i> Daftar Produk</h5>
  <div class="table-responsive">
    <table class="table table-striped table-bordered mt-3">
      <thead class="thead-dark">
        <tr>
          <th>Gambar</th>
          <th>Nama Produk</th>
          <th>Jumlah</th>
          <th>Harga</th>
          <th>Subtotal</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $total = 0;
        while ($item = mysqli_fetch_assoc($items_query)) {
          $name = $item['product_name'];
          $quantity = $item['quantity'];
          $price = $item['price'];
          $subtotal = $quantity * $price;
          $total += $subtotal;

          // Ambil gambar dari tabel produk
          $img_query = mysqli_query($conn, "SELECT gambar FROM products WHERE nama_produk = '".mysqli_real_escape_string($conn, $name)."' LIMIT 1");
          $img_data = mysqli_fetch_assoc($img_query);
          $img_path = $img_data ? $img_data['gambar'] : 'img/default.png';
        ?>
        <tr>
          <td><img src="<?= htmlspecialchars($img_path) ?>" class="product-img"></td>
          <td><?= htmlspecialchars($name) ?></td>
          <td><?= $quantity ?></td>
          <td>Rp<?= number_format($price, 0, ',', '.') ?></td>
          <td>Rp<?= number_format($subtotal, 0, ',', '.') ?></td>
        </tr>
        <?php } ?>
        <tr>
          <td colspan="4" class="text-right"><strong>Total</strong></td>
          <td><strong>Rp<?= number_format($total, 0, ',', '.') ?></strong></td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="text-center mt-4">
   
    <a href="index.php" class="btn btn-fg btn-fg-primary"><i class="fa fa-home"></i> Kembali ke Beranda</a>
  </div>
</div>

<script src="js/bootstrap.min.js"></script>
</body>
</html>
