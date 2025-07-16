<?php
include '../koneksi.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM vendor_users WHERE email = '$email'");
    $vendor = mysqli_fetch_assoc($query);

    if ($vendor && password_verify($password, $vendor['password'])) {
        $_SESSION['vendor_login'] = true;
        $_SESSION['vendor_id'] = $vendor['id'];
        $_SESSION['vendor_name'] = $vendor['nama_toko'];
        header("Location: dashboard_vendor.php");
        exit;
    } else {
        $error = "Email atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FGSHOP | Login Vendor</title>

  <!-- Fonts dan CSS -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
  <link rel="stylesheet" href="../css/bootstrap.min.css"/>
  <link rel="stylesheet" href="../css/style.css"/>

  <style>
    body {
      background: linear-gradient(to right, #ffffffff, #ffffffff);
      font-family: 'Montserrat', sans-serif;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .login-card {
      background: #fff;
      padding: 40px 30px;
      border-radius: 12px;
      max-width: 400px;
      width: 100%;
      box-shadow: 0 10px 40px rgba(0,0,0,0.2);
    }

    .login-card h2 {
      text-align: center;
      font-weight: 700;
      margin-bottom: 30px;
      color: #D10024;
    }

    .btn-login {
      background-color: #D10024;
      color: #fff;
      font-weight: 500;
      border-radius: 30px;
      padding: 10px;
      width: 100%;
      transition: 0.3s;
    }

    .btn-login:hover {
      background-color: #a8001c;
    }

    .alert {
      font-size: 14px;
    }
  </style>
</head>
<body>

<div class="login-card">
  <h2>Login Vendor</h2>

  <?php if (isset($error)): ?>
    <div class="alert alert-danger"><?= $error; ?></div>
  <?php endif; ?>

  <form method="POST">
    <div class="form-group">
      <label>Email</label>
      <input type="email" name="email" class="form-control" required>
    </div>
    <div class="form-group">
      <label>Kata Sandi</label>
      <input type="password" name="password" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-login mt-3">Masuk</button>
  </form>
</div>

<!-- JS -->
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>
