<?php

	include 'admin/koneksi.php';
	if ($_GET['kode']) {
	$nim = $_GET['kode'];
	$output = "SELECT * FROM tb_datatraining WHERE nim='$nim'";
	$hasil = mysqli_query($konek_db,$output);
	$r = mysqli_fetch_array($hasil);


?>
<div class="col-md-12">	
<br>	
	
		<h3>
			<?php echo $r['nama']; ?>
			<div class="pull-right">
			
				<a href="index.php?page=lulusan" class="btn btn-default">Kembali <i class="fa fa-arrow-right"></i></a>
			</div>
		</h3>
		<br>
		<h5> NIM : <b><?php echo $r['nim']; ?></b></h5>
		<h5> NAMA : <b><?php echo $r['nama']; ?></b></h5>
		<h5> Jenis Kelamin : <b><?php echo $r['jk']; ?></b></h5>
		<h5> Status Mahasiswa : <b><?php echo $r['status_mahasiswa']; ?></b></h5>
		<h5> IPK semester 1 : <b><?php echo $r['ipk_1']; ?></b></h5>
		<h5> IPK semester 2 : <b><?php echo $r['ipk_2']; ?></b></h5>
		<h5> IPK semester 3 : <b><?php echo $r['ipk_3']; ?></b></h5>
		<h5> IPK semester 4 : <b><?php echo $r['ipk_4']; ?></b></h5>
		<h5> IPS semester 1 : <b><?php echo $r['ips_1']; ?></b></h5>
		<h5> IPS semester 2 : <b><?php echo $r['ips_2']; ?></b></h5>
		<h5> IPS semester 3 : <b><?php echo $r['ips_3']; ?></b></h5>
		<h5> IPS semester 4 : <b><?php echo $r['ips_4']; ?></b></h5>
		<h5> Masa Studi : <b><?php echo $r['masa_studi']; ?></b></h5>
		<h5> Status kelulusan : <b><?php echo $r['status_kelulusan']; ?></b></h5>	

</div>
<?php

}

?>