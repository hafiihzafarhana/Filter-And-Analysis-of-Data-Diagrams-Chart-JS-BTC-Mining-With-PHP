<?php
include_once('./conn/conn.php');
include_once('./func/query.php');

$sql = "SELECT DISTINCT(DATE(tanggal)), MAX(volidr) as maxvolidr, MAX(volusdt) maxvolusd, MAX(hargausdt) maxhargausd, MAX(hargaidr) maxhargaidr, MIN(hargausdt) as minhargausd, MIN(hargaidr) minhargaidr FROM btc WHERE tanggal LIKE '%2022-05-11%'";
$data = mysqli_query($conn, $sql);
$rows = [];

while($row = mysqli_fetch_array($data)){
  $rows [] = $row;
}
?>

<!DOCTYPE html
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="./assets/images/logo/logo.jpg" type="image/x-icon" />
  <title>Manage Data BTC</title>

  <!-- ========== All CSS files linkup ========= -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="assets/css/lineicons.css" />
  <link rel="stylesheet" href="assets/css/materialdesignicons.min.css" />
  <link rel="stylesheet" href="assets/css/fullcalendar.css" />
  <link rel="stylesheet" href="assets/css/fullcalendar.css" />
  <link rel="stylesheet" href="assets/css/main.css" />
</head>

