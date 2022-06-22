<?php
require_once './conn/conn.php';

$limit = 1500;
if (isset($_GET["hal"]) and !empty($_GET["hal"])) {
    $hal = $_GET["hal"];
} else {
    $hal = 1;
}

$awal = ($hal - 1) * $limit;
// 1-1*1700 = 0;
// 2-1*1700 = 1700
$rows = [];

if(isset($_GET["sub_cari"])){
    if(!empty($_GET["cari_data"])){
    $data = $_GET["cari_data"];
                                                                                        // 0,1700
    $dataLimit = mysqli_query($conn, "SELECT * FROM btc WHERE level LIKE '%$data%' LIMIT $awal,$limit");
    $dataInit = mysqli_query($conn, "SELECT * FROM btc WHERE level LIKE '%$data%'");
    }
    else{
    $dataLimit = mysqli_query($conn, "SELECT * FROM btc LIMIT $awal,$limit");
    $dataInit = $conn->query("SELECT * FROM btc");
    }
}

elseif (isset($_GET["sub_tgl"])) {
    $date1 = date("Y-m-d", strtotime($_GET['date1']));
    $date2 = date("Y-m-d", strtotime($_GET['date2']));
    $dataLimit = mysqli_query($conn, "SELECT * FROM btc WHERE tanggal BETWEEN '$date1' AND '$date2' LIMIT $awal,$limit");
    $dataInit = $conn->query("SELECT * FROM btc WHERE tanggal BETWEEN '$date1' AND '$date2'");
} elseif (isset($_GET["sub_level"])) {
    $level =  $_GET["opsi_level"];
    $dataLimit = mysqli_query($conn, "SELECT * FROM btc WHERE level LIKE '$level' LIMIT $awal,$limit");
    $dataInit = mysqli_query($conn, "SELECT * FROM btc WHERE level LIKE '$level'");
} elseif (isset($_GET["sub_sinyal"])) {
    $sinyal1 = $_GET["cari_sinyal1"];
    $sinyal2 = $_GET["cari_sinyal2"];
    $dataLimit = mysqli_query($conn, "SELECT * FROM btc WHERE sinyal BETWEEN '$sinyal1' AND '$sinyal2' ORDER BY sinyal DESC LIMIT $awal,$limit");
    $dataInit = $conn->query("SELECT * FROM btc WHERE sinyal BETWEEN '$sinyal1' AND '$sinyal2' ORDER BY sinyal DESC");
} elseif (isset($_GET["sub_idr"])) {
    $idr1 = $_GET["harga_idr_1"];
    $idr2 = $_GET["harga_idr_2"];
    $dataLimit = mysqli_query($conn, "SELECT * FROM btc WHERE hargaidr BETWEEN '$idr1' AND '$idr2' ORDER BY sinyal DESC LIMIT $awal,$limit");
    $dataInit = $conn->query("SELECT * FROM btc WHERE hargaidr BETWEEN '$idr1' AND '$idr2' ORDER BY sinyal DESC");
} elseif (isset($_GET["sub_asc_desc"])) {
    $asc_desc = $_GET["opsi_asc_desc"];
    $sql = "SELECT * FROM btc " . "$asc_desc" . " LIMIT $awal,$limit";
    $dataLimit = mysqli_query($conn, $sql);
    $dataInit = $conn->query("SELECT * FROM btc " . $asc_desc);
} else {
    $dataLimit = mysqli_query($conn, "SELECT * FROM btc LIMIT $awal,$limit");
    $dataInit = $conn->query("SELECT * FROM btc");
}
$total = mysqli_num_rows($dataInit);
// echo $total;
// 51099
$pages = ceil($total / $limit); //menemukan angka batasan

while ($row = mysqli_fetch_array($dataLimit)) {
    $rows[] = $row;
}

