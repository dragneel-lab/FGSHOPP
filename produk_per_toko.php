<?php
require 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Semua Produk</title>
  <link rel="stylesheet" href="css/bootstrap.min.css"/>
  <link rel="stylesheet" href="css/font-awesome.min.css"/>
  <link rel="stylesheet" href="css/slick.css"/>
  <link rel="stylesheet" href="css/style.css"/>
</head>
<body>


<header>
   
    <div id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="header-logo">
              <a href="index.php" class="logo">
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
			  
<div class="dropdown">
  <?php if (isset($_SESSION['user']) || isset($_SESSION['vendor_login'])): ?>
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
  <?php else: ?>
    <a href="register/register.php"><i class="fa fa-user"></i> <span>Akun</span></a>
  <?php endif; ?>
</div>



			 
            </div>
			
          </div>
		  
		  
        </div>

        

      </div>
	  
    </div>
	

</header>

<div class="section">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="section-title">
          <h3 class="title">Semua Produk</h3>
        </div>
      </div>

      <div class="col-md-12">
       <div class="row">
  <?php
  $produk = mysqli_query($conn, "SELECT * FROM products");
  while ($row = mysqli_fetch_assoc($produk)) {
  ?>
  <div class="col-md-3 col-sm-6">
    <div class="product">
      <div class="product-img">
        <img src="<?= $row['gambar']; ?>" alt="">
        <div class="product-label">
          <?php if ($row['is_sale']) echo '<span class="sale">-30%</span>'; ?>
          <?php if ($row['is_new']) echo '<span class="new">NEW</span>'; ?>
        </div>
      </div>
      <div class="product-body">
        <p class="product-category"><?= strtoupper($row['kategori']); ?></p>
        <h3 class="product-name"><a href="#"><?= $row['nama_produk']; ?></a></h3>
        <h4 class="product-price">Rp<?= number_format($row['harga'], 0, ',', '.'); ?></h4>
        <div class="product-rating">
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          <i class="fa fa-star-o"></i>
        </div>
        <div class="product-btns">
          <a href="preview.php?id=<?= $row['id']; ?>" class="quick-view"><i class="fa fa-eye"></i></a>
        </div>
      </div>
      <div class="add-to-cart">
        <form action="add_to_cart.php" method="post">
          <input type="hidden" name="product_id" value="<?= $row['id']; ?>">
          <input type="hidden" name="jumlah" value="1">
          <input type="hidden" name="redirect" value="semua_produk.php">
          <button type="submit" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
        </form>
      </div>
    </div>
  </div>
  <?php } ?>
  
</div>
  </div>
  

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/slick.min.js"></script>
<script src="js/main.js"></script>

</body>
</html>
