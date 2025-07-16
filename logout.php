<?php
session_start();
session_unset(); // Menghapus semua variabel session
session_destroy(); // Menghancurkan session

// Tampilkan halaman logout sukses
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Logout Berhasil</title>
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body {
      font-family: 'Montserrat', sans-serif;
      background: #f5f5f5;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .logout-box {
      background: #fff;
      padding: 40px;
      border-radius: 16px;
      text-align: center;
      box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }

    .logout-box h2 {
      margin-bottom: 20px;
      color: #333;
    }

    .logout-box .btn {
      display: inline-block;
      margin: 10px;
      padding: 12px 20px;
      border-radius: 8px;
      text-decoration: none;
      font-weight: bold;
      color: white;
      background: #D10024;
      transition: 0.3s;
    }

    .logout-box .btn:hover {
      background: #a7001d;
    }

    .logout-box i {
      color: #D10024;
      font-size: 48px;
      margin-bottom: 15px;
    }
  </style>
</head>
<body>

<div class="logout-box">
  <i class="fa fa-sign-out-alt"></i>
  <h2>Anda telah logout.</h2>
  <a href="register/register.php" class="btn"><i class="fa fa-user-plus"></i> Register</a>
  <a href="register/register.php" class="btn"><i class="fa fa-sign-in-alt"></i> Login</a>
</div>

</body>
</html>
