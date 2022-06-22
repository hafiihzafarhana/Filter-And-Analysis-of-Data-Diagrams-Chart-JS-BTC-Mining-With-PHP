<?php 
    include_once('./conn/conn.php');

    function ambil_data($data){
        global $conn;

        $ambilData = mysqli_query($conn,$data);

        $rows = [];

        while($row = mysqli_fetch_array($ambilData)){
        // ini adalah bentuk masuknya databse ke dalam array $rows
        $rows[] = $row;
        }

        return $rows;
    }

    function ambil_data_ukur($data){
        global $conn;

        $ambilData = mysqli_query($conn,$data);

        return mysqli_num_rows($ambilData);
    }

    function arrBanyak($data){
        $data2 = ambil_data_ukur('SELECT level FROM btc WHERE level="'.$data.'" AND tanggal LIKE "%2022-04-29%"');
        $data3 = ambil_data_ukur('SELECT level FROM btc WHERE level="'.$data.'" AND tanggal LIKE "%2022-04-30%"');
        $data4 = ambil_data_ukur('SELECT level FROM btc WHERE level="'.$data.'" AND tanggal LIKE "%2022-05-01%"');
        $data5 = ambil_data_ukur('SELECT level FROM btc WHERE level="'.$data.'" AND tanggal LIKE "%2022-05-02%"');
        $data6 = ambil_data_ukur('SELECT level FROM btc WHERE level="'.$data.'" AND tanggal LIKE "%2022-05-03%"');
        $data7 = ambil_data_ukur('SELECT level FROM btc WHERE level="'.$data.'" AND tanggal LIKE "%2022-05-04%"');
        $data8 = ambil_data_ukur('SELECT level FROM btc WHERE level="'.$data.'" AND tanggal LIKE "%2022-05-05%"');
        $data9 = ambil_data_ukur('SELECT level FROM btc WHERE level="'.$data.'" AND tanggal LIKE "%2022-05-06%"');
        $data10 = ambil_data_ukur('SELECT level FROM btc WHERE level="'.$data.'" AND tanggal LIKE "%2022-05-07%"');
        $data11 = ambil_data_ukur('SELECT level FROM btc WHERE level="'.$data.'" AND tanggal LIKE "%2022-05-08%"');
        $data12 = ambil_data_ukur('SELECT level FROM btc WHERE level="'.$data.'" AND tanggal LIKE "%2022-05-09%"');
        $data13 = ambil_data_ukur('SELECT level FROM btc WHERE level="'.$data.'" AND tanggal LIKE "%2022-05-10%"');
        $data14 = ambil_data_ukur('SELECT level FROM btc WHERE level="'.$data.'" AND tanggal LIKE "%2022-05-11%"');

        $array_data_1 = array($data2, $data3, $data4, $data5, $data6, $data7, $data8, $data9, $data10, $data11, $data12, $data13, $data14);

        return $array_data_1;
    }

    function arrUntukChart1_2($lvl, $jenis){
        // moon, crash
    $data_2 = ambil_data_ukur('SELECT level FROM btc WHERE level="'.$lvl.'" AND jenis="'.$jenis.'" AND tanggal LIKE "%2022-04-29%"');
    $data_3 = ambil_data_ukur('SELECT level FROM btc WHERE level="'.$lvl.'" AND jenis="'.$jenis.'" AND tanggal LIKE "%2022-04-30%"');
    $data_4 = ambil_data_ukur('SELECT level FROM btc WHERE level="'.$lvl.'" AND jenis="'.$jenis.'" AND tanggal LIKE "%2022-05-01%"');
    $data_5 = ambil_data_ukur('SELECT level FROM btc WHERE level="'.$lvl.'" AND jenis="'.$jenis.'" AND tanggal LIKE "%2022-05-02%"');
    $data_6 = ambil_data_ukur('SELECT level FROM btc WHERE level="'.$lvl.'" AND jenis="'.$jenis.'" AND tanggal LIKE "%2022-05-03%"');
    $data_7 = ambil_data_ukur('SELECT level FROM btc WHERE level="'.$lvl.'" AND jenis="'.$jenis.'" AND tanggal LIKE "%2022-05-04%"');
    $data_8 = ambil_data_ukur('SELECT level FROM btc WHERE level="'.$lvl.'" AND jenis="'.$jenis.'" AND tanggal LIKE "%2022-05-05%"');
    $data_9 = ambil_data_ukur('SELECT level FROM btc WHERE level="'.$lvl.'" AND jenis="'.$jenis.'" AND tanggal LIKE "%2022-05-06%"');
    $data_10 = ambil_data_ukur('SELECT level FROM btc WHERE level="'.$lvl.'" AND jenis="'.$jenis.'" AND tanggal LIKE "%2022-05-07%"');
    $data_11 = ambil_data_ukur('SELECT level FROM btc WHERE level="'.$lvl.'" AND jenis="'.$jenis.'" AND tanggal LIKE "%2022-05-08%"');
    $data_12 = ambil_data_ukur('SELECT level FROM btc WHERE level="'.$lvl.'" AND jenis="'.$jenis.'" AND tanggal LIKE "%2022-05-09%"');
    $data_13 = ambil_data_ukur('SELECT level FROM btc WHERE level="'.$lvl.'" AND jenis="'.$jenis.'" AND tanggal LIKE "%2022-05-10%"');
    $data_14 = ambil_data_ukur('SELECT level FROM btc WHERE level="'.$lvl.'" AND jenis="'.$jenis.'" AND tanggal LIKE "%2022-05-11%"');

    $array_chart_1_2 = array($data_2, $data_3, $data_4, $data_5, $data_6, $data_7, $data_8, $data_9, $data_10, $data_11, $data_12, $data_13, $data_14);

    return $array_chart_1_2;
    }

    function arrUntukChart4($new_date,$lvl){

        if($new_date != ""){
        $data1 = ambil_data("SELECT SUM(DATE(tanggal) LIKE '%2022-04-29%') AS tgl1, SUM(DATE(tanggal) LIKE '%2022-04-30%') AS tgl2,
        SUM(DATE(tanggal) LIKE '%2022-05-01%') AS tgl3, SUM(DATE(tanggal) LIKE '%2022-05-02%') AS tgl4, SUM(DATE(tanggal) LIKE '%2022-05-03%') AS tgl5,
        SUM(DATE(tanggal) LIKE '%2022-05-04%') AS tgl6, SUM(DATE(tanggal) LIKE '%2022-05-05%') AS tgl7, SUM(DATE(tanggal) LIKE '%2022-05-06%') AS tgl8,
        SUM(DATE(tanggal) LIKE '%2022-05-07%') AS tgl9, SUM(DATE(tanggal) LIKE '%2022-05-08%') AS tgl10, SUM(DATE(tanggal) LIKE '%2022-05-09%') AS tgl11,
        SUM(DATE(tanggal) LIKE '%2022-05-10%') AS tgl12, SUM(DATE(tanggal) LIKE '%2022-05-11%') AS tgl3
        from btc WHERE level='".$lvl."' AND tanggal BETWEEN '2022-04-29' AND '".$new_date."'");

        $datas1 = array($data1[0][0], $data1[0][1], $data1[0][2], $data1[0][3], $data1[0][4], $data1[0][5], $data1[0][6], $data1[0][7], $data1[0][8], $data1[0][9], $data1[0][10], $data1[0][11], $data1[0][12]);
        }
        else{
            $datas1 = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13);
        }

        return $datas1;
    }

    function arrUntukChart5($new_date,$lvl,$jenis){

        if($new_date != ""){

            $data1 = ambil_data("SELECT SUM(DATE(tanggal) LIKE '%2022-04-29%') AS tgl1, SUM(DATE(tanggal) LIKE '%2022-04-30%') AS tgl2,
        SUM(DATE(tanggal) LIKE '%2022-05-01%') AS tgl3, SUM(DATE(tanggal) LIKE '%2022-05-02%') AS tgl4, SUM(DATE(tanggal) LIKE '%2022-05-03%') AS tgl5,
        SUM(DATE(tanggal) LIKE '%2022-05-04%') AS tgl6, SUM(DATE(tanggal) LIKE '%2022-05-05%') AS tgl7, SUM(DATE(tanggal) LIKE '%2022-05-06%') AS tgl8,
        SUM(DATE(tanggal) LIKE '%2022-05-07%') AS tgl9, SUM(DATE(tanggal) LIKE '%2022-05-08%') AS tgl10, SUM(DATE(tanggal) LIKE '%2022-05-09%') AS tgl11,
        SUM(DATE(tanggal) LIKE '%2022-05-10%') AS tgl12, SUM(DATE(tanggal) LIKE '%2022-05-11%') AS tgl3
        from btc WHERE level='".$lvl."' AND jenis='".$jenis."' AND tanggal BETWEEN '2022-04-29' AND '".$new_date."'");

        $datas1 = array($data1[0][0], $data1[0][1], $data1[0][2], $data1[0][3], $data1[0][4], $data1[0][5], $data1[0][6], $data1[0][7], $data1[0][8], $data1[0][9], $data1[0][10], $data1[0][11], $data1[0][12]);
        }

        else{
            $datas1 = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13);
        }

        return $datas1;
    }

    function tanggalan($dt){
    global $conn;
    $date = new DateTime($dt);
    $date->add(new DateInterval('P1D'));

    $new_date = $date->format('Y-m-d');

    $datas = mysqli_query($conn,"SELECT DISTINCT DATE(tanggal) FROM btc WHERE tanggal >= '2022-04-29' AND tanggal <= '$new_date'");

    $ukur_datas = ambil_data_ukur("SELECT DISTINCT DATE(tanggal) FROM btc WHERE tanggal >= '2022-04-29' AND tanggal <= '$new_date'");

    $rows = [];
    while($row = mysqli_fetch_array($datas)){
        $rows [] = $row;
    }

    $kumpulan_tgl = array();
    for ($i=0; $i < $ukur_datas ; $i++) {
        array_push($kumpulan_tgl, $rows[$i][0]);
    }

    return $kumpulan_tgl;
    }

?>