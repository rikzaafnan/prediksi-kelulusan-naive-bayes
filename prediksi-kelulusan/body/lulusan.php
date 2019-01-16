<?php

/**
 * @Author: Rick
 * @Date:   2018-11-06 17:32:40
 * @Last Modified by:   Rick
 * @Last Modified time: 2018-11-23 22:18:20
 */
include 'admin/koneksi.php'; ?>
<div class="col-md-12">
	<div class="row">
		<h2 class="text-center" >Data Alumni </h2>
		<hr>
	</div>
	<div class="row">
		<div class="table-responsive" >
			<table id="table1" class="table table-striped table-bordered" style="width:100%">
				<thead>
					<th>NO</th>
					<th>NIM</th>
					<th>NAMA</th>
					<th>TAHUN MASUK</th>
					<th>TAHUN LULUS</th>
				</thead>
				<tbody>

				<?php
					$no = 0;
					$query = "SELECT nim,nama FROM tb_datatraining";
					$hasil = mysqli_query($konek_db, $query);
					while ($data = mysqli_fetch_array ($hasil)) {
					$no++;				
				?>
					<tr>
						<td><?php echo $no; ?></td>
						<td><?php echo $data[0]; ?></td>
						<td><a class="nostyle" href="index.php?page=detail-lulusan&&kode=<?php echo $data[0];?>"><?php echo $data[1]; ?></a></td>
						<td>2015</td>
						<td>2019</td>
					</tr>
				<?php
					}
				?>
				</tbody>
			</table>
		</div>
	</div> 
</div>