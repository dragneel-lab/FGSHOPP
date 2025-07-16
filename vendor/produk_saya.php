<?php
require '../koneksi.php';
session_start();

// Ambil ID vendor dari URL
$vendor_id = isset($_GET['vendor_id']) ? (int)$_GET['vendor_id'] : 0;

// Ambil data vendor
$vendor = mysqli_query($conn, "SELECT * FROM vendor_users WHERE id = $vendor_id");
$data_vendor = mysqli_fetch_assoc($vendor);

// Jika vendor tidak ditemukan
if (!$data_vendor) {
  echo "Toko tidak ditemukan.";
  exit;
}

// Ambil semua produk milik vendor ini
$produk = mysqli_query($conn, "SELECT * FROM products WHERE vendor_id = $vendor_id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Produk dari <?= htmlspecialchars($data_vendor['nama_toko']); ?></title>
  <link rel="stylesheet" href="../css/bootstrap.min.css"/>
  <link rel="stylesheet" href="../css/font-awesome.min.css"/>
  <link rel="stylesheet" href="../css/style.css"/>
</head>
<body>

<!-- HEADER SEDERHANA -->
<header>
  <div id="header">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-3">
          <div class="header-logo">
            <a href="../index.php" class="logo">
              <img src="../img/logo.png" alt="Logo">
            </a>
          </div>
        </div>
        <div class="col-md-6">
          <div class="header-search">
            <form action="../search.php" method="get">
              <input class="input" name="q" placeholder="Cari produk...">
              <button class="search-btn">Search</button>
            </form>
          </div>
        </div>
        <div class="col-md-3 text-end">
          <a href="../cart.php"><i class="fa fa-shopping-cart"></i> <span>Cart</span></a>
          <a href="../register/register.php"><i class="fa fa-user"></i> <span>Akun</span></a>
        </div>
      </div>
    </div>
  </div>
</header>

<!-- DAFTAR PRODUK -->
<div class="container my-5">
  <h2 class="text-center mb-4">Produk dari Toko: <?= htmlspecialchars($data_vendor['nama_toko']); ?></h2>

  <?php if (mysqli_num_rows($produk) > 0): ?>
    <div class="row">
      <?php while($row = mysqli_fetch_assoc($produk)): ?>
      <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
        <div class="product card h-100">
          <div class="product-img text-center p-3">
            <img src="../<?= $row['gambar']; ?>" alt="<?= $row['nama_produk']; ?>" class="img-fluid" style="max-height: 180px;">
            <div class="product-label">
              <?= $row['is_sale'] ? '<span class="sale">-30%</span>' : ''; ?>
              <?= $row['is_new'] ? '<span class="new">NEW</span>' : ''; ?>
            </div>
          </div>
          <div class="product-body p-3">
            <p class="product-category mb-1 text-muted"><?= strtoupper($row['kategori']); ?></p>
            <h5 class="product-name"><?= htmlspecialchars($row['nama_produk']); ?></h5>
            <h6 class="product-price text-danger mb-2">Rp<?= number_format($row['harga'], 0, ',', '.'); ?></h6>
            <div class="product-rating mb-2">
              <i class="fa fa-star"></i><i class="fa fa-star"></i>
              <i class="fa fa-star"></i><i class="fa fa-star"></i>
              <i class="fa fa-star-o"></i>
            </div>
            <div class="d-flex justify-content-between mb-2">
              <a href="../preview.php?id=<?= $row['id']; ?>" class="btn btn-outline-secondary btn-sm"><i class="fa fa-eye"></i> Detail</a>
              <form action="../add_to_cart.php" method="post" class="m-0">
                <input type="hidden" name="product_id" value="<?= $row['id']; ?>">
                <input type="hidden" name="jumlah" value="1">
                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-shopping-cart"></i> Add to cart</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <?php endwhile; ?>
    </div>
  <?php else: ?>
    <p class="text-center">Toko ini belum memiliki produk.</p>
  <?php endif; ?>
</div>

</body>
</html>
