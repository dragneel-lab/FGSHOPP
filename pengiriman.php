<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Status Pengiriman</title>
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
  <link rel="stylesheet" href="css/bootstrap.min.css"/>
  <link rel="stylesheet" href="css/slick.css"/>
  <link rel="stylesheet" href="css/slick-theme.css"/>
  <link rel="stylesheet" href="css/nouislider.min.css"/>
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/style.css"/>
  <style>
    .status-container {
      margin-top: 80px;
      margin-bottom: 80px;
      text-align: center;
    }

    .step {
      display: inline-block;
      width: 150px;
      margin: 20px;
      position: relative;
    }

    .step .icon {
      width: 80px;
      height: 80px;
      line-height: 80px;
      border-radius: 50%;
      background-color: #dcdcdc;
      margin: auto;
      font-size: 32px;
      color: white;
      transition: 0.3s;
    }

    .step.active .icon {
      background-color: #2ecc71;
    }

    .step-text {
      margin-top: 10px;
      font-weight: bold;
      font-size: 16px;
    }

    .step::after {
      content: "";
      position: absolute;
      top: 40px;
      right: -90px;
      width: 80px;
      height: 4px;
      background-color: #dcdcdc;
      z-index: -1;
    }

    .step.active::after {
      background-color: #2ecc71;
    }

    .step:last-child::after {
      display: none;
    }
  </style>
</head>
<body>

<div class="container status-container">
  <h2 class="text-center mb-5">Status Pengiriman Pesanan Anda</h2>
  <div class="d-flex justify-content-center flex-wrap">
    <div class="step active">
      <div class="icon"><i class="fa fa-cube"></i></div>
      <div class="step-text">Dikemas</div>
    </div>
    <div class="step active">
      <div class="icon"><i class="fa fa-truck"></i></div>
      <div class="step-text">Dikirim</div>
    </div>
    <div class="step active">
      <div class="icon"><i class="fa fa-check-circle"></i></div>
      <div class="step-text">Diterima</div>
    </div>
  </div>
<a href="rincian_pesanan.php" class="btn btn-success mt-3">Lihat Rincian Pesanan</a>

  <a href="index.php" class="btn btn-primary mt-5">Kembali ke Beranda</a>
</div>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/slick.min.js"></script>
<script src="js/nouislider.min.js"></script>
<script src="js/jquery.zoom.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>
