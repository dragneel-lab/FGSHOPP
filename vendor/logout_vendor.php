<?php
session_start();

// Hanya hapus sesi vendor
unset($_SESSION['vendor_login']);
unset($_SESSION['vendor_name']);
unset($_SESSION['vendor_id']);

// Redirect ke halaman utama atau login vendor
header("Location: login_vendor.php");
exit;
?>
