<?php
include 'koneksi.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_index'])) {
    $index = (int)$_POST['remove_index'];
    if (isset($_SESSION['cart'][$index])) {
        unset($_SESSION['cart'][$index]);
        $_SESSION['cart'] = array_values($_SESSION['cart']); // reset index array
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FGSHOP</title>
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
  <link rel="stylesheet" href="css/bootstrap.min.css"/>
  <link rel="stylesheet" href="css/slick.css"/>
  <link rel="stylesheet" href="css/slick-theme.css"/>
  <link rel="stylesheet" href="css/nouislider.min.css"/>
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/style.css"/>
</head>
<body>
  <!-- HEADER -->
   
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
             <form action="search.php" method="get">
  <input class="input" name="q" placeholder="Cari produk...">
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
        <li><a class="dropdown-item" href="vendor/tambah_produk.php"><i class="fa fa-store"></i> Toko Saya</a></li>
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
	<!-- /HEADER -->
<nav id="navigation" class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-nav">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <div class="collapse navbar-collapse" id="main-nav">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Beranda</a></li>
        <li><a href="produk_per_toko.php">Produk</a></li>
        <li><a href="vendor/toko.php">Toko</a></li>
      </ul>

      <!-- Tombol Bergabung Vendor -->
      <ul class="nav navbar-nav navbar-right">
  <li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="margin-top: 8px; margin-left: 15px; padding: 6px 15px; color: #fff; background-color: #D10024;">
      Bergabung Menjadi Vendor <span class="caret"></span>
    </a>
    <ul class="dropdown-menu" style="min-width: 200px; padding: 10px;">
      <li style="margin-bottom: 8px;">
        <a href="vendor/login_vendor.php" class="btn btn-primary btn-block" style="background-color: #D10024; border: none;">Login</a>
      </li>
      <li>
        <a href="vendor/daftar_vendor.php" class="btn btn-default btn-block" style="border: 1px solid #D10024; color: #D10024;">Registrasi</a>
      </li>
    </ul>
  </li>
</ul>

    </div>
  </div>
</nav>

	<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">

		<!-- Banner -->
		<div class="row">
			<div class="col-md-12">
				<div class="banner">
					<img src="./img/banner.png" alt="Banner" style="width: 100%; height: auto; max-width: 100%; border-radius: 10px;">
				</div>
			</div>
		</div>
		<!-- /Banner -->

		<!-- row -->
		<div class="row">
			<!-- shop -->
			<div class="col-md-4 col-xs-6">
				<div class="shop">
					<div class="shop-img">
						<img src="./img/shop01.png" alt="">
					</div>
					<div class="shop-body">
						<h3>Accessories<br>Collection</h3>
						<a href="accessories.php" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
			</div>
			<!-- /shop -->

			<!-- shop -->
			<div class="col-md-4 col-xs-6">
				<div class="shop">
					<div class="shop-img">
						<img src="./img/shop03.png" alt="">
					</div>
					<div class="shop-body">
						<h3>Lighting<br>Collection</h3>
						<a href="lighting.php" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
			</div>
			<!-- /shop -->

			<!-- shop -->
			<div class="col-md-4 col-xs-6">
				<div class="shop">
					<div class="shop-img">
						<img src="./img/shop02.png" alt="">
					</div>
					<div class="shop-body">
						<h3>Cameras<br>Collection</h3>
						<a href="camera.php" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
			</div>
			<!-- /shop -->
		</div>
		<!-- /row -->

	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->

	<div class="section">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="section-title">
						<h3 class="title">New Products</h3>
					</div>
				</div>

				<div class="col-md-12">
					<div class="row">
						<div class="products-tabs">
							<div id="tab1" class="tab-pane active">
								<div class="products-slick" data-nav="#slick-nav-1">
									<?php
									$produk = mysqli_query($conn, "SELECT * FROM products");
									while($row = mysqli_fetch_assoc($produk)) {
									?>
									<div class="product">
										<div class="product-img">
											<img src="<?= $row['gambar']; ?>" alt="">
											<div class="product-label">
												<?php if($row['is_sale']) echo '<span class="sale">-30%</span>'; ?>
												<?php if($row['is_new']) echo '<span class="new">NEW</span>'; ?>
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
												
												<a href="preview.php?id=<?= $row['id']; ?>" class="quick-view" title="Lihat Produk">
  <i class="fa fa-eye"></i>
</a>

											</div>
										</div>
										<div class="add-to-cart">
											<form action="add_to_cart.php" method="post">
												<input type="hidden" name="product_id" value="<?= $row['id']; ?>">
												<input type="hidden" name="jumlah" value="1">
												<button type="submit" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
											</form>
										</div>
									</div>
									<?php } ?>
								</div>
								<div id="slick-nav-1" class="products-slick-nav"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


		<!-- HOT DEAL SECTION -->
		<div id="hot-deal" class="section" style="background-image: url('img/hotdeal.png'); background-size: cover; background-position: center; background-repeat: no-repeat;">

			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="hot-deal">
							<ul class="hot-deal-countdown">
								<li>
									<div>
										<h3>02</h3>
										<span>Days</span>
									</div>
								</li>
								<li>
									<div>
										<h3>10</h3>
										<span>Hours</span>
									</div>
								</li>
								<li>
									<div>
										<h3>34</h3>
										<span>Mins</span>
									</div>
								</li>
								<li>
									<div>
										<h3>60</h3>
										<span>Secs</span>
									</div>
								</li>
							</ul>
							<h2 class="text-uppercase">hot deal this week</h2>
							<p>New Collection Up to 50% OFF</p>
							<a class="primary-btn cta-btn" href="#">Shop now</a>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /HOT DEAL SECTION -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<!-- section title -->
					
					<!-- /section title -->

					<!-- Products tab & slick -->
					<div class="col-md-12">
						<div class="row">
							<div class="products-tabs">
								<!-- tab -->
								<div id="tab2" class="tab-pane fade in active">
									<div class="products-slick" data-nav="#slick-nav-2">
										<!-- product -->
										

										

										
									</div>
									<div id="slick-nav-2" class="products-slick-nav"></div>
								</div>
								<!-- /tab -->
							</div>
						</div>
					</div>
					<!-- /Products tab & slick -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-4 col-xs-6">
						<div class="section-title">
							<h4 class="title">Top selling</h4>
							<div class="section-nav">
								<div id="slick-nav-3" class="products-slick-nav"></div>
							</div>
						</div>

						<div class="products-widget-slick" data-nav="#slick-nav-3">
							<div>
								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="./img/product07.png" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Category</p>
										<h3 class="product-name"><a href="#">product name goes here</a></h3>
										<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
									</div>
								</div>
								<!-- /product widget -->

								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="./img/product08.png" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Category</p>
										<h3 class="product-name"><a href="#">product name goes here</a></h3>
										<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
									</div>
								</div>
								<!-- /product widget -->

								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="./img/product09.png" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Category</p>
										<h3 class="product-name"><a href="#">product name goes here</a></h3>
										<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
									</div>
								</div>
								<!-- product widget -->
							</div>

							<div>
								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="./img/product01.png" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">CAMERA</p>
										<h3 class="product-name"><a href="#">CAMERA CANON EOS 250D</a></h3>
										<h4 class="product-price">Rp8.328.000 <del class="product-old-price">Rp8.328.000 </del></h4>
									</div>
								</div>
								<!-- /product widget -->

								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="./img/product02.png" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">CAMERA</p>
										<h3 class="product-name"><a href="#">FUJIFILM X100S</a></h3>
										<h4 class="product-price">Rp8.550.000 <del class="product-old-price">Rp8.550.000 </del></h4>
									</div>
								</div>
								<!-- /product widget -->

								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="./img/product03.png" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">LIGHTING</p>
										<h3 class="product-name"><a href="#">GODOX MS200-E</a></h3>
										<h4 class="product-price">Rp350.000<del class="product-old-price">Rp350.00</del></h4>
									</div>
								</div>
								<!-- product widget -->
							</div>
						</div>
					</div>

					<div class="col-md-4 col-xs-6">
						<div class="section-title">
							<h4 class="title">Top selling</h4>
							<div class="section-nav">
								<div id="slick-nav-4" class="products-slick-nav"></div>
							</div>
						</div>

						<div class="products-widget-slick" data-nav="#slick-nav-4">
							<div>
								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="./img/product04.png" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">LIGHTING</p>
										<h3 class="product-name"><a href="#">LIGHTING KIT2</a></h3>
										<h4 class="product-price">Rp3.500.000 <del class="product-old-price">Rp3.500.000 </del></h4>
									</div>
								</div>
								<!-- /product widget -->

								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="./img/product05.png" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">AKSESORIS</p>
										<h3 class="product-name"><a href="#">TRIPOD MANFROTTO 545GB</a></h3>
										<h4 class="product-price">Rp7.000.000 <del class="product-old-price">Rp7.000.000</del></h4>
									</div>
								</div>
								<!-- /product widget -->

								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="./img/product06.png" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Category</p>
										<h3 class="product-name"><a href="#">product name goes here</a></h3>
										<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
									</div>
								</div>
								<!-- product widget -->
							</div>

							<div>
								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="./img/product07.png" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Category</p>
										<h3 class="product-name"><a href="#">product name goes here</a></h3>
										<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
									</div>
								</div>
								<!-- /product widget -->

								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="./img/product08.png" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Category</p>
										<h3 class="product-name"><a href="#">product name goes here</a></h3>
										<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
									</div>
								</div>
								<!-- /product widget -->

								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="./img/product09.png" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Category</p>
										<h3 class="product-name"><a href="#">product name goes here</a></h3>
										<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
									</div>
								</div>
								<!-- product widget -->
							</div>
						</div>
					</div>

					<div class="clearfix visible-sm visible-xs"></div>

					<div class="col-md-4 col-xs-6">
						<div class="section-title">
							<h4 class="title">Top selling</h4>
							<div class="section-nav">
								<div id="slick-nav-5" class="products-slick-nav"></div>
							</div>
						</div>

						<div class="products-widget-slick" data-nav="#slick-nav-5">
							<div>
								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="./img/product01.png" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Category</p>
										<h3 class="product-name"><a href="#">product name goes here</a></h3>
										<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
									</div>
								</div>
								<!-- /product widget -->

								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="./img/product02.png" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Category</p>
										<h3 class="product-name"><a href="#">product name goes here</a></h3>
										<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
									</div>
								</div>
								<!-- /product widget -->

								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="./img/product03.png" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Category</p>
										<h3 class="product-name"><a href="#">product name goes here</a></h3>
										<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
									</div>
								</div>
								<!-- product widget -->
							</div>

							<div>
								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="./img/product04.png" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Category</p>
										<h3 class="product-name"><a href="#">product name goes here</a></h3>
										<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
									</div>
								</div>
								<!-- /product widget -->

								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="./img/product05.png" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Category</p>
										<h3 class="product-name"><a href="#">product name goes here</a></h3>
										<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
									</div>
								</div>
								<!-- /product widget -->

								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="./img/product06.png" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Category</p>
										<h3 class="product-name"><a href="#">product name goes here</a></h3>
										<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
									</div>
								</div>
								<!-- product widget -->
							</div>
						</div>
					</div>

				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		

		<!-- FOOTER -->
<footer id="footer">
  <!-- top footer -->
  <div class="section">
    <div class="container">
      <div class="row">

        <!-- Tentang Toko -->
        <div class="col-md-3 col-xs-6">
          <div class="footer">
            <h3 class="footer-title">Tentang Kami</h3>
            <p>FGShop adalah toko alat fotografi terpercaya yang menyediakan kamera, lensa, lighting, dan aksesoris original dengan harga terbaik.</p>
            <ul class="footer-links">
              <li><a href="#"><i class="fa fa-map-marker"></i>Jl. Fotografi No.88, Jakarta</a></li>
              <li><a href="#"><i class="fa fa-phone"></i>+62 812 3456 7890</a></li>
              <li><a href="#"><i class="fa fa-envelope-o"></i>support@fgshop.com</a></li>
            </ul>
          </div>
        </div>

        <!-- Kategori Produk -->
        <div class="col-md-3 col-xs-6">
          <div class="footer">
            <h3 class="footer-title">Kategori Produk</h3>
            <ul class="footer-links">
              <li><a href="#">Kamera DSLR & Mirrorless</a></li>
              <li><a href="#">Lensa</a></li>
              <li><a href="#">Lighting & Flash</a></li>
              <li><a href="#">Tripod & Stabilizer</a></li>
              <li><a href="#">Aksesoris</a></li>
            </ul>
          </div>
        </div>

        <div class="clearfix visible-xs"></div>

        <!-- Informasi -->
        <div class="col-md-3 col-xs-6">
          <div class="footer">
            <h3 class="footer-title">Informasi</h3>
            <ul class="footer-links">
              <li><a href="#">Tentang Kami</a></li>
              <li><a href="#">Cara Belanja</a></li>
              <li><a href="#">Kebijakan Pengembalian</a></li>
              <li><a href="#">Privasi & Keamanan</a></li>
              <li><a href="#">Syarat & Ketentuan</a></li>
            </ul>
          </div>
        </div>

        <!-- Layanan Pelanggan -->
        <div class="col-md-3 col-xs-6">
          <div class="footer">
            <h3 class="footer-title">Layanan</h3>
            <ul class="footer-links">
              <li><a href="#">Akun Saya</a></li>
              <li><a href="#">Keranjang</a></li>
              <li><a href="#">Wishlist</a></li>
              <li><a href="#">Lacak Pesanan</a></li>
              <li><a href="#">Bantuan</a></li>
            </ul>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- bottom footer -->
  <div id="bottom-footer" class="section">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
          <ul class="footer-payments">
            <li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
            <li><a href="#"><i class="fa fa-credit-card"></i></a></li>
            <li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
            <li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
            <li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
          </ul>
          <span class="copyright">
            &copy; <script>document.write(new Date().getFullYear());</script> FGShop. All rights reserved. Powered by FGShop Team.
          </span>
        </div>
      </div>
    </div>
  </div>
</footer>
<!-- /FOOTER -->


		<!-- jQuery Plugins -->
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/slick.min.js"></script>
		<script src="js/nouislider.min.js"></script>
		<script src="js/jquery.zoom.min.js"></script>
		<script src="js/main.js"></script>

	</body>
</html>
