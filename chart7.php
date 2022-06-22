<?php
    include_once('./conn/conn.php');
    include_once('./func/query.php');

    if(isset($_GET["sub_submit"])){
      $kumpulan_tgl = tanggalan($_GET['date']);
    //   Ini dataMaxVolIdr

      $dataMaxVolIdr = ambil_data("SELECT DATE(tanggal), MAX(volidr) FROM btc GROUP BY DATE(tanggal)");
      $dataMinVolIdr = ambil_data("SELECT DATE(tanggal), MIN(volidr) FROM btc GROUP BY DATE(tanggal)");

      $arrMaxVolIdr = array();
      $arrMinVolIdr = array();
      for ($i=1; $i <= count($kumpulan_tgl) ; $i++) {
        array_push($arrMaxVolIdr, $dataMaxVolIdr[$i][1]);
        array_push($arrMinVolIdr, $dataMinVolIdr[$i][1]);
      }

    //   Ini dataAvgRupiah
      $dataMaxRupiah = ambil_data("SELECT DATE(tanggal), MAX(hargaidr) FROM btc GROUP BY DATE(tanggal)");
      $dataMinRupiah = ambil_data("SELECT DATE(tanggal), MIN(hargaidr) FROM btc GROUP BY DATE(tanggal)");

      $arrMaxVRupiah = array();
      $arrMinVRupiah = array();
      for ($i=1; $i <= count($kumpulan_tgl) ; $i++) {
        array_push($arrMaxVRupiah, $dataMaxRupiah[$i][1]);
        array_push($arrMinVRupiah, $dataMinRupiah[$i][1]);
      }

    }

    else if(!isset($_GET['sub_submit'])){
        $kumpulan_tgl = array("k", "j", "i", "h", "g", "f", "e", "d", "c", "b", "a");
        $arrMaxVolIdr = array(1,2,3,4,5,6,7,8,9,10,11);
        $arrMaxVRupiah = array(1,2,3,4,5,6,7,8,9,10,11);
        $arrMinVolIdr = array(1,2,3,4,5,6,7,8,9,10,11);
        $arrMinVRupiah = array(1,2,3,4,5,6,7,8,9,10,11);
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="shortcut icon"
      href="./assets/images/logo/logo.jpg"
      type="image/x-icon"
    />
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
            <a
              href="#0"
              data-bs-toggle="collapse"
              data-bs-target="#ddmenu_1"
              aria-controls="ddmenu_1"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
              <span class="icon">
                <svg width="22" height="22" viewBox="0 0 22 22">
                  <path
                    d="M17.4167 4.58333V6.41667H13.75V4.58333H17.4167ZM8.25 4.58333V10.0833H4.58333V4.58333H8.25ZM17.4167 11.9167V17.4167H13.75V11.9167H17.4167ZM8.25 15.5833V17.4167H4.58333V15.5833H8.25ZM19.25 2.75H11.9167V8.25H19.25V2.75ZM10.0833 2.75H2.75V11.9167H10.0833V2.75ZM19.25 10.0833H11.9167V19.25H19.25V10.0833ZM10.0833 13.75H2.75V19.25H10.0833V13.75Z"
                  />
                </svg>
              </span>
              <span class="text">Dashboard</span>
            </a>
            <ul id="ddmenu_1" class="collapse show dropdown-nav">
              <li>
                <a href="index.php" class=""> Home </a>
              </li>
            </ul>
          </li>

          <li class="nav-item nav-item-has-children">
            <a
              href="#1"
              data-bs-toggle="collapse"
              data-bs-target="#ddmenu_2"
              aria-controls="ddmenu_2"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
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
                <a href="chart7.php" class="active"> Max & Min Value Vol IDR & Rp (Picker) </a>
              </li>
              <li>
                <a href="chart8.php" class="">  Last Buy & Sell IDR (Picker) </a>
              </li>
            </ul>
          </li>

          <li class="nav-item nav-item-has-children">
            <a
              href="#0"
              data-bs-toggle="collapse"
              data-bs-target="#ddmenu_1"
              aria-controls="ddmenu_1"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
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
                  <button
                    id="menu-toggle"
                    class="main-btn primary-btn btn-hover"
                  >
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
                  <h2>Chart</h2>
                </div>
              </div>
              <!-- end col -->
              <div class="col-md-6">
                <div class="breadcrumb-wrapper mb-30">
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item">
                        <a href="#0">Chart</a>
                      </li>
                      <li class="breadcrumb-item active" aria-current="page">
                      Max & Min Value Vol IDR & Rp (Picker)
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
                  <form action="" method="GET">
                            <div class="card-title d-flex">
                                <div class="mb-3 col-md-3 me-1">
                                    <label for="date">Tanggal</label>
                                    <input type="date" class="form-control" id="date" name="date" value="<?php echo (!empty($_GET['date']) ? $_GET['date'] : "") ?>">
                                </div>
                            </div>
                            <input type="submit" class="btn btn-success" name="sub_submit">
                            </form>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </section>

      <section class="card-components">
        <div class="container-fluid">
            <div class="cards-styles">
                <div class="row">
                  
                <?php for ($i=1; $i <= 2 ; $i++) { ?>
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <div class="card-style-3 mb-30">
                            <div class="card-content">
                                <canvas id="myChart<?php echo $i ?>"></canvas>
                            </div>
                        </div>
                    </div>
                    <?php } ?>

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
                  <a
                    href="https://plainadmin.com"
                    rel="nofollow"
                    target="_blank"
                  >
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    console.log(<?php echo json_encode($kumpulan_tgl) ?>)
    let lineChart = (labelMax, labelMin ,charts, max, min) => {
    const ctx = document.getElementById(`${charts}`).getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($kumpulan_tgl) ?>,
            datasets: [{
                label: labelMax,
                data: max,
                backgroundColor: "green",
                borderColor: "green",
                borderWidth: 1
            },
            {
                label: labelMin,
                data: min,
                backgroundColor: "red",
                borderColor: "red",
                borderWidth: 1
            }
        ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

}

lineChart("Max Value Vol IDR", "Min Value Vol IDR","myChart1", <?php echo json_encode(($arrMaxVolIdr)) ?>, <?php echo json_encode(($arrMinVolIdr)) ?>);
lineChart("Max Value Rupiah", "Min Value Rupiah" ,"myChart2", <?php echo json_encode(($arrMaxVRupiah)) ?>, <?php echo json_encode(($arrMinVRupiah)) ?>);

</script>

  </body>
</html>
