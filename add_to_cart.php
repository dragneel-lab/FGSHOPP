<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = (int)$_POST['product_id'];
    $jumlah = (int)$_POST['jumlah'];

    // Ambil data produk dari database
    $query = mysqli_query($conn, "SELECT * FROM products WHERE id = $product_id");
    $product = mysqli_fetch_assoc($query);

    if (!$product) {
        echo "Produk tidak ditemukan.";
        exit;
    }

    // Inisialisasi keranjang jika belum ada
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Cek apakah produk sudah ada di cart
    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] == $product_id) {
            $item['jumlah'] += $jumlah;
            $found = true;
            break;
        }
    }
    unset($item); // break reference

    // Jika belum ada, tambahkan produk ke cart
    if (!$found) {
        $_SESSION['cart'][] = [
            'id' => $product['id'],
            'nama' => $product['nama_produk'],
            'harga' => $product['harga'],
            'gambar' => $product['gambar'],
            'jumlah' => $jumlah
        ];
    }

    // Redirect ke halaman sebelumnya jika tersedia
    if (!empty($_POST['redirect'])) {
        header("Location: " . $_POST['redirect']);
    } else {
        header("Location: index.php");
    }
    exit;
}
?>
