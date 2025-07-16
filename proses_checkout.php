<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "fgshop");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// 🚨 Redirect ke register jika belum login
if (!isset($_SESSION['user_id'])) {
    header("Location: register/register.php");
    exit;
}

// Ambil user_id dari session login
$user_id = $_SESSION['user_id'];

// Ambil data dari form
$first_name  = $_POST['first_name'];
$last_name   = $_POST['last_name'];
$email       = $_POST['email'];
$address     = $_POST['address'];
$city        = $_POST['city'];
$country     = $_POST['country'];
$zip_code    = $_POST['zip_code'];
$tel         = $_POST['tel'];
$total       = $_POST['total'];
$payment_method = $_POST['payment_method'] ?? '';
$note        = $_POST['note'] ?? '';

// Simpan ke tabel orders
$query = "INSERT INTO orders (user_id, first_name, last_name, email, address, city, country, zip_code, tel, total)
          VALUES ('$user_id', '$first_name', '$last_name', '$email', '$address', '$city', '$country', '$zip_code', '$tel', '$total')";
mysqli_query($conn, $query);
$order_id = mysqli_insert_id($conn);

// Simpan item-item pesanan ke tabel order_items
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $product_name = mysqli_real_escape_string($conn, $item['nama']);
        $price = $item['harga'];
        $quantity = $item['jumlah'];

        $queryItem = "INSERT INTO order_items (order_id, product_name, quantity, price)
                      VALUES ('$order_id', '$product_name', '$quantity', '$price')";
        mysqli_query($conn, $queryItem);
    }
}

// Kosongkan keranjang setelah checkout
unset($_SESSION['cart']);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Pesanan Berhasil</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      text-align: center;
      font-family: 'Montserrat', sans-serif;
      padding-top: 50px;
      background: #f7f7f7;
    }
    h2 {
      color: green;
      margin-bottom: 10px;
    }
    #animation-container {
      margin: 30px auto;
      width: 300px;
      height: 300px;
    }
  </style>
</head>
<body>

  <h2>✅ Pesanan Anda Telah Berhasil!</h2>
  <p>Mengarahkan ke halaman pengiriman dalam beberapa detik...</p>

  <!-- Container animasi -->
  <div id="animation-container">
    <canvas id="dotlottie-canvas" width="300" height="300"></canvas>
  </div>

  <!-- Lottie Animation -->
  <script type="module">
    import { DotLottie } from "https://cdn.jsdelivr.net/npm/@lottiefiles/dotlottie-web/+esm";

    const canvas = document.getElementById("dotlottie-canvas");

    new DotLottie({
      autoplay: true,
      loop: true,
      canvas: canvas,
      src: "img/Animation.lottie"
    });
  </script>

  <!-- Redirect otomatis ke pengiriman -->
  <script>
    setTimeout(function() {
      window.location.href = "pengiriman.php";
    }, 4000);
  </script>

</body>
</html>