<body>
  <!-- ======== sidebar-nav start =========== -->
  <aside class="sidebar-nav-wrapper">
    <div class="navbar-logo">
      <a href="index.html">
        Hafi Ihza Farhana (BTC)
      </a>
    </div>
    <nav class="sidebar-nav">
      <ul>
        <li class="nav-item nav-item-has-children">
          <a href="#0" data-bs-toggle="collapse" data-bs-target="#ddmenu_1" aria-controls="ddmenu_1" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon">
              <svg width="22" height="22" viewBox="0 0 22 22">
                <path d="M17.4167 4.58333V6.41667H13.75V4.58333H17.4167ZM8.25 4.58333V10.0833H4.58333V4.58333H8.25ZM17.4167 11.9167V17.4167H13.75V11.9167H17.4167ZM8.25 15.5833V17.4167H4.58333V15.5833H8.25ZM19.25 2.75H11.9167V8.25H19.25V2.75ZM10.0833 2.75H2.75V11.9167H10.0833V2.75ZM19.25 10.0833H11.9167V19.25H19.25V10.0833ZM10.0833 13.75H2.75V19.25H10.0833V13.75Z" />
              </svg>
            </span>
            <span class="text">Dashboard</span>
          </a>
          <ul id="ddmenu_1" class="collapse show dropdown-nav">
            <li>
              <a href="index.php" class="active"> Home </a>
            </li>
          </ul>
        </li>

        <li class="nav-item nav-item-has-children">
          <a href="#1" data-bs-toggle="collapse" data-bs-target="#ddmenu_2" aria-controls="ddmenu_2" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon">
              <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                <path fill="currentColor" d="M9 17H7V10H9V17M13 17H11V7H13V17M17 17H15V13H17V17M19 19H5V5H19V19.1M19 3H5C3.9 3 3 3.9 3 5V19C3 20.1 3.9 21 5 21H19C20.1 21 21 20.1 21 19V5C21 3.9 20.1 3 19 3Z" />
              </svg>
            </span>
            <span class="text">Chart</span>
          </a>
          <ul id="ddmenu_2" class="collapse show dropdown-nav">
            <li>
              <a href="chart1.php" class=""> Tanggal & Level </a>
            </li>
            <li>
              <a href="chart2.php" class=""> Tanggal & Level & Jenis (Moon) </a>
            </li>
            <li>
              <a href="chart3.php" class=""> Tanggal & Level & Jenis (Crash) </a>
            </li>
            <li>
              <a href="chart4.php" class=""> Tanggal & Level (Picker) </a>
            </li>
            <li>
              <a href="chart5.php" class=""> Tanggal & Level & Jenis (Picker) </a>
            </li>
            <li>
              <a href="chart6.php" class=""> AVG Vol IDR & Rp (Picker) </a>
            </li>
            <li>
              <a href="chart7.php" class=""> Max & Min Value Vol IDR & Rp (Picker) </a>
            </li>
            <li>
              <a href="chart8.php" class=""> Last Buy & Sell IDR (Picker) </a>
            </li>
          </ul>
        </li>

        <li class="nav-item nav-item-has-children">
          <a href="#0" data-bs-toggle="collapse" data-bs-target="#ddmenu_1" aria-controls="ddmenu_1" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon">
              <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                <path fill="currentColor" d="M12,3C7.58,3 4,4.79 4,7C4,9.21 7.58,11 12,11C16.42,11 20,9.21 20,7C20,4.79 16.42,3 12,3M4,9V12C4,14.21 7.58,16 12,16C16.42,16 20,14.21 20,12V9C20,11.21 16.42,13 12,13C7.58,13 4,11.21 4,9M4,14V17C4,19.21 7.58,21 12,21C16.42,21 20,19.21 20,17V14C20,16.21 16.42,18 12,18C7.58,18 4,16.21 4,14Z" />
              </svg>
            </span>
            <span class="text">All Data</span>
          </a>
          <ul id="ddmenu_1" class="collapse show dropdown-nav">
            <li>
              <a href="btc.php" class=""> BTC </a>
            </li>
          </ul>
        </li>

      </ul>
    </nav>
  </aside>
  <div class="overlay"></div>
  <!-- ======== sidebar-nav end =========== -->

  <!-- ======== main-wrapper start =========== -->
  <main class="main-wrapper">
    <!-- ========== header start ========== -->
    <header class="header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-5 col-md-5 col-6">
            <div class="header-left d-flex align-items-center">
              <div class="menu-toggle-btn mr-20">
                <button id="menu-toggle" class="main-btn primary-btn btn-hover">
                  <i class="lni lni-chevron-left me-2"></i> Menu
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>
    <!-- ========== header end ========== -->

    <!-- ========== section start ========== -->
    <section class="section">
      <div class="container-fluid">
        <!-- ========== title-wrapper start ========== -->
        <div class="title-wrapper pt-30">
          <div class="row align-items-center">
            <div class="col-md-6">
              <div class="title mb-30">
                <h2>Home</h2>
              </div>
            </div>
            <!-- end col -->
            <div class="col-md-6">
              <div class="breadcrumb-wrapper mb-30">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                      <a href="#0">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                      Home
                    </li>
                  </ol>
                </nav>
              </div>
            </div>
            <!-- end col -->
          </div>
          <!-- end row -->
        </div>
      </div>
      <!-- end container -->
    </section>
    <!-- ========== section end ========== -->
    <section class="card-components">
      <div class="container-fluid">
        <div class="cards-styles">
          <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
              <div class="card-style-3 mb-30">
                <div class="card-content">
                  <div class="row mb-3 text-center">
                    <h3 class="text-dark">Informasi Hari Ini</h3>
                  </div>
                  <div class="row">

                    <div class="col-md-4">
                      <div class="card text-light bg-success mb-3" style="max-width: 18rem;">
                        <div class="card-header">Harga Tertinggi (IDR)</div>
                        <div class="card-body">
                          <p class="card-text">Rp <?php echo $rows[0]["maxhargaidr"] ?></p>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="card text-light bg-danger mb-3" style="max-width: 18rem;">
                        <div class="card-header">Harga Terendah (IDR)</div>
                        <div class="card-body">
                          <p class="card-text">Rp <?php echo $rows[0]["minhargaidr"] ?></p>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="card text-light bg-success mb-3" style="max-width: 18rem;">
                        <div class="card-header">Harga Tertinggi (USD)</div>
                        <div class="card-body">
                          <p class="card-text">$ <?php echo $rows[0]["maxhargausd"] ?></p>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="card text-light bg-danger mb-3" style="max-width: 18rem;">
                        <div class="card-header">Harga Terendah (USD)</div>
                        <div class="card-body">
                          <p class="card-text">$ <?php echo $rows[0]["minhargausd"] ?></p>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="card text-light bg-primary mb-3" style="max-width: 18rem;">
                        <div class="card-header">Volume Transaksi (IDR)</div>
                        <div class="card-body">
                          <p class="card-text">Rp <?php echo $rows[0]['maxvolusd'] ?></p>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="card text-light bg-primary mb-3" style="max-width: 18rem;">
                        <div class="card-header">Volume Transaksi (USD)</div>
                        <div class="card-body">
                          <p class="card-text">$ <?php echo $rows[0]['maxvolidr'] ?></p>
                        </div>
                      </div>
                    </div>

                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ========== footer start =========== -->
    <footer class="footer">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6 order-last order-md-first">
            <div class="copyright text-center text-md-start">
              <p class="text-sm">
                Web From
                <a href="https://plainadmin.com" rel="nofollow" target="_blank">
                  Hafi Ihza Farhana
                </a>
              </p>
            </div>
          </div>
          <!-- end col-->
        </div>
        <!-- end row -->
      </div>
      <!-- end container -->
    </footer>
    <!-- ========== footer end =========== -->
  </main>
  <!-- ======== main-wrapper end =========== -->

  <!-- ========= All Javascript files linkup ======== -->
  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/Chart.min.js"></script>
  <script src="assets/js/dynamic-pie-chart.js"></script>
  <script src="assets/js/moment.min.js"></script>
  <script src="assets/js/fullcalendar.js"></script>
  <script src="assets/js/jvectormap.min.js"></script>
  <script src="assets/js/world-merc.js"></script>
  <script src="assets/js/polyfill.js"></script>
  <script src="assets/js/main.js"></script>

</body>

</html>