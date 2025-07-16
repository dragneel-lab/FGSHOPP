<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "fgshop");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Electro - Template E-Commerce</title>
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
  <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>
  <link type="text/css" rel="stylesheet" href="css/slick.css"/>
  <link type="text/css" rel="stylesheet" href="css/slick-theme.css"/>
  <link type="text/css" rel="stylesheet" href="css/nouislider.min.css"/>
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link type="text/css" rel="stylesheet" href="css/style.css"/>
</head>
<body>

  <!-- BREADCRUMB -->
  <div id="breadcrumb" class="section">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h3 class="breadcrumb-header">Checkout</h3>
          <ul class="breadcrumb-tree">
            <li><a href="#">Beranda</a></li>
            <li class="active">Checkout</li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <!-- SECTION -->
  <div class="section">
    <div class="container">
      <form action="proses_checkout.php" method="POST" onsubmit="return showLoadingAndRedirect();">
        <div class="row">
          <div class="col-md-7">
            <!-- Detail Penagihan -->
            <div class="billing-details">
              <div class="section-title">
                <h3 class="title">Alamat Penagihan</h3>
              </div>
              <div class="form-group">
                <input class="input" type="text" name="first_name" placeholder="Nama Depan" required>
              </div>
              <div class="form-group">
                <input class="input" type="text" name="last_name" placeholder="Nama Belakang" required>
              </div>
              <div class="form-group">
                <input class="input" type="email" name="email" placeholder="Email" required>
              </div>
              <div class="form-group">
                <input class="input" type="text" name="address" placeholder="Alamat Lengkap" required>
              </div>
              <div class="form-group">
                <input class="input" type="text" name="city" placeholder="Kota" required>
              </div>
              <div class="form-group">
                <input class="input" type="text" name="country" placeholder="Negara" value="Indonesia">
              </div>
              <div class="form-group">
                <input class="input" type="text" name="zip_code" placeholder="Kode Pos">
              </div>
              <div class="form-group">
                <input class="input" type="tel" name="tel" placeholder="No. Telepon" required>
              </div>
              <div class="form-group">
                <div class="input-checkbox">
                  <input type="checkbox" id="create-account">
                  <label for="create-account">
                    <span></span>
                    Buat Akun?
                  </label>
                  <div class="caption">
                    <p>Masukkan password untuk membuat akun baru.</p>
                    <input class="input" type="password" name="password" placeholder="Password Anda">
                  </div>
                </div>
              </div>
            </div>
            <!-- Catatan Pesanan -->
            <div class="order-notes">
              <textarea class="input" name="note" placeholder="Catatan untuk pesanan Anda"></textarea>
            </div>
          </div>

          <!-- Ringkasan Pesanan -->
          <div class="col-md-5 order-details">
            <div class="section-title text-center">
              <h3 class="title">Pesanan Anda</h3>
            </div>

            <div class="order-summary">
              <div class="order-col">
                <div><strong>PRODUK</strong></div>
                <div><strong>TOTAL</strong></div>
              </div>
              <div class="order-products">
                <?php
                $total = 0;
                if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
                  foreach ($_SESSION['cart'] as $item) {
                    $name = $item['nama'];
                    $price = $item['harga'];
                    $quantity = $item['jumlah'];
                    $subtotal = $price * $quantity;
                    $total += $subtotal;
                    echo "<div class='order-col'>
                            <div>{$quantity}x {$name}</div>
                            <div>Rp" . number_format($subtotal, 0, ',', '.') . "</div>
                          </div>";
                  }
                } else {
                  echo '<p>Keranjang kosong.</p>';
                }
                ?>
              </div>
              <div class="order-col">
                <div>Pengiriman</div>
                <div><strong>GRATIS</strong></div>
              </div>
              <div class="order-col">
                <div><strong>TOTAL</strong></div>
                <div><strong class="order-total">Rp<?= number_format($total, 0, ',', '.') ?></strong></div>
              </div>
              <input type="hidden" name="total" value="<?= $total ?>">
            </div>

            <!-- Metode Pembayaran -->
            <div class="payment-method">
              <div class="input-radio">
                <input type="radio" name="payment_method" value="Transfer Bank" id="payment-1" checked>
                <label for="payment-1"><span></span> Transfer Bank</label>
              </div>
              <div class="input-radio">
                <input type="radio" name="payment_method" value="Dompet Digital" id="payment-2">
                <label for="payment-2"><span></span> Dompet Digital (OVO/DANA/Gopay)</label>
              </div>
              <div class="input-radio">
                <input type="radio" name="payment_method" value="COD" id="payment-3">
                <label for="payment-3"><span></span> Bayar di Tempat (COD)</label>
              </div>
            </div>

            <div class="input-checkbox">
              <input type="checkbox" id="terms" required>
              <label for="terms">
                <span></span>
                Saya telah membaca dan menyetujui <a href="#">syarat & ketentuan</a>
              </label>
            </div>

            <button type="submit" class="primary-btn order-submit">Lakukan Pemesanan</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- Animasi loading -->
  <div id="loading-animation" style="display:none; text-align:center; margin-top:20px;">
    <h3>Pesanan sedang diproses...</h3>
  </div>

  <script>
    function showLoadingAndRedirect() {
      document.getElementById("loading-animation").style.display = "block";
      return true; // tetap submit form
    }
  </script>

  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/slick.min.js"></script>
  <script src="js/nouislider.min.js"></script>
  <script src="js/jquery.zoom.min.js"></script>
  <script src="js/main.js"></script>
</body>
</html>