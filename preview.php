<?php
include 'koneksi.php';

if (!isset($_GET['id'])) {
    echo "Produk tidak ditemukan.";
    exit;
}

$id = (int)$_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM products WHERE id = $id");
$product = mysqli_fetch_assoc($query);

if (!$product) {
    echo "Produk tidak tersedia.";
    exit;
}

// Produk relevan berdasarkan kategori
$relatedQuery = mysqli_query($conn, "SELECT * FROM products WHERE kategori = '{$product['kategori']}' AND id != {$product['id']} LIMIT 4");
$relatedProducts = [];
while ($row = mysqli_fetch_assoc($relatedQuery)) {
    $relatedProducts[] = $row;
}

session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_index'])) {
    $index = (int)$_POST['remove_index'];
    if (isset($_SESSION['cart'][$index])) {
        unset($_SESSION['cart'][$index]);
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FGSHOP - Preview Produk</title>
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
  <link rel="stylesheet" href="css/bootstrap.min.css"/>
  <link rel="stylesheet" href="css/slick.css"/>
  <link rel="stylesheet" href="css/slick-theme.css"/>
  <link rel="stylesheet" href="css/nouislider.min.css"/>
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/style.css"/>
  <style>
    body {
      font-family: 'Montserrat', sans-serif;
      background-color: #f7f7f7;
    }
    .product-preview {
      background: #fff;
      padding: 40px;
      border-radius: 16px;
      box-shadow: 0 6px 30px rgba(0,0,0,0.1);
      margin-top: 80px;
      transition: all 0.3s ease-in-out;
    }
    .product-preview:hover {
      transform: scale(1.01);
      box-shadow: 0 12px 35px rgba(0,0,0,0.12);
    }
    .product-title {
      font-weight: 700;
      font-size: 32px;
      margin-bottom: 15px;
      transition: all 0.2s ease-in-out;
    }
    .product-title:hover {
      color: #111;
    }
    .product-category {
      font-size: 14px;
      color: #6c757d;
      text-transform: uppercase;
      margin-bottom: 10px;
      transition: all 0.2s ease-in-out;
    }
    .product-price {
      font-size: 28px;
      color: #D10024;
      font-weight: bold;
      margin-bottom: 20px;
      transition: all 0.2s ease-in-out;
    }
    .product-description {
      font-size: 16px;
      color: #444;
      margin-bottom: 20px;
    }
    .form-control:focus {
      box-shadow: none;
      border-color: #D10024;
    }
    .btn-danger {
      background-color: #D10024;
      border: none;
      transition: background-color 0.3s ease;
    }
    .btn-danger:hover {
      background-color: #a8001c;
    }
    .btn-outline-secondary {
      transition: all 0.3s ease-in-out;
    }
    .btn-outline-secondary:hover {
      background-color: #f7f7f7;
      color: #D10024;
      border-color: #D10024;
    }
    .back-btn {
      margin-top: 40px;
    }
    img.img-fluid {
      transition: transform 0.4s ease;
    }
    img.img-fluid:hover {
      transform: scale(1.05);
    }
    .card {
      background-color: #1a1a1a;
      color: #fff;
      border-radius: 12px;
      transition: transform 0.3s ease;
    }
    .card:hover {
      transform: scale(1.02);
      box-shadow: 0 6px 20px rgba(209, 0, 36, 0.2);
    }
    .card .btn-danger {
      background-color: #D10024;
      border: none;
    }
    .card .btn-danger:hover {
      background-color: #a8001c;
    }
  </style>
</head>

<body>
<header>
   
    <div id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="header-logo">
              <a href="#" class="logo">
                <img src="./img/logo.png" alt="">
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
				

              <div class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                  <i class="fa fa-shopping-cart"></i>
                  <span>Your Cart</span>
                </a>
                <div class="cart-dropdown">
                  <div class="cart-list">
                    <?php
                    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                      foreach ($_SESSION['cart'] as $index => $item) {
                        if (is_array($item)) {
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
			  
<div>
  <?php if (isset($_SESSION['user'])): ?>
    <a href="profil.php"><i class="fa fa-user"></i><span>Akun</span></a>
  <?php else: ?>
    <a href="logout.php"><i class="fa fa-user"></i><span>Akun</span></a>
  <?php endif; ?>
</div>

			 
            </div>
			
          </div>
		  
		  
        </div>

        

      </div>
	  
    </div>
	
  </header>
<div class="container">
  <div class="product-preview row align-items-center">
    <div class="col-md-6 text-center mb-4 mb-md-0">
      <img src="<?= $product['gambar']; ?>" alt="<?= htmlspecialchars($product['nama_produk']); ?>" class="img-fluid rounded shadow-sm w-100" style="max-height: 400px; object-fit: contain;">
    </div>
    <div class="col-md-6 px-md-4 text-break">
      <h1 class="product-title"><?= htmlspecialchars($product['nama_produk']); ?></h1>
      <p class="product-category">Kategori: <?= strtoupper($product['kategori']); ?></p>
      <p class="product-price">Rp<?= number_format($product['harga'], 0, ',', '.'); ?></p>
      <p class="product-description"><?= nl2br(htmlspecialchars($product['deskripsi'] ?? 'Tidak ada deskripsi.')); ?></p>
      <form action="add_to_cart.php" method="post" class="mt-4">
        <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
        <input type="hidden" name="redirect" value="preview.php?id=<?= $product['id']; ?>">
        <div class="form-group w-100">
          <label for="jumlah">Jumlah:</label>
          <input type="number" name="jumlah" id="jumlah" value="1" min="1" class="form-control w-100" required>
        </div>
        <button type="submit" class="btn btn-danger mt-3 w-100">
          <i class="fa fa-shopping-cart"></i> Tambah ke Keranjang
        </button>
      </form>
      <div class="back-btn">
        <a href="index.php" class="btn btn-outline-secondary mt-4">
          <i class="fa fa-arrow-left"></i> Kembali ke Beranda
        </a>
      </div>
    </div>
  </div>

 <!-- Produk Terkait -->
<div class="section">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="section-title">
          <h3 class="title">Produk Terkait</h3>
        </div>
      </div>

      <div class="col-md-12">
        <div class="row">
          <div class="products-tabs">
            <div id="tab1" class="tab-pane active">
              <div class="products-slick" data-nav="#slick-nav-related">
                <?php
                $kategori = $product['kategori'];
                $id_saat_ini = $product['id'];
                $terkait = mysqli_query($conn, "SELECT * FROM products WHERE kategori = '$kategori' AND id != $id_saat_ini LIMIT 8");
                while($row = mysqli_fetch_assoc($terkait)) {
                ?>
                <div class="product">
                  <div class="product-img">
                    <img src="<?= $row['gambar']; ?>" alt="">
                    <div class="product-label">
                      <?= $row['is_sale'] ? '<span class="sale">-30%</span>' : ''; ?>
                      <?= $row['is_new'] ? '<span class="new">NEW</span>' : ''; ?>
                    </div>
                  </div>
                  <div class="product-body">
                    <p class="product-category"><?= strtoupper($row['kategori']); ?></p>
                    <h3 class="product-name">
                      <a href="preview.php?id=<?= $row['id']; ?>"><?= $row['nama_produk']; ?></a>
                    </h3>
                    <h4 class="product-price">
                      Rp<?= number_format($row['harga'], 0, ',', '.'); ?>
                      <?php if ($row['is_sale']) echo '<del class="product-old-price">Rp' . number_format($row['harga'] * 1.3, 0, ',', '.') . '</del>'; ?>
                    </h4>
                    <div class="product-rating">
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star-o"></i>
                    </div>
                    <div class="product-btns">
                      <a href="#" class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">wishlist</span></a>
                      <a href="#" class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">compare</span></a>
                      <a href="preview.php?id=<?= $row['id']; ?>" class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">preview</span></a>
                    </div>
                  </div>
                  <div class="add-to-cart">
                    <form action="add_to_cart.php" method="post">
                      <input type="hidden" name="product_id" value="<?= $row['id']; ?>">
                      <input type="hidden" name="jumlah" value="1">
                      <button type="submit" class="add-to-cart-btn">
                        <i class="fa fa-shopping-cart"></i> add to cart
                      </button>
                    </form>
                  </div>
                </div>
                <?php } ?>
              </div>
              <div id="slick-nav-related" class="products-slick-nav"></div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/slick.min.js"></script>
<script src="js/nouislider.min.js"></script>
<script src="js/jquery.zoom.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>
