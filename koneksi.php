<?php
$conn = mysqli_connect("localhost", "root", "", "fgshop");
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