if(empty($_GET['hal']) ){
    $numur = 1;
}
else{
    $numur = $_GET['hal'];
}

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link
      rel="shortcut icon"
      href="./assets/images/logo/logo.jpg"
      type="image/x-icon"
    />

    <link rel="stylesheet" href="//cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="./css/btc.css">
    <title>Hafi Ihza Farhana</title>
</head>

<body>
    <h1 class="text-center">Mining Crypto</h1>
    <div class="px-3">
        <div class="row">
            <!-- searching data -->
            <div class="col-md-4">
                <form action="" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" name="cari_data" id="cari_data" class="form-control" placeholder="cari Level">
                        <input type="submit" class="btn btn-primary" name="sub_cari" id="sub_cari">
                    </div>
                </form>
            </div>

            <div class="col-md-4">
                <form action="" method="GET" class="d-flex">
                    <div class="input-group mb-3">
                        <input type="number" name="cari_sinyal1" value="<?php echo !empty($_GET["cari_sinyal1"]) ? $_GET["cari_sinyal1"] : "" ?>" class="form-control" placeholder="Jarak sinyal 1">
                    </div>
                    <div class="input-group mb-3">
                        <input type="number" name="cari_sinyal2" value="<?php echo !empty($_GET["cari_sinyal2"]) ? $_GET["cari_sinyal2"] : "" ?>" class="form-control" placeholder="Jarak sinyal 2">
                        <input type="submit" class="btn btn-primary" name="sub_sinyal" id="sub_sinyal">
                    </div>
                </form>
            </div>

            <div class="col-md-4">
                <form action="" method="GET" class="d-flex">
                    <div class="input-group mb-3">
                        <input type="number" name="harga_idr_1" class="form-control" value="<?php echo !empty($_GET["harga_idr_1"]) ? $_GET["harga_idr_1"] : "" ?>" placeholder="Jarak IDR 1">
                    </div>
                    <div class="input-group mb-3">
                        <input type="number" name="harga_idr_2" value="<?php echo !empty($_GET["harga_idr_2"]) ? $_GET["harga_idr_2"] : "" ?>" class="form-control" placeholder="Jarak IDR 2">
                        <input type="submit" class="btn btn-primary" name="sub_idr" id="sub_idr">
                    </div>
                </form>
            </div>

            <?php
            $level_btc = mysqli_query($conn, "SELECT DISTINCT(level) FROM btc");
            $row_level_btc = [];
            while ($row = mysqli_fetch_array($level_btc)) {
                $row_level_btc[] = $row;
            }
            // 16
            $jumlahRowLevelBTC = mysqli_num_rows($level_btc);
            // deklarasi array
            $arrLevel = array();
            // echo "<pre>";
            // print_r($row_level_btc);
            // echo "</pre>";

            ?>
                <?php
                    for($i = 1; $i<$jumlahRowLevelBTC; $i++){
                        array_push($arrLevel,$row_level_btc[$i]["level"]);
                    }
                ?>
            <div class="col-md-4">
                <form action="" method="GET" class="d-flex">
                    <select class="form-select" name="opsi_level">
                        <?php foreach ($row_level_btc as $level) : ?>
                            <option value="<?= $level['level'] ?>" <?php echo !empty($_GET["opsi_level"]) && ($_GET["opsi_level"] == $level["level"]) ? "selected" : "" ?>><?= $level["level"] ?></option>
                        <?php endforeach; ?>
                        <input type="submit" class="btn btn-primary" name="sub_level" id="sub_level">
                    </select>
                </form>
            </div>

            <?php
            $asc_desc_btc = mysqli_query($conn, "SELECT * FROM asc_desc_btc");
            $row_ascdesc_btc = [];
            while ($row = mysqli_fetch_array($asc_desc_btc)) {
                $row_ascdesc_btc[] = $row;
            }
            // print_r($row_ascdesc_btc);
            ?>
            <div class="col-md-4">
                <form action="" method="GET" class="d-flex">
                    <select class="form-select" name="opsi_asc_desc">
                        <?php foreach ($row_ascdesc_btc as $ascdesc) : ?>
                            <option value="<?= $ascdesc['value'] ?>" <?php echo !empty($_GET["opsi_asc_desc"]) && ($_GET["opsi_asc_desc"] == $ascdesc["value"]) ? "selected" : "" ?>><?= $ascdesc["nama"] ?></option>
                        <?php endforeach; ?>
                        <input type="submit" class="btn btn-primary" name="sub_asc_desc" id="sub_asc_desc">
                    </select>
                </form>
            </div>

            <div class="col-md-4">
                <form action="" method="GET">
                    <div class="d-flex">
                        <div class="input-group mb-4">
                            <input type="date" value="<?php echo !empty($_GET["date1"]) ? $_GET["date1"] : "" ?>" class="form-control" placeholder="Set Awal" name="date1" />
                        </div> &nbsp;
                        <div class="input-group mb-4">
                            <input type="date" class="form-control" value="<?php echo !empty($_GET["date2"]) ? $_GET["date2"] : "" ?>" placeholder="Set Akhir" name="date2" />
                            <input type="submit" class="btn btn-primary" name="sub_tgl" id="sub_tgl">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <a href="index.php" class="btn btn-info text-light">Kembali Halaman Utama</a>
        <div class="tabme mt-3">
        <table class="table mt-3" id="myTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Sinyal</th>
                    <th>Level</th>
                    <th>Tanggal</th>
                    <th>Harga IDR</th>
                    <th>Harga USD</th>
                    <th>Volum IDR</th>
                    <th>Volum USD</th>
                    <th>Last Buy</th>
                    <th>Last Sell</th>
                    <th>Jenis</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $row) : ?>
                    <tr>
                        <td><?php echo $row["id"] ?></td>
                        <td><?php echo $row['sinyal'] ?></td>
                        <td><?php echo $row['level'] ?></td>
                        <td><?php echo $row['tanggal'] ?></td>
                        <td><?php echo $row['hargaidr'] ?></td>
                        <td><?php echo $row['hargausdt'] ?></td>
                        <td><?php echo $row['volidr'] ?></td>
                        <td><?php echo $row['volusdt'] ?></td>
                        <td><?php echo $row['lastbuy'] ?></td>
                        <td><?php echo $row['lastsell'] ?></td>
                        <td><?php echo $row['jenis'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
    </div>

    <a href="#" class="scroll sTop">TOP</a>
    <a href="#lst" class="scroll sBottom">BTM</a>

    <!-- </div> -->
    <nav class="pag" id="lst">
        <ul class="pagination justify-content-center pagination-sm">
            <!-- berdasarkan searching -->
            <?php if (!empty($_GET["sub_cari"]) && !empty($_GET["cari_data"])) : ?>
                <li class="page-item <?php echo $_GET['hal'] < 2? "disabled" : "" ?>"><a class="page-link" href="btc.php?&cari_data=<?php echo $_GET["cari_data"] ?>&sub_cari=Submit&hal=<?php echo 1 ?>"><<</a></li>
                <li class="page-item <?php echo $_GET['hal'] < 2? "disabled" : "" ?>"><a class="page-link" href="btc.php?&cari_data=<?php echo $_GET["cari_data"] ?>&sub_cari=Submit&hal=<?php echo ($numur-1) ?>"><</a></li>

                <?php for ($i = $numur; $i <= $numur+6; $i++) : ?>
                    <?php if($i <= $pages): ?>
                    <li class="page-item float-start"><a class="page-link" href="btc.php?&cari_data=<?php echo $_GET["cari_data"] ?>&sub_cari=Submit&hal=<?php echo $i ?>"><?php echo $i ?></a></li>
                    <?php endif; ?>
                    <?php endfor; ?>

                <li class="page-item <?php echo $_GET['hal'] < $pages? "" : "disabled" ?>"><a class="page-link" href="btc.php?&cari_data=<?php echo $_GET["cari_data"] ?>&sub_cari=Submit&hal=<?php echo ($numur+1) ?>">></a></li>
                <li class="page-item <?php echo $_GET['hal'] < $pages? "" : "disabled" ?>"><a class="page-link" href="btc.php?&cari_data=<?php echo $_GET["cari_data"] ?>&sub_cari=Submit&hal=<?php echo $pages ?>">>></a></li>
                <?php ?>

                <!-- berdasarkan tanggal -->
            <?php elseif (!empty($_GET["sub_tgl"]) && !empty($_GET["date1"]) && !empty($_GET["date2"])) : ?>
                <li class="page-item <?php echo $_GET['hal'] < 2? "disabled" : "" ?>"><a class="page-link" href="btc.php?date1=<?php echo $date1 ?>&date2=<?php echo $date2 ?>&sub_tgl=Submit&hal=<?php echo 1 ?>"><<</a></li>
                <li class="page-item <?php echo $_GET['hal'] < 2? "disabled" : "" ?>"><a class="page-link" href="btc.php?date1=<?php echo $date1 ?>&date2=<?php echo $date2 ?>&sub_tgl=Submit&hal=<?php echo ($numur-1) ?>"><</a></li>

                <?php for ($i = $numur; $i <= $numur+6; $i++) : ?>
                    <?php if($i <= $pages): ?>
                    <li class="page-item"><a class="page-link" href="btc.php?date1=<?php echo $date1 ?>&date2=<?php echo $date2 ?>&sub_tgl=Submit&hal=<?php echo $i ?>"><?php echo $i ?></a></li>
                    <?php endif; ?>
                    <?php endfor; ?>
                <?php ?>

                <li class="page-item <?php echo $_GET['hal'] < $pages? "" : "disabled" ?>"><a class="page-link" href="btc.php?date1=<?php echo $date1 ?>&date2=<?php echo $date2 ?>&sub_tgl=Submit&hal=<?php echo ($numur+1) ?>">></a></li>
                <li class="page-item <?php echo $_GET['hal'] < $pages? "" : "disabled" ?>"><a class="page-link" href="btc.php?date1=<?php echo $date1 ?>&date2=<?php echo $date2 ?>&sub_tgl=Submit&hal=<?php echo $pages ?>">>></a></li>

                <!-- Berdasarkan level -->
            <?php elseif (!empty($_GET["sub_level"]) && !empty($_GET["opsi_level"])) : ?>
                <li class="page-item <?php echo $_GET['hal'] < 2? "disabled" : "" ?>"><a class="page-link" href="btc.php?opsi_level=<?php echo $_GET["opsi_level"] ?>&sub_level=Submit&hal=<?php echo 1 ?>"><<</a></li>
                <li class="page-item <?php echo $_GET['hal'] < 2? "disabled" : "" ?>"><a class="page-link" href="btc.php?opsi_level=<?php echo $_GET["opsi_level"] ?>&sub_level=Submit&hal=<?php echo ($numur-1) ?>"><</a></li>
                
                <?php for ($i = $numur; $i <= $numur+6; $i++) : ?>
                    <?php if($i <= $pages): ?>
                    <li class="page-item"><a class="page-link" href="btc.php?opsi_level=<?php echo $_GET["opsi_level"] ?>&sub_level=Submit&hal=<?php echo $i ?>"><?php echo $i ?></a></li>
                    <?php endif; ?>
                <?php endfor; ?>

                <li class="page-item <?php echo $_GET['hal'] < $pages? "" : "disabled" ?>"><a class="page-link" href="btc.php?opsi_level=<?php echo $_GET["opsi_level"] ?>&sub_level=Submit&hal=<?php echo ($numur+1) ?>">></a></li>
                <li class="page-item <?php echo $_GET['hal'] < $pages? "" : "disabled" ?>"><a class="page-link" href="btc.php?opsi_level=<?php echo $_GET["opsi_level"] ?>&sub_level=Submit&hal=<?php echo $pages ?>">>></a></li>

                <!--  berdasarkan sinyal -->
            <?php elseif (!empty($_GET["sub_sinyal"]) && !empty($_GET["cari_sinyal1"]) && !empty($_GET["cari_sinyal2"])) : ?>
                <li class="page-item <?php echo $_GET['hal'] < 2? "disabled" : "" ?>"><a class="page-link" href="btc.php?cari_sinyal1=<?php echo $sinyal1 ?>&cari_sinyal2=<?php echo $sinyal2 ?>&sub_sinyal=Submit&hal=<?php echo 1 ?>"><<</a></li>
                <li class="page-item <?php echo $_GET['hal'] < 2? "disabled" : "" ?>"><a class="page-link" href="btc.php?cari_sinyal1=<?php echo $sinyal1 ?>&cari_sinyal2=<?php echo $sinyal2 ?>&sub_sinyal=Submit&hal=<?php echo ($numur-1) ?>"><</a></li>
                
                <?php for ($i = $numur; $i <= $numur+6; $i++) : ?>
                    <?php if($i <= $pages): ?>
                    <li class="page-item"><a class="page-link" href="btc.php?cari_sinyal1=<?php echo $sinyal1 ?>&cari_sinyal2=<?php echo $sinyal2 ?>&sub_sinyal=Submit&hal=<?php echo $i ?>"><?php echo $i ?></a></li>
                    <?php endif; ?>
                <?php endfor; ?>
                
                <li class="page-item <?php echo $_GET['hal'] < $pages? "" : "disabled" ?>"><a class="page-link" href="btc.php?cari_sinyal1=<?php echo $sinyal1 ?>&cari_sinyal2=<?php echo $sinyal2 ?>&sub_sinyal=Submit&hal=<?php echo ($numur+1) ?>">></a></li>
                <li class="page-item <?php echo $_GET['hal'] < $pages? "" : "disabled" ?>"><a class="page-link" href="btc.php?cari_sinyal1=<?php echo $sinyal1 ?>&cari_sinyal2=<?php echo $sinyal2 ?>&sub_sinyal=Submit&hal=<?php echo $pages ?>">>></a></li>
                <?php ?>

                <!-- ascending berdasarkan rentang harga -->
            <?php elseif (!empty($_GET["sub_idr"]) && !empty($_GET["harga_idr_1"]) && !empty($_GET["harga_idr_2"])) : ?>
                <li class="page-item <?php echo $_GET['hal'] < 2? "disabled" : "" ?>"><a class="page-link" href="btc.php?harga_idr_1=<?php echo $idr1 ?>&harga_idr_2=<?php echo $idr2 ?>&sub_idr=Submit&hal=<?php echo 1 ?>"><<</a></li>
                <li class="page-item <?php echo $_GET['hal'] < 2? "disabled" : "" ?>"><a class="page-link" href="btc.php?harga_idr_1=<?php echo $idr1 ?>&harga_idr_2=<?php echo $idr2 ?>&sub_idr=Submit&hal=<?php echo ($numur-1) ?>"><</a></li>

                <?php for ($i = $numur; $i <= $numur+6; $i++) : ?>
                    <?php if($i <= $pages): ?>
                    <li class="page-item"><a class="page-link" href="btc.php?harga_idr_1=<?php echo $idr1 ?>&harga_idr_2=<?php echo $idr2 ?>&sub_idr=Submit&hal=<?php echo $i ?>"><?php echo $i ?></a></li>
                    <?php endif; ?>
                <?php endfor; ?>

                <li class="page-item <?php echo $_GET['hal'] < $pages? "" : "disabled" ?>"><a class="page-link" href="btc.php?harga_idr_1=<?php echo $idr1 ?>&harga_idr_2=<?php echo $idr2 ?>&sub_idr=Submit&hal=<?php echo ($numur+1) ?>">></a></li>
                <li class="page-item <?php echo $_GET['hal'] < $pages? "" : "disabled" ?>"><a class="page-link" href="btc.php?harga_idr_1=<?php echo $idr1 ?>&harga_idr_2=<?php echo $idr2 ?>&sub_idr=Submit&hal=<?php echo $pages ?>">>></a></li>
                <?php ?>

                <!-- ascedning berdasarkan table -->
            <?php elseif (!empty($_GET["opsi_asc_desc"]) && !empty($_GET["sub_asc_desc"])) : ?>
                <li class="page-item <?php echo $_GET['hal'] < 2? "disabled" : "" ?>"><a class="page-link" href="btc.php?opsi_asc_desc=<?php echo $asc_desc ?>&sub_asc_desc=Submit&hal=<?php echo 1 ?>"><<</a></li>
                <li class="page-item <?php echo $_GET['hal'] < 2? "disabled" : "" ?>"><a class="page-link" href="btc.php?opsi_asc_desc=<?php echo $asc_desc ?>&sub_asc_desc=Submit&hal=<?php echo ($numur-1) ?>"><</a></li>
                
                <?php for ($i = $numur; $i <= $numur+6; $i++) : ?>
                    <?php if($i <= $pages): ?>
                    <li class="page-item"><a class="page-link" href="btc.php?opsi_asc_desc=<?php echo $asc_desc ?>&sub_asc_desc=Submit&hal=<?php echo $i ?>"><?php echo $i ?></a></li>
                    <?php endif; ?>
                <?php endfor; ?>
                
                <li class="page-item <?php echo $_GET['hal'] < $pages? "" : "disabled" ?>"><a class="page-link" href="btc.php?opsi_asc_desc=<?php echo $asc_desc ?>&sub_asc_desc=Submit&hal=<?php echo ($numur+1) ?>">></a></li>
                <li class="page-item <?php echo $_GET['hal'] < $pages? "" : "disabled" ?>"><a class="page-link" href="btc.php?opsi_asc_desc=<?php echo $asc_desc ?>&sub_asc_desc=Submit&hal=<?php echo $pages ?>">>></a></li>
                <?php ?>

                <!-- load data awal -->
            <?php else : ?>
                <li class="page-item <?php echo $_GET['hal'] < 2? "disabled" : "" ?>"><a class="page-link" href="btc.php?hal=<?php echo 1 ?>"><<</a></li>
                <li class="page-item <?php echo $_GET['hal'] < 2? "disabled" : "" ?>"><a class="page-link" href="btc.php?hal=<?php echo ($numur-1) ?>"><</a></li>

                <?php for ($i = $numur; $i <= $numur+6; $i++) : ?>
                    <?php if($i <= $pages): ?>
                    <li class="page-item"><a class="page-link" href="btc.php?hal=<?php echo $i ?>"><?php echo $i ?></a></li>
                    <?php endif; ?>
                    <?php endfor; ?>
                
                <li class="page-item <?php echo $_GET['hal'] < $pages? "" : "disabled" ?>"><a class="page-link" href="btc.php?hal=<?php echo ($numur+1) ?>">></a></li>
                <li class="page-item <?php echo $_GET['hal'] < $pages? "" : "disabled" ?>"><a class="page-link" href="btc.php?hal=<?php echo ($pages) ?>">>></a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- jQuery UI library -->
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <!-- datatable -->
    <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>

    <script type="text/javascript">
        // #cari_data
        $(function() {
            $("#cari_data").autocomplete({
                source: <?php echo json_encode($arrLevel) ?>,
            });
        });

        $(document).ready( function () {
            $('#myTable').DataTable({
                "searching":false,
                "paging" : false,
                dom: 'Bfrtip',
                buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
            });
        });
    </script>
</body>

</html>