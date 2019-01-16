
<?php

/**
 * @Author: Rick
 * @Date:   2018-11-08 22:45:07
 * @Last Modified by:   Rick
 * @Last Modified time: 2018-11-19 15:20:24
 */
include('admin/koneksi.php');
?>
<!-- awal col md -->
<div class="col-md-12">
	<h2>METODE NAIVE BAYES</h2>
	<hr>

	<!-- awal col md -->
	<div class="col-md-12">

		<style type="text/css">
			.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td{
				border-top: 1px solid #fff ;
			}
		</style>
		<br>

		<h4>
			Prediksi Kelulusan dengan Naive Bayes	
		</h4>
		<br>
		
        <!-- Awal Tabel Tahap 1 -->
		<div class="panel panel-info">
        	<div class="panel-heading">TAHAP 1 - Menghitung Jumlah Kelas</div>
            <ul class="nav nav-tabs">
                <li role="presentation">
                    <a href="#tab1" data-toggle="tab" >status kelulusan</a>
                </li>
                <li role="presentation">
                    <a href="#tab2" data-toggle="tab" >masa Studi</a>
                </li>
                <li role="presentation">
                    <a href="#tab3" data-toggle="tab" >IPK</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane" id="tab1">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <h6>X = Peluang prediksi status kelulusan </h6>
                                <tr>
                                    <th>Total Data </th>
                                    <th colspan="2" ><h3>Jumlah kelas Status Kelulusan</h3></th>
                                </tr>                  
                                <?php 
                                    if (isset($_POST['submit'])){
                                        $nim            = $_POST['nim'];
                                        $nama           = $_POST['nama'];
                                        $jk             = $_POST['jk'];
                                        $sm             = $_POST['sm'];
                                        $ipk1            = $_POST['ipk1'];
                                        $ipk2            = $_POST['ipk2'];
                                        $ipk3            = $_POST['ipk3'];
                                        $ipk4            = $_POST['ipk4'];
                                        $ips1            = $_POST['ips1'];
                                        $ips2            = $_POST['ips2'];
                                        $ips3            = $_POST['ips3'];
                                        $ips4            = $_POST['ips4'];
                                        $rataipk = (($ipk1+$ipk1+$ipk1+$ipk1)/4);
                                        
                                        if (($ipk1 > 4) || ($ipk2 > 4)|| ($ipk3 > 4) || ($ipk4 > 4) || ($ips1 > 4) || ($ips2 > 4)|| ($ips3 > 4)|| ($ips4 > 4)) 
                                            {
                                                echo "<script>alert('IPK dan IPS berlebihan');window.location='index.php?page=naivebayes'</script>";
                                            } else{

                                            // perhitungan TAHAP 1
                                                                                                
                                                // mencari total data training
                                                $sql = "SELECT COUNT(*) AS jumlah FROM tb_datatraining";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $totaldata = $result['jumlah'];

                                                // total data 'TEPAT' yang ada pada data training
                                                $sql = "SELECT COUNT(*) AS jumlah FROM tb_datatraining where status_kelulusan='TEPAT' group by status_kelulusan";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $totaldatatepat = $result['jumlah'];
                                                $totaldatatepatfix = $totaldatatepat/$totaldata;

                                                // total data 'TERLAMBAT' yang ada pada data training 
                                                $sql = "SELECT COUNT(*) AS jumlah FROM tb_datatraining where status_kelulusan='TERLAMBAT' group by status_kelulusan";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $totaldataterlambat     = $result['jumlah'];
                                                $totaldataterlambatfix = $totaldataterlambat/$totaldata;

                                                
                                ?>
                                <tr>
                                    <td rowspan='8'> <?php echo $totaldata; ?>  </td>
                                    <th>P(Y= TEPAT)  </th>
                                    <th>P(Y= TERLAMBAT) </th> 
                                </tr>
                                <tr>
                                    <td> <?php echo $totaldatatepat; ?>  </td> 
                                    <td> <?php echo $totaldataterlambat; ?>  </td>
                                </tr>
                                <tr>
                                    <td>P(Y= TEPAT) / total data</td> 
                                    <td>P(Y= TERLAMBAT) / total data</td>
                                </tr>
                                <tr>
                                    <td> <?php echo $totaldatatepatfix = $totaldatatepat/$totaldata; ?>  </td> 
                                    <td> <?php echo $totaldataterlambatfix = $totaldataterlambat/$totaldata; ?>  </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab2">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <h6>X = Peluang prediksi masa studi </h6>
                                <tr>
                                    <th>Total Data </th>
                                    <th colspan="2" ><h3> Jumlah kelas Masa Studi</h3></th>
                                </tr>                  
                                    <?php
                                        // total data 'masa studi = 7 ' yang ada pada data training   
                                        $sql = "SELECT COUNT(*) AS jumlah FROM tb_datatraining where masa_studi =7";
                                        $query = mysqli_query($konek_db,$sql);
                                        $result = mysqli_fetch_array($query);
                                        $totaldatams7 = $result['jumlah'];
                                        $totaldatams7fix = $totaldatams7/$totaldata;

                                        // total data 'masa studi = 8 ' yang ada pada data training   
                                        $sql = "SELECT COUNT(*) AS jumlah FROM tb_datatraining where masa_studi =8";
                                        $query = mysqli_query($konek_db,$sql);
                                        $result = mysqli_fetch_array($query);
                                        $totaldatams8 = $result['jumlah'];
                                        $totaldatams8fix = $totaldatams8/$totaldata;

                                        // total data 'masa studi = 9 ' yang ada pada data training   
                                        $sql = "SELECT COUNT(*) AS jumlah FROM tb_datatraining where masa_studi =9";
                                        $query = mysqli_query($konek_db,$sql);
                                        $result = mysqli_fetch_array($query);
                                        $totaldatams9 = $result['jumlah'];
                                        $totaldatams9fix = $totaldatams9/$totaldata;

                                        // total data 'masa studi = 10 ' yang ada pada data training   
                                        $sql = "SELECT COUNT(*) AS jumlah FROM tb_datatraining where masa_studi =10";
                                        $query = mysqli_query($konek_db,$sql);
                                        $result = mysqli_fetch_array($query);
                                        $totaldatams10 = $result['jumlah'];
                                        $totaldatams10fix = $totaldatams10/$totaldata;


                                        

                                    ?>
                                <tr>
                                    <td rowspan='8'> <?php echo $totaldata; ?>  </td>
                                    <th>P(X= Masa Studi = 7 semester)  </th>
                                    <th>P(X= Masa Studi = 8 semester) </th> 
                                </tr>
                                <tr>
                                    <td> <?php echo $totaldatams7; ?>  </td> 
                                    <td> <?php echo $totaldatams8; ?>  </td>
                                </tr>
                                <tr>
                                    <td> P(X= Masa Studi = 7 semester) / totaldata </td> 
                                    <td> P(X= Masa Studi = 8 semester) / totaldata </td>
                                </tr>
                                <tr>
                                    <td> <?php echo $totaldatams7fix; ?>  </td> 
                                    <td> <?php echo $totaldatams8fix; ?>  </td>
                                </tr>
                                <tr>
                                    <th> P(X= Masa Studi = 9 semester)</th> 
                                    <th> P(X= Masa Studi = 10 semester)</th>
                                </tr>
                                <tr>
                                    <td> <?php echo $totaldatams9; ?>  </td> 
                                    <td> <?php echo $totaldatams10; ?>  </td>
                                </tr>
                                <tr>
                                    <td> P(X= Masa Studi = 9 semester) / totaldata </td> 
                                    <td> P(X= Masa Studi = 10 semester) / totaldata </td>
                                </tr>
                                <tr>
                                    <td> <?php echo $totaldatams9fix; ?>  </td> 
                                    <td> <?php echo $totaldatams10fix; ?>  </td>
                                </tr>
                                
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab3">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <h6>X = Peluang prediksi IPK </h6>
                                
                                <?php
                                    // total data 'IPK antara 3.51 dan 4.00' yang ada pada data training
                                    $sql = "SELECT COUNT(*) AS jumlah FROM tb_datatraining where ipk_lulus >=3.51 and ipk_lulus <=4.00";
                                    $query = mysqli_query($konek_db,$sql);
                                    $result = mysqli_fetch_array($query);
                                    $totaldataipkcumlaude = $result['jumlah'];
                                    $totaldataipkcumlaudefix = $totaldataipkcumlaude/$totaldata;
                                    $totaldataipkcumlaudefix =number_format($totaldataipkcumlaudefix,8);

                                    
                                    // total data 'IPK antara 2.76 dan 3.50' yang ada pada data training
                                    $sql = "SELECT COUNT(*) AS jumlah FROM tb_datatraining where ipk_lulus >=2.76 && ipk_lulus <=3.50";
                                    $query = mysqli_query($konek_db,$sql);
                                    $result = mysqli_fetch_array($query);
                                    $totaldataipksgtmemuaskan = $result['jumlah'];
                                    $totaldataipksgtmemuaskanfix = $totaldataipksgtmemuaskan/$totaldata;
                                    $totaldataipksgtmemuaskanfix =number_format($totaldataipksgtmemuaskanfix,8);


                                    // total data 'IPK antara 2.00 dan 2.75' yang ada pada data training
                                    $sql = "SELECT COUNT(*) AS jumlah FROM tb_datatraining where ipk_lulus >=2.00 && ipk_lulus <=2.75";
                                    $query = mysqli_query($konek_db,$sql);
                                    $result = mysqli_fetch_array($query);
                                    $totaldataipkmemuaskan = $result['jumlah'];
                                    $totaldataipkmemuaskanfix = $totaldataipkmemuaskan/$totaldata;
                                    $totaldataipkmemuaskanfix =number_format($totaldataipkmemuaskanfix,8);
                                ?>
                                <tr>
                                    <th>Total Data </th>
                                    <th colspan="2" ><h3>Jumlah kelas Range IPK</h3></th>
                                </tr>                  
                                    
                                <tr>
                                    <td rowspan='6'> <?php echo $totaldata; ?>  </td>
                                    <th>P(X= prediksi IPK cumlaude)  </th>
                                    <td><?php echo $totaldataipkcumlaude; ?></td> 
                                </tr>
                                <tr>
                                    <th>P(X= prediksi IPK sangat memuaskan)  </th>
                                    <td><?php echo $totaldataipksgtmemuaskan; ?></td>
                                </tr>
                                <tr>
                                    <th>P(X= prediksi IPK memuaskan)  </th>
                                    <td><?php echo $totaldataipkmemuaskan; ?></td>
                                </tr>
                                <tr>
                                    <td>P(X= prediksi IPK cumlaude) / Total data  </td>
                                    <td><?php echo $totaldataipkcumlaudefix; ?></td> 
                                </tr>
                                <tr>
                                    <td>P(X= prediksi IPK sangat memuaskan) / Total data </td>
                                    <td><?php echo $totaldataipksgtmemuaskanfix; ?></td>
                                </tr>
                                <tr>
                                    <td>P(X= prediksi IPK memuaskan) / Total data </td>
                                    <td><?php echo $totaldataipkmemuaskanfix; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
		</div>
        <!-- /Akhir Tabel Tahap 1 -->

        <!-- ini tabel kedua -->
        <div class="panel panel-info">
            <div class="panel-heading">TAHAP 2 - Menghitung Probabilitas</div>
            <ul class="nav nav-tabs">
                <li role="presentation">
                    <a href="#tab1t2" data-toggle="tab" >cara hitung prediksi status kelulusan</a>
                </li>
                <li role="presentation">
                    <a href="#tab2t2" data-toggle="tab" >cara hitung prediksi Masa studi</a>
                </li>
                <li role="presentation">
                    <a href="#tab3t2" data-toggle="tab" >cara hitung prediksi IPK</a>
                </li>
            </ul>
            <div class="tab-content">
                <!-- Awal Cara hitung prediksi status kelulusan -->
                    <div class="tab-pane" id="tab1t2">
                        <!-- <div class="panel panel-info">
                            <div class="panel-heading"> cara hitung prediksi status kelulusan </div> -->
                            <div class="panel-body">
                                                
                                <div class="table-responsive">
                                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <!-- QUERY Perhitungan Jenis kelamin dan Status mahasiswa -->
                                        <?php

                                            // total data 'jenis-kelamin yang dicari' yg 'TEPAT' pada data training
                                            $sql = "SELECT COUNT(*) AS jumlah FROM tb_datatraining where jk = '$jk' and status_kelulusan = 'TEPAT' group by jk";
                                            $query = mysqli_query($konek_db,$sql);
                                            $result = mysqli_fetch_array($query);
                                            $jktepat = $result['jumlah'];  
                                            $hasiljktepat = $jktepat/$totaldatatepat;
                                            $hasiljktepat = number_format($hasiljktepat,3);

                                            // total data 'jenis-kelamin yang dicari' yg 'TERLAMBAT' pada data training
                                            $sql = "SELECT COUNT(*) AS jumlah FROM tb_datatraining where jk = '$jk' and status_kelulusan = 'TERLAMBAT' group by jk";
                                            $query = mysqli_query($konek_db,$sql);
                                            $result = mysqli_fetch_array($query);
                                            $jkterlambat = $result['jumlah'];
                                            $hasiljkterlambat = number_format($hasiljktepat,3);
                                            

                                            // total data 'STATUS MAHASISWA yang dicari' yg 'TEPAT' pada data training
                                            $sql = "SELECT COUNT(*) AS jumlah FROM tb_datatraining where status_mahasiswa = '$sm' and status_kelulusan = 'TEPAT' group by status_mahasiswa";
                                            $query = mysqli_query($konek_db,$sql);
                                            $result = mysqli_fetch_array($query);
                                            $smtepat = $result['jumlah'];
                                            $hasilsmtepat = $smtepat/$totaldatatepat;
                                            $hasilsmtepat = number_format($hasilsmtepat,3);
                                            

                                            // total data 'STATUS MAHASISWA yang dicari' yg 'TErlambat' pada data training
                                            $sql = "SELECT COUNT(*) AS jumlah FROM tb_datatraining where status_mahasiswa = '$sm' and status_kelulusan = 'TERLAMBAT' group by status_mahasiswa";
                                            $query = mysqli_query($konek_db,$sql);
                                            $result = mysqli_fetch_array($query);
                                            $smterlambat = $result['jumlah'];
                                            $hasilsmterlambat = $smterlambat / $totaldataterlambat;
                                            $hasilsmterlambat = number_format($hasilsmterlambat,3);
                                        ?>
                                        <!-- /Akhir QUERY Perhitungan Jenis kelamin dan Status mahasiswa -->

                                    <!-- awal perhitungan Jenis kelamin -->
                                        <tr>                                      
                                            <th colspan="4" >jumlah data JENIS KELAMIN = <i> <?php echo $jk; ?> </i> | Y= TEPAT</th>
                                            <th colspan="4">P(jumlah data JENIS KELAMIN = <i> <?php echo $jk; ?> </i> | Y= TERLAMBAT</th>
                                        </tr>
                                        <tr>              
                                            <th colspan="4"><?php echo $jktepat; ?></th>
                                            <td colspan="4"><?php if ($jkterlambat > 0) {
                                                        echo $jkterlambat;  
                                                    }else {                                                                                            
                                                        echo 0;
                                                    }; ?></td>
                                        </tr>
                                        <tr>                                      
                                            <th colspan="4" >P(JENIS KELAMIN = <i> <?php echo $jk; ?> </i> | Y= TEPAT)</th>
                                            <th colspan="4">P(JENIS KELAMIN = <i> <?php echo $jk; ?> </i> | Y= TERLAMBAT</th>
                                        </tr>
                                        <tr>              
                                            <th colspan="4"><?php
                                                    if ($jktepat > 0) {
                                                        $hasiljktepat = $jktepat/$totaldatatepat;
                                                        $hasiljktepat = number_format($hasiljktepat,3);
                                                        echo $hasiljktepat;
                                                    }else {
                                                        $jktepat=0;
                                                        $hasiljktepat = $jktepat/$totaldatatepat;
                                                        echo $hasiljktepat;
                                                    }
                                                ?></th>
                                            <th colspan="4">
                                                <?php
                                                    if ($jkterlambat > 0) {
                                                        $hasiljkterlambat = $jkterlambat / $totaldataterlambat;
                                                        $hasiljkterlambat = number_format($hasiljkterlambat,3);
                                                        echo $hasiljkterlambat;  
                                                    }else {                                      
                                                        $jkterlambat=0;
                                                        $hasiljkterlambat = $jkterlambat / $totaldataterlambat;
                                                        echo $hasiljkterlambat;
                                                    }
                                                ?>
                                            </th>
                                        </tr>
                                    <!-- /Akhir perhitungan Jenis kelamin -->

                                    <!-- awal perhitungan Status mahasiswa -->
                                        <tr>                                      
                                            <th colspan="4" >jumlah data STATUS MAHASISWA = <i> <?php echo $sm; ?> </i> | Y= TEPAT</th>
                                            <th colspan="4"> jumlah data STATUS MAHASISWA = <i> <?php echo $sm; ?> </i> | Y= TERLAMBAT</th>
                                        </tr>
                                        <tr>              
                                            <td colspan="4"><?php echo $smtepat; ?></td>
                                            <td colspan="4"><?php echo $smterlambat; ?></td>
                                        </tr>
                                        <tr>                                      
                                            <th colspan="4" >P(STATUS MAHASISWA = <i> <?php echo $sm; ?> </i> | Y= TEPAT</th>
                                            <th colspan="4">
                                                P(STATUS MAHASISWA = <i> <?php echo $sm; ?> </i> | Y= TERLAMBAT
                                            </th>
                                        </tr>
                                        <tr>              
                                            <th colspan="4" >
                                            <?php
                                                    if ($smtepat > 0) {
                                                        $hasilsmtepat = $smtepat/$totaldatatepat;
                                                        $hasilsmtepat = number_format($hasilsmtepat,3);
                                                        echo $hasilsmtepat;
                                                    }else {
                                                        $smtepat=0;
                                                        $hasilsmtepat = $smtepat/$totaldatatepat;
                                                        echo $hasilsmtepat;
                                                    }
                                                ?></th>
                                            <th colspan="4">
                                                <?php
                                                    if ($smterlambat > 0) {
                                                        $hasilsmterlambat = $smterlambat / $totaldataterlambat;
                                                        $hasilsmterlambat = number_format($hasilsmterlambat,3);
                                                        echo $hasilsmterlambat;  
                                                    }else {                                      
                                                        $smterlambat=0;
                                                        $hasilsmterlambat = $smterlambat / $totaldataterlambat;
                                                        echo $hasilsmterlambat;
                                                    }
                                                ?>
                                            </th>
                                        </tr>
                                    <!-- /Akhir perhitungan Status mahasiswa -->
                                        <tr >
                                            <th colspan="8" > <br><h3>IPK</h3>  </th>
                                        </tr>
                                        
                                        <!-- QUERY Perhitungan IPK dan Standar deviasi -->
                                        <?php
                                        // Mean IPK1 dengan keterangan TEPAT 
                                            $sql = "SELECT AVG(ipk_1) FROM tb_datatraining  WHERE status_kelulusan = 'TEPAT'";
                                            $query = mysqli_query($konek_db,$sql);
                                            $result = mysqli_fetch_array($query);
                                            $meanipk1tepat = $result[0];
                                        // Mean IPK2 dengan keterangan TEPAT 
                                            $sql = "SELECT AVG(ipk_2) FROM tb_datatraining  WHERE status_kelulusan = 'TEPAT'";
                                            $query = mysqli_query($konek_db,$sql);
                                            $result = mysqli_fetch_array($query);
                                            $meanipk2tepat = $result[0];
                                        // Mean IPK3 dengan keterangan TEPAT 
                                            $sql = "SELECT AVG(ipk_3) FROM tb_datatraining  WHERE status_kelulusan = 'TEPAT'";
                                            $query = mysqli_query($konek_db,$sql);
                                            $result = mysqli_fetch_array($query);
                                            $meanipk3tepat = $result[0];
                                        // Mean IPK4 dengan keterangan TEPAT 
                                            $sql = "SELECT AVG(ipk_4) FROM tb_datatraining  WHERE status_kelulusan = 'TEPAT'";
                                            $query = mysqli_query($konek_db,$sql);
                                            $result = mysqli_fetch_array($query);
                                            $meanipk4tepat = $result[0];

                                        // Mean IPK1 dengan keterangan TERLAMBA 
                                            $sql = "SELECT AVG(ipk_1) FROM tb_datatraining  WHERE status_kelulusan = 'TERLAMBAT'";
                                            $query = mysqli_query($konek_db,$sql);
                                            $result = mysqli_fetch_array($query);
                                            $meanipk1terlambat = $result[0];
                                        // Mean IPK2 dengan keterangan TERLAMBAT 
                                            $sql = "SELECT AVG(ipk_2) FROM tb_datatraining  WHERE status_kelulusan = 'TERLAMBAT'";
                                            $query = mysqli_query($konek_db,$sql);
                                            $result = mysqli_fetch_array($query);
                                            $meanipk2terlambat = $result[0];
                                        // Mean IPK3 dengan keterangan TERLAMBAT 
                                            $sql = "SELECT AVG(ipk_3) FROM tb_datatraining  WHERE status_kelulusan = 'TERLAMBAT'";
                                            $query = mysqli_query($konek_db,$sql);
                                            $result = mysqli_fetch_array($query);
                                            $meanipk3terlambat = $result[0];
                                        // Mean IPK4 dengan keterangan TERLAMBAT 
                                            $sql = "SELECT AVG(ipk_4) FROM tb_datatraining  WHERE status_kelulusan = 'TERLAMBAT'";
                                            $query = mysqli_query($konek_db,$sql);
                                            $result = mysqli_fetch_array($query);
                                            $meanipk4terlambat = $result[0];


                                        //standar deviasi dengan keterangan TEPAT 
                                            $sql = "SELECT STD(ipk_1) FROM tb_datatraining WHERE status_kelulusan = 'TEPAT'";
                                            $query = mysqli_query($konek_db,$sql);
                                            $result = mysqli_fetch_array($query);
                                            $sdipk1tepat = $result[0];
                                        //standar deviasi dengan keterangan TEPAT 
                                            $sql = "SELECT STD(ipk_2) FROM tb_datatraining WHERE status_kelulusan = 'TEPAT'";
                                            $query = mysqli_query($konek_db,$sql);
                                            $result = mysqli_fetch_array($query);
                                            $sdipk2tepat = $result[0];
                                        //standar deviasi dengan keterangan TEPAT 
                                            $sql = "SELECT STD(ipk_3) FROM tb_datatraining WHERE status_kelulusan = 'TEPAT'";
                                            $query = mysqli_query($konek_db,$sql);
                                            $result = mysqli_fetch_array($query);
                                            $sdipk3tepat = $result[0];
                                        //standar deviasi dengan keterangan TEPAT 
                                            $sql = "SELECT STD(ipk_4) FROM tb_datatraining WHERE status_kelulusan = 'TEPAT'";
                                            $query = mysqli_query($konek_db,$sql);
                                            $result = mysqli_fetch_array($query);
                                            $sdipk4tepat = $result[0];


                                        //standar deviasi dengan keterangan TERLAMBAT 
                                            $sql = "SELECT STD(ipk_1) FROM tb_datatraining WHERE status_kelulusan = 'TERLAMBAT'";
                                            $query = mysqli_query($konek_db,$sql);
                                            $result = mysqli_fetch_array($query);
                                            $sdipk1terlambat = $result[0];
                                        //standar deviasi dengan keterangan TERLAMBAT 
                                            $sql = "SELECT STD(ipk_2) FROM tb_datatraining WHERE status_kelulusan = 'TERLAMBAT'";
                                            $query = mysqli_query($konek_db,$sql);
                                            $result = mysqli_fetch_array($query);
                                            $sdipk2terlambat = $result[0];
                                        //standar deviasi dengan keterangan TERLAMBAT 
                                            $sql = "SELECT STD(ipk_3) FROM tb_datatraining WHERE status_kelulusan = 'TERLAMBAT'";
                                            $query = mysqli_query($konek_db,$sql);
                                            $result = mysqli_fetch_array($query);
                                            $sdipk3terlambat = $result[0];
                                        //standar deviasi dengan keterangan TERLAMBAT 
                                            $sql = "SELECT STD(ipk_4) FROM tb_datatraining WHERE status_kelulusan = 'TERLAMBAT'";
                                            $query = mysqli_query($konek_db,$sql);
                                            $result = mysqli_fetch_array($query);
                                            $sdipk4terlambat = $result[0];
                                        ?>
                                        <!-- /Akhir QUERY Perhitungan IPK dan Standar deviasi -->

                                        <!-- Awal perhitungan Mean IPK -->
                                        <tr>                                      
                                            <th><b><i>MEAN IPK SEMESTER 1 | Y = TEPAT</i></b></th>
                                            <th><b><i>MEAN IPK SEMESTER 2 | Y = TEPAT</i></b></th>
                                        <th><b><i>MEAN IPK SEMESTER 3 | Y = TEPAT</i></b></th>
                                            <th><b><i>MEAN IPK SEMESTER 4 | Y = TEPAT</i></b></th>
                                            <th><b><i>MEAN IPK SEMESTER 1 | Y = TERLAMBAT</i></b></th>
                                            <th><b><i>MEAN IPK SEMESTER 2 | Y = TERLAMBAT</i></b></th>
                                        <th><b><i>MEAN IPK SEMESTER 3 | Y = TERLAMBAT</i></b></th>
                                            <th><b><i>MEAN IPK SEMESTER 4 | Y = TERLAMBAT</i></b></th>
                                        </tr>
                                        <tr>              
                                            <td><?php $meanipk1tepat = number_format($meanipk1tepat,8); echo $meanipk1tepat; ?></td>
                                            <td><?php $meanipk2tepat = number_format($meanipk2tepat,8); echo $meanipk2tepat; ?></td>
                                            <td><?php $meanipk3tepat = number_format($meanipk3tepat,8); echo $meanipk3tepat; ?></td>
                                            <td><?php $meanipk4tepat = number_format($meanipk4tepat,8); echo $meanipk4tepat; ?></td>
                                            <td><?php $meanipk1terlambat = number_format($meanipk1terlambat,8); echo $meanipk1terlambat; ?></td>
                                            <td><?php $meanipk2terlambat = number_format($meanipk2terlambat,8); echo $meanipk2terlambat; ?></td>
                                            <td><?php $meanipk3terlambat = number_format($meanipk3terlambat,8); echo $meanipk3terlambat; ?></td>
                                            <td><?php $meanipk4terlambat = number_format($meanipk4terlambat,8); echo $meanipk4terlambat; ?></td>
                                        </tr>
                                        <!-- /Akhir perhitungan Mean IPK -->
                                        
                                        <!-- Awal perhitungan Standar Deviasi IPK -->
                                        <tr>                                      
                                            <th><b><i>standar deviasi IPK SEMESTER 1 | Y = TEPAT</i></b></th>
                                            <th><b><i>standar deviasi IPK SEMESTER 2 | Y = TEPAT</i></b></th>
                                        <th><b><i>standar deviasi IPK SEMESTER 3 | Y = TEPAT</i></b></th>
                                            <th><b><i>standar deviasi IPK SEMESTER 4 | Y = TEPAT</i></b></th>
                                            <th><b><i>standar deviasi IPK SEMESTER 1 | Y = TERLAMBAT</i></b></th>
                                            <th><b><i>standar deviasi IPK SEMESTER 2 | Y = TERLAMBAT</i></b></th>
                                        <th><b><i>standar deviasi IPK SEMESTER 3 | Y = TERLAMBAT</i></b></th>
                                            <th><b><i>standar deviasi IPK SEMESTER 4 | Y = TERLAMBAT</i></b></th>
                                        </tr>
                                        <tr>              
                                                        
                                            <td><?php $sdipk1tepat = number_format($sdipk1tepat,8);  echo $sdipk1tepat; ?></td>
                                            <td><?php $sdipk2tepat = number_format($sdipk2tepat,8); echo $sdipk2tepat; ?></td>
                                            <td><?php $sdipk3tepat = number_format($sdipk3tepat,8); echo $sdipk3tepat; ?></td>
                                            <td><?php $sdipk4tepat = number_format($sdipk4tepat,8); echo $sdipk4tepat; ?></td>
                                            <td><?php $sdipk1terlambat = number_format($sdipk1terlambat,8); echo $sdipk1terlambat; ?></td>
                                            <td><?php $sdipk2terlambat = number_format($sdipk2terlambat,8); echo $sdipk2terlambat; ?></td>
                                            <td><?php $sdipk3terlambat = number_format($sdipk3terlambat,8); echo $sdipk3terlambat; ?></td>
                                            <td><?php $sdipk4terlambat = number_format($sdipk4terlambat,8); echo $sdipk4terlambat; ?></td>
                                        </tr>
                                        <!-- /Akhir perhitungan Standar Deviasi IPK-->

                                        <!-- Awal perhitungan IPK -->
                                        <tr>
                                            <th>P(IPK semester 1 | Y= TEPAT</th>
                                            <td>
                                                <?php
                                                    //  $nilai_bilangan = 9;
                                                    // $hasil_akar    =sqrt($nilai_bilangan);
                                                    // echo $hasil_akar;


                                                    // rumusnya
                                                    // keterangan
                                                    // w = yang dicari.
                                                    // e merupakan tetapan = 2.7183 
                                                    // (fw) =(1/akar{2xpixstandar_deviasi})*e^-(w-ratarata)^2/2*(standardeviasi^2)
                                                    // pertama cari yang di dluar pangkat.
                                                    //
                                                    $pangkat2 = 2;
                                                    $etetap = 2.7183; 
                                                    $hasil = (1/sqrt(2*3.14*$sdipk1tepat));
                                                    // mengubah format data jadi 3 aangka dibelakang koma
                                                    $hasil = number_format($hasil,3);
                                                    
                                                    $e =-(pow(($ipk1-$meanipk1tepat),$pangkat2))/2*(pow($sdipk1tepat,$pangkat2));
                                                    // mengubah format data jadi 3 aangka dibelakang koma
                                                    $e = number_format($e,3);

                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);

                                                    $coba = $hasil*$perkalian;
                                                    $coba = number_format($coba,8);
                                                    if (is_nan($coba)) {
                                                        echo 0;
                                                    }
                                                    elseif(is_infinite($coba)){
                                                        echo 0;
                                                    }else{
                                                        echo $coba;
                                                    } 
                                                ?>
                                            </td>
                                            <th>P(IPK semester 2 | Y= TEPAT</th>
                                            <td>
                                                <?php 
                                                    $hasil = (1/sqrt(2*3.14*$sdipk2tepat));
                
                                                    $e =-(pow(($ipk2-$meanipk2tepat),$pangkat2))/2*(pow($sdipk2tepat,$pangkat2));
                                                    $e = number_format($e,3);

                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);

                                                    $coba2 = $hasil*$perkalian;
                                                    $coba2 = number_format($coba2,8);
                                                    if (is_nan($coba2)) {
                                                        echo 0;
                                                    }
                                                    elseif(is_infinite($coba2)){
                                                        echo 0;
                                                    }else{
                                                        echo $coba2;
                                                    } 
                                                ?>       
                                            </td>
                                            <th>P(IPK semester 3 | Y= TEPAT</th>
                                            <td>
                                                <?php 
                                                    $hasil = (1/sqrt(2*3.14*$sdipk3tepat));
                
                                                    $e =-(pow(($ipk3-$meanipk3tepat),$pangkat2))/2*(pow($sdipk3tepat,$pangkat2));
                                                    $e = number_format($e,3);

                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);

                                                    $coba3 = $hasil*$perkalian;
                                                    $coba3 = number_format($coba3,8);
                                                    if (is_nan($coba3)) {
                                                        echo 0;
                                                    }
                                                    elseif(is_infinite($coba3)){
                                                        echo 0;
                                                    }else{
                                                        echo $coba3;
                                                    } 
                                                ?>
                                            </td>
                                            <th>P(IPK semester 4 | Y= TEPAT</th>
                                            <td>
                                                <?php 
                                                    $hasil = (1/sqrt(2*3.14*$sdipk4tepat));
                
                                                    $e =-(pow(($ipk4-$meanipk4tepat),$pangkat2))/2*(pow($sdipk4tepat,$pangkat2));
                                                    $e = number_format($e,3);

                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);

                                                    $coba4 = $hasil*$perkalian;
                                                    $coba4 = number_format($coba4,8);
                                                    if (is_nan($coba4)) {
                                                        echo 0;
                                                    }
                                                    elseif(is_infinite($coba4)){
                                                        echo 0;
                                                    }else{
                                                        echo $coba4;
                                                    } 
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>P(IPK semester 1 | Y= TERLAMBAT</th>
                                            <td>
                                                <?php 
                                                    $hasil = (1/sqrt(2*3.14*$sdipk1terlambat));
                
                                                    $e =-(pow(($ipk1-$meanipk1terlambat),$pangkat2))/2*(pow($sdipk1terlambat,$pangkat2));
                                                    $e = number_format($e,3);

                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);

                                                    $coba5 = $hasil*$perkalian;
                                                    $coba5 = number_format($coba5,8);
                                                    if (is_nan($coba5)) {
                                                        echo 0;
                                                    }
                                                    elseif(is_infinite($coba5)){
                                                        echo 0;
                                                    }else{
                                                        echo $coba5;
                                                    } 
                                                ?>
                                            </td>
                                            <th>P(IPK semester 2 | Y= TERLAMBAT</th>
                                            <td>
                                                <?php 
                                                    $hasil = (1/sqrt(2*3.14*$sdipk2terlambat));
                
                                                    $e =-(pow(($ipk2-$meanipk2terlambat),$pangkat2))/2*(pow($sdipk2terlambat,$pangkat2));
                                                    $e = number_format($e,3);

                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);

                                                    $coba6 = $hasil*$perkalian;
                                                    $coba6 = number_format($coba6,8);
                                                    if (is_nan($coba6)) {
                                                        echo 0;
                                                    }
                                                    elseif(is_infinite($coba6)){
                                                        echo 0;
                                                    }else{
                                                        echo $coba6;
                                                    } 
                                                ?>
                                            </td>
                                            <th>P(IPK semester 3 | Y= TERLAMBAT</th>
                                            <td>
                                                <?php 
                                                    $hasil = (1/sqrt(2*3.14*$sdipk3terlambat));
                
                                                    $e =-(pow(($ipk3-$meanipk3terlambat),$pangkat2))/2*(pow($sdipk3terlambat,$pangkat2));
                                                    $e = number_format($e,3);

                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);

                                                    $coba7 = $hasil*$perkalian;
                                                    $coba7 = number_format($coba7,8);
                                                    if (is_nan($coba7)) {
                                                        echo 0;
                                                    }
                                                    elseif(is_infinite($coba7)){
                                                        echo 0;
                                                    }else{
                                                        echo $coba7;
                                                    } 
                                                ?>
                                            </td>
                                            <th>P(IPK semester 4 | Y= TERLAMBAT</th>
                                            <td>
                                                <?php 
                                                    $hasil = (1/sqrt(2*3.14*$sdipk4terlambat));
                
                                                    $e =-(pow(($ipk4-$meanipk4terlambat),$pangkat2))/2*(pow($sdipk4terlambat,$pangkat2));
                                                    $e = number_format($e,3);

                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);

                                                    $coba8 = $hasil*$perkalian;
                                                    $coba8 = number_format($coba8,8);
                                                    if (is_nan($coba8)) {
                                                        echo 0;
                                                    }
                                                    elseif(is_infinite($coba8)){
                                                        echo 0;
                                                    }else{
                                                        echo $coba8;
                                                    } 
                                                ?>
                                            </td>
                                        </tr>
                                        <!-- /Akhir perhitungan IPK -->
                            
                                        <tr >
                                            <th colspan="8" > <br><h3>IPS</h3>  </th>
                                        </tr>
                                        
                                        <!-- QUERY Perhitungan IPS dan Standar deviasi -->
                                        <?php
                                            // Mean IPS1 dengan keterangan TEPAT 
                                                $sql = "SELECT AVG(ips_1) FROM tb_datatraining  WHERE status_kelulusan = 'TEPAT'";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $meanips1tepat = $result[0];
                                            // Mean IPS2 dengan keterangan TEPAT 
                                                $sql = "SELECT AVG(ips_2) FROM tb_datatraining  WHERE status_kelulusan = 'TEPAT'";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $meanips2tepat = $result[0];
                                            // Mean IPS3 dengan keterangan TEPAT 
                                                $sql = "SELECT AVG(ips_3) FROM tb_datatraining  WHERE status_kelulusan = 'TEPAT'";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $meanips3tepat = $result[0];
                                            // Mean IPS4 dengan keterangan TEPAT 
                                                $sql = "SELECT AVG(ips_4) FROM tb_datatraining  WHERE status_kelulusan = 'TEPAT'";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $meanips4tepat = $result[0];

                                            // Mean IPS1 dengan keterangan TERLAMBAT 
                                                $sql = "SELECT AVG(ips_1) FROM tb_datatraining  WHERE status_kelulusan = 'TERLAMBAT'";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $meanips1terlambat = $result[0];
                                            // Mean IPS2 dengan keterangan TERLAMBAT 
                                                $sql = "SELECT AVG(ips_2) FROM tb_datatraining  WHERE status_kelulusan = 'TERLAMBAT'";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $meanips2terlambat = $result[0];
                                            // Mean IPS3 dengan keterangan TERLAMBAT 
                                                $sql = "SELECT AVG(ips_3) FROM tb_datatraining  WHERE status_kelulusan = 'TERLAMBAT'";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $meanips3terlambat = $result[0];
                                            // Mean IPS4 dengan keterangan TERLAMBAT 
                                                $sql = "SELECT AVG(ips_4) FROM tb_datatraining  WHERE status_kelulusan = 'TERLAMBAT'";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $meanips4terlambat = $result[0];

                                            //standar deviasi dengan keterangan TEPAT 
                                                $sql = "SELECT STD(ips_1) FROM tb_datatraining WHERE status_kelulusan = 'TEPAT'";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $sdips1tepat = $result[0];
                                            //standar deviasi dengan keterangan TEPAT 
                                                $sql = "SELECT STD(ips_2) FROM tb_datatraining WHERE status_kelulusan = 'TEPAT'";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $sdips2tepat = $result[0];
                                            //standar deviasi dengan keterangan TEPAT 
                                                $sql = "SELECT STD(ips_3) FROM tb_datatraining WHERE status_kelulusan = 'TEPAT'";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $sdips3tepat = $result[0];
                                            //standar deviasi dengan keterangan TEPAT 
                                                $sql = "SELECT STD(ips_4) FROM tb_datatraining WHERE status_kelulusan = 'TEPAT'";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $sdips4tepat = $result[0];

                                            //standar deviasi dengan keterangan TERLAMBAT 
                                                $sql = "SELECT STD(ips_1) FROM tb_datatraining WHERE status_kelulusan = 'TERLAMBAT'";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $sdips1terlambat = $result[0];
                                            //standar deviasi dengan keterangan TERLAMBAT 
                                                $sql = "SELECT STD(ips_2) FROM tb_datatraining WHERE status_kelulusan = 'TERLAMBAT'";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $sdips2terlambat = $result[0];
                                            //standar deviasi dengan keterangan TERLAMBAT 
                                                $sql = "SELECT STD(ips_3) FROM tb_datatraining WHERE status_kelulusan = 'TERLAMBAT'";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $sdips3terlambat = $result[0];
                                            //standar deviasi dengan keterangan TERLAMBAT 
                                                $sql = "SELECT STD(ips_4) FROM tb_datatraining WHERE status_kelulusan = 'TERLAMBAT'";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $sdips4terlambat = $result[0];
                                        ?>
                                        <!-- /Akhir QUERY Perhitungan IPK dan Standar deviasi -->
                                        
                                        <!-- Awal perhitungan Mean IPS -->
                                        <tr>                                      
                                            <th><b><i>MEAN IPS SEMESTER 1 | Y = TEPAT</i></b></th>
                                            <th><b><i>MEAN IPS SEMESTER 2 | Y = TEPAT</i></b></th>
                                            <th><b><i>MEAN IPS SEMESTER 3 | Y = TEPAT</i></b></th>
                                            <th><b><i>MEAN IPS SEMESTER 4 | Y = TEPAT</i></b></th>
                                            <th><b><i>MEAN IPS SEMESTER 1 | Y = TERLAMBAT</i></b></th>
                                            <th><b><i>MEAN IPS SEMESTER 2 | Y = TERLAMBAT</i></b></th>
                                            <th><b><i>MEAN IPS SEMESTER 3 | Y = TERLAMBAT</i></b></th>
                                            <th><b><i>MEAN IPS SEMESTER 4 | Y = TERLAMBAT</i></b></th>
                                        </tr>
                                        <tr>              
                                            <td><?php $meanips1tepat = number_format($meanips1tepat,8); echo $meanips1tepat; ?></td>
                                            <td><?php $meanips2tepat = number_format($meanips2tepat,8); echo $meanips2tepat; ?></td>
                                            <td><?php $meanips3tepat = number_format($meanips3tepat,8); echo $meanips3tepat; ?></td>
                                            <td><?php $meanips4tepat = number_format($meanips4tepat,8); echo $meanips4tepat; ?></td>
                                            <td><?php $meanips1terlambat = number_format($meanips1terlambat,8); echo $meanips1terlambat; ?></td>
                                            <td><?php $meanips2terlambat = number_format($meanips2terlambat,8); echo $meanips2terlambat; ?></td>
                                            <td><?php $meanips3terlambat = number_format($meanips3terlambat,8); echo $meanips3terlambat; ?></td>
                                            <td><?php $meanips4terlambat = number_format($meanips4terlambat,8); echo $meanips4terlambat; ?></td>
                                        </tr>
                                        <!-- /Akhir perhitungan Mean IPS -->

                                        <!-- Awal perhitungan Standar deviasi IPS -->
                                        <tr>                                      
                                            <th><b><i>standar deviasi IPS SEMESTER 1 | Y = TEPAT</i></b></th>
                                            <th><b><i>standar deviasi IPS SEMESTER 2 | Y = TEPAT</i></b></th>
                                        <th><b><i>standar deviasi IPS SEMESTER 3 | Y = TEPAT</i></b></th>
                                            <th><b><i>standar deviasi IPS SEMESTER 4 | Y = TEPAT</i></b></th>
                                            <th><b><i>standar deviasi IPS SEMESTER 1 | Y = TERLAMBAT</i></b></th>
                                            <th><b><i>standar deviasi IPS SEMESTER 2 | Y = TERLAMBAT</i></b></th>
                                        <th><b><i>standar deviasi IPS SEMESTER 3 | Y = TERLAMBAT</i></b></th>
                                            <th><b><i>standar deviasi IPS SEMESTER 4 | Y = TERLAMBAT</i></b></th>
                                        </tr>
                                        <tr>              
                                            <td><?php $sdips1tepat = number_format($sdips1tepat,8); echo $sdips1tepat; ?></td>
                                            <td><?php $sdips2tepat = number_format($sdips2tepat,8); echo $sdips2tepat; ?></td>
                                            <td><?php $sdips3tepat = number_format($sdips3tepat,8); echo $sdips3tepat; ?></td>
                                            <td><?php $sdips4tepat = number_format($sdips4tepat,8); echo $sdips4tepat; ?></td>
                                            <td><?php $sdips1terlambat = number_format($sdips1terlambat,8); echo $sdips1terlambat; ?></td>
                                            <td><?php $sdips2terlambat = number_format($sdips2terlambat,8); echo $sdips2terlambat; ?></td>
                                            <td><?php $sdips3terlambat = number_format($sdips3terlambat,8); echo $sdips3terlambat; ?></td>
                                            <td><?php $sdips4terlambat = number_format($sdips4terlambat,8); echo $sdips4terlambat; ?></td>
                                        </tr>
                                        <!-- /Akhir perhitungan Standar deviasi IPS -->
                                        
                                        <!-- Awal perhitungan IPS -->
                                        <tr>
                                            <th>P(IPS semester 1 | Y= TEPAT</th>
                                            <td>
                                                <?php
                                                    //  $nilai_bilangan = 9;
                                                    // $hasil_akar    =sqrt($nilai_bilangan);
                                                    // echo $hasil_akar;


                                                    // rumusnya
                                                    // keterangan
                                                    // w = yang dicari.
                                                    // e merupakan tetapan = 2.7183 
                                                    // (fw) =(1/akar{2xpixstandar_deviasi})*e^-(w-ratarata)^2/standardeviasi^2
                                                    // pertama cari yang di dluar pangkat.
                                                    //
                                                    $pangkat2 = 2;
                                                    $etetap = 2.7183; 
                                                    $hasil = (1/sqrt(2*3.14*$sdips1tepat));
                                                    
                                                    $e =-(pow(($ips1-$meanips1tepat),$pangkat2))/2*(pow($sdips1tepat,$pangkat2));
                                                    $e = number_format($e,3);

                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);

                                                    $coba9 = $hasil*$perkalian;
                                                    $coba9 = number_format($coba9,8);
                                                    if (is_nan($coba9)) {
                                                        echo 0;
                                                    }
                                                    elseif(is_infinite($coba9)){
                                                        echo 0;
                                                    }else{
                                                        echo $coba9;
                                                    }  
                                                ?>
                                            </td>
                                            <th>P(IPS semester 2 | Y= TEPAT</th>
                                            <td>
                                                <?php 
                                                    $hasil = (1/sqrt(2*3.14*$sdips2tepat));
                                                    
                                                    $e =-(pow(($ips2-$meanips2tepat),$pangkat2))/2*(pow($sdips2tepat,$pangkat2));
                                                    $e = number_format($e,3);

                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);

                                                    $coba10 = $hasil*$perkalian;
                                                    $coba10 = number_format($coba10,8);;
                                                    if (is_nan($coba10)) {
                                                        echo 0;
                                                    }
                                                    elseif(is_infinite($coba10)){
                                                        echo 0;
                                                    }else{
                                                        echo $coba10;
                                                    } 
                                                ?>
                                            </td>
                                            <th>P(IPS semester 3 | Y= TEPAT</th>
                                            <td>
                                                <?php 
                                                    $hasil = (1/sqrt(2*3.14*$sdips3tepat));
                                                    
                                                    $e =-(pow(($ips3-$meanips3tepat),$pangkat2))/2*(pow($sdips3tepat,$pangkat2));
                                                    $e = number_format($e,3);

                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);

                                                    $coba11 = $hasil*$perkalian;
                                                    $coba11 = number_format($coba11,8);
                                                    if (is_nan($coba11)) {
                                                        echo 0;
                                                    }
                                                    elseif(is_infinite($coba11)){
                                                        echo 0;
                                                    }else{
                                                        echo $coba11;
                                                    } 
                                                ?>
                                            </td>
                                            <th>P(IPS semester 4 | Y= TEPAT</th>
                                            <td>
                                                <?php 
                                                    $hasil = (1/sqrt(2*3.14*$sdips4tepat));
                                                    
                                                    $e =-(pow(($ips4-$meanips4tepat),$pangkat2))/2*(pow($sdips4tepat,$pangkat2));
                                                    $e = number_format($e,3);

                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);

                                                    $coba12 = $hasil*$perkalian;
                                                    $coba12 = number_format($coba12,8);
                                                    if (is_nan($coba12)) {
                                                        echo 0;
                                                    }
                                                    elseif(is_infinite($coba12)){
                                                        echo 0;
                                                    }else{
                                                        echo $coba12;
                                                    } 
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>P(IPS semester 1 | Y= TERLAMBAT</th>
                                            <td>
                                                <?php 
                                                    $hasil = (1/sqrt(2*3.14*$sdips1terlambat));
                                                    
                                                    $e =-(pow(($ips1-$meanips1terlambat),$pangkat2))/2*(pow($sdips1terlambat,$pangkat2));
                                                    $e = number_format($e,3);

                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);

                                                    $coba13 = $hasil*$perkalian;
                                                    $coba13 = number_format($coba13,8);
                                                    if (is_nan($coba13)) {
                                                        echo 0;
                                                    }
                                                    elseif(is_infinite($coba13)){
                                                        echo 0;
                                                    }else{
                                                        echo $coba13;
                                                    } 
                                                ?>
                                            </td>
                                            <th>P(IPS semester 2 | Y= TERLAMBAT</th>
                                            <td>
                                                <?php 
                                                    $hasil = (1/sqrt(2*3.14*$sdips2terlambat));
                                                    
                                                    $e =-(pow(($ips2-$meanips2terlambat),$pangkat2))/2*(pow($sdips2terlambat,$pangkat2));
                                                    $e = number_format($e,8);

                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,8);

                                                    $coba14 = $hasil*$perkalian;
                                                    $coba14 = number_format($coba14,8);
                                                    if (is_nan($coba14)) {
                                                        echo 0;
                                                    }
                                                    elseif(is_infinite($coba14)){
                                                        echo 0;
                                                    }else{
                                                        echo $coba14;
                                                    }  
                                                ?>
                                            </td>
                                            <th>P(IPS semester 3 | Y= TERLAMBAT</th>
                                            <td>
                                                <?php 
                                                    $hasil = (1/sqrt(2*3.14*$sdips3terlambat));
                                                    
                                                    $e =-(pow(($ips3-$meanips3terlambat),$pangkat2))/2*(pow($sdips3terlambat,$pangkat2));
                                                    $e = number_format($e,3);

                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);

                                                    $coba15 = $hasil*$perkalian;
                                                    $coba15 = number_format($coba15,8);
                                                    if (is_nan($coba15)) {
                                                        echo 0;
                                                    }
                                                    elseif(is_infinite($coba15)){
                                                        echo 0;
                                                    }else{
                                                        echo $coba15;
                                                    } 
                                                ?>
                                            </td>
                                            <th>P(IPS semester 4 | Y= TERLAMBAT</th>
                                            <td>
                                                <?php 
                                                    $hasil = (1/sqrt(2*3.14*$sdips4terlambat));
                                                    
                                                    $e =-(pow(($ips4-$meanips4terlambat),$pangkat2))/2*(pow($sdips4terlambat,$pangkat2));
                                                    $e = number_format($e,3);

                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);

                                                    $coba16 = $hasil*$perkalian;
                                                    $coba16 = number_format($coba16,8);
                                                    if (is_nan($coba16)) {
                                                        echo 0;
                                                    }
                                                    elseif(is_infinite($coba16)){
                                                        echo 0;
                                                    }else{
                                                        echo $coba16;
                                                    } 
                                                ?>
                                            </td>
                                        </tr>
                                        <!-- Akhir perhitungan IPS -->
                                    </table>
                                </div>
                            </div>
                        <!-- </div> -->                           
                    </div>
                <!-- /Akhir Cara hitung prediksi status kelulusan -->

                <!-- AWAL cara hitung prediksi masa studi -->
                    <div class="tab-pane" id="tab2t2">
                        <!-- <div class="panel panel-info">
                            <div class="panel-heading"> cara hitung prediksi Masa studi </div> -->
                            <div class="panel-body">
                                <!-- query untuk menghitung total data jenis kelamin dan status mahasiswa  -->
                                <?php  
                                // total data 'jenis-kelamin yang dicari' yg Semester 7 pada data training
									$sql = "SELECT COUNT(*) AS jumlah FROM tb_datatraining where jk = '$jk' and masa_studi =7 group by jk";
									$query = mysqli_query($konek_db,$sql);
									$result = mysqli_fetch_array($query);
									$jkms7 = $result['jumlah'];  
									$hasiljkms7 = $jkms7/$totaldatams7;
									$hasiljkms7 = number_format($hasiljkms7,3);
									
								// total data 'jenis-kelamin yang dicari' yg Semester 8 pada data training
									$sql = "SELECT COUNT(*) AS jumlah FROM tb_datatraining where jk = '$jk' and masa_studi =8 group by jk";
									$query = mysqli_query($konek_db,$sql);
									$result = mysqli_fetch_array($query);
									$jkms8 = $result['jumlah'];  
									$hasiljkms8 = $jkms8/$totaldatams8;
									$hasiljkms8 = number_format($hasiljkms8,3);
									
								// total data 'jenis-kelamin yang dicari' yg Semester 9 pada data training
									$sql = "SELECT COUNT(*) AS jumlah FROM tb_datatraining where jk = '$jk' and masa_studi =9 group by jk";
									$query = mysqli_query($konek_db,$sql);
									$result = mysqli_fetch_array($query);
									$jkms9 = $result['jumlah'];  
									$hasiljkms9 = $jkms9/$totaldatams9;
									$hasiljkms9 = number_format($hasiljkms9,3);
									
								// total data 'jenis-kelamin yang dicari' yg Semester 10 pada data training
									$sql = "SELECT COUNT(*) AS jumlah FROM tb_datatraining where jk = '$jk' and masa_studi =10 group by jk";
									$query = mysqli_query($konek_db,$sql);
									$result = mysqli_fetch_array($query);
									$jkms10 = $result['jumlah'];  
									$hasiljkms10 = $jkms10/$totaldatams10;
									$hasiljkms10 = number_format($hasiljkms10,3);
									
								// total data 'STATUS MAHASISWA yang dicari' yg Semester 7 pada data training
									$sql = "SELECT COUNT(*) AS jumlah FROM tb_datatraining where status_mahasiswa = '$sm' and masa_studi =7 group by status_mahasiswa";
									$query = mysqli_query($konek_db,$sql);
									$result = mysqli_fetch_array($query);
									$smms7 = $result['jumlah'];
									$hasilsmms7 = $smms7/$totaldatams7;
									$hasilsmms7 = number_format($hasilsmms7,3);
									
								// total data 'STATUS MAHASISWA yang dicari' yg Semester 8 pada data training
									$sql = "SELECT COUNT(*) AS jumlah FROM tb_datatraining where status_mahasiswa = '$sm' and masa_studi =8 group by status_mahasiswa";
									$query = mysqli_query($konek_db,$sql);
									$result = mysqli_fetch_array($query);
									$smms8 = $result['jumlah'];
									$hasilsmms8 = $smms8/$totaldatams8;
									$hasilsmms8 = number_format($hasilsmms8,3);

								// total data 'STATUS MAHASISWA yang dicari' yg Semester 9 pada data training
									$sql = "SELECT COUNT(*) AS jumlah FROM tb_datatraining where status_mahasiswa = '$sm' and masa_studi =9 group by status_mahasiswa";
									$query = mysqli_query($konek_db,$sql);
									$result = mysqli_fetch_array($query);
									$smms9 = $result['jumlah'];
									$hasilsmms9 = $smms9/$totaldatams9;
									$hasilsmms9 = number_format($hasilsmms9,3);

								// total data 'STATUS MAHASISWA yang dicari' yg Semester 10 pada data training
									$sql = "SELECT COUNT(*) AS jumlah FROM tb_datatraining where status_mahasiswa = '$sm' and masa_studi =10 group by status_mahasiswa";
									$query = mysqli_query($konek_db,$sql);
									$result = mysqli_fetch_array($query);
									$smms10 = $result['jumlah'];
									$hasilsmms10 = $smms10/$totaldatams10;
      
                                ?>
                                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <!-- awal baris menghitung jenis kelamin -->
                                        <tr>
                                            <th colspan="8" >
                                                <h3>Jenis Kelamin</h3>
                                            </th>
                                        </tr>          
                                        <tr>                                      
                                            <th colspan="4" >Jumlah data JENIS KELAMIN = <i> <?php echo $jk; ?> </i> | Y= 7 semester</th>
                                            <td colspan="4" ><?php echo $jkms7; ?></td>  
                                        </tr>
                                        <tr>
                                            <th colspan="4">Jumlah data JENIS KELAMIN = <i> <?php echo $jk; ?> </i> | Y= 8 semester</th>
                
                                            <td colspan="4" ><?php if ($jkms8 > 0) {
                                                echo $jkms8;
                                            }else {
                                                echo 0;
                                            } ?></td>              
                                        </tr>
                                        <tr>
                                            <th colspan="4">Jumlah data JENIS KELAMIN = <i> <?php echo $jk; ?> </i> | Y= 9 semester</th>
                
                                            <td colspan="4" ><?php if ($jkms9 > 0) {
                                                echo $jkms9;
                                            }else {
                                                echo 0;
                                            } ?></td>              
                                        </tr>
                                        <tr>
                                            <th colspan="4">Jumlah data JENIS KELAMIN = <i> <?php echo $jk; ?> </i> | Y= 10 semester</th>
                
                                            <td colspan="4" ><?php if ($jkms10 > 0) {
                                                echo $jkms10;
                                            }else {
                                                echo 0;
                                            } ?></td>              
                                        </tr>
                                        <tr>                                      
                                            <th colspan="4" >(JENIS KELAMIN = <i> <?php echo $jk; ?> </i> | Y= 7 semester) / total data </th>
                                            <td colspan="4" ><?php echo $hasiljkms7; ?></td>  
                                        </tr>
                                        <tr>
                                            <th colspan="4">(JENIS KELAMIN = <i> <?php echo $jk; ?> </i> | Y= 8 semester) / total data </th>
                
                                            <td colspan="4" ><?php if ($hasiljkms8 > 0) {
                                                echo $hasiljkms8;
                                            }else {
                                                echo 0;
                                            } ?></td>              
                                        </tr>
                                        <tr>
                                            <th colspan="4">(JENIS KELAMIN = <i> <?php echo $jk; ?> </i> | Y= 9 semester) / total data </th>
                
                                            <td colspan="4" ><?php if ($hasiljkms9 > 0) {
                                                echo $hasiljkms9;
                                            }else {
                                                echo 0;
                                            } ?></td>              
                                        </tr>
                                        <tr>
                                            <th colspan="4">(JENIS KELAMIN = <i> <?php echo $jk; ?> </i> | Y= 10 semester) / total data </th>
                
                                            <td colspan="4" ><?php if ($hasiljkms10 > 0) {
                                                echo $hasiljkms10;
                                            }else {
                                                echo 0;
                                            } ?></td>              
                                        </tr>
                                    <!-- akhir baris menghitung jenis kelamin -->
                                    <tr>
                                        <th colspan="8" >
                                            <h3>Status Mahasiswa</h3>
                                        </th>
                                    </tr>
                                    <!-- Awal baris menghitung status mahasiswa -->
                                        <tr>                                      
                                            <th colspan="4" >Jumlah data Status Mahasiswa = <i> <?php echo $sm; ?> </i> | Y= 7 semester</th>
                                            <td colspan="4" ><?php echo $smms7; ?></td>  
                                        </tr>
                                        <tr>
                                            <th colspan="4">Jumlah data Status Mahasiswa = <i> <?php echo $sm; ?> </i> | Y= 8 semester</th>
                
                                            <td colspan="4" ><?php if ($smms8 > 0) {
                                                echo $smms8;
                                            }else {
                                                echo 0;
                                            } ?></td>              
                                        </tr>
                                        <tr>
                                            <th colspan="4">Jumlah data Status Mahasiswa = <i> <?php echo $sm; ?> </i> | Y= 9 semester</th>
                
                                            <td colspan="4" ><?php if ($smms9 > 0) {
                                                echo $smms9;
                                            }else {
                                                echo 0;
                                            } ?></td>              
                                        </tr>
                                        <tr>
                                            <th colspan="4">Jumlah data Status Mahasiswa = <i> <?php echo $sm; ?> </i> | Y= 10 semester</th>
                
                                            <td colspan="4" ><?php if ($smms10 > 0) {
                                                echo $smms10;
                                            }else {
                                                echo 0;
                                            } ?></td>              
                                        </tr>
                                        <tr>                                      
                                            <th colspan="4" >(Status Mahasiswa = <i> <?php echo $sm; ?> </i> | Y= 7 semester) / total data </th>
                                            <td colspan="4" ><?php echo $hasilsmms7; ?></td>  
                                        </tr>
                                        <tr>
                                            <th colspan="4">(Status Mahasiswa = <i> <?php echo $sm; ?> </i> | Y= 8 semester) / total data </th>
                
                                            <td colspan="4" ><?php if ($hasilsmms8 > 0) {
                                                echo $hasilsmms8;
                                            }else {
                                                echo 0;
                                            } ?></td>              
                                        </tr>
                                        <tr>
                                            <th colspan="4">(Status Mahasiswa = <i> <?php echo $sm; ?> </i> | Y= 8 semester) / total data </th>
                
                                            <td colspan="4" ><?php if ($hasilsmms9 > 0) {
                                                echo $hasilsmms9;
                                            }else {
                                                echo 0;
                                            } ?></td>              
                                        </tr>
                                        <tr>
                                            <th colspan="4">(Status Mahasiswa = <i> <?php echo $sm; ?> </i> | Y= 8 semester) / total data </th>
                
                                            <td colspan="4" ><?php if ($hasilsmms10 > 0) {
                                                echo $hasilsmms10;
                                            }else {
                                                echo 0;
                                            } ?></td>              
                                        </tr>
                                    <!-- akhir baris menghitung status mahasiswa -->
                                    <tr>
                                        <th colspan="8" >
                                            <h3>IPK</h3>
                                        </th>
                                    </tr>
                                    <!-- awal baris untuk menghitung MEAN dan standar deviasi IPK -->
                                        <?php
                                            // Masa studi = 7
                                                // Mean IPK1 dengan keterangan semester 7 
                                                    $sql = "SELECT AVG(ipk_1) FROM tb_datatraining  WHERE masa_studi =7";
                                                    $query = mysqli_query($konek_db,$sql);
                                                    $result = mysqli_fetch_array($query);
                                                    $meanipk1ms7 = $result[0];
                                                    $meanipk1ms7 = number_format($meanipk1ms7,3);
                                                // Mean IPK2 dengan keterangan semester 7 
                                                    $sql = "SELECT AVG(ipk_2) FROM tb_datatraining  WHERE masa_studi =7";
                                                    $query = mysqli_query($konek_db,$sql);
                                                    $result = mysqli_fetch_array($query);
                                                    $meanipk2ms7 = $result[0];
                                                    $meanipk2ms7 = number_format($meanipk2ms7,3);
                                                // Mean IPK3 dengan keterangan semester 7 
                                                    $sql = "SELECT AVG(ipk_3) FROM tb_datatraining  WHERE masa_studi =7";
                                                    $query = mysqli_query($konek_db,$sql);
                                                    $result = mysqli_fetch_array($query);
                                                    $meanipk3ms7 = $result[0];
                                                    $meanipk3ms7 = number_format($meanipk3ms7,3);
                                                // Mean IPK4 dengan keterangan semester 7 
                                                    $sql = "SELECT AVG(ipk_4) FROM tb_datatraining  WHERE masa_studi =7";
                                                    $query = mysqli_query($konek_db,$sql);
                                                    $result = mysqli_fetch_array($query);
                                                    $meanipk4ms7 = $result[0];
                                                    $meanipk4ms7 = number_format($meanipk4ms7,3);
                                                //standar deviasi IPK dengan keterangan  semester 7 
                                                    $sql = "SELECT STD(ipk_1) FROM tb_datatraining WHERE masa_studi =7";
                                                    $query = mysqli_query($konek_db,$sql);
                                                    $result = mysqli_fetch_array($query);
                                                    $sdipk1ms7 = $result[0];
                                                    $sdipk1ms7 = number_format($sdipk1ms7,3);
                                                //standar deviasi IPK dengan keterangan semester 7 
                                                    $sql = "SELECT STD(ipk_2) FROM tb_datatraining WHERE masa_studi =7";
                                                    $query = mysqli_query($konek_db,$sql);
                                                    $result = mysqli_fetch_array($query);
                                                    $sdipk2ms7 = $result[0];
                                                    $sdipk2ms7 = number_format($sdipk2ms7,3);
                                                //standar deviasi IPK dengan keterangan  semester 7
                                                    $sql = "SELECT STD(ipk_3) FROM tb_datatraining WHERE masa_studi =7";
                                                    $query = mysqli_query($konek_db,$sql);
                                                    $result = mysqli_fetch_array($query);
                                                    $sdipk3ms7 = $result[0];
                                                    $sdipk3ms7 = number_format($sdipk3ms7,3);
                                                //standar deviasi IPK dengan keterangan semester 7 
                                                    $sql = "SELECT STD(ipk_4) FROM tb_datatraining WHERE masa_studi =7";
                                                    $query = mysqli_query($konek_db,$sql);
                                                    $result = mysqli_fetch_array($query);
                                                    $sdipk4ms7 = $result[0];
                                                    $sdipk4ms7 = number_format($sdipk4ms7,3);
                                            // Akhir Masa studi=7
                                            // Masa studi = 8
                                                // Mean IPK1 dengan keterangan semester 8 
                                                    $sql = "SELECT AVG(ipk_1) FROM tb_datatraining  WHERE masa_studi =8";
                                                    $query = mysqli_query($konek_db,$sql);
                                                    $result = mysqli_fetch_array($query);
                                                    $meanipk1ms8 = $result[0];
                                                    $meanipk1ms8 = number_format($meanipk1ms8,3);
                                                // Mean IPK2 dengan keterangan semester 8 
                                                    $sql = "SELECT AVG(ipk_2) FROM tb_datatraining  WHERE masa_studi =8";
                                                    $query = mysqli_query($konek_db,$sql);
                                                    $result = mysqli_fetch_array($query);
                                                    $meanipk2ms8 = $result[0];
                                                    $meanipk2ms8 = number_format($meanipk2ms8,3);
                                                // Mean IPK3 dengan keterangan semester 8 
                                                    $sql = "SELECT AVG(ipk_3) FROM tb_datatraining  WHERE masa_studi =8";
                                                    $query = mysqli_query($konek_db,$sql);
                                                    $result = mysqli_fetch_array($query);
                                                    $meanipk3ms8 = $result[0];
                                                    $meanipk3ms8 = number_format($meanipk3ms8,3);
                                                // Mean IPK4 dengan keterangan semester 8 
                                                    $sql = "SELECT AVG(ipk_4) FROM tb_datatraining  WHERE masa_studi =8";
                                                    $query = mysqli_query($konek_db,$sql);
                                                    $result = mysqli_fetch_array($query);
                                                    $meanipk4ms8 = $result[0];
                                                    $meanipk4ms8 = number_format($meanipk4ms8,3);
                                                //standar deviasi IPK dengan keterangan  semester 8 
                                                    $sql = "SELECT STD(ipk_1) FROM tb_datatraining WHERE masa_studi =8";
                                                    $query = mysqli_query($konek_db,$sql);
                                                    $result = mysqli_fetch_array($query);
                                                    $sdipk1ms8 = $result[0];
                                                    $sdipk1ms8 = number_format($sdipk1ms8,3);
                                                //standar deviasi IPK dengan keterangan semester 8 
                                                    $sql = "SELECT STD(ipk_2) FROM tb_datatraining WHERE masa_studi =8";
                                                    $query = mysqli_query($konek_db,$sql);
                                                    $result = mysqli_fetch_array($query);
                                                    $sdipk2ms8 = $result[0];
                                                    $sdipk2ms8 = number_format($sdipk2ms8,3);
                                                //standar deviasi IPK dengan keterangan  semester 8
                                                    $sql = "SELECT STD(ipk_3) FROM tb_datatraining WHERE masa_studi =8";
                                                    $query = mysqli_query($konek_db,$sql);
                                                    $result = mysqli_fetch_array($query);
                                                    $sdipk3ms8 = $result[0];
                                                    $sdipk3ms8 = number_format($sdipk3ms8,3);
                                                //standar deviasi IPK dengan keterangan semester 8 
                                                    $sql = "SELECT STD(ipk_4) FROM tb_datatraining WHERE masa_studi =8";
                                                    $query = mysqli_query($konek_db,$sql);
                                                    $result = mysqli_fetch_array($query);
                                                    $sdipk4ms8 = $result[0];
                                                    $sdipk4ms8 = number_format($sdipk4ms8,3);
                                            // Akhir Masa studi=8
                                            // Masa studi = 9
                                                // Mean IPK1 dengan keterangan semester 9 
                                                    $sql = "SELECT AVG(ipk_1) FROM tb_datatraining  WHERE masa_studi =9";
                                                    $query = mysqli_query($konek_db,$sql);
                                                    $result = mysqli_fetch_array($query);
                                                    $meanipk1ms9 = $result[0];
                                                    $meanipk1ms9 = number_format($meanipk1ms9,3);
                                                // Mean IPK2 dengan keterangan semester 9 
                                                    $sql = "SELECT AVG(ipk_2) FROM tb_datatraining  WHERE masa_studi =9";
                                                    $query = mysqli_query($konek_db,$sql);
                                                    $result = mysqli_fetch_array($query);
                                                    $meanipk2ms9 = $result[0];
                                                    $meanipk2ms9 = number_format($meanipk2ms9,3);
                                                // Mean IPK3 dengan keterangan semester 9 
                                                    $sql = "SELECT AVG(ipk_3) FROM tb_datatraining  WHERE masa_studi =9";
                                                    $query = mysqli_query($konek_db,$sql);
                                                    $result = mysqli_fetch_array($query);
                                                    $meanipk3ms9 = $result[0];
                                                    $meanipk3ms9 = number_format($meanipk3ms9,3);
                                                // Mean IPK4 dengan keterangan semester 9 
                                                    $sql = "SELECT AVG(ipk_4) FROM tb_datatraining  WHERE masa_studi =9";
                                                    $query = mysqli_query($konek_db,$sql);
                                                    $result = mysqli_fetch_array($query);
                                                    $meanipk4ms9 = $result[0];
                                                    $meanipk4ms9 = number_format($meanipk4ms9,3);
                                                //standar deviasi IPK dengan keterangan  semester 9 
                                                    $sql = "SELECT STD(ipk_1) FROM tb_datatraining WHERE masa_studi =9";
                                                    $query = mysqli_query($konek_db,$sql);
                                                    $result = mysqli_fetch_array($query);
                                                    $sdipk1ms9 = $result[0];
                                                    $sdipk1ms9 = number_format($sdipk1ms9,3);
                                                //standar deviasi IPK dengan keterangan semester 9 
                                                    $sql = "SELECT STD(ipk_2) FROM tb_datatraining WHERE masa_studi =9";
                                                    $query = mysqli_query($konek_db,$sql);
                                                    $result = mysqli_fetch_array($query);
                                                    $sdipk2ms9 = $result[0];
                                                    $sdipk2ms9 = number_format($sdipk2ms9,3);
                                                //standar deviasi IPK dengan keterangan  semester 9
                                                    $sql = "SELECT STD(ipk_3) FROM tb_datatraining WHERE masa_studi =9";
                                                    $query = mysqli_query($konek_db,$sql);
                                                    $result = mysqli_fetch_array($query);
                                                    $sdipk3ms9 = $result[0];
                                                    $sdipk3ms9 = number_format($sdipk3ms9,3);
                                                //standar deviasi IPK dengan keterangan semester 9 
                                                    $sql = "SELECT STD(ipk_4) FROM tb_datatraining WHERE masa_studi =9";
                                                    $query = mysqli_query($konek_db,$sql);
                                                    $result = mysqli_fetch_array($query);
                                                    $sdipk4ms9 = $result[0];
                                                    $sdipk4ms9 = number_format($sdipk4ms9,3);
                                            // Akhir Masa studi=9
                                            // Masa studi = 10
                                                // Mean IPK1 dengan keterangan semester 10 
                                                    $sql = "SELECT AVG(ipk_1) FROM tb_datatraining  WHERE masa_studi =10";
                                                    $query = mysqli_query($konek_db,$sql);
                                                    $result = mysqli_fetch_array($query);
                                                    $meanipk1ms10 = $result[0];
                                                    $meanipk1ms10 = number_format($meanipk1ms10,3);
                                                // Mean IPK2 dengan keterangan semester 10 
                                                    $sql = "SELECT AVG(ipk_2) FROM tb_datatraining  WHERE masa_studi =10";
                                                    $query = mysqli_query($konek_db,$sql);
                                                    $result = mysqli_fetch_array($query);
                                                    $meanipk2ms10 = $result[0];
                                                    $meanipk2ms10 = number_format($meanipk2ms10,3);
                                                // Mean IPK3 dengan keterangan semester 10 
                                                    $sql = "SELECT AVG(ipk_3) FROM tb_datatraining  WHERE masa_studi =10";
                                                    $query = mysqli_query($konek_db,$sql);
                                                    $result = mysqli_fetch_array($query);
                                                    $meanipk3ms10 = $result[0];
                                                    $meanipk3ms10 = number_format($meanipk3ms10,3);
                                                // Mean IPK4 dengan keterangan semester 10 
                                                    $sql = "SELECT AVG(ipk_4) FROM tb_datatraining  WHERE masa_studi =10";
                                                    $query = mysqli_query($konek_db,$sql);
                                                    $result = mysqli_fetch_array($query);
                                                    $meanipk4ms10 = $result[0];
                                                    $meanipk4ms10 = number_format($meanipk4ms10,3);
                                                //standar deviasi IPK dengan keterangan  semester 10 
                                                    $sql = "SELECT STD(ipk_1) FROM tb_datatraining WHERE masa_studi =10";
                                                    $query = mysqli_query($konek_db,$sql);
                                                    $result = mysqli_fetch_array($query);
                                                    $sdipk1ms10 = $result[0];
                                                    $sdipk1ms10 = number_format($sdipk1ms10,3);
                                                //standar deviasi IPK dengan keterangan semester 10 
                                                    $sql = "SELECT STD(ipk_2) FROM tb_datatraining WHERE masa_studi =10";
                                                    $query = mysqli_query($konek_db,$sql);
                                                    $result = mysqli_fetch_array($query);
                                                    $sdipk2ms10 = $result[0];
                                                    $sdipk2ms10 = number_format($sdipk2ms10,3);
                                                //standar deviasi IPK dengan keterangan  semester 10
                                                    $sql = "SELECT STD(ipk_3) FROM tb_datatraining WHERE masa_studi =10";
                                                    $query = mysqli_query($konek_db,$sql);
                                                    $result = mysqli_fetch_array($query);
                                                    $sdipk3ms10 = $result[0];
                                                    $sdipk3ms10 = number_format($sdipk3ms10,3);
                                                //standar deviasi IPK dengan keterangan semester 10 
                                                    $sql = "SELECT STD(ipk_4) FROM tb_datatraining WHERE masa_studi =10";
                                                    $query = mysqli_query($konek_db,$sql);
                                                    $result = mysqli_fetch_array($query);
                                                    $sdipk4ms10 = $result[0];
                                                    $sdipk4ms10 = number_format($sdipk4ms10,3);
                                            // Akhir Masa studi=10
                                        ?>
                                    <!-- Akhir baris untuk menghitung MEAN dan standar deviasi IPK -->
                                    <tr>                                      
                                        <th><b><i>MEAN IPK SEMESTER 1 | Y = 7 semester</i></b></th>
                                        <th><b><i>MEAN IPK SEMESTER 2 | Y = 7 semester</i></b></th>
                                       <th><b><i>MEAN IPK SEMESTER 3 | Y = 7 semester</i></b></th>
                                        <th><b><i>MEAN IPK SEMESTER 4 | Y = 7 semester</i></b></th>
                                        <th><b><i>MEAN IPK SEMESTER 1 | Y = 8 semester</i></b></th>
                                        <th><b><i>MEAN IPK SEMESTER 2 | Y = 8 semester</i></b></th>
                                       <th><b><i>MEAN IPK SEMESTER 3 | Y = 8 semester</i></b></th>
                                        <th><b><i>MEAN IPK SEMESTER 4 | Y = 8 semester</i></b></th>
                                    </tr>
                                    <tr>              
                                        <td><?php echo $meanipk1ms7; ?> </td>
                                        <td><?php echo $meanipk2ms7; ?> </td>
                                        <td><?php echo $meanipk3ms7; ?> </td>
                                        <td><?php echo $meanipk4ms7; ?> </td>
                                        <td><?php echo $meanipk1ms8; ?> </td>
                                        <td><?php echo $meanipk3ms8; ?> </td>
                                        <td><?php echo $meanipk3ms8; ?> </td>
                                        <td><?php echo $meanipk4ms8; ?> </td>
                                    </tr>
                                    <tr>                                      
                                        <th><b><i>MEAN IPK SEMESTER 1 | Y = 9 semester</i></b></th>
                                        <th><b><i>MEAN IPK SEMESTER 2 | Y = 9 semester</i></b></th>
                                       <th><b><i>MEAN IPK SEMESTER 3 | Y = 9 semester</i></b></th>
                                        <th><b><i>MEAN IPK SEMESTER 4 | Y = 9 semester</i></b></th>
                                        <th><b><i>MEAN IPK SEMESTER 1 | Y = 10 semester</i></b></th>
                                        <th><b><i>MEAN IPK SEMESTER 2 | Y = 10 semester</i></b></th>
                                       <th><b><i>MEAN IPK SEMESTER 3 | Y = 10 semester</i></b></th>
                                        <th><b><i>MEAN IPK SEMESTER 4 | Y = 10 semester</i></b></th>
                                    </tr>
                                    <tr>              
                                        <td><?php echo $meanipk1ms9; ?> </td>
                                        <td><?php echo $meanipk2ms9; ?> </td>
                                        <td><?php echo $meanipk3ms9; ?> </td>
                                        <td><?php echo $meanipk4ms9; ?> </td>
                                        <td><?php echo $meanipk1ms10; ?> </td>
                                        <td><?php echo $meanipk2ms10; ?> </td>
                                        <td><?php echo $meanipk3ms10; ?> </td>
                                        <td><?php echo $meanipk4ms10; ?> </td>
                                    </tr>
                                    <tr>                                      
                                        <th><b><i>standar deviasi IPK SEMESTER 1 | Y = 7 semester</i></b></th>
                                        <th><b><i>standar deviasi IPK SEMESTER 2 | Y = 7 semester</i></b></th>
                                       <th><b><i>standar deviasi IPK SEMESTER 3 | Y = 7 semester</i></b></th>
                                        <th><b><i>standar deviasi IPK SEMESTER 4 | Y = 7 semester</i></b></th>
                                        <th><b><i>standar deviasi IPK SEMESTER 1 | Y = 8 semester</i></b></th>
                                        <th><b><i>standar deviasi IPK SEMESTER 2 | Y = 8 semester</i></b></th>
                                       <th><b><i>standar deviasi IPK SEMESTER 3 | Y = 8 semester</i></b></th>
                                        <th><b><i>standar deviasi IPK SEMESTER 4 | Y = 8 semester</i></b></th>
                                    </tr>
                                    <tr>              
                                        <td><?php echo $sdipk1ms7; ?></td>
                                        <td><?php echo $sdipk2ms7; ?></td>
                                        <td><?php echo $sdipk3ms7; ?></td>
                                        <td><?php echo $sdipk4ms7; ?></td>
                                        <td><?php echo $sdipk1ms8; ?></td>
                                        <td><?php echo $sdipk2ms8; ?></td>
                                        <td><?php echo $sdipk3ms8; ?></td>
                                        <td><?php echo $sdipk4ms8; ?></td>                          
                                    </tr>
                                    <tr>                                      
                                        <th><b><i>standar deviasi IPK SEMESTER 1 | Y = 9 semester</i></b></th>
                                        <th><b><i>standar deviasi IPK SEMESTER 2 | Y = 9 semester</i></b></th>
                                       <th><b><i>standar deviasi IPK SEMESTER 3 | Y = 9 semester</i></b></th>
                                        <th><b><i>standar deviasi IPK SEMESTER 4 | Y = 9 semester</i></b></th>
                                        <th><b><i>standar deviasi IPK SEMESTER 1 | Y = 10 semester</i></b></th>
                                        <th><b><i>standar deviasi IPK SEMESTER 2 | Y = 10 semester</i></b></th>
                                       <th><b><i>standar deviasi IPK SEMESTER 3 | Y = 10 semester</i></b></th>
                                        <th><b><i>standar deviasi IPK SEMESTER 4 | Y = 10 semester</i></b></th>
                                    </tr>
                                    <tr>              
                                        <td><?php echo $sdipk1ms9; ?></td>
                                        <td><?php echo $sdipk2ms9; ?></td>
                                        <td><?php echo $sdipk3ms9; ?></td>
                                        <td><?php echo $sdipk4ms9; ?></td>
                                        <td><?php echo $sdipk1ms10; ?></td>
                                        <td><?php echo $sdipk2ms10; ?></td>
                                        <td><?php echo $sdipk3ms10; ?></td>
                                        <td><?php echo $sdipk4ms10; ?></td>                          
                                    </tr>
                                    <!-- /akhir baris untuk menghitung MEAN dan standar deviasi IPK -->

                                    <?php
                                        // Menghitung IPK
                                            // menghitung ipk semester 1 
                                                // keterangan masa studi = 7
                                                    $hasilipk1ms7 = (1/sqrt(2*3.14*$sdipk1ms7));
                                                    $hasilipk1ms7 = number_format($hasilipk1ms7,3);
                                                    $e =-(pow(($ipk1-$meanipk1ms7),$pangkat2))/2*(pow($sdipk1ms7,$pangkat2));
                                                    $e = number_format($e,3);
                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);
                                                    $cobaipk1ms7 = $hasilipk1ms7*$perkalian;
                                                    $cobaipk1ms7 = number_format($cobaipk1ms7,3);
                                                // keterangan masa studi = 8
                                                    $hasilipk1ms8 = (1/sqrt(2*3.14*$sdipk1ms8));
                                                    $hasilipk1ms8 = number_format($hasilipk1ms8,3);
                                                    $e =-(pow(($ipk1-$meanipk1ms8),$pangkat2))/2*(pow($sdipk1ms8,$pangkat2));
                                                    $e = number_format($e,3);
                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);
                                                    $cobaipk1ms8 = $hasilipk1ms8*$perkalian;
                                                    $cobaipk1ms8 = number_format($cobaipk1ms8,3);
                                                // keterangan masa studi = 9
                                                    $hasilipk1ms9 = (1/sqrt(2*3.14*$sdipk1ms9));
                                                    $hasilipk1ms9 = number_format($hasilipk1ms9,3);
                                                    $e =-(pow(($ipk1-$meanipk1ms9),$pangkat2))/2*(pow($sdipk1ms9,$pangkat2));
                                                    $e = number_format($e,3);
                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);
                                                    $cobaipk1ms9 = $hasilipk1ms9*$perkalian;
                                                    $cobaipk1ms9 = number_format($cobaipk1ms9,3);
                                                // keterangan masa studi = 10
                                                    $hasilipk1ms10 = (1/sqrt(2*3.14*$sdipk1ms10));
                                                    $hasilipk1ms10 = number_format($hasilipk1ms10,3);
                                                    $e =-(pow(($ipk1-$meanipk1ms10),$pangkat2))/2*(pow($sdipk1ms10,$pangkat2));
                                                    $e = number_format($e,3);
                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);
                                                    $cobaipk1ms10 = $hasilipk1ms10*$perkalian;
                                                    $cobaipk1ms10 = number_format($cobaipk1ms10,3);
                                            
                                            // menghitung ipk semester 2
                                                // keterangan masa studi = 7
                                                    $hasilipk2ms7 = (1/sqrt(2*3.14*$sdipk2ms7));
                                                    $hasilipk2ms7 = number_format($hasilipk2ms7,3);
                                                    $e =-(pow(($ipk2-$meanipk2ms7),$pangkat2))/2*(pow($sdipk2ms7,$pangkat2));
                                                    $e = number_format($e,3);
                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);
                                                    $cobaipk2ms7 = $hasilipk2ms7*$perkalian;
                                                    $cobaipk2ms7 = number_format($cobaipk2ms7,3);
                                                // keterangan masa studi = 8
                                                    $hasilipk2ms8 = (1/sqrt(2*3.14*$sdipk2ms8));
                                                    $hasilipk2ms8 = number_format($hasilipk2ms8,3);
                                                    $e =-(pow(($ipk2-$meanipk2ms8),$pangkat2))/2*(pow($sdipk2ms8,$pangkat2));
                                                    $e = number_format($e,3);
                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);
                                                    $cobaipk2ms8 = $hasilipk2ms8*$perkalian;
                                                    $cobaipk2ms8 = number_format($cobaipk2ms8,3);
                                                // keterangan masa studi = 9
                                                    $hasilipk2ms9 = (1/sqrt(2*3.14*$sdipk2ms9));
                                                    $hasilipk2ms9 = number_format($hasilipk2ms9,3);
                                                    $e =-(pow(($ipk2-$meanipk2ms9),$pangkat2))/2*(pow($sdipk2ms9,$pangkat2));
                                                    $e = number_format($e,3);
                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);
                                                    $cobaipk2ms9 = $hasilipk2ms9*$perkalian;
                                                    $cobaipk2ms9 = number_format($cobaipk2ms9,3);
                                                // keterangan masa studi = 10
                                                    $hasilipk2ms10 = (1/sqrt(2*3.14*$sdipk2ms10));
                                                    $hasilipk2ms10 = number_format($hasilipk2ms10,3);
                                                    $e =-(pow(($ipk2-$meanipk2ms10),$pangkat2))/2*(pow($sdipk2ms10,$pangkat2));
                                                    $e = number_format($e,3);
                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);
                                                    $cobaipk2ms10 = $hasilipk2ms10*$perkalian;
                                                    $cobaipk2ms10 = number_format($cobaipk2ms10,3);
                                            // menghitung ipk semester 3
                                                // keterangan masa studi = 7
                                                    $hasilipk3ms7 = (1/sqrt(2*3.14*$sdipk3ms7));
                                                    $hasilipk3ms7 = number_format($hasilipk3ms7,3);
                                                    $e =-(pow(($ipk3-$meanipk3ms7),$pangkat2))/2*(pow($sdipk3ms7,$pangkat2));
                                                    $e = number_format($e,3);
                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);
                                                    $cobaipk3ms7 = $hasilipk3ms7*$perkalian;
                                                    $cobaipk3ms7 = number_format($cobaipk3ms7,3);
                                                // keterangan masa studi = 8
                                                    $hasilipk3ms8 = (1/sqrt(2*3.14*$sdipk3ms8));
                                                    $hasilipk3ms8 = number_format($hasilipk3ms8,3);
                                                    $e =-(pow(($ipk3-$meanipk3ms8),$pangkat2))/2*(pow($sdipk3ms8,$pangkat2));
                                                    $e = number_format($e,3);
                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);
                                                    $cobaipk3ms8 = $hasilipk3ms8*$perkalian;
                                                    $cobaipk3ms8 = number_format($cobaipk3ms8,3);
                                                // keterangan masa studi = 9
                                                    $hasilipk3ms9 = (1/sqrt(2*3.14*$sdipk3ms9));
                                                    $hasilipk3ms9 = number_format($hasilipk3ms9,3);
                                                    $e =-(pow(($ipk3-$meanipk3ms9),$pangkat2))/2*(pow($sdipk3ms9,$pangkat2));
                                                    $e = number_format($e,3);
                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);
                                                    $cobaipk3ms9 = $hasilipk3ms9*$perkalian;
                                                    $cobaipk3ms9 = number_format($cobaipk3ms9,3);
                                                // keterangan masa studi = 10
                                                    $hasilipk3ms10 = (1/sqrt(2*3.14*$sdipk3ms10));
                                                    $hasilipk3ms10 = number_format($hasilipk3ms10,3);
                                                    $e =-(pow(($ipk3-$meanipk3ms10),$pangkat2))/2*(pow($sdipk3ms10,$pangkat2));
                                                    $e = number_format($e,3);
                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);
                                                    $cobaipk3ms10 = $hasilipk3ms10*$perkalian;
                                                    $cobaipk3ms10 = number_format($cobaipk3ms10,3);

                                            // menghitung ipk semester 4
                                                // keterangan masa studi = 7
                                                    $hasilipk4ms7 = (1/sqrt(2*3.14*$sdipk4ms7));
                                                    $hasilipk4ms7 = number_format($hasilipk4ms7,3);
                                                    $e =-(pow(($ipk4-$meanipk4ms7),$pangkat2))/2*(pow($sdipk4ms7,$pangkat2));
                                                    $e = number_format($e,3);
                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);
                                                    $cobaipk4ms7 = $hasilipk4ms7*$perkalian;
                                                    $cobaipk4ms7 = number_format($cobaipk4ms7,3);
                                                // keterangan masa studi = 8
                                                    $hasilipk4ms8 = (1/sqrt(2*3.14*$sdipk4ms8));
                                                    $hasilipk4ms8 = number_format($hasilipk4ms8,3);
                                                    $e =-(pow(($ipk4-$meanipk4ms8),$pangkat2))/2*(pow($sdipk4ms8,$pangkat2));
                                                    $e = number_format($e,3);
                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);
                                                    $cobaipk4ms8 = $hasilipk4ms8*$perkalian;
                                                    $cobaipk4ms8 = number_format($cobaipk4ms8,3);
                                                // keterangan masa studi = 9
                                                    $hasilipk4ms9 = (1/sqrt(2*3.14*$sdipk4ms9));
                                                    $hasilipk4ms9 = number_format($hasilipk4ms9,3);
                                                    $e =-(pow(($ipk4-$meanipk4ms9),$pangkat2))/2*(pow($sdipk4ms9,$pangkat2));
                                                    $e = number_format($e,3);
                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);
                                                    $cobaipk4ms9 = $hasilipk4ms9*$perkalian;
                                                    $cobaipk4ms9 = number_format($cobaipk4ms9,3);
                                                // keterangan masa studi = 10
                                                    $hasilipk4ms10 = (1/sqrt(2*3.14*$sdipk4ms10));
                                                    $hasilipk4ms10 = number_format($hasilipk4ms10,3);
                                                    $e =-(pow(($ipk4-$meanipk4ms10),$pangkat2))/2*(pow($sdipk4ms10,$pangkat2));
                                                    $e = number_format($e,3);
                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);
                                                    $cobaipk4ms10 = $hasilipk4ms10*$perkalian;
                                                    $cobaipk4ms10 = number_format($cobaipk4ms10,3);
								        // akhir menghitung IPK
                                    ?>
                                    
                                
                                   <tr>                                      
                                        <th><b><i>IPK SEMESTER 1 | Y = 7 semester</i></b></th>
                                        <th><b>IPK SEMESTER 2 | Y = 7 semester</i></b></th>
                                       <th><b><i>IPK SEMESTER 3 | Y = 7 semester</i></b></th>
                                        <th><b><i>IPK SEMESTER 4 | Y = 7 semester</i></b></th>
                                        <th><b><i>IPK SEMESTER 1 | Y = 8 semester</i></b></th>
                                        <th><b><i>IPK SEMESTER 2 | Y = 8 semester</i></b></th>
                                       <th><b><i>IPK SEMESTER 3 | Y = 8 semester</i></b></th>
                                        <th><b><i>IPK SEMESTER 4 | Y = 8 semester</i></b></th>
                                    </tr>
                                    <tr>              
                                        <td><?php echo $cobaipk1ms7; ?> </td>
                                        <td><?php echo $cobaipk2ms7; ?> </td>
                                        <td><?php echo $cobaipk3ms7; ?> </td>
                                        <td><?php echo $cobaipk4ms7; ?> </td>
                                        <td><?php echo $cobaipk1ms8; ?> </td>
                                        <td><?php echo $cobaipk2ms8; ?> </td>
                                        <td><?php echo $cobaipk3ms8; ?> </td>
                                        <td><?php echo $cobaipk4ms8; ?> </td>
                                    </tr>
                                    <tr>                                      
                                        <th><b><i>IPK SEMESTER 1 | Y = 9 semester</i></b></th>
                                        <th><b><i>IPK SEMESTER 2 | Y = 9 semester</i></b></th>
                                       <th><b><i>IPK SEMESTER 3 | Y = 9 semester</i></b></th>
                                        <th><b><i>IPK SEMESTER 4 | Y = 9 semester</i></b></th>
                                        <th><b><i>IPK SEMESTER 1 | Y = 10 semester</i></b></th>
                                        <th><b><i>IPK SEMESTER 2 | Y = 10 semester</i></b></th>
                                       <th><b><i>IPK SEMESTER 3 | Y = 10 semester</i></b></th>
                                        <th><b><i>IPK SEMESTER 4 | Y = 10 semester</i></b></th>
                                    </tr>
                                    <tr>              
                                        <td><?php echo $cobaipk1ms9; ?> </td>
                                        <td><?php echo $cobaipk2ms9; ?> </td>
                                        <td><?php echo $cobaipk3ms9; ?> </td>
                                        <td><?php echo $cobaipk4ms9; ?> </td>
                                        <td><?php echo $cobaipk1ms10; ?> </td>
                                        <td><?php echo $cobaipk2ms10; ?> </td>
                                        <td><?php echo $cobaipk3ms10; ?> </td>
                                        <td><?php echo $cobaipk4ms10; ?> </td>
                                    </tr>
                                    <tr>
                                        <th colspan="8" ><h3>IPS</h3></th>
                                    </tr>
                                    

                                    <?php
                                        // QUERY MEAN dan STANDAR DEVIASI IPS
                                            // Masa studi = 7
                                                // Mean IPS1 dengan keterangan semester 7 
                                                    $sql = "SELECT AVG(ips_1) FROM tb_datatraining  WHERE masa_studi =7";
                                                    $query = mysqli_query($konek_db,$sql);
                                                    $result = mysqli_fetch_array($query);
                                                    $meanips1ms7 = $result[0];
                                                    $meanips1ms7 = number_format($meanips1ms7,3);
                                                // Mean IPS2 dengan keterangan semester 7 
                                                    $sql = "SELECT AVG(ips_2) FROM tb_datatraining  WHERE masa_studi =7";
                                                    $query = mysqli_query($konek_db,$sql);
                                                    $result = mysqli_fetch_array($query);
                                                    $meanips2ms7 = $result[0];
                                                    $meanips2ms7 = number_format($meanips2ms7,3);
                                                // Mean IPS3 dengan keterangan semester 7 
                                                    $sql = "SELECT AVG(ips_3) FROM tb_datatraining  WHERE masa_studi =7";
                                                    $query = mysqli_query($konek_db,$sql);
                                                    $result = mysqli_fetch_array($query);
                                                    $meanips3ms7 = $result[0];
                                                    $meanips3ms7 = number_format($meanips3ms7,3);
                                                // Mean IPS4 dengan keterangan semester 7 
                                                    $sql = "SELECT AVG(ips_4) FROM tb_datatraining  WHERE masa_studi =7";
                                                    $query = mysqli_query($konek_db,$sql);
                                                    $result = mysqli_fetch_array($query);
                                                    $meanips4ms7 = $result[0];
                                                    $meanips4ms7 = number_format($meanips4ms7,3);
                                                //standar deviasi IPS dengan keterangan  semester 7 
                                                    $sql = "SELECT STD(ips_1) FROM tb_datatraining WHERE masa_studi =7";
                                                    $query = mysqli_query($konek_db,$sql);
                                                    $result = mysqli_fetch_array($query);
                                                    $sdips1ms7 = $result[0];
                                                    $sdips1ms7 = number_format($sdips1ms7,3);
                                                //standar deviasi IPS dengan keterangan semester 7 
                                                    $sql = "SELECT STD(ips_2) FROM tb_datatraining WHERE masa_studi =7";
                                                    $query = mysqli_query($konek_db,$sql);
                                                    $result = mysqli_fetch_array($query);
                                                    $sdips2ms7 = $result[0];
                                                    $sdips2ms7 = number_format($sdips2ms7,3);
                                                //standar deviasi IPS dengan keterangan  semester 7
                                                    $sql = "SELECT STD(ips_3) FROM tb_datatraining WHERE masa_studi =7";
                                                    $query = mysqli_query($konek_db,$sql);
                                                    $result = mysqli_fetch_array($query);
                                                    $sdips3ms7 = $result[0];
                                                    $sdips3ms7 = number_format($sdips3ms7,3);
                                                //standar deviasi IPS dengan keterangan semester 7 
                                                    $sql = "SELECT STD(ips_4) FROM tb_datatraining WHERE masa_studi =7";
                                                    $query = mysqli_query($konek_db,$sql);
                                                    $result = mysqli_fetch_array($query);
                                                    $sdips4ms7 = $result[0];
                                                    $sdips4ms7 = number_format($sdips4ms7,3);
                                            // Akhir Masa studi=7
                                            // Masa studi = 8
                                                // Mean IPS1 dengan keterangan semester 8 
                                                    $sql = "SELECT AVG(ips_1) FROM tb_datatraining  WHERE masa_studi =8";
                                                    $query = mysqli_query($konek_db,$sql);
                                                    $result = mysqli_fetch_array($query);
                                                    $meanips1ms8 = $result[0];
                                                    $meanips1ms8 = number_format($meanips1ms8,3);
                                                // Mean IPS2 dengan keterangan semester 8 
                                                    $sql = "SELECT AVG(ips_2) FROM tb_datatraining  WHERE masa_studi =8";
                                                    $query = mysqli_query($konek_db,$sql);
                                                    $result = mysqli_fetch_array($query);
                                                    $meanips2ms8 = $result[0];
                                                    $meanips2ms8 = number_format($meanips2ms8,3);
                                                // Mean IPS3 dengan keterangan semester 8 
                                                    $sql = "SELECT AVG(ips_3) FROM tb_datatraining  WHERE masa_studi =8";
                                                    $query = mysqli_query($konek_db,$sql);
                                                    $result = mysqli_fetch_array($query);
                                                    $meanips3ms8 = $result[0];
                                                    $meanips3ms8 = number_format($meanips3ms8,3);
                                                // Mean IPS4 dengan keterangan semester 8 
                                                    $sql = "SELECT AVG(ips_4) FROM tb_datatraining  WHERE masa_studi =8";
                                                    $query = mysqli_query($konek_db,$sql);
                                                    $result = mysqli_fetch_array($query);
                                                    $meanips4ms8 = $result[0];
                                                    $meanips4ms8 = number_format($meanips4ms8,3);
                                                //standar deviasi IPS dengan keterangan  semester 8 
                                                    $sql = "SELECT STD(ips_1) FROM tb_datatraining WHERE masa_studi =8";
                                                    $query = mysqli_query($konek_db,$sql);
                                                    $result = mysqli_fetch_array($query);
                                                    $sdips1ms8 = $result[0];
                                                    $sdips1ms8 = number_format($sdips1ms8,3);
                                                //standar deviasi IPS dengan keterangan semester 8 
                                                    $sql = "SELECT STD(ips_2) FROM tb_datatraining WHERE masa_studi =8";
                                                    $query = mysqli_query($konek_db,$sql);
                                                    $result = mysqli_fetch_array($query);
                                                    $sdips2ms8 = $result[0];
                                                    $sdips2ms8 = number_format($sdips2ms8,3);
                                                //standar deviasi IPS dengan keterangan  semester 8
                                                    $sql = "SELECT STD(ips_3) FROM tb_datatraining WHERE masa_studi =8";
                                                    $query = mysqli_query($konek_db,$sql);
                                                    $result = mysqli_fetch_array($query);
                                                    $sdips3ms8 = $result[0];
                                                    $sdips3ms8 = number_format($sdips3ms8,3);
                                                //standar deviasi IPS dengan keterangan semester 8 
                                                    $sql = "SELECT STD(ips_4) FROM tb_datatraining WHERE masa_studi =8";
                                                    $query = mysqli_query($konek_db,$sql);
                                                    $result = mysqli_fetch_array($query);
                                                    $sdips4ms8 = $result[0];
                                                    $sdips4ms8 = number_format($sdips4ms8,3);
                                            // Akhir Masa studi=8
                                            // Masa studi = 9
                                                // Mean IPS1 dengan keterangan semester 9 
                                                    $sql = "SELECT AVG(ips_1) FROM tb_datatraining  WHERE masa_studi =9";
                                                    $query = mysqli_query($konek_db,$sql);
                                                    $result = mysqli_fetch_array($query);
                                                    $meanips1ms9 = $result[0];
                                                    $meanips1ms9 = number_format($meanips1ms9,3);
                                                // Mean IPS2 dengan keterangan semester 9 
                                                    $sql = "SELECT AVG(ips_2) FROM tb_datatraining  WHERE masa_studi =9";
                                                    $query = mysqli_query($konek_db,$sql);
                                                    $result = mysqli_fetch_array($query);
                                                    $meanips2ms9 = $result[0];
                                                    $meanips2ms9 = number_format($meanips2ms9,3);
                                                // Mean IPS3 dengan keterangan semester 9 
                                                    $sql = "SELECT AVG(ips_3) FROM tb_datatraining  WHERE masa_studi =9";
                                                    $query = mysqli_query($konek_db,$sql);
                                                    $result = mysqli_fetch_array($query);
                                                    $meanips3ms9 = $result[0];
                                                    $meanips3ms9 = number_format($meanips3ms9,3);
                                                // Mean IPS4 dengan keterangan semester 9 
                                                    $sql = "SELECT AVG(ips_4) FROM tb_datatraining  WHERE masa_studi =9";
                                                    $query = mysqli_query($konek_db,$sql);
                                                    $result = mysqli_fetch_array($query);
                                                    $meanips4ms9 = $result[0];
                                                    $meanips4ms9 = number_format($meanips4ms9,3);
                                                //standar deviasi IPS dengan keterangan  semester 9 
                                                    $sql = "SELECT STD(ips_1) FROM tb_datatraining WHERE masa_studi =9";
                                                    $query = mysqli_query($konek_db,$sql);
                                                    $result = mysqli_fetch_array($query);
                                                    $sdips1ms9 = $result[0];
                                                    $sdips1ms9 = number_format($sdips1ms9,3);
                                                //standar deviasi IPS dengan keterangan semester 9 
                                                    $sql = "SELECT STD(ips_2) FROM tb_datatraining WHERE masa_studi =9";
                                                    $query = mysqli_query($konek_db,$sql);
                                                    $result = mysqli_fetch_array($query);
                                                    $sdips2ms9 = $result[0];
                                                    $sdips2ms9 = number_format($sdips2ms9,3);
                                                //standar deviasi IPS dengan keterangan  semester 9
                                                    $sql = "SELECT STD(ips_3) FROM tb_datatraining WHERE masa_studi =9";
                                                    $query = mysqli_query($konek_db,$sql);
                                                    $result = mysqli_fetch_array($query);
                                                    $sdips3ms9 = $result[0];
                                                    $sdips3ms9 = number_format($sdips3ms9,3);
                                                //standar deviasi IPS dengan keterangan semester 9 
                                                    $sql = "SELECT STD(ips_4) FROM tb_datatraining WHERE masa_studi =9";
                                                    $query = mysqli_query($konek_db,$sql);
                                                    $result = mysqli_fetch_array($query);
                                                    $sdips4ms9 = $result[0];
                                                    $sdips4ms9 = number_format($sdips4ms9,3);
                                            // Akhir Masa studi=9
                                            // Masa studi = 10
                                                // Mean IPS1 dengan keterangan semester 10 
                                                    $sql = "SELECT AVG(ips_1) FROM tb_datatraining  WHERE masa_studi =10";
                                                    $query = mysqli_query($konek_db,$sql);
                                                    $result = mysqli_fetch_array($query);
                                                    $meanips1ms10 = $result[0];
                                                    $meanips1ms10 = number_format($meanips1ms10,3);
                                                // Mean IPS2 dengan keterangan semester 10 
                                                    $sql = "SELECT AVG(ips_2) FROM tb_datatraining  WHERE masa_studi =10";
                                                    $query = mysqli_query($konek_db,$sql);
                                                    $result = mysqli_fetch_array($query);
                                                    $meanips2ms10 = $result[0];
                                                    $meanips2ms10 = number_format($meanips2ms10,3);
                                                // Mean IPS3 dengan keterangan semester 10 
                                                    $sql = "SELECT AVG(ips_3) FROM tb_datatraining  WHERE masa_studi =10";
                                                    $query = mysqli_query($konek_db,$sql);
                                                    $result = mysqli_fetch_array($query);
                                                    $meanips3ms10 = $result[0];
                                                    $meanips3ms10 = number_format($meanips3ms10,3);
                                                // Mean IPS4 dengan keterangan semester 10 
                                                    $sql = "SELECT AVG(ips_4) FROM tb_datatraining  WHERE masa_studi =10";
                                                    $query = mysqli_query($konek_db,$sql);
                                                    $result = mysqli_fetch_array($query);
                                                    $meanips4ms10 = $result[0];
                                                    $meanips4ms10 = number_format($meanips4ms10,3);
                                                //standar deviasi IPS dengan keterangan  semester 10 
                                                    $sql = "SELECT STD(ips_1) FROM tb_datatraining WHERE masa_studi =10";
                                                    $query = mysqli_query($konek_db,$sql);
                                                    $result = mysqli_fetch_array($query);
                                                    $sdips1ms10 = $result[0];
                                                    $sdips1ms10 = number_format($sdips1ms10,3);
                                                //standar deviasi IPS dengan keterangan semester 10 
                                                    $sql = "SELECT STD(ips_2) FROM tb_datatraining WHERE masa_studi =10";
                                                    $query = mysqli_query($konek_db,$sql);
                                                    $result = mysqli_fetch_array($query);
                                                    $sdips2ms10 = $result[0];
                                                    $sdips2ms10 = number_format($sdips2ms10,3);
                                                //standar deviasi IPS dengan keterangan  semester 10
                                                    $sql = "SELECT STD(ips_3) FROM tb_datatraining WHERE masa_studi =10";
                                                    $query = mysqli_query($konek_db,$sql);
                                                    $result = mysqli_fetch_array($query);
                                                    $sdips3ms10 = $result[0];
                                                    $sdips3ms10 = number_format($sdips3ms10,3);
                                                //standar deviasi IPS dengan keterangan semester 10 
                                                    $sql = "SELECT STD(ips_4) FROM tb_datatraining WHERE masa_studi =10";
                                                    $query = mysqli_query($konek_db,$sql);
                                                    $result = mysqli_fetch_array($query);
                                                    $sdips4ms10 = $result[0];
                                                    $sdips4ms10 = number_format($sdips4ms10,3);
                                            // Akhir Masa studi=10
                                        // QUERY MEAN dan STANDAR DEVIASI IPS
                                    ?>
                                    
                                    <!-- awal baris untuk menghitung MEAN dan standar deviasi IPK -->
                                    <tr>                                      
                                        <th><b><i>MEAN IPS SEMESTER 1 | Y = 7 semester</i></b></th>
                                        <th><b><i>MEAN IPS SEMESTER 2 | Y = 7 semester</i></b></th>
                                       <th><b><i>MEAN IPS SEMESTER 3 | Y = 7 semester</i></b></th>
                                        <th><b><i>MEAN IPS SEMESTER 4 | Y = 7 semester</i></b></th>
                                        <th><b><i>MEAN IPS SEMESTER 1 | Y = 8 semester</i></b></th>
                                        <th><b><i>MEAN IPS SEMESTER 2 | Y = 8 semester</i></b></th>
                                       <th><b><i>MEAN IPS SEMESTER 3 | Y = 8 semester</i></b></th>
                                        <th><b><i>MEAN IPS SEMESTER 4 | Y = 8 semester</i></b></th>
                                    </tr>
                                    <tr>              
                                        <td><?php echo $meanips1ms7; ?> </td>
                                        <td><?php echo $meanips2ms7; ?> </td>
                                        <td><?php echo $meanips3ms7; ?> </td>
                                        <td><?php echo $meanips4ms7; ?> </td>
                                        <td><?php echo $meanips1ms8; ?> </td>
                                        <td><?php echo $meanips2ms8; ?> </td>
                                        <td><?php echo $meanips3ms8; ?> </td>
                                        <td><?php echo $meanips4ms8; ?> </td>
                                    </tr>
                                    <tr>                                      
                                        <th><b><i>MEAN IPS SEMESTER 1 | Y = 9 semester</i></b></th>
                                        <th><b><i>MEAN IPS SEMESTER 2 | Y = 9 semester</i></b></th>
                                       <th><b><i>MEAN IPS SEMESTER 3 | Y = 9 semester</i></b></th>
                                        <th><b><i>MEAN IPS SEMESTER 4 | Y = 9 semester</i></b></th>
                                        <th><b><i>MEAN IPS SEMESTER 1 | Y = 10 semester</i></b></th>
                                        <th><b><i>MEAN IPS SEMESTER 2 | Y = 10 semester</i></b></th>
                                       <th><b><i>MEAN IPS SEMESTER 3 | Y = 10 semester</i></b></th>
                                        <th><b><i>MEAN IPS SEMESTER 4 | Y = 10 semester</i></b></th>
                                    </tr>
                                    <tr>              
                                        <td><?php echo $meanips1ms9; ?> </td>
                                        <td><?php echo $meanips2ms9; ?> </td>
                                        <td><?php echo $meanips3ms9; ?> </td>
                                        <td><?php echo $meanips4ms9; ?> </td>
                                        <td><?php echo $meanips1ms10; ?> </td>
                                        <td><?php echo $meanips2ms10; ?> </td>
                                        <td><?php echo $meanips3ms10; ?> </td>
                                        <td><?php echo $meanips4ms10; ?> </td>
                                    </tr>
                                    <tr>                                      
                                        <th><b><i>standar deviasi IPS SEMESTER 1 | Y = 7 semester</i></b></th>
                                        <th><b><i>standar deviasi IPS SEMESTER 2 | Y = 7 semester</i></b></th>
                                       <th><b><i>standar deviasi IPS SEMESTER 3 | Y = 7 semester</i></b></th>
                                        <th><b><i>standar deviasi IPS SEMESTER 4 | Y = 7 semester</i></b></th>
                                        <th><b><i>standar deviasi IPS SEMESTER 1 | Y = 8 semester</i></b></th>
                                        <th><b><i>standar deviasi IPS SEMESTER 2 | Y = 8 semester</i></b></th>
                                       <th><b><i>standar deviasi IPS SEMESTER 3 | Y = 8 semester</i></b></th>
                                        <th><b><i>standar deviasi IPS SEMESTER 4 | Y = 8 semester</i></b></th>
                                    </tr>
                                    <tr>              
                                        <td><?php echo $sdipk1ms7; ?></td>
                                        <td><?php echo $sdipk2ms7; ?></td>
                                        <td><?php echo $sdipk3ms7; ?></td>
                                        <td><?php echo $sdipk4ms7; ?></td>
                                        <td><?php echo $sdipk1ms8; ?></td>
                                        <td><?php echo $sdipk2ms8; ?></td>
                                        <td><?php echo $sdipk3ms8; ?></td>
                                        <td><?php echo $sdipk4ms8; ?></td>                          
                                    </tr>
                                    <tr>                                      
                                        <th><b><i>standar deviasi IPS SEMESTER 1 | Y = 9 semester</i></b></th>
                                        <th><b><i>standar deviasi IPS SEMESTER 2 | Y = 9 semester</i></b></th>
                                       <th><b><i>standar deviasi IPS SEMESTER 3 | Y = 9 semester</i></b></th>
                                        <th><b><i>standar deviasi IPS SEMESTER 4 | Y = 9 semester</i></b></th>
                                        <th><b><i>standar deviasi IPS SEMESTER 1 | Y = 10 semester</i></b></th>
                                        <th><b><i>standar deviasi IPS SEMESTER 2 | Y = 10 semester</i></b></th>
                                       <th><b><i>standar deviasi IPS SEMESTER 3 | Y = 10 semester</i></b></th>
                                        <th><b><i>standar deviasi IPS SEMESTER 4 | Y = 10 semester</i></b></th>
                                    </tr>
                                    <tr>              
                                        <td><?php echo $sdipk1ms9; ?></td>
                                        <td><?php echo $sdipk2ms9; ?></td>
                                        <td><?php echo $sdipk3ms9; ?></td>
                                        <td><?php echo $sdipk4ms9; ?></td>
                                        <td><?php echo $sdipk1ms10; ?></td>
                                        <td><?php echo $sdipk2ms10; ?></td>
                                        <td><?php echo $sdipk3ms10; ?></td>
                                        <td><?php echo $sdipk4ms10; ?></td>                          
                                    </tr>
                                    <!-- /akhir baris untuk menghitung MEAN dan standar deviasi IPS -->
                                    
                                    <?php
                                        // Menghitung IPS
                                            // menghitung ips semester 1 
                                                // keterangan masa studi = 7
                                                    $hasilips1ms7 = (1/sqrt(2*3.14*$sdips1ms7));
                                                    $hasilips1ms7 = number_format($hasilips1ms7,3);
                                                    $e =-(pow(($ips1-$meanips1ms7),$pangkat2))/2*(pow($sdips1ms7,$pangkat2));
                                                    $e = number_format($e,3);
                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);
                                                    $cobaips1ms7 = $hasilips1ms7*$perkalian;
                                                    $cobaips1ms7 = number_format($cobaips1ms7,3);
                                                // keterangan masa studi = 8
                                                    $hasilips1ms8 = (1/sqrt(2*3.14*$sdips1ms8));
                                                    $hasilips1ms8 = number_format($hasilips1ms8,3);
                                                    $e =-(pow(($ips1-$meanips1ms8),$pangkat2))/2*(pow($sdips1ms8,$pangkat2));
                                                    $e = number_format($e,3);
                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);
                                                    $cobaips1ms8 = $hasilips1ms8*$perkalian;
                                                    $cobaips1ms8 = number_format($cobaips1ms8,3);
                                                // keterangan masa studi = 9
                                                    $hasilips1ms9 = (1/sqrt(2*3.14*$sdips1ms9));
                                                    $hasilips1ms9 = number_format($hasilips1ms9,3);
                                                    $e =-(pow(($ips1-$meanips1ms9),$pangkat2))/2*(pow($sdips1ms9,$pangkat2));
                                                    $e = number_format($e,3);
                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);
                                                    $cobaips1ms9 = $hasilips1ms9*$perkalian;
                                                    $cobaips1ms9 = number_format($cobaips1ms9,8);
                                                // keterangan masa studi = 10
                                                    $hasilips1ms10 = (1/sqrt(2*3.14*$sdips1ms10));
                                                    $hasilips1ms10 = number_format($hasilips1ms10,3);
                                                    $e =-(pow(($ips1-$meanips1ms10),$pangkat2))/2*(pow($sdips1ms10,$pangkat2));
                                                    $e = number_format($e,3);
                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);
                                                    $cobaips1ms10 = $hasilips1ms10*$perkalian;
                                                    $cobaips1ms10 = number_format($cobaips1ms10,3);
                                            
                                            // menghitung ips semester 2
                                                // keterangan masa studi = 7
                                                    $hasilips2ms7 = (1/sqrt(2*3.14*$sdips2ms7));
                                                    $hasilips2ms7 = number_format($hasilips2ms7,3);
                                                    $e =-(pow(($ips2-$meanips2ms7),$pangkat2))/2*(pow($sdips2ms7,$pangkat2));
                                                    $e = number_format($e,3);
                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);
                                                    $cobaips2ms7 = $hasilips2ms7*$perkalian;
                                                    $cobaips2ms7 = number_format($cobaips2ms7,7);
                                                // keterangan masa studi = 8
                                                    $hasilips2ms8 = (1/sqrt(2*3.14*$sdips2ms8));
                                                    $hasilips2ms8 = number_format($hasilips2ms8,3);
                                                    $e =-(pow(($ips2-$meanips2ms8),$pangkat2))/2*(pow($sdips2ms8,$pangkat2));
                                                    $e = number_format($e,3);
                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);
                                                    $cobaips2ms8 = $hasilips2ms8*$perkalian;
                                                    $cobaips2ms8 = number_format($cobaips2ms8,7);
                                                // keterangan masa studi = 9
                                                    $hasilips2ms9 = (1/sqrt(2*3.14*$sdips2ms9));
                                                    $hasilips2ms9 = number_format($hasilips2ms9,3);
                                                    $e =-(pow(($ips2-$meanips2ms9),$pangkat2))/2*(pow($sdips2ms9,$pangkat2));
                                                    $e = number_format($e,3);
                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);
                                                    $cobaips2ms9 = $hasilips2ms9*$perkalian;
                                                    $cobaips2ms9 = number_format($cobaips2ms9,7);
                                                // keterangan masa studi = 10
                                                    $hasilips2ms10 = (1/sqrt(2*3.14*$sdips2ms10));
                                                    $hasilips2ms10 = number_format($hasilips2ms10,3);
                                                    $e =-(pow(($ips2-$meanips2ms10),$pangkat2))/2*(pow($sdips2ms10,$pangkat2));
                                                    $e = number_format($e,3);
                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);
                                                    $cobaips2ms10 = $hasilips2ms10*$perkalian;
                                                    $cobaips2ms10 = number_format($cobaips2ms10,9);
                                            // menghitung ips semester 3
                                                // keterangan masa studi = 7
                                                    $hasilips3ms7 = (1/sqrt(2*3.14*$sdips3ms7));
                                                    $hasilips3ms7 = number_format($hasilips3ms7,3);
                                                    $e =-(pow(($ips3-$meanips3ms7),$pangkat2))/2*(pow($sdips3ms7,$pangkat2));
                                                    $e = number_format($e,3);
                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);
                                                    $cobaips3ms7 = $hasilips3ms7*$perkalian;
                                                    $cobaips3ms7 = number_format($cobaips3ms7,3);
                                                // keterangan masa studi = 8
                                                    $hasilips3ms8 = (1/sqrt(2*3.14*$sdips3ms8));
                                                    $hasilips3ms8 = number_format($hasilips3ms8,3);
                                                    $e =-(pow(($ips3-$meanips3ms8),$pangkat2))/2*(pow($sdips3ms8,$pangkat2));
                                                    $e = number_format($e,3);
                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);
                                                    $cobaips3ms8 = $hasilips3ms8*$perkalian;
                                                    $cobaips3ms8 = number_format($cobaips3ms8,3);
                                                // keterangan masa studi = 9
                                                    $hasilips3ms9 = (1/sqrt(2*3.14*$sdips3ms9));
                                                    $hasilips3ms9 = number_format($hasilips3ms9,3);
                                                    $e =-(pow(($ips3-$meanips3ms9),$pangkat2))/2*(pow($sdips3ms9,$pangkat2));
                                                    $e = number_format($e,3);
                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);
                                                    $cobaips3ms9 = $hasilips3ms9*$perkalian;
                                                    $cobaips3ms9 = number_format($cobaips3ms9,3);
                                                // keterangan masa studi = 10
                                                    $hasilips3ms10 = (1/sqrt(2*3.14*$sdips3ms10));
                                                    $hasilips3ms10 = number_format($hasilips3ms10,3);
                                                    $e =-(pow(($ips3-$meanips3ms10),$pangkat2))/2*(pow($sdips3ms10,$pangkat2));
                                                    $e = number_format($e,3);
                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);
                                                    $cobaips3ms10 = $hasilips3ms10*$perkalian;
                                                    $cobaips3ms10 = number_format($cobaips3ms10,3);

                                            // menghitung ips semester 4
                                                // keterangan masa studi = 7
                                                    $hasilips4ms7 = (1/sqrt(2*3.14*$sdips4ms7));
                                                    $hasilips4ms7 = number_format($hasilips4ms7,3);
                                                    $e =-(pow(($ips4-$meanips4ms7),$pangkat2))/2*(pow($sdips4ms7,$pangkat2));
                                                    $e = number_format($e,3);
                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);
                                                    $cobaips4ms7 = $hasilips4ms7*$perkalian;
                                                    $cobaips4ms7 = number_format($cobaips4ms7,3);
                                                // keterangan masa studi = 8
                                                    $hasilips4ms8 = (1/sqrt(2*3.14*$sdips4ms8));
                                                    $hasilips4ms8 = number_format($hasilips4ms8,3);
                                                    $e =-(pow(($ips4-$meanips4ms8),$pangkat2))/2*(pow($sdips4ms8,$pangkat2));
                                                    $e = number_format($e,3);
                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);
                                                    $cobaips4ms8 = $hasilips4ms8*$perkalian;
                                                    $cobaips4ms8 = number_format($cobaips4ms8,3);
                                                // keterangan masa studi = 9
                                                    $hasilips4ms9 = (1/sqrt(2*3.14*$sdips4ms9));
                                                    $hasilips4ms9 = number_format($hasilips4ms9,3);
                                                    $e =-(pow(($ips4-$meanips4ms9),$pangkat2))/2*(pow($sdips4ms9,$pangkat2));
                                                    $e = number_format($e,3);
                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);
                                                    $cobaips4ms9 = $hasilips4ms9*$perkalian;
                                                    $cobaips4ms9 = number_format($cobaips4ms9,3);
                                                // keterangan masa studi = 10
                                                    $hasilips4ms10 = (1/sqrt(2*3.14*$sdips4ms10));
                                                    $hasilips4ms10 = number_format($hasilips4ms10,3);
                                                    $e =-(pow(($ips4-$meanips4ms10),$pangkat2))/2*(pow($sdips4ms10,$pangkat2));
                                                    $e = number_format($e,3);
                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);
                                                    $cobaips4ms10 = $hasilips4ms10*$perkalian;
                                                    $cobaips4ms10 = number_format($cobaips4ms10,3);
                                        // akhir menghitung IPS
                                    ?>
                                    <!-- awal baris menghitung IPS -->
                                    <tr>                                      
                                        <th><b><i>IPS SEMESTER 1 | Y = 7 semester</i></b></th>
                                        <th><b>IPS SEMESTER 2 | Y = 7 semester</i></b></th>
                                       <th><b><i>IPS SEMESTER 3 | Y = 7 semester</i></b></th>
                                        <th><b><i>IPS SEMESTER 4 | Y = 7 semester</i></b></th>
                                        <th><b><i>IPS SEMESTER 1 | Y = 8 semester</i></b></th>
                                        <th><b><i>IPS SEMESTER 2 | Y = 8 semester</i></b></th>
                                       <th><b><i>IPS SEMESTER 3 | Y = 8 semester</i></b></th>
                                        <th><b><i>IPS SEMESTER 4 | Y = 8 semester</i></b></th>
                                    </tr>
                                    <tr>              
                                        <td><?php echo $cobaips1ms7; ?> </td>
                                        <td><?php echo $cobaips2ms7; ?> </td>
                                        <td><?php echo $cobaips3ms7; ?> </td>
                                        <td><?php echo $cobaips4ms7; ?> </td>
                                        <td><?php echo $cobaips1ms8; ?> </td>
                                        <td><?php echo $cobaips2ms8; ?> </td>
                                        <td><?php echo $cobaips3ms8; ?> </td>
                                        <td><?php echo $cobaips4ms8; ?> </td>
                                    </tr>
                                    <tr>                                      
                                        <th><b><i>IPS SEMESTER 1 | Y = 9 semester</i></b></th>
                                        <th><b><i>IPS SEMESTER 2 | Y = 9 semester</i></b></th>
                                       <th><b><i>IPS SEMESTER 3 | Y = 9 semester</i></b></th>
                                        <th><b><i>IPS SEMESTER 4 | Y = 9 semester</i></b></th>
                                        <th><b><i>IPS SEMESTER 1 | Y = 10 semester</i></b></th>
                                        <th><b><i>IPS SEMESTER 2 | Y = 10 semester</i></b></th>
                                       <th><b><i>IPS SEMESTER 3 | Y = 10 semester</i></b></th>
                                        <th><b><i>IPS SEMESTER 4 | Y = 10 semester</i></b></th>
                                    </tr>
                                    <tr>              
                                        <td><?php echo $cobaips1ms9; ?> </td>
                                        <td><?php echo $cobaips2ms9; ?> </td>
                                        <td><?php echo $cobaips3ms9; ?> </td>
                                        <td><?php echo $cobaips4ms9; ?> </td>
                                        <td><?php echo $cobaips1ms10; ?> </td>
                                        <td><?php echo $cobaips2ms10; ?> </td>
                                        <td><?php echo $cobaips3ms10; ?> </td>
                                        <td><?php echo $cobaips4ms10; ?> </td>
                                    </tr>
                                    <!-- /askhir baris menghitung IPS -->
                                </table>
                            </div>
                        <!-- </div> -->
                    </div>
                <!-- /Akhir cara hitung prediksi masa studi -->

                <!-- AWAL cara hitung prediksi IPK -->
                    <div class="tab-pane" id="tab3t2">
                        <!-- <div class="panel panel-info">
                            <div class="panel-heading"> cara hitung prediksi IPK </div> -->
                            <div class="panel-body">
                                <!-- query untuk menghitung total data jenis kelamin dan status mahasiswa  -->
                                <?php  
                                    // Query mencari jenis kelamin dan status mahasisswa
									// total data 'jenis-kelamin yang dicari' dengan 'IPK Cumlaude' pada data training 
										$sql = "SELECT COUNT(*) AS jumlah FROM tb_datatraining where jk = '$jk' and ipk_lulus >=3.51 && ipk_lulus<=4.00";
										$query = mysqli_query($konek_db,$sql);
										$result = mysqli_fetch_array($query);
										$jkcumlaude = $result['jumlah'];
										$hasiljkcumlaude = $jkcumlaude/$totaldataipkcumlaude;

									// total data 'jenis-kelamin yang dicari' dengan 'IPK Sangat Memuaskan' pada data training
										$sql = "SELECT COUNT(*) AS jumlah FROM tb_datatraining where jk = '$jk' and ipk_lulus >=2.76 && ipk_lulus<=3.50";
										$query = mysqli_query($konek_db,$sql);
										$result = mysqli_fetch_array($query);
										$jksgtmemuaskan = $result['jumlah'];
										$hasiljksgtmemuaskan = $jksgtmemuaskan/$totaldataipksgtmemuaskan;

									// total data 'jenis-kelamin yang dicari' dengan 'IPK Memuaskan' pada data training
										$sql = "SELECT COUNT(*) AS jumlah FROM tb_datatraining where jk = '$jk' and ipk_lulus >=2.00 && ipk_lulus<=2.75";
										$query = mysqli_query($konek_db,$sql);
										$result = mysqli_fetch_array($query);
										$jkmemuaskan = $result['jumlah'];
										$hasiljkmemuaskan = $jkmemuaskan/$totaldataipkmemuaskan;

									// total data 'STATUS MAHASISWA yang dicari' dengan 'IPK Cumlaude' pada data training
										$sql = "SELECT COUNT(*) AS jumlah FROM tb_datatraining where status_mahasiswa = '$sm' and ipk_lulus >=3.51 && ipk_lulus<=4.00";
										$query = mysqli_query($konek_db,$sql);
										$result = mysqli_fetch_array($query);
										$smcumlaude = $result['jumlah'];
										$hasilsmcumlaude = $smcumlaude/$totaldataipkcumlaude;

									// total data 'STATUS MAHASISWA yang dicari' dengan 'IPK Sangat Memuaskan' pada data training
										$sql = "SELECT COUNT(*) AS jumlah FROM tb_datatraining where status_mahasiswa = '$sm' and ipk_lulus >=2.76 && ipk_lulus<=3.50";
										$query = mysqli_query($konek_db,$sql);
										$result = mysqli_fetch_array($query);
										$smsgtmemuaskan = $result['jumlah'];
										$hasilsmsgtmemuaskan = $smsgtmemuaskan/$totaldataipksgtmemuaskan;

									// total data 'STATUS MAHASISWA yang dicari' dengan 'IPK Memuaskan' pada data training
										$sql = "SELECT COUNT(*) AS jumlah FROM tb_datatraining where status_mahasiswa = '$sm' and ipk_lulus >=2.00 && ipk_lulus<=2.75";
										$query = mysqli_query($konek_db,$sql);
										$result = mysqli_fetch_array($query);
										$smmemuaskan = $result['jumlah'];
										$hasilsmmemuaskan = $smmemuaskan/$totaldataipkmemuaskan;
								    // Akhir Query mencari jenis kelamin dan status mahasisswa                              
                                ?>
                                <!-- Akhir query untuk menghitung total data jenis kelamin dan status mahasiswa  -->
                                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <!-- awal baris menghitung jenis kelamin -->
                                    <tr>              
                                        <th >Jumlah data JENIS KELAMIN = <i> <?php echo $jk; ?> </i> | Y= cumlaude</th>
                                        <td ><?php echo $jkcumlaude; ?></td>
                                    </tr>
                                    <tr>              
                                        <th >Jumlah data JENIS KELAMIN = <i> <?php echo $jk; ?> </i> | Y= sangat memuaskan</th>
                                        <td ><?php echo $jksgtmemuaskan; ?></td>
                                    </tr>

                                    <tr>              
                                        <th >Jumlah data JENIS KELAMIN = <i> <?php echo $jk; ?> </i> | Y = memuaskan</th>
                                        <td ><?php echo $jkmemuaskan; ?></td>
                                    </tr>          
                                    <tr>                                      
                                        <th >P(JENIS KELAMIN = <i> <?php echo $jk; ?> </i> | Y= cumlaude / Total data cumlaude</th>
                                        <td >
                                            <?php
                                                if ($hasiljkcumlaude > 0) {
                                                    echo $hasiljkcumlaude;
                                                }else {
                                                   echo 0;
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                    
                                    <tr>              
                                        <th >P(JENIS KELAMIN = <i> <?php echo $jk; ?> </i> | Y= sangat memuaskan / Total data sangat memuaskan</th>
                                        <td >
                                            <?php
                                                 if ($hasiljksgtmemuaskan > 0) {
                                                    echo $hasiljksgtmemuaskan;
                                                }else {
                                                   echo 0;
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                    
                                    <tr>              
                                        <th >P(JENIS KELAMIN = <i> <?php echo $jk; ?> </i> | Y k / total data memuaskan </th>
                                        <td >
                                            <?php
                                                 if ($hasiljkmemuaskan > 0) {
                                                    echo $hasiljkmemuaskan;
                                                }else {
                                                   echo 0;
                                                }
                                                
                                            ?>
                                        </td>
                                    </tr>
                                <!-- akhir baris menghitung jenis kelamin -->

                                    <tr>
                                        <td colspan="2"><h5>Status Mahasiswa</h5></td>
                                    </tr>
                                
                                <!-- awal baris menghitung Status Mahasiswa -->
                                    <tr>              
                                        <th >Jumlah data Status Mahasiswa = <i> <?php echo $sm; ?> </i> | Y= IPK Cumlaude</th>
                                        <td ><?php echo $smcumlaude; ?></td>
                                    </tr>
                                     <tr>              
                                        <th >Jumlah data Status Mahasiswa = <i> <?php echo $sm; ?> </i> | Y= IPK Sangat Memuaskan</th>
                                        <td ><?php echo $smsgtmemuaskan; ?></td>
                                    </tr>
                                    <tr>              
                                        <th >Jumlah data Status Mahasiswa = <i> <?php echo $sm; ?> </i> | IPK Memuaskan</th>
                                        <td ><?php echo $smmemuaskan; ?></td>
                                    </tr>       
                                    <tr>                                      
                                        <th  >P(Status Mahasiswa = <i> <?php echo $sm; ?> </i> | Y= IPK Cumlaude) / Total data IPK Cumlaude</th>
                                        <td >
                                            <?php
                                                if ($hasilsmcumlaude > 0) {
                                                    $hasilsmcumlaude = number_format($hasilsmcumlaude,8);
                                                    echo $hasilsmcumlaude;
                                                }else {
                                                   echo 0;
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                   
                                    <tr>              
                                        <th >P(Status Mahasiswa = <i> <?php echo $sm; ?> </i> | Y= IPK Sangat Memuaskan ) / Total data IPK Sangat Memuaskan</th>
                                        <td >
                                            <?php
                                                if ($hasilsmsgtmemuaskan > 0) {
                                                    $hasilsmsgtmemuaskan = number_format($hasilsmsgtmemuaskan,8);
                                                    echo $hasilsmsgtmemuaskan;
                                                }else {
                                                   echo 0;
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                    
                                    <tr>              
                                        <th >P(Status Mahasiswa = <i> <?php echo $sm; ?> </i> | Y= IPK Memuaskan) / total data IPK Memuaskan</th>
                                        <td >
                                            <?php
                                                if ($hasilsmmemuaskan > 0) {
                                                    $hasilsmmemuaskan = number_format($hasilsmmemuaskan,8);
                                                    echo $hasilsmmemuaskan;
                                                }else {
                                                   echo 0;
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                <!-- akhir baris menghitung Status Mahasiswa -->

                                    <tr>
                                        <td colspan="2" ><h5>IPK</h5></td>
                                    </tr>

                                
                                    <?php
                                    // QUERY MEAN dan STANDAR DEVIASI IPK
                                        // Query ipk_lulus >=3.51 && ipk_lulus<=4.00 (cumlaude)
                                            // Mean IPK1 dengan keterangan semester ipk_lulus >=3.51 && ipk_lulus<=4.00 
                                                $sql = "SELECT AVG(ipk_1) FROM tb_datatraining  WHERE ipk_lulus >=3.51 && ipk_lulus<=4.00";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $meanipk1cumlaude = $result[0];
                                                $meanipk1cumlaude = number_format($meanipk1cumlaude,3);
                                            // Mean IPK2 dengan keterangan semester ipk_lulus >=3.51 && ipk_lulus<=4.00 
                                                $sql = "SELECT AVG(ipk_2) FROM tb_datatraining  WHERE ipk_lulus >=3.51 && ipk_lulus<=4.00";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $meanipk2cumlaude = $result[0];
                                                $meanipk2cumlaude = number_format($meanipk2cumlaude,3);
                                            // Mean IPK3 dengan keterangan semester ipk_lulus >=3.51 && ipk_lulus<=4.00 
                                                $sql = "SELECT AVG(ipk_3) FROM tb_datatraining  WHERE ipk_lulus >=3.51 && ipk_lulus<=4.00";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $meanipk3cumlaude = $result[0];
                                                $meanipk3cumlaude = number_format($meanipk3cumlaude,3);
                                            // Mean IPK4 dengan keterangan semester ipk_lulus >=3.51 && ipk_lulus<=4.00 
                                                $sql = "SELECT AVG(ipk_4) FROM tb_datatraining  WHERE ipk_lulus >=3.51 && ipk_lulus<=4.00";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $meanipk4cumlaude = $result[0];
                                                $meanipk4cumlaude = number_format($meanipk4cumlaude,3);
                                            //standar deviasi IPK dengan keterangan  semester ipk_lulus >=3.51 && ipk_lulus<=4.00 
                                                $sql = "SELECT STD(ipk_1) FROM tb_datatraining WHERE ipk_lulus >=3.51 && ipk_lulus<=4.00";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $sdipk1cumlaude = $result[0];
                                                $sdipk1cumlaude = number_format($sdipk1cumlaude,3);
                                            //standar deviasi IPK dengan keterangan semester ipk_lulus >=3.51 && ipk_lulus<=4.00 
                                                $sql = "SELECT STD(ipk_2) FROM tb_datatraining WHERE ipk_lulus >=3.51 && ipk_lulus<=4.00";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $sdipk2cumlaude = $result[0];
                                                $sdipk2cumlaude = number_format($sdipk2cumlaude,3);
                                            //standar deviasi IPK dengan keterangan  semester ipk_lulus >=3.51 && ipk_lulus<=4.00
                                                $sql = "SELECT STD(ipk_3) FROM tb_datatraining WHERE ipk_lulus >=3.51 && ipk_lulus<=4.00";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $sdipk3cumlaude = $result[0];
                                                $sdipk3cumlaude = number_format($sdipk3cumlaude,3);
                                            //standar deviasi IPK dengan keterangan semester ipk_lulus >=3.51 && ipk_lulus<=4.00 
                                                $sql = "SELECT STD(ipk_4) FROM tb_datatraining WHERE ipk_lulus >=3.51 && ipk_lulus<=4.00";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $sdipk4cumlaude = $result[0];
                                                $sdipk4cumlaude = number_format($sdipk4cumlaude,3);
                                        // Query ipk_lulus >=2.76 && ipk_lulus<=3.50 (sgt memuaskan)
                                            // Mean IPK1 dengan keterangan semester ipk_lulus >=2.76 && ipk_lulus<=3.50 
                                                $sql = "SELECT AVG(ipk_1) FROM tb_datatraining  WHERE ipk_lulus >=2.76 && ipk_lulus<=3.50";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $meanipk1sgtmemuaskan = $result[0];
                                                $meanipk1sgtmemuaskan = number_format($meanipk1sgtmemuaskan,3);
                                            // Mean IPK2 dengan keterangan semester ipk_lulus >=2.76 && ipk_lulus<=3.50 
                                                $sql = "SELECT AVG(ipk_2) FROM tb_datatraining  WHERE ipk_lulus >=2.76 && ipk_lulus<=3.50";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $meanipk2sgtmemuaskan = $result[0];
                                                $meanipk2sgtmemuaskan = number_format($meanipk2sgtmemuaskan,3);
                                            // Mean IPK3 dengan keterangan semester ipk_lulus >=2.76 && ipk_lulus<=3.50 
                                                $sql = "SELECT AVG(ipk_3) FROM tb_datatraining  WHERE ipk_lulus >=2.76 && ipk_lulus<=3.50";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $meanipk3sgtmemuaskan = $result[0];
                                                $meanipk3sgtmemuaskan = number_format($meanipk3sgtmemuaskan,3);
                                            // Mean IPK4 dengan keterangan semester ipk_lulus >=2.76 && ipk_lulus<=3.50 
                                                $sql = "SELECT AVG(ipk_4) FROM tb_datatraining  WHERE ipk_lulus >=2.76 && ipk_lulus<=3.50";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $meanipk4sgtmemuaskan = $result[0];
                                                $meanipk4sgtmemuaskan = number_format($meanipk4sgtmemuaskan,3);
                                            //standar deviasi IPK dengan keterangan  semester ipk_lulus >=2.76 && ipk_lulus<=3.50 
                                                $sql = "SELECT STD(ipk_1) FROM tb_datatraining WHERE ipk_lulus >=2.76 && ipk_lulus<=3.50";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $sdipk1sgtmemuaskan = $result[0];
                                                $sdipk1sgtmemuaskan = number_format($sdipk1sgtmemuaskan,3);
                                            //standar deviasi IPK dengan keterangan semester ipk_lulus >=2.76 && ipk_lulus<=3.50 
                                                $sql = "SELECT STD(ipk_2) FROM tb_datatraining WHERE ipk_lulus >=2.76 && ipk_lulus<=3.50";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $sdipk2sgtmemuaskan = $result[0];
                                                $sdipk2sgtmemuaskan = number_format($sdipk2sgtmemuaskan,3);
                                            //standar deviasi IPK dengan keterangan  semester ipk_lulus >=2.76 && ipk_lulus<=3.50
                                                $sql = "SELECT STD(ipk_3) FROM tb_datatraining WHERE ipk_lulus >=2.76 && ipk_lulus<=3.50";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $sdipk3sgtmemuaskan = $result[0];
                                                $sdipk3sgtmemuaskan = number_format($sdipk3sgtmemuaskan,3);
                                            //standar deviasi IPK dengan keterangan semester ipk_lulus >=2.76 && ipk_lulus<=3.50 
                                                $sql = "SELECT STD(ipk_4) FROM tb_datatraining WHERE ipk_lulus >=2.76 && ipk_lulus<=3.50";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $sdipk4sgtmemuaskan = $result[0];
                                                $sdipk4sgtmemuaskan = number_format($sdipk4sgtmemuaskan,3);
                                        // Query ipk_lulus >=2.00 && ipk_lulus<=2.75 (memuaskan)
                                            // Mean IPK1 dengan keterangan semester >=2.00 && ipk_lulus<=2.75 
                                                $sql = "SELECT AVG(ipk_1) FROM tb_datatraining  WHERE ipk_lulus>=2.00 && ipk_lulus<=2.75";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $meanipk1memuaskan = $result[0];
                                                $meanipk1memuaskan = number_format($meanipk1memuaskan,3);
                                            // Mean IPK2 dengan keterangan semester >=2.00 && ipk_lulus<=2.75 
                                                $sql = "SELECT AVG(ipk_2) FROM tb_datatraining  WHERE ipk_lulus>=2.00 && ipk_lulus<=2.75";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $meanipk2memuaskan = $result[0];
                                                $meanipk2memuaskan = number_format($meanipk2memuaskan,3);
                                            // Mean IPK3 dengan keterangan semester >=2.00 && ipk_lulus<=2.75 
                                                $sql = "SELECT AVG(ipk_3) FROM tb_datatraining  WHERE ipk_lulus>=2.00 && ipk_lulus<=2.75";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $meanipk3memuaskan = $result[0];
                                                $meanipk3memuaskan = number_format($meanipk3memuaskan,3);
                                            // Mean IPK4 dengan keterangan semester >=2.00 && ipk_lulus<=2.75 
                                                $sql = "SELECT AVG(ipk_4) FROM tb_datatraining  WHERE ipk_lulus>=2.00 && ipk_lulus<=2.75";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $meanipk4memuaskan = $result[0];
                                                $meanipk4memuaskan = number_format($meanipk4memuaskan,3);
                                            //standar deviasi IPK dengan keterangan  semester >=2.00 && ipk_lulus<=2.75 
                                                $sql = "SELECT STD(ipk_1) FROM tb_datatraining WHERE ipk_lulus>=2.00 && ipk_lulus<=2.75";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $sdipk1memuaskan = $result[0];
                                                $sdipk1memuaskan = number_format($sdipk1memuaskan,3);
                                            //standar deviasi IPK dengan keterangan semester >=2.00 && ipk_lulus<=2.75 
                                                $sql = "SELECT STD(ipk_2) FROM tb_datatraining WHERE ipk_lulus>=2.00 && ipk_lulus<=2.75";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $sdipk2memuaskan = $result[0];
                                                $sdipk2memuaskan = number_format($sdipk2memuaskan,3);
                                            //standar deviasi IPK dengan keterangan  semester >=2.00 && ipk_lulus<=2.75
                                                $sql = "SELECT STD(ipk_3) FROM tb_datatraining WHERE ipk_lulus>=2.00 && ipk_lulus<=2.75";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $sdipk3memuaskan = $result[0];
                                                $sdipk3memuaskan = number_format($sdipk3memuaskan,3);
                                            //standar deviasi IPK dengan keterangan semester >=2.00 && ipk_lulus<=2.75 
											$sql = "SELECT STD(ipk_4) FROM tb_datatraining WHERE ipk_lulus>=2.00 && ipk_lulus<=2.75";
											$query = mysqli_query($konek_db,$sql);
											$result = mysqli_fetch_array($query);
											$sdipk4memuaskan = $result[0];
											$sdipk4memuaskan = number_format($sdipk4memuaskan,3);
									

                                    // Akhir QUERY MEAN dan STANDAR DEVIASI IPK
                                    // QUERY MEAN dan STANDAR DEVIASI IPS
                                        // Query ipk_lulus >=3.51 && ipk_lulus<=4.00 (cumlaude)
                                            // Mean IPS1 dengan keterangan semester ipk_lulus >=3.51 && ipk_lulus<=4.00 
                                                $sql = "SELECT AVG(ips_1) FROM tb_datatraining  WHERE ipk_lulus >=3.51 && ipk_lulus<=4.00";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $meanips1cumlaude = $result[0];
                                                $meanips1cumlaude = number_format($meanips1cumlaude,3);
                                            // Mean IPS2 dengan keterangan semester ipk_lulus >=3.51 && ipk_lulus<=4.00 
                                                $sql = "SELECT AVG(ips_2) FROM tb_datatraining  WHERE ipk_lulus >=3.51 && ipk_lulus<=4.00";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $meanips2cumlaude = $result[0];
                                                $meanips2cumlaude = number_format($meanips2cumlaude,3);
                                            // Mean IPS3 dengan keterangan semester ipk_lulus >=3.51 && ipk_lulus<=4.00 
                                                $sql = "SELECT AVG(ips_3) FROM tb_datatraining  WHERE ipk_lulus >=3.51 && ipk_lulus<=4.00";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $meanips3cumlaude = $result[0];
                                                $meanips3cumlaude = number_format($meanips3cumlaude,3);
                                            // Mean IPS4 dengan keterangan semester ipk_lulus >=3.51 && ipk_lulus<=4.00 
                                                $sql = "SELECT AVG(ips_4) FROM tb_datatraining  WHERE ipk_lulus >=3.51 && ipk_lulus<=4.00";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $meanips4cumlaude = $result[0];
                                                $meanips4cumlaude = number_format($meanips4cumlaude,3);
                                            //standar deviasi IPS dengan keterangan  semester ipk_lulus >=3.51 && ipk_lulus<=4.00 
                                                $sql = "SELECT STD(ips_1) FROM tb_datatraining WHERE ipk_lulus >=3.51 && ipk_lulus<=4.00";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $sdips1cumlaude = $result[0];
                                                $sdips1cumlaude = number_format($sdips1cumlaude,3);
                                            //standar deviasi IPS dengan keterangan semester ipk_lulus >=3.51 && ipk_lulus<=4.00 
                                                $sql = "SELECT STD(ips_2) FROM tb_datatraining WHERE ipk_lulus >=3.51 && ipk_lulus<=4.00";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $sdips2cumlaude = $result[0];
                                                $sdips2cumlaude = number_format($sdips2cumlaude,3);
                                            //standar deviasi IPS dengan keterangan  semester ipk_lulus >=3.51 && ipk_lulus<=4.00
                                                $sql = "SELECT STD(ips_3) FROM tb_datatraining WHERE ipk_lulus >=3.51 && ipk_lulus<=4.00";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $sdips3cumlaude = $result[0];
                                                $sdips3cumlaude = number_format($sdips3cumlaude,3);
                                            //standar deviasi IPS dengan keterangan semester ipk_lulus >=3.51 && ipk_lulus<=4.00 
                                                $sql = "SELECT STD(ips_4) FROM tb_datatraining WHERE ipk_lulus >=3.51 && ipk_lulus<=4.00";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $sdips4cumlaude = $result[0];
                                                $sdips4cumlaude = number_format($sdips4cumlaude,3);
                                        // Query ipk_lulus >=2.76 && ipk_lulus<=3.50 (sgt memuaskan)
                                            // Mean IPS1 dengan keterangan semester ipk_lulus >=2.76 && ipk_lulus<=3.50 
                                                $sql = "SELECT AVG(ips_1) FROM tb_datatraining  WHERE ipk_lulus >=2.76 && ipk_lulus<=3.50";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $meanips1sgtmemuaskan = $result[0];
                                                $meanips1sgtmemuaskan = number_format($meanips1sgtmemuaskan,3);
                                            // Mean IPS2 dengan keterangan semester ipk_lulus >=2.76 && ipk_lulus<=3.50 
                                                $sql = "SELECT AVG(ips_2) FROM tb_datatraining  WHERE ipk_lulus >=2.76 && ipk_lulus<=3.50";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $meanips2sgtmemuaskan = $result[0];
                                                $meanips2sgtmemuaskan = number_format($meanips2sgtmemuaskan,3);
                                            // Mean IPS3 dengan keterangan semester ipk_lulus >=2.76 && ipk_lulus<=3.50 
                                                $sql = "SELECT AVG(ips_3) FROM tb_datatraining  WHERE ipk_lulus >=2.76 && ipk_lulus<=3.50";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $meanips3sgtmemuaskan = $result[0];
                                                $meanips3sgtmemuaskan = number_format($meanips3sgtmemuaskan,3);
                                            // Mean IPS4 dengan keterangan semester ipk_lulus >=2.76 && ipk_lulus<=3.50 
                                                $sql = "SELECT AVG(ips_4) FROM tb_datatraining  WHERE ipk_lulus >=2.76 && ipk_lulus<=3.50";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $meanips4sgtmemuaskan = $result[0];
                                                $meanips4sgtmemuaskan = number_format($meanips4sgtmemuaskan,3);
                                            //standar deviasi IPS dengan keterangan  semester ipk_lulus >=2.76 && ipk_lulus<=3.50 
                                                $sql = "SELECT STD(ips_1) FROM tb_datatraining WHERE ipk_lulus >=2.76 && ipk_lulus<=3.50";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $sdips1sgtmemuaskan = $result[0];
                                                $sdips1sgtmemuaskan = number_format($sdips1sgtmemuaskan,3);
                                            //standar deviasi IPS dengan keterangan semester ipk_lulus >=2.76 && ipk_lulus<=3.50 
                                                $sql = "SELECT STD(ips_2) FROM tb_datatraining WHERE ipk_lulus >=2.76 && ipk_lulus<=3.50";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $sdips2sgtmemuaskan = $result[0];
                                                $sdips2sgtmemuaskan = number_format($sdips2sgtmemuaskan,3);
                                            //standar deviasi IPS dengan keterangan  semester ipk_lulus >=2.76 && ipk_lulus<=3.50
                                                $sql = "SELECT STD(ips_3) FROM tb_datatraining WHERE ipk_lulus >=2.76 && ipk_lulus<=3.50";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $sdips3sgtmemuaskan = $result[0];
                                                $sdips3sgtmemuaskan = number_format($sdips3sgtmemuaskan,3);
                                            //standar deviasi IPS dengan keterangan semester ipk_lulus >=2.76 && ipk_lulus<=3.50 
                                                $sql = "SELECT STD(ips_4) FROM tb_datatraining WHERE ipk_lulus >=2.76 && ipk_lulus<=3.50";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $sdips4sgtmemuaskan = $result[0];
                                                $sdips4sgtmemuaskan = number_format($sdips4sgtmemuaskan,3);
                                        // Query ipk_lulus >=2.00 && ipk_lulus<=2.75 (memuaskan)
                                            // Mean IPS1 dengan keterangan semester >=2.00 && ipk_lulus<=2.75 
                                                $sql = "SELECT AVG(ips_1) FROM tb_datatraining  WHERE ipk_lulus>=2.00 && ipk_lulus<=2.75";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $meanips1memuaskan = $result[0];
                                                $meanips1memuaskan = number_format($meanips1memuaskan,3);
                                            // Mean IPS2 dengan keterangan semester >=2.00 && ipk_lulus<=2.75 
                                                $sql = "SELECT AVG(ips_2) FROM tb_datatraining  WHERE ipk_lulus>=2.00 && ipk_lulus<=2.75";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $meanips2memuaskan = $result[0];
                                                $meanips2memuaskan = number_format($meanips2memuaskan,3);
                                            // Mean IPS3 dengan keterangan semester >=2.00 && ipk_lulus<=2.75 
                                                $sql = "SELECT AVG(ips_3) FROM tb_datatraining  WHERE ipk_lulus>=2.00 && ipk_lulus<=2.75";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $meanips3memuaskan = $result[0];
                                                $meanips3memuaskan = number_format($meanips3memuaskan,3);
                                            // Mean IPS4 dengan keterangan semester >=2.00 && ipk_lulus<=2.75 
                                                $sql = "SELECT AVG(ips_4) FROM tb_datatraining  WHERE ipk_lulus>=2.00 && ipk_lulus<=2.75";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $meanips4memuaskan = $result[0];
                                                $meanips4memuaskan = number_format($meanips4memuaskan,3);
                                            //standar deviasi IPS dengan keterangan  semester >=2.00 && ipk_lulus<=2.75 
                                                $sql = "SELECT STD(ips_1) FROM tb_datatraining WHERE ipk_lulus>=2.00 && ipk_lulus<=2.75";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $sdips1memuaskan = $result[0];
                                                $sdips1memuaskan = number_format($sdips1memuaskan,3);
                                            //standar deviasi IPS dengan keterangan semester >=2.00 && ipk_lulus<=2.75 
                                                $sql = "SELECT STD(ips_2) FROM tb_datatraining WHERE ipk_lulus>=2.00 && ipk_lulus<=2.75";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $sdips2memuaskan = $result[0];
                                                $sdips2memuaskan = number_format($sdips2memuaskan,3);
                                            //standar deviasi IPS dengan keterangan  semester >=2.00 && ipk_lulus<=2.75
                                                $sql = "SELECT STD(ips_3) FROM tb_datatraining WHERE ipk_lulus>=2.00 && ipk_lulus<=2.75";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $sdips3memuaskan = $result[0];
                                                $sdips3memuaskan = number_format($sdips3memuaskan,3);
                                            //standar deviasi IPS dengan keterangan semester >=2.00 && ipk_lulus<=2.75 
                                                $sql = "SELECT STD(ips_4) FROM tb_datatraining WHERE ipk_lulus>=2.00 && ipk_lulus<=2.75";
                                                $query = mysqli_query($konek_db,$sql);
                                                $result = mysqli_fetch_array($query);
                                                $sdips4memuaskan = $result[0];
                                                $sdips4memuaskan = number_format($sdips4memuaskan,3);
                                    // Akhir QUERY MEAN dan STANDAR DEVIASI IPS
                                        // $sql = "SELECT STD(ipk_3) FROM tb_datatraining WHERE masa_studi <=8";
                                        // $query = mysqli_query($konek_db,$sql);
                                        // $result = mysqli_fetch_array($query);
                                        // $sdipk3krg8 = $result[0];

                                    ?>
                                <!-- awal baris untuk menghitung MEAN dan standar deviasi IPK -->
                                    <tr>
                                        <th><b><i>MEAN IPK semester 1 | Y = cumlaude</i></b></th>
                                        <td><?php echo $meanipk1cumlaude ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>MEAN IPK semester 2 | Y = cumlaude</i></b></th>
                                        <td><?php echo $meanipk2cumlaude ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>MEAN IPK semester 3 | Y = cumlaude</i></b></th>
                                        <td><?php echo $meanipk3cumlaude ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>MEAN IPK semester 4 | Y = cumlaude</i></b></th>
                                        <td><?php echo $meanipk4cumlaude ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>MEAN IPK semester 1 | Y = sangat memuaskan</i></b></th>
                                        <td><?php echo $meanipk1sgtmemuaskan ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>MEAN IPK semester 2 | Y = sangat memuaskan</i></b></th>
                                        <td><?php echo $meanipk2sgtmemuaskan ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>MEAN IPK semester 3 | Y = sangat memuaskan</i></b></th>
                                        <td><?php echo $meanipk3sgtmemuaskan ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>MEAN IPK semester 4 | Y = sangat memuaskan</i></b></th>
                                        <td><?php echo $meanipk4sgtmemuaskan ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>MEAN IPK semester 1 | Y = memuaskan</i></b></th>
                                        <td><?php echo $meanipk1memuaskan ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>MEAN IPK semester 2 | Y = memuaskan</i></b></th>
                                        <td><?php echo $meanipk2memuaskan ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>MEAN IPK semester 3 | Y = memuaskan</i></b></th>
                                        <td><?php echo $meanipk3memuaskan ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>MEAN IPK semester 4 | Y = memuaskan</i></b></th>
                                        <td><?php echo $meanipk4memuaskan ?></td>
                                    </tr>

                                    <tr>
                                        <th><b><i>Standar Deviasi IPK semester 1 | Y = cumlaude</i></b></th>
                                        <td><?php echo $sdipk1cumlaude ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>Standar Deviasi IPK semester 2 | Y = cumlaude</i></b></th>
                                        <td><?php echo $sdipk2cumlaude ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>Standar Deviasi IPK semester 3 | Y = cumlaude</i></b></th>
                                        <td><?php echo $sdipk3cumlaude ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>Standar Deviasi IPK semester 4 | Y = cumlaude</i></b></th>
                                        <td><?php echo $sdipk4cumlaude ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>Standar Deviasi IPK semester 1 | Y = sangat memuaskan</i></b></th>
                                        <td><?php echo $sdipk1sgtmemuaskan ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>Standar Deviasi IPK semester 2 | Y = sangat memuaskan</i></b></th>
                                        <td><?php echo $sdipk2sgtmemuaskan ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>Standar Deviasi IPK semester 3 | Y = sangat memuaskan</i></b></th>
                                        <td><?php echo $sdipk3sgtmemuaskan ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>Standar Deviasi IPK semester 4 | Y = sangat memuaskan</i></b></th>
                                        <td><?php echo $sdipk4sgtmemuaskan ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>Standar Deviasi IPK semester 1 | Y = memuaskan</i></b></th>
                                        <td><?php echo $sdipk1memuaskan ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>Standar Deviasi IPK semester 2 | Y = memuaskan</i></b></th>
                                        <td><?php echo $sdipk2memuaskan ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>Standar Deviasi IPK semester 3 | Y = memuaskan</i></b></th>
                                        <td><?php echo $sdipk3memuaskan ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>Standar Deviasi IPK semester 4 | Y = memuaskan</i></b></th>
                                        <td><?php echo $sdipk4memuaskan ?></td>
                                    </tr>
                                    
                                    
                                <!-- /akhir baris untuk menghitung MEAN dan standar deviasi IPK -->
                                    <?php 
                                        // Menghitung IPK 
                                            // menghitung IPK semester 1
                                                // keterangan ipk_lulus >=3.51 && ipk_lulus<=4.00 (cumlaude)
                                                    $hasilipk1cumlaude = (1/sqrt(2*3.14*$sdipk1cumlaude));
                                                    $hasilipk1cumlaude = number_format($hasilipk1cumlaude,3);
                                                    $e =-(pow(($ipk1-$meanipk1cumlaude),$pangkat2))/2*(pow($sdipk1cumlaude,$pangkat2));
                                                    $e = number_format($e,3);
                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);
                                                    $cobaipk1cumlaude = $hasilipk1cumlaude*$perkalian;
                                                    $cobaipk1cumlaude = number_format($cobaipk1cumlaude,8);
                                                // keterangan ipk_lulus >=2.76 && ipk_lulus<=3.50 (sgt memuaskan)
                                                    $hasilipk1sgtmemuaskan = (1/sqrt(2*3.14*$sdipk1sgtmemuaskan));
                                                    $hasilipk1sgtmemuaskan = number_format($hasilipk1sgtmemuaskan,3);
                                                    $e =-(pow(($ipk1-$meanipk1sgtmemuaskan),$pangkat2))/2*(pow($sdipk1sgtmemuaskan,$pangkat2));
                                                    $e = number_format($e,3);
                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);
                                                    $cobaipk1sgtmemuaskan = $hasilipk1sgtmemuaskan*$perkalian;
                                                    $cobaipk1sgtmemuaskan = number_format($cobaipk1sgtmemuaskan,8);
                                                // keterangan ipk_lulus >=2.00 && ipk_lulus<=2.75 (memuaskan)
                                                    $hasilipk1memuaskan = (1/sqrt(2*3.14*$sdipk1memuaskan));
                                                    $hasilipk1memuaskan = number_format($hasilipk1memuaskan,3);
                                                    $e =-(pow(($ipk1-$meanipk1memuaskan),$pangkat2))/2*(pow($sdipk1memuaskan,$pangkat2));
                                                    $e = number_format($e,3);
                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);
                                                    $cobaipk1memuaskan = $hasilipk1memuaskan*$perkalian;
                                                    $cobaipk1memuaskan = number_format($cobaipk1memuaskan,8);
                                            // menghitung IPK semester 2
                                                // keterangan ipk_lulus >=3.51 && ipk_lulus<=4.00 (cumlaude)
                                                    $hasilipk2cumlaude = (1/sqrt(2*3.14*$sdipk2cumlaude));
                                                    $hasilipk2cumlaude = number_format($hasilipk2cumlaude,3);
                                                    $e =-(pow(($ipk2-$meanipk2cumlaude),$pangkat2))/2*(pow($sdipk2cumlaude,$pangkat2));
                                                    $e = number_format($e,3);
                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);
                                                    $cobaipk2cumlaude = $hasilipk2cumlaude*$perkalian;
                                                    $cobaipk2cumlaude = number_format($cobaipk2cumlaude,8);
                                                // keterangan ipk_lulus >=2.76 && ipk_lulus<=3.50 (sgt memuaskan)
                                                    $hasilipk2sgtmemuaskan = (1/sqrt(2*3.14*$sdipk2sgtmemuaskan));
                                                    $hasilipk2sgtmemuaskan = number_format($hasilipk2sgtmemuaskan,3);
                                                    $e =-(pow(($ipk2-$meanipk2sgtmemuaskan),$pangkat2))/2*(pow($sdipk2sgtmemuaskan,$pangkat2));
                                                    $e = number_format($e,3);
                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);
                                                    $cobaipk2sgtmemuaskan = $hasilipk2sgtmemuaskan*$perkalian;
                                                    $cobaipk2sgtmemuaskan = number_format($cobaipk2sgtmemuaskan,8);
                                                // keterangan ipk_lulus >=2.00 && ipk_lulus<=2.75 (memuaskan)
                                                    $hasilipk2memuaskan = (1/sqrt(2*3.14*$sdipk2memuaskan));
                                                    $hasilipk2memuaskan = number_format($hasilipk2memuaskan,3);
                                                    $e =-(pow(($ipk2-$meanipk2memuaskan),$pangkat2))/2*(pow($sdipk2memuaskan,$pangkat2));
                                                    $e = number_format($e,3);
                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);
                                                    $cobaipk2memuaskan = $hasilipk2memuaskan*$perkalian;
                                                    $cobaipk2memuaskan = number_format($cobaipk2memuaskan,8);
                                            // menghitung IPK semester 3
                                                // keterangan ipk_lulus >=3.51 && ipk_lulus<=4.00 (cumlaude)
                                                    $hasilipk3cumlaude = (1/sqrt(2*3.14*$sdipk3cumlaude));
                                                    $hasilipk3cumlaude = number_format($hasilipk3cumlaude,3);
                                                    $e =-(pow(($ipk3-$meanipk3cumlaude),$pangkat2))/2*(pow($sdipk3cumlaude,$pangkat2));
                                                    $e = number_format($e,3);
                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);
                                                    $cobaipk3cumlaude = $hasilipk3cumlaude*$perkalian;
                                                    $cobaipk3cumlaude = number_format($cobaipk3cumlaude,8);
                                                // keterangan ipk_lulus >=2.76 && ipk_lulus<=3.50 (sgt memuaskan)
                                                    $hasilipk3sgtmemuaskan = (1/sqrt(2*3.14*$sdipk3sgtmemuaskan));
                                                    $hasilipk3sgtmemuaskan = number_format($hasilipk3sgtmemuaskan,3);
                                                    $e =-(pow(($ipk3-$meanipk3sgtmemuaskan),$pangkat2))/2*(pow($sdipk3sgtmemuaskan,$pangkat2));
                                                    $e = number_format($e,3);
                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);
                                                    $cobaipk3sgtmemuaskan = $hasilipk3sgtmemuaskan*$perkalian;
                                                    $cobaipk3sgtmemuaskan = number_format($cobaipk3sgtmemuaskan,8);
                                                // keterangan ipk_lulus >=2.00 && ipk_lulus<=2.75 (memuaskan)
                                                    $hasilipk3memuaskan = (1/sqrt(2*3.14*$sdipk3memuaskan));
                                                    $hasilipk3memuaskan = number_format($hasilipk3memuaskan,3);
                                                    $e =-(pow(($ipk3-$meanipk3memuaskan),$pangkat2))/2*(pow($sdipk3memuaskan,$pangkat2));
                                                    $e = number_format($e,3);
                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);
                                                    $cobaipk3memuaskan = $hasilipk3memuaskan*$perkalian;
                                                    $cobaipk3memuaskan = number_format($cobaipk3memuaskan,8);
                                            // menghitung IPK semester 4
                                                // keterangan ipk_lulus >=3.51 && ipk_lulus<=4.00 (cumlaude)
                                                    $hasilipk4cumlaude = (1/sqrt(2*3.14*$sdipk4cumlaude));
                                                    $hasilipk4cumlaude = number_format($hasilipk4cumlaude,3);
                                                    $e =-(pow(($ipk4-$meanipk4cumlaude),$pangkat2))/2*(pow($sdipk4cumlaude,$pangkat2));
                                                    $e = number_format($e,3);
                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);
                                                    $cobaipk4cumlaude = $hasilipk4cumlaude*$perkalian;
                                                    $cobaipk4cumlaude = number_format($cobaipk4cumlaude,8);
                                                // keterangan ipk_lulus >=2.76 && ipk_lulus<=3.50 (sgt memuaskan)
                                                    $hasilipk4sgtmemuaskan = (1/sqrt(2*3.14*$sdipk4sgtmemuaskan));
                                                    $hasilipk4sgtmemuaskan = number_format($hasilipk4sgtmemuaskan,3);
                                                    $e =-(pow(($ipk4-$meanipk4sgtmemuaskan),$pangkat2))/2*(pow($sdipk4sgtmemuaskan,$pangkat2));
                                                    $e = number_format($e,3);
                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);
                                                    $cobaipk4sgtmemuaskan = $hasilipk4sgtmemuaskan*$perkalian;
                                                    $cobaipk4sgtmemuaskan = number_format($cobaipk4sgtmemuaskan,8);
                                                // keterangan ipk_lulus >=2.00 && ipk_lulus<=2.75 (memuaskan)
                                                    $hasilipk4memuaskan = (1/sqrt(2*3.14*$sdipk4memuaskan));
                                                    $hasilipk4memuaskan = number_format($hasilipk4memuaskan,3);
                                                    $e =-(pow(($ipk4-$meanipk4memuaskan),$pangkat2))/2*(pow($sdipk4memuaskan,$pangkat2));
                                                    $e = number_format($e,3);
                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);
                                                    $cobaipk4memuaskan = $hasilipk4memuaskan*$perkalian;
                                                    $cobaipk4memuaskan = number_format($cobaipk4memuaskan,8);
                                        // Akhir menghitung IPK
                                    ?>
                                <!-- awal baris untuk menghitung IPK -->
                                    <tr>
                                        <th><b><i>IPK semester 1 | Y = cumlaude</i></b></th>
                                        <td><?php echo $cobaipk1cumlaude ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>IPK semester 2 | Y = cumlaude</i></b></th>
                                        <td><?php echo $cobaipk2cumlaude ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>IPK semester 3 | Y = cumlaude</i></b></th>
                                        <td><?php echo $cobaipk3cumlaude ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>IPK semester 4 | Y = cumlaude</i></b></th>
                                        <td><?php echo $cobaipk4cumlaude ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>IPK semester 1 | Y = sangat memuaskan</i></b></th>
                                        <td><?php echo $cobaipk1sgtmemuaskan ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>IPK semester 2 | Y = sangat memuaskan</i></b></th>
                                        <td><?php echo $cobaipk2sgtmemuaskan ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>IPK semester 3 | Y = sangat memuaskan</i></b></th>
                                        <td><?php echo $cobaipk3sgtmemuaskan ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>IPK semester 4 | Y = sangat memuaskan</i></b></th>
                                        <td><?php echo $cobaipk4sgtmemuaskan ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>IPK semester 1 | Y = memuaskan</i></b></th>
                                        <td><?php echo $cobaipk1memuaskan ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>IPK semester 2 | Y = memuaskan</i></b></th>
                                        <td><?php echo $cobaipk2memuaskan ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>IPK semester 3 | Y = memuaskan</i></b></th>
                                        <td><?php echo $cobaipk3memuaskan ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>IPK semester 4 | Y = memuaskan</i></b></th>
                                        <td><?php echo $cobaipk4memuaskan ?></td>
                                    </tr>      
                                <!-- /akhir baris untuk menghitung IPK -->
                                
                                    <tr>
                                        <td colspan="2" ><h5>IPS</h5></td>
                                    </tr>
                                    
                                <!-- Awala bais untuk menghitung MEAN dan standar deviasi IPS -->
                                    <tr>
                                        <th><b><i>MEAN IPS semester 1 | Y = cumlaude</i></b></th>
                                        <td><?php echo $meanips1cumlaude ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>MEAN IPS semester 2 | Y = cumlaude</i></b></th>
                                        <td><?php echo $meanips2cumlaude ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>MEAN IPS semester 3 | Y = cumlaude</i></b></th>
                                        <td><?php echo $meanips3cumlaude ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>MEAN IPS semester 4 | Y = cumlaude</i></b></th>
                                        <td><?php echo $meanips4cumlaude ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>MEAN IPS semester 1 | Y = sangat memuaskan</i></b></th>
                                        <td><?php echo $meanips1sgtmemuaskan ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>MEAN IPS semester 2 | Y = sangat memuaskan</i></b></th>
                                        <td><?php echo $meanips2sgtmemuaskan ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>MEAN IPS semester 3 | Y = sangat memuaskan</i></b></th>
                                        <td><?php echo $meanips3sgtmemuaskan ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>MEAN IPS semester 4 | Y = sangat memuaskan</i></b></th>
                                        <td><?php echo $meanips4sgtmemuaskan ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>MEAN IPS semester 1 | Y = memuaskan</i></b></th>
                                        <td><?php echo $meanips1memuaskan ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>MEAN IPS semester 2 | Y = memuaskan</i></b></th>
                                        <td><?php echo $meanips2memuaskan ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>MEAN IPS semester 3 | Y = memuaskan</i></b></th>
                                        <td><?php echo $meanips3memuaskan ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>MEAN IPS semester 4 | Y = memuaskan</i></b></th>
                                        <td><?php echo $meanips4memuaskan ?></td>
                                    </tr>

                                    <tr>
                                        <th><b><i>Standar Deviasi IPS semester 1 | Y = cumlaude</i></b></th>
                                        <td><?php echo $sdips1cumlaude ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>Standar Deviasi IPS semester 2 | Y = cumlaude</i></b></th>
                                        <td><?php echo $sdips2cumlaude ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>Standar Deviasi IPS semester 3 | Y = cumlaude</i></b></th>
                                        <td><?php echo $sdips3cumlaude ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>Standar Deviasi IPS semester 4 | Y = cumlaude</i></b></th>
                                        <td><?php echo $sdips4cumlaude ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>Standar Deviasi IPS semester 1 | Y = sangat memuaskan</i></b></th>
                                        <td><?php echo $sdips1sgtmemuaskan ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>Standar Deviasi IPS semester 2 | Y = sangat memuaskan</i></b></th>
                                        <td><?php echo $sdips2sgtmemuaskan ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>Standar Deviasi IPS semester 3 | Y = sangat memuaskan</i></b></th>
                                        <td><?php echo $sdips3sgtmemuaskan ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>Standar Deviasi IPS semester 4 | Y = sangat memuaskan</i></b></th>
                                        <td><?php echo $sdips4sgtmemuaskan ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>Standar Deviasi IPS semester 1 | Y = memuaskan</i></b></th>
                                        <td><?php echo $sdips1memuaskan ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>Standar Deviasi IPS semester 2 | Y = memuaskan</i></b></th>
                                        <td><?php echo $sdips2memuaskan ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>Standar Deviasi IPS semester 3 | Y = memuaskan</i></b></th>
                                        <td><?php echo $sdips3memuaskan ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>Standar Deviasi IPS semester 4 | Y = memuaskan</i></b></th>
                                        <td><?php echo $sdips4memuaskan ?></td>
                                    </tr>
                                <!-- Akhir bais untuk menghitung MEAN dan standar deviasi IPS -->

                                    <?php
                                        // Menghitung IPS 
                                            // menghitung IPS semester 1
                                                // keterangan ipk_lulus >=3.51 && ipk_lulus<=4.00 (cumlaude)
                                                    $hasilips1cumlaude = (1/sqrt(2*3.14*$sdips1cumlaude));
                                                    $hasilips1cumlaude = number_format($hasilips1cumlaude,3);
                                                    $e =-(pow(($ips1-$meanips1cumlaude),$pangkat2))/2*(pow($sdips1cumlaude,$pangkat2));
                                                    $e = number_format($e,3);
                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);
                                                    $cobaips1cumlaude = $hasilips1cumlaude*$perkalian;
                                                    $cobaips1cumlaude = number_format($cobaips1cumlaude,8);
                                                // keterangan ipk_lulus >=2.76 && ipk_lulus<=3.50 (sgt memuaskan)
                                                    $hasilips1sgtmemuaskan = (1/sqrt(2*3.14*$sdips1sgtmemuaskan));
                                                    $hasilips1sgtmemuaskan = number_format($hasilips1sgtmemuaskan,3);
                                                    $e =-(pow(($ips1-$meanips1sgtmemuaskan),$pangkat2))/2*(pow($sdips1sgtmemuaskan,$pangkat2));
                                                    $e = number_format($e,3);
                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);
                                                    $cobaips1sgtmemuaskan = $hasilips1sgtmemuaskan*$perkalian;
                                                    $cobaips1sgtmemuaskan = number_format($cobaips1sgtmemuaskan,8);
                                                // keterangan ipk_lulus >=2.00 && ipk_lulus<=2.75 (memuaskan)
                                                    $hasilips1memuaskan = (1/sqrt(2*3.14*$sdips1memuaskan));
                                                    $hasilips1memuaskan = number_format($hasilips1memuaskan,3);
                                                    $e =-(pow(($ips1-$meanips1memuaskan),$pangkat2))/2*(pow($sdips1memuaskan,$pangkat2));
                                                    $e = number_format($e,3);
                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);
                                                    $cobaips1memuaskan = $hasilips1memuaskan*$perkalian;
                                                    $cobaips1memuaskan = number_format($cobaips1memuaskan,8);
                                            // menghitung IPS semester 2
                                                // keterangan ipk_lulus >=3.51 && ipk_lulus<=4.00 (cumlaude)
                                                    $hasilips2cumlaude = (1/sqrt(2*3.14*$sdips2cumlaude));
                                                    $hasilips2cumlaude = number_format($hasilips2cumlaude,3);
                                                    $e =-(pow(($ips2-$meanips2cumlaude),$pangkat2))/2*(pow($sdips2cumlaude,$pangkat2));
                                                    $e = number_format($e,3);
                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);
                                                    $cobaips2cumlaude = $hasilips2cumlaude*$perkalian;
                                                    $cobaips2cumlaude = number_format($cobaips2cumlaude,8);
                                                // keterangan ipk_lulus >=2.76 && ipk_lulus<=3.50 (sgt memuaskan)
                                                    $hasilips2sgtmemuaskan = (1/sqrt(2*3.14*$sdips2sgtmemuaskan));
                                                    $hasilips2sgtmemuaskan = number_format($hasilips2sgtmemuaskan,3);
                                                    $e =-(pow(($ips2-$meanips2sgtmemuaskan),$pangkat2))/2*(pow($sdips2sgtmemuaskan,$pangkat2));
                                                    $e = number_format($e,3);
                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);
                                                    $cobaips2sgtmemuaskan = $hasilips2sgtmemuaskan*$perkalian;
                                                    $cobaips2sgtmemuaskan = number_format($cobaips2sgtmemuaskan,8);
                                                // keterangan ipk_lulus >=2.00 && ipk_lulus<=2.75 (memuaskan)
                                                    $hasilips2memuaskan = (1/sqrt(2*3.14*$sdips2memuaskan));
                                                    $hasilips2memuaskan = number_format($hasilips2memuaskan,3);
                                                    $e =-(pow(($ips2-$meanips2memuaskan),$pangkat2))/2*(pow($sdips2memuaskan,$pangkat2));
                                                    $e = number_format($e,3);
                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);
                                                    $cobaips2memuaskan = $hasilips2memuaskan*$perkalian;
                                                    $cobaips2memuaskan = number_format($cobaips2memuaskan,8);
                                            // menghitung IPS semester 3
                                                // keterangan ipk_lulus >=3.51 && ipk_lulus<=4.00 (cumlaude)
                                                    $hasilips3cumlaude = (1/sqrt(2*3.14*$sdips3cumlaude));
                                                    $hasilips3cumlaude = number_format($hasilips3cumlaude,3);
                                                    $e =-(pow(($ips3-$meanips3cumlaude),$pangkat2))/2*(pow($sdips3cumlaude,$pangkat2));
                                                    $e = number_format($e,3);
                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);
                                                    $cobaips3cumlaude = $hasilips3cumlaude*$perkalian;
                                                    $cobaips3cumlaude = number_format($cobaips3cumlaude,8);
                                                // keterangan ipk_lulus >=2.76 && ipk_lulus<=3.50 (sgt memuaskan)
                                                    $hasilips3sgtmemuaskan = (1/sqrt(2*3.14*$sdips3sgtmemuaskan));
                                                    $hasilips3sgtmemuaskan = number_format($hasilips3sgtmemuaskan,3);
                                                    $e =-(pow(($ips3-$meanips3sgtmemuaskan),$pangkat2))/2*(pow($sdips3sgtmemuaskan,$pangkat2));
                                                    $e = number_format($e,3);
                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);
                                                    $cobaips3sgtmemuaskan = $hasilips3sgtmemuaskan*$perkalian;
                                                    $cobaips3sgtmemuaskan = number_format($cobaips3sgtmemuaskan,8);
                                                // keterangan ipk_lulus >=2.00 && ipk_lulus<=2.75 (memuaskan)
                                                    $hasilips3memuaskan = (1/sqrt(2*3.14*$sdips3memuaskan));
                                                    $hasilips3memuaskan = number_format($hasilips3memuaskan,3);
                                                    $e =-(pow(($ips3-$meanips3memuaskan),$pangkat2))/2*(pow($sdips3memuaskan,$pangkat2));
                                                    $e = number_format($e,3);
                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);
                                                    $cobaips3memuaskan = $hasilips3memuaskan*$perkalian;
                                                    $cobaips3memuaskan = number_format($cobaips3memuaskan,8);
                                            // menghitung IPS semester 4
                                                // keterangan ipk_lulus >=3.51 && ipk_lulus<=4.00 (cumlaude)
                                                    $hasilips4cumlaude = (1/sqrt(2*3.14*$sdips4cumlaude));
                                                    $hasilips4cumlaude = number_format($hasilips4cumlaude,3);
                                                    $e =-(pow(($ips4-$meanips4cumlaude),$pangkat2))/2*(pow($sdips4cumlaude,$pangkat2));
                                                    $e = number_format($e,3);
                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);
                                                    $cobaips4cumlaude = $hasilips4cumlaude*$perkalian;
                                                    $cobaips4cumlaude = number_format($cobaips4cumlaude,8);
                                                // keterangan ipk_lulus >=2.76 && ipk_lulus<=3.50 (sgt memuaskan)
                                                    $hasilips4sgtmemuaskan = (1/sqrt(2*3.14*$sdips4sgtmemuaskan));
                                                    $hasilips4sgtmemuaskan = number_format($hasilips4sgtmemuaskan,3);
                                                    $e =-(pow(($ips4-$meanips4sgtmemuaskan),$pangkat2))/2*(pow($sdips4sgtmemuaskan,$pangkat2));
                                                    $e = number_format($e,3);
                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);
                                                    $cobaips4sgtmemuaskan = $hasilips4sgtmemuaskan*$perkalian;
                                                    $cobaips4sgtmemuaskan = number_format($cobaips4sgtmemuaskan,8);
                                                // keterangan ipk_lulus >=2.00 && ipk_lulus<=2.75 (memuaskan)
                                                    $hasilips4memuaskan = (1/sqrt(2*3.14*$sdips4memuaskan));
                                                    $hasilips4memuaskan = number_format($hasilips4memuaskan,3);
                                                    $e =-(pow(($ips4-$meanips4memuaskan),$pangkat2))/2*(pow($sdips4memuaskan,$pangkat2));
                                                    $e = number_format($e,3);
                                                    $perkalian = pow($etetap,$e);
                                                    $perkalian = number_format($perkalian,3);
                                                    $cobaips4memuaskan = $hasilips4memuaskan*$perkalian;
                                                    $cobaips4memuaskan = number_format($cobaips4memuaskan,8);
                                        // Akhir menghitung IPS
                                    ?>
                                <!-- awal baris untuk menghitung IPS -->
                                    <tr>
                                        <th><b><i>IPK semester 1 | Y = cumlaude</i></b></th>
                                        <td><?php echo $cobaips1cumlaude ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>IPK semester 2 | Y = cumlaude</i></b></th>
                                        <td><?php echo $cobaips2cumlaude ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>IPK semester 3 | Y = cumlaude</i></b></th>
                                        <td><?php echo $cobaips3cumlaude ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>IPK semester 4 | Y = cumlaude</i></b></th>
                                        <td><?php echo $cobaips4cumlaude ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>IPK semester 1 | Y = sangat memuaskan</i></b></th>
                                        <td><?php echo $cobaips1sgtmemuaskan ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>IPK semester 2 | Y = sangat memuaskan</i></b></th>
                                        <td><?php echo $cobaips2sgtmemuaskan ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>IPK semester 3 | Y = sangat memuaskan</i></b></th>
                                        <td><?php echo $cobaips3sgtmemuaskan ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>IPK semester 4 | Y = sangat memuaskan</i></b></th>
                                        <td><?php echo $cobaips4sgtmemuaskan ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>IPK semester 1 | Y = memuaskan</i></b></th>
                                        <td><?php echo $cobaips1memuaskan ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>IPK semester 2 | Y = memuaskan</i></b></th>
                                        <td><?php echo $cobaips2memuaskan ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>IPK semester 3 | Y = memuaskan</i></b></th>
                                        <td><?php echo $cobaips3memuaskan ?></td>
                                    </tr>
                                    <tr>
                                        <th><b><i>IPK semester 4 | Y = memuaskan</i></b></th>
                                        <td><?php echo $cobaips4memuaskan ?></td>
                                    </tr>      
                                <!-- /akhir baris untuk menghitung IPS -->
                                </table>
                            </div>
                        <!-- </div> -->
                    </div>
                <!-- /Akhir cara hitung prediksi IPK -->
            </div> 
        </div>
        <!-- /Akhir Tabel kedua -->
			
		<!-- AWAL Tabel tiga -->
        <div class="panel panel-info">
            <div class="panel-heading">TAHAP 3</div>
            <div class="panel-body">        
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example"> 
                    <!-- mengalikan semua dengan data TEPAT  -->
                    <tr>                                     
                        <th>kalikan semua dengan yg tepat</th>
                        <th>
                            <!-- Perhitungan Tabel 3 -->
                            <?php
                                $cobatepat =$totaldatatepatfix*$hasiljktepat*$hasilsmtepat*$coba*$coba2*$coba3*$coba4*$coba9*$coba10*$coba11*$coba12;
                                //$cobatepat = number_format($cobatepat,8);
                                if (is_nan($cobatepat)) {
                                    echo 0;
                                  }
                                elseif(is_infinite($cobatepat)){
                                    echo 0;
                                }else{
                                    echo $cobatepat;
                                } 
                            ?>
                        </th>
                    </tr>

                    <!-- mengalikan semua dengan data TERLAMBAT  -->
                    <tr>              
                        <th>kalikan semua dengan yang TERLAMBAT</th>
                        <th>
                            <?php
                                $cobaterlambat =$totaldataterlambatfix*$hasiljkterlambat*$hasilsmterlambat*$coba5*$coba6*$coba7*$coba8*$coba13*$coba14*$coba15*$coba16;
                                //$cobaterlambat = number_format($cobaterlambat,8);                                
                                if (is_nan($cobaterlambat)) {
                                        echo 0;
                                    }
                                    elseif(is_infinite($cobaterlambat)){
                                        echo 0;
                                    }else{
                                        echo $cobaterlambat;
                                    } 

                            ?>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="2" ></th>
                    </tr>

                    <!-- mengalikan semua dengan data 7 semester  -->
                    <tr>                                      
                        <th>kalikan semua dengan Y = 7 semester</th>
                        <th>
                            <!-- Perhitungan Tabel 3 -->
                            <?php
                                $cobams7 =$totaldatams7fix*$hasiljkms7*$hasilsmms7*$cobaipk1ms7*$cobaipk2ms7*$cobaipk3ms7*$cobaipk4ms7*$cobaips1ms7*$cobaips2ms7*$cobaips3ms7*$cobaips4ms7;
								if (is_nan($cobams7)) {
                                    echo 0;
                                  }
                                elseif(is_infinite($cobams7)){
                                    echo 0;
                                }else{
                                    echo $cobams7;
                                }
                            ?>
                        </th>
                    </tr>
                    
                    <!-- mengalikan semua dengan data 8 semester  -->
                    <tr>                                      
                        <th>kalikan semua dengan Y = 8 semester</th>
                        <th>
                            <!-- Perhitungan Tabel 3 -->
                            <?php
								$cobams8 =$totaldatams8fix*$hasiljkms8*$hasilsmms8*$cobaipk1ms8*$cobaipk2ms8*$cobaipk3ms8*$cobaipk4ms8*$cobaips1ms8*$cobaips2ms8*$cobaips3ms8*$cobaips4ms8;
                                if (is_nan($cobams8)) {
                                    echo 0;
                                  }
                                elseif(is_infinite($cobams8)){
                                    echo 0;
                                }else{
                                    echo $cobams8;
                                }
                            ?>
                        </th>
                    </tr>
                    
                    <!-- mengalikan semua dengan data 9 semester  -->
                    <tr>                                      
                        <th>kalikan semua dengan Y = 9 semester</th>
                        <th>
                            <!-- Perhitungan Tabel 3 -->
                            <?php
                               
								$cobams9 =$totaldatams9fix*$hasiljkms9*$hasilsmms9*$cobaipk1ms9*$cobaipk2ms9*$cobaipk3ms9*$cobaipk4ms9*$cobaips1ms9*$cobaips2ms9*$cobaips3ms9*$cobaips4ms9;
                                if (is_nan($cobams9)) {
                                    echo 0;
                                  }
                                elseif(is_infinite($cobams9)){
                                    echo 0;
                                }else{
                                    echo $cobams9;
                                }
                            ?>
                        </th>
                    </tr>
                    
                    <!-- mengalikan semua dengan data 10 semester  -->
                    <tr>                                      
                        <th>kalikan semua dengan Y = 10 semester</th>
                        <th>
                            <!-- Perhitungan Tabel 3 -->
                            <?php
								$cobams10 =$totaldatams10fix*$hasiljkms10*$hasilsmms10*$cobaipk1ms10*$cobaipk2ms10*$cobaipk3ms10*$cobaipk4ms10*$cobaips1ms10*$cobaips2ms10*$cobaips3ms10*$cobaips4ms10;
                                if (is_nan($cobams10)) {
                                    echo 0;
                                  }
                                elseif(is_infinite($cobams10)){
                                    echo 0;
                                }else{
                                    echo $cobams10;
                                }
                            ?>
                        </th>
                    </tr>
                    

                    <!-- mengalikan semua dengan data IPK CUMLAUDE  -->
                    <tr>              
                        <th>kalikan semua dengan data IPK CUMLAUDE </th>
                        <th>
                            <?php
                                $cobacumlaude =$totaldataipkcumlaudefix*$hasiljkcumlaude*$hasilsmcumlaude*$cobaipk1cumlaude*$cobaipk2cumlaude*$cobaipk3cumlaude*$cobaipk4cumlaude*$cobaips1cumlaude*$cobaips2cumlaude*$cobaips3cumlaude*$cobaips4cumlaude;
                                if (is_nan($cobacumlaude)) {
                                    echo 0;
                                  }
                                elseif(is_infinite($cobacumlaude)){
                                    echo 0;
                                }else{
                                    echo $cobacumlaude;
                                } 
                            ?>
                        </th>
                    </tr>
                    <!-- mengalikan semua dengan data IPK SGT MEMUASKAN  -->
                    <tr>              
                        <th>kalikan semua dengan data IPK SGT MEMUASKAN </th>
                        <th>
                            <?php
                                $cobasgtmemuaskan =$totaldataipksgtmemuaskanfix*$hasiljksgtmemuaskan*$hasilsmsgtmemuaskan*$cobaipk1sgtmemuaskan*$cobaipk2sgtmemuaskan*$cobaipk3sgtmemuaskan*$cobaipk4sgtmemuaskan*$cobaips1sgtmemuaskan*$cobaips2sgtmemuaskan*$cobaips3sgtmemuaskan*$cobaips4sgtmemuaskan;
                                if (is_nan($cobasgtmemuaskan)) {
                                    echo 0;
                                  }
                                elseif(is_infinite($cobasgtmemuaskan)){
                                    echo 0;
                                }else{
                                    echo $cobasgtmemuaskan;
                                } 
                            ?>
                        </th>
                    </tr>
                    
                    <!-- mengalikan semua dengan data IPK MEMUASKAN  -->
                    <tr>              
                        <th>kalikan semua dengan data IPK MEMUASKAN </th>
                        <th>
                            <?php 
                                $cobamemuaskan =$totaldataipkmemuaskanfix*$hasiljkmemuaskan*$hasilsmmemuaskan*$cobaipk1memuaskan*$cobaipk2memuaskan*$cobaipk3memuaskan*$cobaipk4memuaskan*$cobaips1memuaskan*$cobaips2memuaskan*$cobaips3memuaskan*$cobaips4memuaskan;
                                if (is_nan($cobamemuaskan)) {
                                    echo 0;
                                  }
                                elseif(is_infinite($cobamemuaskan)){
                                    echo 0;
                                }else{
                                    echo $cobamemuaskan;
                                }
                             ?>
                        </th>
                    </tr>
                </table>
            </div>
        </div>
        <!-- /Akhir Tabel tiga -->

        <!-- AWAL Tabel Hasil -->
        <div class="panel panel-info">
                <!-- <div class="panel-heading">Tabel Hasil</div>
                    <div class="panel-body">        
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <tr>  
                                <th> NIM</th>
                                <th> Nama </th>
                                <th> Jenis-kelamin </th>
                                <th> IPK </th>
                                <th> IPS </th>                                      
                                <th>Hasil</th>
                            </tr>
                            <tr>  
                                <th> <?php echo $nim; ?> </th>
                                <th> <?php echo $nama; ?> </th>
                                <th> <?php echo $jk; ?> </th>                                     
                                <th> -->
                                <!-- Perhitungan AKhir naive Bayes -->
                                <!--  <?php

                                
                                        if ($hasilakhirtepat > $hasilakhirterlambat && $hasilakhirkrg8 > $hasilakhirlbh8 ) {
                                            echo "Selamat Anda Akan lulus dengan <b> TEPAT </b> dengan masa studi kurang lebih 8 semseter "; 
                                        }elseif ($hasilakhirtepat < $hasilakhirterlambat && $hasilakhirkrg8 < $hasilakhirlbh8 ) {
                                            echo "Anda kemungkinan bisa lulus <b> TERLAMBAT </b> dengan masa studi lebih dari 8 semseter ";        
                                        }else{
                                            echo "kamu masih belum kelihatan";
                                        }
                                    ?> -->
                                <!-- </th>
                            </tr>
                        </table>
                    
                </div> -->
            <div class="panel-heading">Data Hasil</div>
            <div class="panel-body">
                <table >
                    <tr>
                        <td colspan="2">NIM :</td>
                        <td ><?php echo $nim; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">Nama Mahasiswa :</td>
                        <td ><?php echo $nama; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">jenis Kelamin :</td>
                        <td ><?php echo $jk; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">Status Mahasiswa :</td>
                        <td ><?php echo $sm; ?></td>
                    </tr>
                    <tr>
                        <td colspan="4" >IPK</td>
                    </tr>
                    <tr>
                        <td>IPK 1</td>
                        <td>IPK 2</td>
                        <td>IPK 3</td>
                        <td>IPK 4</td>
                    </tr>
                    <tr>
                        <td><?php echo $ipk1; ?> </td>
                        <td><?php echo $ipk2;?></td>
                        <td><?php echo $ipk3;?></td>
                        <td><?php echo $ipk4;?></td>
                    </tr>
                    <tr>
                        <td colspan="4" >IPS</td>
                    </tr>
                    <tr>
                        <td>IPS 1</td>
                        <td>IPS 2</td>
                        <td>IPS 3</td>
                        <td>IPS 4</td>
                    </tr>
                    <tr>
                        <td><?php echo $ips1; ?> </td>
                        <td><?php echo $ips2;?></td>
                        <td><?php echo $ips3;?></td>
                        <td><?php echo $ips4;?></td>
                    </tr>
                    <tr>
                        <?php 

                            // status mahasiswa
                            //$cobatepat = number_format($cobatepat,8);
                            //$cobaterlambat = number_format($cobaterlambat,8);
                            if ($cobatepat>$cobaterlambat) {
                                $hasilsm = 'TEPAT';
                            }else{
                                $hasilsm = 'TERLAMBAT';
                            }

                            // masa studi
                            if ($cobams7 > $cobams8 ) {
                                    
                                    $hasilms = 7;
								}
								elseif ($cobams8 > $cobams9 ) {
                                    $hasilms = 8;
								 }elseif ($cobams9 > $cobams10) {
                                    $hasilms = 9;
								 }
								else{
                                    $hasilms = 10;

								}	
                            // Predikat IPK  kelulusan
                                if ($cobacumlaude > $cobasgtmemuaskan ) {
									// $cobacumlaude = number_format($cobatepat,8);
                                    $hasilcumlaude = "CUMLAUDE";
                                    $hasilpredikat = $hasilcumlaude;
								}
								elseif ($cobasgtmemuaskan > $cobamemuaskan ) {
									$hasilsgtmemuaskan = "SANGAT MEMUASKAN";
                                    $hasilpredikat = $hasilsgtmemuaskan;
                                    
								 }elseif ($cobamemuaskan != 0 ) {
									$hasilmemuaskan = "MEMUASKAN";
                                    $hasilpredikat = $hasilmemuaskan;
                                    
								 }
								else{
                                    $hasilgagal = "CUKUP";
                                    $hasilpredikat = $hasilgagal;
                                    
								}

                         ?>
                       <td colspan="4">Maka Akan diprediksikan lulus dengan :</td> 
                    </tr>
                    <tr>
                         <td colspan="4"><h4> status mahasiswa lulus dengan <b><?php echo $hasilsm; ?></b> dan masa studi <b><?php echo $hasilms; ?></b> semester,kemudian akan menerima predikat IPK <b> <?php echo $hasilpredikat; ?></b></h4></td>
                    </tr>
                </table>

            </div>
        </div>
        <!-- /Akhir Tabel Hasil -->
        <?php

        
             }                       
            }
        ?>
	</div>
	<!-- /akhir col md -->
</div>
<!-- /akhir col md -->

