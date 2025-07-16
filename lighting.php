<?php
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Accessories Collection</title>
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
  <link rel="stylesheet" href="css/bootstrap.min.css"/>
  <link rel="stylesheet" href="css/slick.css"/>
  <link rel="stylesheet" href="css/slick-theme.css"/>
  <link rel="stylesheet" href="css/nouislider.min.css"/>
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/style.css"/>
</head>
<body>
<header>
		<div id="top-header"></div>
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
							<div><a href="#"><i class="fa fa-heart-o"></i><span>Your Wishlist</span></a></div>
							<div class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
									<i class="fa fa-shopping-cart"></i>
									<span>Your Cart</span>
								</a>
								<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_index'])) {
    $index = (int)$_POST['remove_index'];
    if (isset($_SESSION['cart'][$index])) {
        unset($_SESSION['cart'][$index]);
        $_SESSION['cart'] = array_values($_SESSION['cart']); // reset index array
    }
}
?>

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

		</div>
							
							<div class="menu-toggle"><a href="#"><i class="fa fa-bars"></i><span>Menu</span></a></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
<div><div class="section">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="section-title">
					<h3 class="title">lighting</h3>	
					</div>
				</div>

				
									
<div class="section">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="section-title">
						
					</div>
				</div>

				<div class="col-md-12">
					<div class="row">
						<div class="products-tabs">
							<div id="tab1" class="tab-pane active">
								<div class="products-slick" >
									<?php
									$produk = mysqli_query($conn, "SELECT * FROM products WHERE kategori = 'LIGHTING'");

									while($row = mysqli_fetch_assoc($produk)) {
									?>
									<div class="product">
										<div class="product-img">
											<img src="<?= ($row['id'] == 15) ? './img/productacc10.png' : $row['gambar']; ?>" alt="">
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
												<button class="add-to-wishlist"><i class="fa fa-heart-o"></i></button>
												<button class="add-to-compare"><i class="fa fa-exchange"></i></button>
												<button class="quick-view"><i class="fa fa-eye"></i></button>
											</div>
										</div>
										<div class="add-to-cart">
											<form action="add_to_cart.php" method="post">
  <input type="hidden" name="product_id" value="<?= $row['id']; ?>">
  <input type="hidden" name="jumlah" value="1">
  <input type="hidden" name="redirect" value="lighting.php">
  <button type="submit" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
</form>
										</div>
									</div>
									<?php } ?>
								</div>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
									
        <div class="section">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="section-title">
						
					</div>
				</div>

				<div class="col-md-12">
					<div class="row">
						<div class="products-tabs">
							<div id="tab1" class="tab-pane active">
								<div class="products-slick" >
									<?php
									$produk = mysqli_query($conn, "SELECT * FROM products WHERE kategori = 'LIGHTING'");

									while($row = mysqli_fetch_assoc($produk)) {
									?>
									<div class="product">
										<div class="product-img">
											<img src="<?= ($row['id'] == 16) ? './img/productacc11.png' : $row['gambar']; ?>" alt="">
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
												<button class="add-to-wishlist"><i class="fa fa-heart-o"></i></button>
												<button class="add-to-compare"><i class="fa fa-exchange"></i></button>
												<button class="quick-view"><i class="fa fa-eye"></i></button>
											</div>
										</div>
										<div class="add-to-cart">
											<form action="add_to_cart.php" method="post">
  <input type="hidden" name="product_id" value="<?= $row['id']; ?>">
  <input type="hidden" name="jumlah" value="1">
  <input type="hidden" name="redirect" value="lighting.php">
  <button type="submit" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
</form>
										</div>
									</div>
									<?php } ?>
								</div>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
	

    <!-- FOOTER -->
		<footer id="footer">
			<!-- top footer -->
			<div class="section">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">About Us</h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.</p>
								<ul class="footer-links">
									<li><a href="#"><i class="fa fa-map-marker"></i>1734 Stonecoal Road</a></li>
									<li><a href="#"><i class="fa fa-phone"></i>+021-95-51-84</a></li>
									<li><a href="#"><i class="fa fa-envelope-o"></i>email@email.com</a></li>
								</ul>
							</div>
						</div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Categories</h3>
								<ul class="footer-links">
									<li><a href="#">Hot deals</a></li>
									<li><a href="#">Laptops</a></li>
									<li><a href="#">Smartphones</a></li>
									<li><a href="#">Cameras</a></li>
									<li><a href="#">Accessories</a></li>
								</ul>
							</div>
						</div>

						<div class="clearfix visible-xs"></div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Information</h3>
								<ul class="footer-links">
									<li><a href="#">About Us</a></li>
									<li><a href="#">Contact Us</a></li>
									<li><a href="#">Privacy Policy</a></li>
									<li><a href="#">Orders and Returns</a></li>
									<li><a href="#">Terms & Conditions</a></li>
								</ul>
							</div>
						</div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Service</h3>
								<ul class="footer-links">
									<li><a href="#">My Account</a></li>
									<li><a href="#">View Cart</a></li>
									<li><a href="#">Wishlist</a></li>
									<li><a href="#">Track My Order</a></li>
									<li><a href="#">Help</a></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /top footer -->

			<!-- bottom footer -->
			<div id="bottom-footer" class="section">
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-12 text-center">
							<ul class="footer-payments">
								<li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
								<li><a href="#"><i class="fa fa-credit-card"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-amex"></i></a></li>
							</ul>
							<span class="copyright">
								<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
								Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
							<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
							</span>
						</div>
					</div>
						<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /bottom footer -->
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