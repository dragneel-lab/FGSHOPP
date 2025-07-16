<?php
require 'koneksi.php';
session_start();

$q = isset($_GET['q']) ? mysqli_real_escape_string($conn, $_GET['q']) : '';

$hasil = [];
if ($q !== '') {
    $sql = "SELECT * FROM products 
            WHERE nama_produk LIKE '%$q%' OR kategori LIKE '%$q%'";
    $query = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($query)) {
        $hasil[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Hasil Pencarian</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/style.css">
  <style>
    .product-img img {
      max-height: 180px;
      object-fit: contain;
    }
    .product-label {
      position: absolute;
      top: 10px;
      right: 10px;
    }
    .product-label span {
      background: #D10024;
      color: white;
      padding: 3px 8px;
      font-size: 12px;
      border-radius: 4px;
      font-weight: bold;
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
              <input class="input" name="q" placeholder="Cari produk..." value="<?= htmlspecialchars($q) ?>">
              <button class="search-btn">Search</button>
            </form>
          </div>
        </div>
        <div class="col-md-3 text-end">
          <div class="header-ctn d-flex justify-content-end gap-3">
            <a href="cart.php"><i class="fa fa-shopping-cart"></i> <span>Cart</span></a>

            <div class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-user"></i> <span>Akun</span>
              </a>
              <ul class="dropdown-menu" style="min-width: 180px; padding: 10px; background-color: #fff; border: 1px solid #ddd; border-radius: 6px;">
                <?php if (isset($_SESSION['user'])): ?>
                  <li><a class="dropdown-item" href="profil.php"><i class="fa fa-user-circle"></i> Profil</a></li>
                <?php endif; ?>

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

<!-- HASIL PENCARIAN -->
<div class="container my-5">

  <div class="row">
    <?php if (count($hasil) > 0): ?>
      <?php foreach ($hasil as $produk): ?>
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
          <div class="product card h-100 position-relative">
            <div class="product-img text-center p-3">
              <img src="<?= $produk['gambar'] ?>" alt="<?= $produk['nama_produk'] ?>" class="img-fluid">
              <div class="product-label">
                <?= $produk['is_sale'] ? '<span>SALE</span>' : '' ?>
                <?= $produk['is_new'] ? '<span>NEW</span>' : '' ?>
              </div>
            </div>
            <div class="product-body p-3">
              <p class="product-category mb-1 text-muted"><?= strtoupper($produk['kategori']) ?></p>
              <h5 class="product-name"><?= htmlspecialchars($produk['nama_produk']) ?></h5>
              <h6 class="product-price text-danger mb-2">Rp<?= number_format($produk['harga'], 0, ',', '.') ?></h6>
              <div class="d-flex justify-content-between">
                <a href="preview.php?id=<?= $produk['id'] ?>" class="btn btn-outline-secondary btn-sm"><i class="fa fa-eye"></i> Lihat</a>
                <form action="add_to_cart.php" method="post" class="m-0">
                  <input type="hidden" name="product_id" value="<?= $produk['id'] ?>">
                  <input type="hidden" name="jumlah" value="1">
                  <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-shopping-cart"></i> Add</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="col-12">
        <p>Tidak ada produk ditemukan.</p>
      </div>
    <?php endif; ?>
  </div>
</div>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>
