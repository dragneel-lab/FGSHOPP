<?php
session_start();
$total = 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Keranjang Belanja</title>
    <!-- Font & CSS -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="css/slick-theme.css">
    <link rel="stylesheet" href="css/nouislider.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f8f9fa;
        }
        .cart-title {
            font-weight: 700;
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .cart-table th, .cart-table td {
            vertical-align: middle !important;
            font-size: 14px;
        }
        .cart-table th {
            background-color: #343a40;
            color: #fff;
        }
        .cart-total {
            font-size: 18px;
            font-weight: 600;
            text-align: right;
        }
        .cart-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .btn-dark-custom {
            background-color: #222;
            color: #fff;
            border-radius: 0;
            padding: 12px 20px;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 14px;
        }
        .btn-danger-custom {
            background-color: #d10024;
            color: #fff;
            border-radius: 0;
            padding: 12px 20px;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 14px;
        }
        .btn-danger-custom:hover {
            background-color: #b8001d;
        }
    </style>
</head>
<body>
<div class="container my-5">
    <h2 class="cart-title">Keranjang Belanja</h2>
    <div class="table-responsive">
        <table class="table table-bordered cart-table">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as $index => $item) {
                        if (is_array($item)) {
                            $subtotal = $item['harga'] * $item['jumlah'];
                            $total += $subtotal;
                            echo "<tr>
                                    <td>{$item['nama']}</td>
                                    <td>Rp" . number_format($item['harga'], 0, ',', '.') . "</td>
                                    <td>{$item['jumlah']}</td>
                                    <td>Rp" . number_format($subtotal, 0, ',', '.') . "</td>
                                    <td>
                                        <a href='remove_from_cart.php?index=$index' class='btn btn-sm btn-danger'>
                                            <i class='fa fa-trash'></i> Hapus
                                        </a>
                                    </td>
                                  </tr>";
                        }
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>Keranjang kosong</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="cart-total">
        Total: <span class="text-danger">Rp<?= number_format($total, 0, ',', '.') ?></span>
    </div>

    <div class="cart-buttons">
        <a href="index.php" class="btn btn-dark-custom">Lanjut Belanja</a>
        <a href="checkout.php" class="btn btn-danger-custom">Checkout <i class="fa fa-arrow-right ms-1"></i></a>
    </div>
</div>
</body>
</html>
