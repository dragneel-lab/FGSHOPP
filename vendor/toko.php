<?php
include '../koneksi.php';
session_start();

// Ambil semua data vendor
$vendors = mysqli_query($conn, "SELECT * FROM vendor_users ORDER BY created_at DESC");

// Hitung total belanja jika ada
$total = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $total += $item['harga'] * $item['jumlah'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>FGSHOP - Toko Vendor</title>
  <link rel="stylesheet" href="../css/bootstrap.min.css"/>
  <link rel="stylesheet" href="../css/font-awesome.min.css"/>
  <link rel="stylesheet" href="../css/style.css"/>
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

  <style>
    body {
      background-color: #f9f9f9;
      font-family: 'Montserrat', sans-serif;
    }
    .vendor-card {
      background: #fff;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
      margin-bottom: 30px;
      text-align: center;
      height: 100%;
    }
    .vendor-card img {
      max-width: 100px;
      max-height: 100px;
      object-fit: cover;
      border-radius: 50%;
      margin-bottom: 15px;
    }
    .vendor-title {
      font-size: 20px;
      font-weight: bold;
    }
    .vendor-location {
      font-size: 14px;
      color: #777;
    }
    .vendor-desc {
      font-size: 14px;
      color: #555;
      margin: 10px 0;
      min-height: 60px;
    }
    .btn-vendor {
      background-color: #D10024;
      border: none;
      color: #fff;
      padding: 8px 18px;
      border-radius: 6px;
      text-decoration: none;
      font-weight: 500;
    }
    .btn-vendor:hover {
      background-color: #a8001c;
    }
  </style>
</head>
<body>

<!-- HEADER -->
<header>
  <div id="header">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-3">
          <div class="header-logo">
            <a href="../index.php" class="logo">
              <img src="../img/logo.png" alt="">
            </a>
          </div>
        </div>

        <div class="col-md-6">
          <div class="header-search">
            <form>
              <input class="input" placeholder="Search here">
              <button class="search-btn">Search</button>
            </form>
          </div>
        </div>

        <div class="col-md-3 clearfix">
          <div class="header-ctn">

            <!-- Cart -->
            <div class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                <i class="fa fa-shopping-cart"></i>
                <span>Your Cart</span>
              </a>
              <div class="cart-dropdown">
                <div class="cart-list">
                  <?php
                  if (!empty($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as $index => $item) {
                      echo '
                      <div class="product-widget">
                        <div class="product-img" style="width:60px;height:60px;overflow:hidden">
                          <img src="' . $item['gambar'] . '" style="width:100%;height:auto;" alt="">
                        </div>
                        <div class="product-body">
                          <h3 class="product-name">' . $item['nama'] . '</h3>
                          <h4 class="product-price"><span class="qty">' . $item['jumlah'] . 'x</span> Rp' . number_format($item['harga'], 0, ',', '.') . '</h4>
                        </div>
                      </div>';
                    }
                  } else {
                    echo '<p class="text-center">Keranjang kosong</p>';
                  }
                  ?>
                </div>
                <div class="cart-summary">
                  <small><?= count($_SESSION['cart'] ?? []); ?> item(s) selected</small>
                  <h5>SUBTOTAL: Rp<?= number_format($total, 0, ',', '.'); ?></h5>
                </div>
                <div class="cart-btns">
                  <a href="../cart.php">View Cart</a>
                  <a href="../checkout.php">Checkout <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
            </div>

            <!-- Account -->
            <div class="dropdown">
              <?php if (isset($_SESSION['user']) || isset($_SESSION['vendor_login'])): ?>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <i class="fa fa-user"></i> <span>Akun</span>
                </a>
                <ul class="dropdown-menu" style="min-width: 180px; padding: 10px;">
                  <?php if (isset($_SESSION['user'])): ?>
                    <li><a href="../profil.php"><i class="fa fa-user-circle"></i> Profil</a></li>
                  <?php endif; ?>
                  <?php if (isset($_SESSION['vendor_login'])): ?>
                    <li><a href="dashboard_vendor.php"><i class="fa fa-store"></i> Toko Saya</a></li>
                  <?php endif; ?>
                  <li><a class="text-danger" href="../logout.php"><i class="fa fa-sign-out"></i> Logout</a></li>
                </ul>
              <?php else: ?>
                <a href="../register/register.php"><i class="fa fa-user"></i> <span>Akun</span></a>
              <?php endif; ?>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</header>

<!-- MAIN VENDOR SECTION -->
<div class="container">
  <h2 class="text-center my-4">Toko Para Vendor</h2>
  <div class="row">
    <?php while($vendor = mysqli_fetch_assoc($vendors)): ?>
      <div class="col-md-4 col-sm-6">
        <div class="vendor-card">
          <img src="../<?= htmlspecialchars($vendor['gambar']) ?: 'img/default.png'; ?>" alt="Logo Toko">
          <div class="vendor-title"><?= htmlspecialchars($vendor['nama_toko']); ?></div>
          <div class="vendor-location">📍 <?= htmlspecialchars($vendor['lokasi']); ?></div>
          <div class="vendor-desc"><?= nl2br(htmlspecialchars($vendor['deskripsi'])); ?></div>
          <a href="produk_saya.php?vendor_id=<?= $vendor['id']; ?>" class="btn-vendor">Lihat Produk</a>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
</div>

<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>
