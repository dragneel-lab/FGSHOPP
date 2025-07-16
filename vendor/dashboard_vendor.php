<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Vendor</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CDN -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Montserrat', sans-serif;
      background-color: #f8f9fc;
    }

    .sidebar {
      height: 100vh;
      background-color: #1c1f26;
      color: #fff;
      padding-top: 20px;
    }

    .sidebar h4 {
      color: #D10024;
      text-align: center;
      font-weight: 700;
      margin-bottom: 30px;
    }

    .sidebar a {
      color: #ccc;
      display: block;
      padding: 10px 20px;
      text-decoration: none;
    }

    .sidebar a:hover,
    .sidebar a.active {
      background-color: #D10024;
      color: #fff;
    }

    .card-stat {
      border: none;
      border-radius: 12px;
      box-shadow: 0 3px 8px rgba(0,0,0,0.05);
    }

    .card-stat h5 {
      font-size: 16px;
      font-weight: 600;
    }

    .card-stat p {
      font-size: 22px;
      font-weight: 700;
      color: #D10024;
    }

    .chart-card {
      border: none;
      border-radius: 12px;
      box-shadow: 0 3px 8px rgba(0,0,0,0.05);
      padding: 20px;
      margin-top: 30px;
    }

    h3 {
      font-weight: 600;
      margin-bottom: 30px;
      color: #1c1f26;
    }
  </style>
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
      <div class="col-md-2 sidebar">
         <a href="../index.php" class="logo">
                <img src="../img/logo.png" alt="">
              </a>
        <a href="tambah_produk.php">Tambah Produk</a>
      </div>

      

  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    const ctx = document.getElementById('salesChart').getContext('2d');
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
        datasets: [{
          label: 'Penjualan',
          data: [12, 19, 3, 5, 2, 8],
          backgroundColor: '#D10024'
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: { display: false }
        },
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>
</body>
</html>
