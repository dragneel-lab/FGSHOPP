<?php
include 'koneksi.php';
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: register/register.php");
    exit;
}
$name = $_SESSION['user'];

// Hapus produk dari keranjang jika diklik
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_index'])) {
  $index = (int)$_POST['remove_index'];
  if (isset($_SESSION['cart'][$index])) {
    unset($_SESSION['cart'][$index]);
    $_SESSION['cart'] = array_values($_SESSION['cart']);
  }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Profil Pengguna</title>
  <link rel="stylesheet" href="css/bootstrap.min.css"/>
  <link rel="stylesheet" href="css/font-awesome.min.css"/>
  <link rel="stylesheet" href="css/style.css"/>
  <style>
    body {
      font-family: 'Montserrat', sans-serif;
      background: linear-gradient(135deg, #f0f0f0, #fefefe);
    }

    .profile-container {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 80vh;
    }

    .profile-box {
      width: 380px;
      background: rgba(255, 255, 255, 0.9);
      border-radius: 16px;
      padding: 40px 30px;
      box-shadow: 0 8px 30px rgba(0,0,0,0.1);
      text-align: center;
      border: 1px solid #e0e0e0;
    }

    .profile-box .fa-user-circle {
      font-size: 90px;
      color: #D10024;
      margin-bottom: 15px;
    }

    .profile-box h3 {
      font-size: 24px;
      font-weight: 700;
      color: #222;
      margin-bottom: 25px;
    }

    .status-item {
      display: inline-block;
      background: #D10024;
      color: white;
      font-weight: bold;
      padding: 15px 25px;
      border-radius: 12px;
      transition: all 0.3s ease;
      margin-bottom: 30px;
      text-transform: uppercase;
      letter-spacing: 1px;
      text-decoration: none;
    }

    .status-item:hover {
      background: #a7001d;
      transform: translateY(-2px);
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
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
            <a href="index.php" class="logo">
              <img src="img/logo.png" alt="FGSHOP Logo">
            </a>
          </div>
        </div>

        <div class="col-md-6">
          <div class="header-search">
            <form action="search.php" method="get">
              <input class="input" name="q" placeholder="Cari produk...">
              <button class="search-btn">Search</button>
            </form>
          </div>
        </div>

        <div class="col-md-3 text-end">
          <div class="header-ctn d-flex justify-content-end gap-3">

            <!-- CART DROPDOWN -->
            <div class="dropdown me-3">
              <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-shopping-cart"></i> <span>Your Cart</span>
              </a>
              <div class="cart-dropdown">
                <div class="cart-list">
                  <?php
                  if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as $index => $item) {
                      echo '
                      <div class="product-widget d-flex justify-content-between align-items-center mb-2">
                        <div class="d-flex align-items-center">
                          <div class="product-img" style="width: 60px; height: 60px; overflow: hidden;">
                            <img src="' . $item['gambar'] . '" alt="" style="width: 100%; height: auto;">
                          </div>
                          <div class="product-body ms-2">
                            <h3 class="product-name mb-1" style="font-size: 14px;">' . $item['nama'] . '</h3>
                            <h4 class="product-price mb-0" style="font-size: 13px;">
                              <span class="qty">' . $item['jumlah'] . 'x</span> Rp' . number_format($item['harga'], 0, ',', '.') . '
                            </h4>
                          </div>
                        </div>
                        <form method="post" style="margin: 0;">
                          <input type="hidden" name="remove_index" value="' . $index . '">
                          <button type="submit" class="btn btn-link text-danger p-0 ms-2" title="Hapus">
                            <i class="fa fa-times"></i>
                          </button>
                        </form>
                      </div>';
                    }
                  } else {
                    echo '<p class="text-center">Keranjang kosong</p>';
                  }
                  ?>
                </div>

                <div class="cart-summary">
                  <small>
                    <?php
                    $total = 0;
                    if (isset($_SESSION['cart'])) {
                      foreach ($_SESSION['cart'] as $item) {
                        $total += $item['harga'] * $item['jumlah'];
                      }
                      echo count($_SESSION['cart']) . ' item(s) selected';
                    } else {
                      echo '0 item';
                    }
                    ?>
                  </small>
                  <h5>SUBTOTAL: Rp<?= number_format($total, 0, ',', '.'); ?></h5>
                </div>

                <div class="d-flex mt-3">
                  <a href="cart.php" class="btn btn-dark flex-fill text-uppercase fw-semibold">View Cart</a>
                  <a href="checkout.php" class="btn btn-danger flex-fill text-uppercase fw-semibold">
                    Checkout <i class="fa fa-arrow-right ms-1"></i>
                  </a>
                </div>
              </div>
            </div>

            <!-- AKUN -->
            <div class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-user"></i> <span>Akun</span>
              </a>
              <ul class="dropdown-menu" style="min-width: 180px; padding: 10px; background-color: #fff; border: 1px solid #ddd; border-radius: 6px;">
                <li><a class="dropdown-item" href="profil.php"><i class="fa fa-user-circle"></i> Profil</a></li>
                <?php if (isset($_SESSION['vendor_login'])): ?>
                  <li><a class="dropdown-item" href="vendor/dashboard_vendor.php"><i class="fa fa-store"></i> Toko Saya</a></li>
                <?php endif; ?>
                <li><a class="dropdown-item text-danger" href="logout.php"><i class="fa fa-sign-out"></i> Logout</a></li>
              </ul>
            </div>

          </div>
        </div>

      </div>
    </div>
  </div>
</header>

<!-- PROFIL -->
<div class="container profile-container">
  <div class="profile-box">
    <i class="fa fa-user-circle"></i>
    <h3><?= htmlspecialchars($name); ?></h3>
    <a href="rincian_pesanan.php" class="status-item"><i class="fa fa-clipboard-list"></i> Informasi Pesanan</a>
  </div>
</div>

<!-- JS -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
