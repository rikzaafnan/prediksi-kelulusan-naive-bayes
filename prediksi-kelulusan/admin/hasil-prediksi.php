

<?php

/**
 * @Author: Rick
 * @Date:   2018-11-08 07:36:38
 * @Last Modified by:   Rick
 * @Last Modified time: 2018-11-08 08:14:45
 */
include('koneksi.php');
include('include/header.php');
?>



    <!-- Main content -->
    <section class="content">
      

    	<div class="row">

        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Hasil Prediksi dengan Metode Naive Bayes</h3>
              
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              
              <div class="table-responsive" >
			<table id="example1" class="table table-striped table-bordered" style="width:100%">
				<thead>
					<th>NO</th>
					<th>NIM</th>
					<th>NAMA</th>
					<th>JENIS KELAMIN</th>
					<th>Status kelulusan</th>
					<th>Jumlah semester</th>
					<th>Range IPK kelulusan</th>
					<th>Perhitungan</th>
				</thead>
				<tbody>
					<?php
						// menampilkan data dari data test
						$sql ="SELECT * FROM tb_datatest ORDER BY nama ASC";
						$hasil = mysqli_query($konek_db,$sql);
						$no = 1;

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
						
						
						while ($data = mysqli_fetch_array($hasil)) {
							$jeniskelamin = $data[2];
							$statusmahasiswa = $data[3];
							$ipk1 = $data[4];
							$ipk2 = $data[5];
							$ipk3 = $data[6];
							$ipk4 = $data[7];
							$ips1 = $data[9];
							$ips2 = $data[10];
							$ips3 = $data[11];
							$ips4 = $data[12];
							
							$pangkat2 = 2;
							$pi = 3.14;
							$etetap = 2.7183; 
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


								// total data 'IPK antara 3.51 dan 4.00' yang ada pada data training
								$sql = "SELECT COUNT(*) AS jumlah FROM tb_datatraining where ipk_lulus >=3.51 and ipk_lulus <=4.00";
								$query = mysqli_query($konek_db,$sql);
								$result = mysqli_fetch_array($query);
								$totaldataipkcumlaude = $result['jumlah'];
								$totaldataipkcumlaudefix = $totaldataipkcumlaude/$totaldata;
								
								// total data 'IPK antara 2.76 dan 3.50' yang ada pada data training
								$sql = "SELECT COUNT(*) AS jumlah FROM tb_datatraining where ipk_lulus >=2.76 && ipk_lulus <=3.50";
								$query = mysqli_query($konek_db,$sql);
								$result = mysqli_fetch_array($query);
								$totaldataipksgtmemuaskan = $result['jumlah'];
								$totaldataipksgtmemuaskanfix = $totaldataipksgtmemuaskan/$totaldata;

								// total data 'IPK antara 2.00 dan 2.75' yang ada pada data training
								$sql = "SELECT COUNT(*) AS jumlah FROM tb_datatraining where ipk_lulus >=2.00 && ipk_lulus <=2.75";
								$query = mysqli_query($konek_db,$sql);
								$result = mysqli_fetch_array($query);
								$totaldataipkmemuaskan = $result['jumlah'];
								$totaldataipkmemuaskanfix = $totaldataipkmemuaskan/$totaldata;

						
							?>
					<tr>
						<td><?php echo $no; ?></td>
                        <td><?php echo $data[0]; ?></td>
                        <td><?php echo $data[1]; ?></td>
                        <td><?php echo $jeniskelamin; ?></td>
						<td><?php						
							//Status Mahasiswa 
								// total data 'jenis-kelamin yang dicari' yg 'TEPAT' pada data training
								$sql = "SELECT COUNT(*) AS jumlah FROM tb_datatraining where jk = '$jeniskelamin' and status_kelulusan = 'TEPAT' group by jk";
								$query = mysqli_query($konek_db,$sql);
								$result = mysqli_fetch_array($query);
								$jktepat = $result['jumlah'];  
								$hasiljktepat = $jktepat/$totaldatatepat;
                                $hasiljktepat = number_format($hasiljktepat,3);

								// total data 'jenis-kelamin yang dicari' yg 'TERLAMBAT' pada data training
								$sql = "SELECT COUNT(*) AS jumlah FROM tb_datatraining where jk = '$jeniskelamin' and status_kelulusan = 'TERLAMBAT' group by jk";
								$query = mysqli_query($konek_db,$sql);
								$result = mysqli_fetch_array($query);
								$jkterlambat = $result['jumlah'];
								$hasiljkterlambat = number_format($hasiljktepat,3);
								

								// total data 'STATUS MAHASISWA yang dicari' yg 'TEPAT' pada data training
								$sql = "SELECT COUNT(*) AS jumlah FROM tb_datatraining where status_mahasiswa = '$statusmahasiswa' and status_kelulusan = 'TEPAT' group by status_mahasiswa";
								$query = mysqli_query($konek_db,$sql);
								$result = mysqli_fetch_array($query);
								$smtepat = $result['jumlah'];
								$hasilsmtepat = $smtepat/$totaldatatepat;
                                $hasilsmtepat = number_format($hasilsmtepat,3);
								

								// total data 'STATUS MAHASISWA yang dicari' yg 'TErlambat' pada data training
								$sql = "SELECT COUNT(*) AS jumlah FROM tb_datatraining where status_mahasiswa = '$statusmahasiswa' and status_kelulusan = 'TERLAMBAT' group by status_mahasiswa";
								$query = mysqli_query($konek_db,$sql);
								$result = mysqli_fetch_array($query);
								$smterlambat = $result['jumlah'];
								$hasilsmterlambat = $smterlambat / $totaldataterlambat;
								$hasilsmterlambat = number_format($hasilsmterlambat,3);
								// QUERY IPK
									// Mean IPK1 dengan keterangan TEPAT 
										$sql = "SELECT AVG(ipk_1) FROM tb_datatraining  WHERE status_kelulusan = 'TEPAT'";
										$query = mysqli_query($konek_db,$sql);
										$result = mysqli_fetch_array($query);
										$meanipk1tepat = $result[0];
										$meanipk1tepat = number_format($meanipk1tepat,3);
									// Mean IPK2 dengan keterangan TEPAT 
										$sql = "SELECT AVG(ipk_2) FROM tb_datatraining  WHERE status_kelulusan = 'TEPAT'";
										$query = mysqli_query($konek_db,$sql);
										$result = mysqli_fetch_array($query);
										$meanipk2tepat = $result[0];
										$meanipk2tepat = number_format($meanipk2tepat,3);
									// Mean IPK3 dengan keterangan TEPAT 
										$sql = "SELECT AVG(ipk_3) FROM tb_datatraining  WHERE status_kelulusan = 'TEPAT'";
										$query = mysqli_query($konek_db,$sql);
										$result = mysqli_fetch_array($query);
										$meanipk3tepat = $result[0];
										$meanipk3tepat = number_format($meanipk3tepat,3);
									// Mean IPK4 dengan keterangan TEPAT 
										$sql = "SELECT AVG(ipk_4) FROM tb_datatraining  WHERE status_kelulusan = 'TEPAT'";
										$query = mysqli_query($konek_db,$sql);
										$result = mysqli_fetch_array($query);
										$meanipk4tepat = $result[0];
										$meanipk4tepat = number_format($meanipk4tepat,3);

										
									// Mean IPK1 dengan keterangan TERLAMBA 
										$sql = "SELECT AVG(ipk_1) FROM tb_datatraining  WHERE status_kelulusan = 'TERLAMBAT'";
										$query = mysqli_query($konek_db,$sql);
										$result = mysqli_fetch_array($query);
										$meanipk1terlambat = $result[0];
										$meanipk1terlambat = number_format($meanipk1terlambat,3);
									// Mean IPK2 dengan keterangan TERLAMBAT 
										$sql = "SELECT AVG(ipk_2) FROM tb_datatraining  WHERE status_kelulusan = 'TERLAMBAT'";
										$query = mysqli_query($konek_db,$sql);
										$result = mysqli_fetch_array($query);
										$meanipk2terlambat = $result[0];
										$meanipk2terlambat = number_format($meanipk2terlambat,3);
									// Mean IPK3 dengan keterangan TERLAMBAT 
										$sql = "SELECT AVG(ipk_3) FROM tb_datatraining  WHERE status_kelulusan = 'TERLAMBAT'";
										$query = mysqli_query($konek_db,$sql);
										$result = mysqli_fetch_array($query);
										$meanipk3terlambat = $result[0];
										$meanipk3terlambat = number_format($meanipk3terlambat,3);
									// Mean IPK4 dengan keterangan TERLAMBAT 
										$sql = "SELECT AVG(ipk_4) FROM tb_datatraining  WHERE status_kelulusan = 'TERLAMBAT'";
										$query = mysqli_query($konek_db,$sql);
										$result = mysqli_fetch_array($query);
										$meanipk4terlambat = $result[0];
										$meanipk3terlambat = number_format($meanipk3terlambat,3);
										

									//standar deviasi IPS dengan keterangan TEPAT 
										$sql = "SELECT STD(ipk_1) FROM tb_datatraining WHERE status_kelulusan = 'TEPAT'";
										$query = mysqli_query($konek_db,$sql);
										$result = mysqli_fetch_array($query);
										$sdipk1tepat = $result[0];
										$sdipk1tepat = number_format($sdipk1tepat,3);
									//standar deviasi IPS dengan keterangan TEPAT 
										$sql = "SELECT STD(ipk_2) FROM tb_datatraining WHERE status_kelulusan = 'TEPAT'";
										$query = mysqli_query($konek_db,$sql);
										$result = mysqli_fetch_array($query);
										$sdipk2tepat = $result[0];
										$sdipk2tepat = number_format($sdipk2tepat,3);
									//standar deviasi IPS dengan keterangan TEPAT 
										$sql = "SELECT STD(ipk_3) FROM tb_datatraining WHERE status_kelulusan = 'TEPAT'";
										$query = mysqli_query($konek_db,$sql);
										$result = mysqli_fetch_array($query);
										$sdipk3tepat = $result[0];
										$sdipk3tepat = number_format($sdipk3tepat,3);
									//standar deviasi IPS dengan keterangan TEPAT 
										$sql = "SELECT STD(ipk_4) FROM tb_datatraining WHERE status_kelulusan = 'TEPAT'";
										$query = mysqli_query($konek_db,$sql);
										$result = mysqli_fetch_array($query);
										$sdipk4tepat = $result[0];
										$sdipk4tepat = number_format($sdipk4tepat,3);


									//standar deviasi IPS dengan keterangan TERLAMBAT 
										$sql = "SELECT STD(ipk_1) FROM tb_datatraining WHERE status_kelulusan = 'TERLAMBAT'";
										$query = mysqli_query($konek_db,$sql);
										$result = mysqli_fetch_array($query);
										$sdipk1terlambat = $result[0];
										$sdipk1terlambat = number_format($sdipk1terlambat,3);

									//standar deviasi IPS dengan keterangan TERLAMBAT 
										$sql = "SELECT STD(ipk_2) FROM tb_datatraining WHERE status_kelulusan = 'TERLAMBAT'";
										$query = mysqli_query($konek_db,$sql);
										$result = mysqli_fetch_array($query);
										$sdipk2terlambat = $result[0];
										$sdipk2terlambat = number_format($sdipk2terlambat,3);

									//standar deviasi IPS dengan keterangan TERLAMBAT 
										$sql = "SELECT STD(ipk_3) FROM tb_datatraining WHERE status_kelulusan = 'TERLAMBAT'";
										$query = mysqli_query($konek_db,$sql);
										$result = mysqli_fetch_array($query);
										$sdipk3terlambat = $result[0];
										$sdipk3terlambat = number_format($sdipk3terlambat,3);

									//standar deviasi IPS dengan keterangan TERLAMBAT 
										$sql = "SELECT STD(ipk_4) FROM tb_datatraining WHERE status_kelulusan = 'TERLAMBAT'";
										$query = mysqli_query($konek_db,$sql);
										$result = mysqli_fetch_array($query);
										$sdipk4terlambat = $result[0];
										$sdipk4terlambat = number_format($sdipk4terlambat,3);
								// AKHIR QUERY IPK
								// QUERY IPS
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
								
								
								
									// Rumus jika data test adalah numerik : IPK dan IPS
								// Akhir Query IPS 
									// Menghitung IPK
										// menghitung ipk status TEPAT semester 1
											$hasil1 = (1/sqrt(2*3.14*$sdipk1tepat));
											//mengubah format data jadi 3 aangka dibelakang koma
											$hasil1 = number_format($hasil1,3);
											// $satu = 1;
											// $sqrt1 =sqrt(2*$pi*$sdipk1tepat);
											// $sqrt1 = number_format($sqrt1,4);
											// $hasil1 =  1/$sqrt1;
											
											$e =-(pow(($ipk1-$meanipk1tepat),$pangkat2))/2*(pow($sdipk1tepat,$pangkat2));
											// mengubah format data jadi 3 aangka dibelakang koma
											$e = number_format($e,3);

											$perkalian = pow($etetap,$e);
											$perkalian = number_format($perkalian,3);

											$coba = $hasil1*$perkalian;
											$coba = number_format($coba,3);
									
										// menghitung ipk status TEPAT semester 2
											$hasil2 = (1/sqrt(2*3.14*$sdipk1tepat));
											//mengubah format data jadi 3 aangka dibelakang koma
											$hasil2 = number_format($hasil2,3);
											// $satu = 1;
											// $sqrt1 =sqrt(2*$pi*$sdipk1tepat);
											// $sqrt1 = number_format($sqrt1,4);
											// $hasil1 =  1/$sqrt1;
											
											$e =-(pow(($ipk2-$meanipk2tepat),$pangkat2))/2*(pow($sdipk2tepat,$pangkat2));
											// mengubah format data jadi 3 aangka dibelakang koma
											$e = number_format($e,3);

											$perkalian = pow($etetap,$e);
											$perkalian = number_format($perkalian,3);

											$coba2 = $hasil1*$perkalian;
											$coba2 = number_format($coba2,3);
									
										// menghitung ipk status TEPAT semester 3
											$hasil3 = (1/sqrt(2*3.14*$sdipk3tepat));
											//mengubah format data jadi 3 aangka dibelakang koma
											$hasil3 = number_format($hasil3,3);
											// $satu = 1;
											// $sqrt1 =sqrt(2*$pi*$sdipk1tepat);
											// $sqrt1 = number_format($sqrt1,4);
											// $hasil1 =  1/$sqrt1;
											
											$e =-(pow(($ipk3-$meanipk3tepat),$pangkat2))/2*(pow($sdipk3tepat,$pangkat2));
											// mengubah format data jadi 3 aangka dibelakang koma
											$e = number_format($e,3);

											$perkalian = pow($etetap,$e);
											$perkalian = number_format($perkalian,3);

											$coba3 = $hasil3*$perkalian;
											$coba3 = number_format($coba3,3);
									
										// menghitung ipk status TEPAT semester 4
											$hasil4 = (1/sqrt(2*3.14*$sdipk4tepat));
											//mengubah format data jadi 3 aangka dibelakang koma
											$hasil4 = number_format($hasil4,3);
											// $satu = 1;
											// $sqrt1 =sqrt(2*$pi*$sdipk1tepat);
											// $sqrt1 = number_format($sqrt1,4);
											// $hasil1 =  1/$sqrt1;
											
											$e =-(pow(($ipk4-$meanipk4tepat),$pangkat2))/2*(pow($sdipk4tepat,$pangkat2));
											// mengubah format data jadi 3 aangka dibelakang koma
											$e = number_format($e,3);

											$perkalian = pow($etetap,$e);
											$perkalian = number_format($perkalian,3);

											$coba4 = $hasil4*$perkalian;
											$coba4 = number_format($coba4,3);
										
											// menghitung ipk status TEPAT semester 1
											$hasil1 = (1/sqrt(2*3.14*$sdipk1tepat));
											//mengubah format data jadi 3 aangka dibelakang koma
											$hasil1 = number_format($hasil1,3);
											// $satu = 1;
											// $sqrt1 =sqrt(2*$pi*$sdipk1tepat);
											// $sqrt1 = number_format($sqrt1,4);
											// $hasil1 =  1/$sqrt1;
											
											$e =-(pow(($ipk1-$meanipk1tepat),$pangkat2))/2*(pow($sdipk1tepat,$pangkat2));
											// mengubah format data jadi 3 aangka dibelakang koma
											$e = number_format($e,3);

											$perkalian = pow($etetap,$e);
											$perkalian = number_format($perkalian,3);

											$coba = $hasil1*$perkalian;
											$coba = number_format($coba,3);
									
										// menghitung ipk status TERLAMBAT semester 1
											$hasil5 = (1/sqrt(2*3.14*$sdipk1terlambat));
											//mengubah format data jadi 3 aangka dibelakang koma
											$hasil5 = number_format($hasil5,3);
											// $satu = 1;
											// $sqrt1 =sqrt(2*$pi*$sdipk1tepat);
											// $sqrt1 = number_format($sqrt1,4);
											// $hasil1 =  1/$sqrt1;
											
											$e =-(pow(($ipk1-$meanipk1terlambat),$pangkat2))/2*(pow($sdipk1terlambat,$pangkat2));
											// mengubah format data jadi 3 aangka dibelakang koma
											$e = number_format($e,3);

											$perkalian = pow($etetap,$e);
											$perkalian = number_format($perkalian,3);

											$coba5 = $hasil5*$perkalian;
											$coba5 = number_format($coba5,10);
									
										// menghitung ipk status TERLAMBAT semester 2
											$hasil6 = (1/sqrt(2*3.14*$sdipk2terlambat));
											$hasil6 = number_format($hasil6,3);
											$e =-(pow(($ipk2-$meanipk2terlambat),$pangkat2))/2*(pow($sdipk2terlambat,$pangkat2));
											$e = number_format($e,3);
											$perkalian = pow($etetap,$e);
											$perkalian = number_format($perkalian,3);
											$coba6 = $hasil6*$perkalian;
											$coba6 = number_format($coba6,10);
									
										// menghitung ipk status TERLAMBAT semester 3
											$hasil7 = (1/sqrt(2*3.14*$sdipk3terlambat));
											$hasil7 = number_format($hasil7,3);		
											$e =-(pow(($ipk3-$meanipk3terlambat),$pangkat2))/2*(pow($sdipk3terlambat,$pangkat2));
											$e = number_format($e,3);
											$perkalian = pow($etetap,$e);
											$perkalian = number_format($perkalian,3);
											$coba7 = $hasil7*$perkalian;
											$coba7 = number_format($coba7,10);

										// menghitung ipk status TERLAMBAT semester 4
											$hasil8 = (1/sqrt(2*3.14*$sdipk4terlambat));
											$hasil8 = number_format($hasil5,3);
											$e =-(pow(($ipk4-$meanipk4terlambat),$pangkat2))/2*(pow($sdipk4terlambat,$pangkat2));
											$e = number_format($e,3);
											$perkalian = pow($etetap,$e);
											$perkalian = number_format($perkalian,3);
											$coba8 = $hasil8*$perkalian;
											$coba8 = number_format($coba8,10);
						
									// menghitung IPS
										// menghitung ips status TEPAT semester 1
											$hasil9 = (1/sqrt(2*3.14*$sdips1tepat));
											$hasil9 = number_format($hasil9,3);
											$e =-(pow(($ips1-$meanips1tepat),$pangkat2))/2*(pow($sdips1tepat,$pangkat2));
											$e = number_format($e,3);
											$perkalian = pow($etetap,$e);
											$perkalian = number_format($perkalian,3);
											$coba9 = $hasil9*$perkalian;
											$coba9 = number_format($coba9,3);
									
										// menghitung ips status TEPAT semester 2
											$hasil10 = (1/sqrt(2*3.14*$sdips1tepat));
											$hasil10 = number_format($hasil10,3);
											$e =-(pow(($ips2-$meanips2tepat),$pangkat2))/2*(pow($sdips2tepat,$pangkat2));
											$e = number_format($e,3);

											$perkalian = pow($etetap,$e);
											$perkalian = number_format($perkalian,3);

											$coba10 = $hasil1*$perkalian;
											$coba10 = number_format($coba10,3);
									
										// menghitung ips status TEPAT semester 3
											$hasil11 = (1/sqrt(2*3.14*$sdips3tepat));
											$hasil11 = number_format($hasil11,3);
											$e =-(pow(($ips3-$meanips3tepat),$pangkat2))/2*(pow($sdips3tepat,$pangkat2));
											$e = number_format($e,3);

											$perkalian = pow($etetap,$e);
											$perkalian = number_format($perkalian,3);

											$coba11 = $hasil11*$perkalian;
											$coba11 = number_format($coba11,3);
									
										// menghitung ips status TEPAT semester 4
											$hasil12 = (1/sqrt(2*3.14*$sdips4tepat));
											$hasil12 = number_format($hasil12,3);
											$e =-(pow(($ips4-$meanips4tepat),$pangkat2))/2*(pow($sdips4tepat,$pangkat2));
											$e = number_format($e,3);

											$perkalian = pow($etetap,$e);
											$perkalian = number_format($perkalian,3);

											$coba12 = $hasil12*$perkalian;
											$coba12 = number_format($coba12,3);
									
										// menghitung ips status TERLAMBAT semester 1
											$hasil13 = (1/sqrt(2*3.14*$sdips1terlambat));
											$hasil13 = number_format($hasil13,3);
											$e =-(pow(($ips1-$meanips1terlambat),$pangkat2))/2*(pow($sdips1terlambat,$pangkat2));
											$e = number_format($e,3);

											$perkalian = pow($etetap,$e);
											$perkalian = number_format($perkalian,3);

											$coba13 = $hasil13*$perkalian;
											$coba13 = number_format($coba13,10);
									
										// menghitung ips status TERLAMBAT semester 2
											$hasil14 = (1/sqrt(2*3.14*$sdips2terlambat));
											$hasil14 = number_format($hasil14,3);
											$e =-(pow(($ips2-$meanips2terlambat),$pangkat2))/2*(pow($sdips2terlambat,$pangkat2));
											$e = number_format($e,3);
											$perkalian = pow($etetap,$e);
											$perkalian = number_format($perkalian,3);
											$coba14 = $hasil14*$perkalian;
											$coba14 = number_format($coba14,10);
									
										// menghitung ips status TERLAMBAT semester 3
											$hasil15 = (1/sqrt(2*3.14*$sdips3terlambat));
											$hasil15 = number_format($hasil15,3);		
											$e =-(pow(($ips3-$meanips3terlambat),$pangkat2))/2*(pow($sdips3terlambat,$pangkat2));
											$e = number_format($e,3);
											$perkalian = pow($etetap,$e);
											$perkalian = number_format($perkalian,3);
											$coba15 = $hasil15*$perkalian;
											$coba15 = number_format($coba15,10);

										// menghitung ips status TERLAMBAT semester 4
											$hasil16 = (1/sqrt(2*3.14*$sdips4terlambat));
											$hasil16 = number_format($hasil16,3);
											$e =-(pow(($ips4-$meanips4terlambat),$pangkat2))/2*(pow($sdips4terlambat,$pangkat2));
											$e = number_format($e,3);
											$perkalian = pow($etetap,$e);
											$perkalian = number_format($perkalian,3);
											$coba16 = $hasil16*$perkalian;
											$coba16 = number_format($coba16,10);
					
								$cobatepat =$totaldatatepatfix*$hasiljktepat*$hasilsmtepat*$coba*$coba2*$coba3*$coba4*$coba9*$coba10*$coba11*$coba12;
								$cobaterlambat =$totaldataterlambatfix*$hasiljkterlambat*$hasilsmterlambat*$coba5*$coba6*$coba7*$coba8*$coba13*$coba14*$coba15*$coba16;

								if ($cobatepat > $cobaterlambat) {
									$cobatepat = number_format($cobatepat,15);
									echo "TEPAT";
								}
								elseif ($cobaterlambat > $cobatepat ) {
									echo "TERLAMBAT";
								}else{
									echo "error";
								}
							?>
						</td>
						<td> 
							<?php
							//Jumlah Semester
								// Query mencari jenis kelamin dan status mahasisswa
									// total data 'jenis-kelamin yang dicari' yg 'TEPAT' pada data training
									$sql = "SELECT COUNT(*) AS jumlah FROM tb_datatraining where jk = '$jeniskelamin' and masa_studi =7 group by jk";
									$query = mysqli_query($konek_db,$sql);
									$result = mysqli_fetch_array($query);
									$jkms7 = $result['jumlah'];  
									$hasiljkms7 = $jkms7/$totaldatams7;
									$hasiljkms7 = number_format($hasiljkms7,3);
									
									// total data 'jenis-kelamin yang dicari' yg 'TEPAT' pada data training
									$sql = "SELECT COUNT(*) AS jumlah FROM tb_datatraining where jk = '$jeniskelamin' and masa_studi =8 group by jk";
									$query = mysqli_query($konek_db,$sql);
									$result = mysqli_fetch_array($query);
									$jkms8 = $result['jumlah'];  
									$hasiljkms8 = $jkms8/$totaldatams8;
									$hasiljkms8 = number_format($hasiljkms8,3);
									
									// total data 'jenis-kelamin yang dicari' yg 'TEPAT' pada data training
									$sql = "SELECT COUNT(*) AS jumlah FROM tb_datatraining where jk = '$jeniskelamin' and masa_studi =9 group by jk";
									$query = mysqli_query($konek_db,$sql);
									$result = mysqli_fetch_array($query);
									$jkms9 = $result['jumlah'];  
									$hasiljkms9 = $jkms7/$totaldatams9;
									$hasiljkms9 = number_format($hasiljkms9,3);
									
									// total data 'jenis-kelamin yang dicari' yg 'TEPAT' pada data training
									$sql = "SELECT COUNT(*) AS jumlah FROM tb_datatraining where jk = '$jeniskelamin' and masa_studi =10 group by jk";
									$query = mysqli_query($konek_db,$sql);
									$result = mysqli_fetch_array($query);
									$jkms10 = $result['jumlah'];  
									$hasiljkms10 = $jkms7/$totaldatams10;
									$hasiljkms10 = number_format($hasiljkms10,3);
									
									// total data 'STATUS MAHASISWA yang dicari' yg 'TEPAT' pada data training
									$sql = "SELECT COUNT(*) AS jumlah FROM tb_datatraining where status_mahasiswa = '$statusmahasiswa' and masa_studi =7 group by status_mahasiswa";
									$query = mysqli_query($konek_db,$sql);
									$result = mysqli_fetch_array($query);
									$smms7 = $result['jumlah'];
									$hasilsmms7 = $smms7/$totaldatatepat;
									$hasilsmms7 = number_format($hasilsmms7,3);
									
									// total data 'STATUS MAHASISWA yang dicari' yg 'TEPAT' pada data training
									$sql = "SELECT COUNT(*) AS jumlah FROM tb_datatraining where status_mahasiswa = '$statusmahasiswa' and masa_studi =8 group by status_mahasiswa";
									$query = mysqli_query($konek_db,$sql);
									$result = mysqli_fetch_array($query);
									$smms8 = $result['jumlah'];
									$hasilsmms8 = $smms8/$totaldatatepat;
									$hasilsmms8 = number_format($hasilsmms8,3);

									// total data 'STATUS MAHASISWA yang dicari' yg 'TEPAT' pada data training
									$sql = "SELECT COUNT(*) AS jumlah FROM tb_datatraining where status_mahasiswa = '$statusmahasiswa' and masa_studi =9 group by status_mahasiswa";
									$query = mysqli_query($konek_db,$sql);
									$result = mysqli_fetch_array($query);
									$smms9 = $result['jumlah'];
									$hasilsmms9 = $smms9/$totaldatatepat;
									$hasilsmms9 = number_format($hasilsmms9,3);

									// total data 'STATUS MAHASISWA yang dicari' yg 'TEPAT' pada data training
									$sql = "SELECT COUNT(*) AS jumlah FROM tb_datatraining where status_mahasiswa = '$statusmahasiswa' and masa_studi =10 group by status_mahasiswa";
									$query = mysqli_query($konek_db,$sql);
									$result = mysqli_fetch_array($query);
									$smms10 = $result['jumlah'];
									$hasilsmms10 = $smms10/$totaldatatepat;
									$hasilsmms10 = number_format($hasilsmms10,3);
								
			
							
								// QUERY MEAN dan STANDAR DEVIASI IPK
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
								// QUERY MEAN dan STANDAR DEVIASI IPK

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
											$cobaips1ms9 = number_format($cobaips1ms9,3);
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
											$cobaips2ms7 = number_format($cobaips2ms7,3);
										// keterangan masa studi = 8
											$hasilips2ms8 = (1/sqrt(2*3.14*$sdips2ms8));
											$hasilips2ms8 = number_format($hasilips2ms8,3);
											$e =-(pow(($ips2-$meanips2ms8),$pangkat2))/2*(pow($sdips2ms8,$pangkat2));
											$e = number_format($e,3);
											$perkalian = pow($etetap,$e);
											$perkalian = number_format($perkalian,3);
											$cobaips2ms8 = $hasilips2ms8*$perkalian;
											$cobaips2ms8 = number_format($cobaips2ms8,3);
										// keterangan masa studi = 9
											$hasilips2ms9 = (1/sqrt(2*3.14*$sdips2ms9));
											$hasilips2ms9 = number_format($hasilips2ms9,3);
											$e =-(pow(($ips2-$meanips2ms9),$pangkat2))/2*(pow($sdips2ms9,$pangkat2));
											$e = number_format($e,3);
											$perkalian = pow($etetap,$e);
											$perkalian = number_format($perkalian,3);
											$cobaips2ms9 = $hasilips2ms9*$perkalian;
											$cobaips2ms9 = number_format($cobaips2ms9,3);
										// keterangan masa studi = 10
											$hasilips2ms10 = (1/sqrt(2*3.14*$sdips2ms10));
											$hasilips2ms10 = number_format($hasilips2ms10,3);
											$e =-(pow(($ips2-$meanips2ms10),$pangkat2))/2*(pow($sdips2ms10,$pangkat2));
											$e = number_format($e,3);
											$perkalian = pow($etetap,$e);
											$perkalian = number_format($perkalian,3);
											$cobaips2ms10 = $hasilips2ms10*$perkalian;
											$cobaips2ms10 = number_format($cobaips2ms10,3);
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
								
								$cobams7 =$totaldatams7fix*$hasiljkms7*$hasilsmms7*$cobaipk1ms7*$cobaipk2ms7*$cobaipk3ms7*$cobaipk4ms7*$cobaips1ms7*$cobaips2ms7*$cobaips3ms7*$cobaips4ms7;
								$cobams8 =$totaldatams8fix*$hasiljkms8*$hasilsmms8*$cobaipk1ms8*$cobaipk2ms8*$cobaipk3ms8*$cobaipk4ms8*$cobaips1ms8*$cobaips2ms8*$cobaips3ms8*$cobaips4ms8;
								$cobams9 =$totaldatams9fix*$hasiljkms9*$hasilsmms9*$cobaipk1ms9*$cobaipk2ms9*$cobaipk3ms9*$cobaipk4ms9*$cobaips1ms9*$cobaips2ms9*$cobaips3ms9*$cobaips4ms9;
								$cobams10 =$totaldatams10fix*$hasiljkms10*$hasilsmms10*$cobaipk1ms10*$cobaipk2ms10*$cobaipk3ms10*$cobaipk4ms10*$cobaips1ms10*$cobaips2ms10*$cobaips3ms10*$cobaips4ms10;

								if ($cobams7 > $cobams8 ) {
									$cobams7 = number_format($cobatepat,8);
									echo 7;
								}
								elseif ($cobams8 > $cobams9 ) {
									echo 8;
								 }elseif ($cobams9 > $cobams10) {
									echo 9;
								 }
								else{
									echo 10;
								}								
							?>
						</td>
						<td>
							<?php
							//Predikat IPK Kelulusan
								// Query mencari jenis kelamin dan status mahasisswa
									// total data 'jenis-kelamin yang dicari' dengan 'IPK antara 3.51 dan 4.00' pada data training 
										$sql = "SELECT COUNT(*) AS jumlah FROM tb_datatraining where jk = '$jeniskelamin' and ipk_lulus >=3.51 && ipk_lulus<=4.00";
										$query = mysqli_query($konek_db,$sql);
										$result = mysqli_fetch_array($query);
										$jkcumlaude = $result['jumlah'];
										$hasiljkcumlaude = $jkcumlaude/$totaldataipkcumlaude;

									// total data 'jenis-kelamin yang dicari' dengan 'IPK antara 2.76 dan 3.50' pada data training
										$sql = "SELECT COUNT(*) AS jumlah FROM tb_datatraining where jk = '$jeniskelamin' and ipk_lulus >=2.76 && ipk_lulus<=3.50";
										$query = mysqli_query($konek_db,$sql);
										$result = mysqli_fetch_array($query);
										$jksgtmemuaskan = $result['jumlah'];
										$hasiljksgtmemuaskan = $jksgtmemuaskan/$totaldataipksgtmemuaskan;

									// total data 'jenis-kelamin yang dicari' dengan 'IPK antara 2.00 dan 2.75' pada data training
										$sql = "SELECT COUNT(*) AS jumlah FROM tb_datatraining where jk = '$jeniskelamin' and ipk_lulus >=2.00 && ipk_lulus<=2.75";
										$query = mysqli_query($konek_db,$sql);
										$result = mysqli_fetch_array($query);
										$jkmemuaskan = $result['jumlah'];
										$hasiljkmemuaskan = $jkmemuaskan/$totaldataipkmemuaskan;

									// total data 'STATUS MAHASISWA yang dicari' dengan 'IPK antara 3.51 dan 4.00' pada data training
										$sql = "SELECT COUNT(*) AS jumlah FROM tb_datatraining where status_mahasiswa = '$statusmahasiswa' and ipk_lulus >=3.51 && ipk_lulus<=4.00";
										$query = mysqli_query($konek_db,$sql);
										$result = mysqli_fetch_array($query);
										$smcumlaude = $result['jumlah'];
										$hasilsmcumlaude = $smcumlaude/$totaldataipkcumlaude;

									// total data 'STATUS MAHASISWA yang dicari' dengan 'IPK antara 2.76 dan 3.50' pada data training
										$sql = "SELECT COUNT(*) AS jumlah FROM tb_datatraining where status_mahasiswa = '$statusmahasiswa' and ipk_lulus >=2.76 && ipk_lulus<=3.50";
										$query = mysqli_query($konek_db,$sql);
										$result = mysqli_fetch_array($query);
										$smsgtmemuaskan = $result['jumlah'];
										$hasilsmsgtmemuaskan = $smsgtmemuaskan/$totaldataipksgtmemuaskan;

									// total data 'STATUS MAHASISWA yang dicari' dengan 'IPK antara 2.00 dan 2.75' pada data training
										$sql = "SELECT COUNT(*) AS jumlah FROM tb_datatraining where status_mahasiswa = '$statusmahasiswa' and ipk_lulus >=2.00 && ipk_lulus<=2.75";
										$query = mysqli_query($konek_db,$sql);
										$result = mysqli_fetch_array($query);
										$smmemuaskan = $result['jumlah'];
										$hasilsmmemuaskan = $smmemuaskan/$totaldataipkmemuaskan;
								// Akhir Query mencari jenis kelamin dan status mahasisswa
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
											$cobaipk1cumlaude = number_format($cobaipk1cumlaude,3);
										// keterangan ipk_lulus >=2.76 && ipk_lulus<=3.50 (sgt memuaskan)
											$hasilipk1sgtmemuaskan = (1/sqrt(2*3.14*$sdipk1sgtmemuaskan));
											$hasilipk1sgtmemuaskan = number_format($hasilipk1sgtmemuaskan,3);
											$e =-(pow(($ipk1-$meanipk1sgtmemuaskan),$pangkat2))/2*(pow($sdipk1sgtmemuaskan,$pangkat2));
											$e = number_format($e,3);
											$perkalian = pow($etetap,$e);
											$perkalian = number_format($perkalian,3);
											$cobaipk1sgtmemuaskan = $hasilipk1sgtmemuaskan*$perkalian;
											$cobaipk1sgtmemuaskan = number_format($cobaipk1sgtmemuaskan,3);
										// keterangan ipk_lulus >=2.00 && ipk_lulus<=2.75 (memuaskan)
											$hasilipk1memuaskan = (1/sqrt(2*3.14*$sdipk1memuaskan));
											$hasilipk1memuaskan = number_format($hasilipk1memuaskan,3);
											$e =-(pow(($ipk1-$meanipk1memuaskan),$pangkat2))/2*(pow($sdipk1memuaskan,$pangkat2));
											$e = number_format($e,3);
											$perkalian = pow($etetap,$e);
											$perkalian = number_format($perkalian,3);
											$cobaipk1memuaskan = $hasilipk1memuaskan*$perkalian;
											$cobaipk1memuaskan = number_format($cobaipk1memuaskan,3);
									// menghitung IPK semester 2
										// keterangan ipk_lulus >=3.51 && ipk_lulus<=4.00 (cumlaude)
											$hasilipk2cumlaude = (1/sqrt(2*3.14*$sdipk2cumlaude));
											$hasilipk2cumlaude = number_format($hasilipk2cumlaude,3);
											$e =-(pow(($ipk2-$meanipk2cumlaude),$pangkat2))/2*(pow($sdipk2cumlaude,$pangkat2));
											$e = number_format($e,3);
											$perkalian = pow($etetap,$e);
											$perkalian = number_format($perkalian,3);
											$cobaipk2cumlaude = $hasilipk2cumlaude*$perkalian;
											$cobaipk2cumlaude = number_format($cobaipk2cumlaude,3);
										// keterangan ipk_lulus >=2.76 && ipk_lulus<=3.50 (sgt memuaskan)
											$hasilipk2sgtmemuaskan = (1/sqrt(2*3.14*$sdipk2sgtmemuaskan));
											$hasilipk2sgtmemuaskan = number_format($hasilipk2sgtmemuaskan,3);
											$e =-(pow(($ipk2-$meanipk2sgtmemuaskan),$pangkat2))/2*(pow($sdipk2sgtmemuaskan,$pangkat2));
											$e = number_format($e,3);
											$perkalian = pow($etetap,$e);
											$perkalian = number_format($perkalian,3);
											$cobaipk2sgtmemuaskan = $hasilipk2sgtmemuaskan*$perkalian;
											$cobaipk2sgtmemuaskan = number_format($cobaipk2sgtmemuaskan,3);
										// keterangan ipk_lulus >=2.00 && ipk_lulus<=2.75 (memuaskan)
											$hasilipk2memuaskan = (1/sqrt(2*3.14*$sdipk2memuaskan));
											$hasilipk2memuaskan = number_format($hasilipk2memuaskan,3);
											$e =-(pow(($ipk2-$meanipk2memuaskan),$pangkat2))/2*(pow($sdipk2memuaskan,$pangkat2));
											$e = number_format($e,3);
											$perkalian = pow($etetap,$e);
											$perkalian = number_format($perkalian,3);
											$cobaipk2memuaskan = $hasilipk2memuaskan*$perkalian;
											$cobaipk2memuaskan = number_format($cobaipk2memuaskan,3);
									// menghitung IPK semester 3
										// keterangan ipk_lulus >=3.51 && ipk_lulus<=4.00 (cumlaude)
											$hasilipk3cumlaude = (1/sqrt(2*3.14*$sdipk3cumlaude));
											$hasilipk3cumlaude = number_format($hasilipk3cumlaude,3);
											$e =-(pow(($ipk3-$meanipk3cumlaude),$pangkat2))/2*(pow($sdipk3cumlaude,$pangkat2));
											$e = number_format($e,3);
											$perkalian = pow($etetap,$e);
											$perkalian = number_format($perkalian,3);
											$cobaipk3cumlaude = $hasilipk3cumlaude*$perkalian;
											$cobaipk3cumlaude = number_format($cobaipk3cumlaude,3);
										// keterangan ipk_lulus >=2.76 && ipk_lulus<=3.50 (sgt memuaskan)
											$hasilipk3sgtmemuaskan = (1/sqrt(2*3.14*$sdipk3sgtmemuaskan));
											$hasilipk3sgtmemuaskan = number_format($hasilipk3sgtmemuaskan,3);
											$e =-(pow(($ipk3-$meanipk3sgtmemuaskan),$pangkat2))/2*(pow($sdipk3sgtmemuaskan,$pangkat2));
											$e = number_format($e,3);
											$perkalian = pow($etetap,$e);
											$perkalian = number_format($perkalian,3);
											$cobaipk3sgtmemuaskan = $hasilipk3sgtmemuaskan*$perkalian;
											$cobaipk3sgtmemuaskan = number_format($cobaipk3sgtmemuaskan,3);
										// keterangan ipk_lulus >=2.00 && ipk_lulus<=2.75 (memuaskan)
											$hasilipk3memuaskan = (1/sqrt(2*3.14*$sdipk3memuaskan));
											$hasilipk3memuaskan = number_format($hasilipk3memuaskan,3);
											$e =-(pow(($ipk3-$meanipk3memuaskan),$pangkat2))/2*(pow($sdipk3memuaskan,$pangkat2));
											$e = number_format($e,3);
											$perkalian = pow($etetap,$e);
											$perkalian = number_format($perkalian,3);
											$cobaipk3memuaskan = $hasilipk3memuaskan*$perkalian;
											$cobaipk3memuaskan = number_format($cobaipk3memuaskan,3);
									// menghitung IPK semester 4
										// keterangan ipk_lulus >=3.51 && ipk_lulus<=4.00 (cumlaude)
											$hasilipk4cumlaude = (1/sqrt(2*3.14*$sdipk4cumlaude));
											$hasilipk4cumlaude = number_format($hasilipk4cumlaude,3);
											$e =-(pow(($ipk4-$meanipk4cumlaude),$pangkat2))/2*(pow($sdipk4cumlaude,$pangkat2));
											$e = number_format($e,3);
											$perkalian = pow($etetap,$e);
											$perkalian = number_format($perkalian,3);
											$cobaipk4cumlaude = $hasilipk4cumlaude*$perkalian;
											$cobaipk4cumlaude = number_format($cobaipk4cumlaude,3);
										// keterangan ipk_lulus >=2.76 && ipk_lulus<=3.50 (sgt memuaskan)
											$hasilipk4sgtmemuaskan = (1/sqrt(2*3.14*$sdipk4sgtmemuaskan));
											$hasilipk4sgtmemuaskan = number_format($hasilipk4sgtmemuaskan,3);
											$e =-(pow(($ipk4-$meanipk4sgtmemuaskan),$pangkat2))/2*(pow($sdipk4sgtmemuaskan,$pangkat2));
											$e = number_format($e,3);
											$perkalian = pow($etetap,$e);
											$perkalian = number_format($perkalian,3);
											$cobaipk4sgtmemuaskan = $hasilipk4sgtmemuaskan*$perkalian;
											$cobaipk4sgtmemuaskan = number_format($cobaipk4sgtmemuaskan,3);
										// keterangan ipk_lulus >=2.00 && ipk_lulus<=2.75 (memuaskan)
											$hasilipk4memuaskan = (1/sqrt(2*3.14*$sdipk4memuaskan));
											$hasilipk4memuaskan = number_format($hasilipk4memuaskan,3);
											$e =-(pow(($ipk4-$meanipk4memuaskan),$pangkat2))/2*(pow($sdipk4memuaskan,$pangkat2));
											$e = number_format($e,3);
											$perkalian = pow($etetap,$e);
											$perkalian = number_format($perkalian,3);
											$cobaipk4memuaskan = $hasilipk4memuaskan*$perkalian;
											$cobaipk4memuaskan = number_format($cobaipk4memuaskan,3);
								// Akhir menghitung IPK
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
											$cobaips1cumlaude = number_format($cobaips1cumlaude,3);
										// keterangan ipk_lulus >=2.76 && ipk_lulus<=3.50 (sgt memuaskan)
											$hasilips1sgtmemuaskan = (1/sqrt(2*3.14*$sdips1sgtmemuaskan));
											$hasilips1sgtmemuaskan = number_format($hasilips1sgtmemuaskan,3);
											$e =-(pow(($ips1-$meanips1sgtmemuaskan),$pangkat2))/2*(pow($sdips1sgtmemuaskan,$pangkat2));
											$e = number_format($e,3);
											$perkalian = pow($etetap,$e);
											$perkalian = number_format($perkalian,3);
											$cobaips1sgtmemuaskan = $hasilips1sgtmemuaskan*$perkalian;
											$cobaips1sgtmemuaskan = number_format($cobaips1sgtmemuaskan,3);
										// keterangan ipk_lulus >=2.00 && ipk_lulus<=2.75 (memuaskan)
											$hasilips1memuaskan = (1/sqrt(2*3.14*$sdips1memuaskan));
											$hasilips1memuaskan = number_format($hasilips1memuaskan,3);
											$e =-(pow(($ips1-$meanips1memuaskan),$pangkat2))/2*(pow($sdips1memuaskan,$pangkat2));
											$e = number_format($e,3);
											$perkalian = pow($etetap,$e);
											$perkalian = number_format($perkalian,3);
											$cobaips1memuaskan = $hasilips1memuaskan*$perkalian;
											$cobaips1memuaskan = number_format($cobaips1memuaskan,3);
									// menghitung IPS semester 2
										// keterangan ipk_lulus >=3.51 && ipk_lulus<=4.00 (cumlaude)
											$hasilips2cumlaude = (1/sqrt(2*3.14*$sdips2cumlaude));
											$hasilips2cumlaude = number_format($hasilips2cumlaude,3);
											$e =-(pow(($ips2-$meanips2cumlaude),$pangkat2))/2*(pow($sdips2cumlaude,$pangkat2));
											$e = number_format($e,3);
											$perkalian = pow($etetap,$e);
											$perkalian = number_format($perkalian,3);
											$cobaips2cumlaude = $hasilips2cumlaude*$perkalian;
											$cobaips2cumlaude = number_format($cobaips2cumlaude,3);
										// keterangan ipk_lulus >=2.76 && ipk_lulus<=3.50 (sgt memuaskan)
											$hasilips2sgtmemuaskan = (1/sqrt(2*3.14*$sdips2sgtmemuaskan));
											$hasilips2sgtmemuaskan = number_format($hasilips2sgtmemuaskan,3);
											$e =-(pow(($ips2-$meanips2sgtmemuaskan),$pangkat2))/2*(pow($sdips2sgtmemuaskan,$pangkat2));
											$e = number_format($e,3);
											$perkalian = pow($etetap,$e);
											$perkalian = number_format($perkalian,3);
											$cobaips2sgtmemuaskan = $hasilips2sgtmemuaskan*$perkalian;
											$cobaips2sgtmemuaskan = number_format($cobaips2sgtmemuaskan,3);
										// keterangan ipk_lulus >=2.00 && ipk_lulus<=2.75 (memuaskan)
											$hasilips2memuaskan = (1/sqrt(2*3.14*$sdips2memuaskan));
											$hasilips2memuaskan = number_format($hasilips2memuaskan,3);
											$e =-(pow(($ips2-$meanips2memuaskan),$pangkat2))/2*(pow($sdips2memuaskan,$pangkat2));
											$e = number_format($e,3);
											$perkalian = pow($etetap,$e);
											$perkalian = number_format($perkalian,3);
											$cobaips2memuaskan = $hasilips2memuaskan*$perkalian;
											$cobaips2memuaskan = number_format($cobaips2memuaskan,3);
									// menghitung IPS semester 3
										// keterangan ipk_lulus >=3.51 && ipk_lulus<=4.00 (cumlaude)
											$hasilips3cumlaude = (1/sqrt(2*3.14*$sdips3cumlaude));
											$hasilips3cumlaude = number_format($hasilips3cumlaude,3);
											$e =-(pow(($ips3-$meanips3cumlaude),$pangkat2))/2*(pow($sdips3cumlaude,$pangkat2));
											$e = number_format($e,3);
											$perkalian = pow($etetap,$e);
											$perkalian = number_format($perkalian,3);
											$cobaips3cumlaude = $hasilips3cumlaude*$perkalian;
											$cobaips3cumlaude = number_format($cobaips3cumlaude,3);
										// keterangan ipk_lulus >=2.76 && ipk_lulus<=3.50 (sgt memuaskan)
											$hasilips3sgtmemuaskan = (1/sqrt(2*3.14*$sdips3sgtmemuaskan));
											$hasilips3sgtmemuaskan = number_format($hasilips3sgtmemuaskan,3);
											$e =-(pow(($ips3-$meanips3sgtmemuaskan),$pangkat2))/2*(pow($sdips3sgtmemuaskan,$pangkat2));
											$e = number_format($e,3);
											$perkalian = pow($etetap,$e);
											$perkalian = number_format($perkalian,3);
											$cobaips3sgtmemuaskan = $hasilips3sgtmemuaskan*$perkalian;
											$cobaips3sgtmemuaskan = number_format($cobaips3sgtmemuaskan,3);
										// keterangan ipk_lulus >=2.00 && ipk_lulus<=2.75 (memuaskan)
											$hasilips3memuaskan = (1/sqrt(2*3.14*$sdips3memuaskan));
											$hasilips3memuaskan = number_format($hasilips3memuaskan,3);
											$e =-(pow(($ips3-$meanips3memuaskan),$pangkat2))/2*(pow($sdips3memuaskan,$pangkat2));
											$e = number_format($e,3);
											$perkalian = pow($etetap,$e);
											$perkalian = number_format($perkalian,3);
											$cobaips3memuaskan = $hasilips3memuaskan*$perkalian;
											$cobaips3memuaskan = number_format($cobaips3memuaskan,3);
									// menghitung IPS semester 4
										// keterangan ipk_lulus >=3.51 && ipk_lulus<=4.00 (cumlaude)
											$hasilips4cumlaude = (1/sqrt(2*3.14*$sdips4cumlaude));
											$hasilips4cumlaude = number_format($hasilips4cumlaude,3);
											$e =-(pow(($ips4-$meanips4cumlaude),$pangkat2))/2*(pow($sdips4cumlaude,$pangkat2));
											$e = number_format($e,3);
											$perkalian = pow($etetap,$e);
											$perkalian = number_format($perkalian,3);
											$cobaips4cumlaude = $hasilips4cumlaude*$perkalian;
											$cobaips4cumlaude = number_format($cobaips4cumlaude,3);
										// keterangan ipk_lulus >=2.76 && ipk_lulus<=3.50 (sgt memuaskan)
											$hasilips4sgtmemuaskan = (1/sqrt(2*3.14*$sdips4sgtmemuaskan));
											$hasilips4sgtmemuaskan = number_format($hasilips4sgtmemuaskan,3);
											$e =-(pow(($ips4-$meanips4sgtmemuaskan),$pangkat2))/2*(pow($sdips4sgtmemuaskan,$pangkat2));
											$e = number_format($e,3);
											$perkalian = pow($etetap,$e);
											$perkalian = number_format($perkalian,3);
											$cobaips4sgtmemuaskan = $hasilips4sgtmemuaskan*$perkalian;
											$cobaips4sgtmemuaskan = number_format($cobaips4sgtmemuaskan,3);
										// keterangan ipk_lulus >=2.00 && ipk_lulus<=2.75 (memuaskan)
											$hasilips4memuaskan = (1/sqrt(2*3.14*$sdips4memuaskan));
											$hasilips4memuaskan = number_format($hasilips4memuaskan,3);
											$e =-(pow(($ips4-$meanips4memuaskan),$pangkat2))/2*(pow($sdips4memuaskan,$pangkat2));
											$e = number_format($e,3);
											$perkalian = pow($etetap,$e);
											$perkalian = number_format($perkalian,3);
											$cobaips4memuaskan = $hasilips4memuaskan*$perkalian;
											$cobaips4memuaskan = number_format($cobaips4memuaskan,3);
								// Akhir menghitung IPS

								//mengalikan semua angka dengan kelas yang sama
									$cobacumlaude =$totaldataipkcumlaudefix*$hasiljkcumlaude*$hasilsmcumlaude*$cobaipk1cumlaude*$cobaipk2cumlaude*$cobaipk3cumlaude*$cobaipk4cumlaude*$cobaips1cumlaude*$cobaips2cumlaude*$cobaips3cumlaude*$cobaips4cumlaude;
									$cobasgtmemuaskan =$totaldataipksgtmemuaskanfix*$hasiljksgtmemuaskan*$hasilsmsgtmemuaskan*$cobaipk1sgtmemuaskan*$cobaipk2sgtmemuaskan*$cobaipk3sgtmemuaskan*$cobaipk4sgtmemuaskan*$cobaips1sgtmemuaskan*$cobaips2sgtmemuaskan*$cobaips3sgtmemuaskan*$cobaips4sgtmemuaskan;
									$cobamemuaskan =$totaldataipkmemuaskanfix*$hasiljkmemuaskan*$hasilsmmemuaskan*$cobaipk1memuaskan*$cobaipk2memuaskan*$cobaipk3memuaskan*$cobaipk4memuaskan*$cobaips1memuaskan*$cobaips2memuaskan*$cobaips3memuaskan*$cobaips4memuaskan;
								if ($cobacumlaude > $cobasgtmemuaskan ) {
									// $cobacumlaude = number_format($cobatepat,8);
									$hasilcumlaude = "CUMLAUDE";
									echo $hasilcumlaude;
								}
								elseif ($cobasgtmemuaskan > $cobamemuaskan ) {
									$hasilsgtmemuaskan = "SANGAT MEMUASKAN";
									echo $hasilsgtmemuaskan;
								 }elseif ($cobamemuaskan != 0 ) {
									$hasilmemuaskan = "MEMUASKAN";
									echo $hasilmemuaskan;
								 }
								else{
									echo "CUKUP";
								}
						
							?>
						</td>
                        <td> <a href="detail-perhitungan.php?nim=<?php echo $data[0]; ?>" class="btn btn-default btn-sm" >detail </a> </td>
					</tr>
				<?php
					$no++;
					}
				?>
				</tbody>
			</table>
		</div>
            	
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  <?php

/**
 * @Author: Rick
 * @Date:   2018-11-08 07:36:38
 * @Last Modified by:   Rick
 * @Last Modified time: 2018-11-08 08:14:45
 */
include('include/footer.php');
?>