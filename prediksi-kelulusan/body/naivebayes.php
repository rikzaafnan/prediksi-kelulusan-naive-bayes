<?php

/**
 * @Author: Rick
 * @Date:   2018-11-06 20:06:18
 * @Last Modified by:   Rick
 * @Last Modified time: 2018-11-13 00:42:53
 */
?>
<div class="col-md-12">
	<h2>METODE NAIVE BAYES</h2>
	<hr>
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
		<form action="index.php?page=cara-test" method="POST">

			<div class="form-group row">
				<label class="col-xs-2 col-form-label">NIM</label>
				<div class="col-xs-10">
					<input type="text" name="nim" id="nim" size=15 class="form-control" required  />
				</div>
			</div>
			<div class="form-group row">
				<label class="col-xs-2 col-form-label">NAMA</label>
				<div class="col-xs-10">
					<input type="text" name="nama" id="nama" size=15 class="form-control" required  />
				</div>
			</div>
			<div class="form-group row">
				<label class="col-xs-2 col-form-label">JENIS KELAMIN</label>
				<div class="col-xs-10">
					<label class="radio-inline rd-geser" required>
                    	<input type="radio" id="laki-laki" name="jk" class="radio" alt="" title="" value="LAKI-LAKI">Laki-laki
                    <label class="radio-inline">    
                        <input type="radio" id="perempuan" name="jk" class="radio" alt="" title="" value="PEREMPUAN" >Perempuan 
				</div>
			</div>
			<div class="form-group row">
				<label class="col-xs-2 col-form-label">STATUS MAHASISWA</label>
				<div class="col-xs-10">
					<select name="sm" class="form-control" id="inlineFormCustomSelectPref">
	                    <option selected>Choose...</option>
	                    <option value="MAHASISWA">Mahasiswa</option>
	                    <option value="PEKERJA">Pekerja</option>
	                </select>
				</div>
			</div>
			<div class="form-group row">
				<h2 class="col-xs-6 col-form-label" >IPK</h2>	
			</div>
			<div class="form-group row">
				<label class="col-xs-2 col-form-label">IPK semester 1</label>
				<div class="col-xs-3">
					<input type="text" name="ipk1" id="ipk1" size=15 class="form-control" required  />
				</div>
				<label class="col-xs-2 col-form-label">IPK semester 3</label>
				<div class="col-xs-3">
					<input type="text" name="ipk3" id="ipk3" size=15 class="form-control" required  />
				</div>
			</div>
			<div class="form-group row">
				<label class="col-xs-2 col-form-label">IPK semester 2</label>
				<div class="col-xs-3">
					<input type="text" name="ipk2" id="ipk2m" size=15 class="form-control" required  />
				</div>
				<label class="col-xs-2 col-form-label">IPK semester 4</label>
				<div class="col-xs-3">
					<input type="text" name="ipk4" id="ipk4" size=15 class="form-control" required  />
				</div>
			</div>


			<div class="form-group row">
				<h2 class="col-xs-6 col-form-label" >IPS</h2>	
			</div>
			<div class="form-group row">
				<label class="col-xs-2 col-form-label">IPS semester 1</label>
				<div class="col-xs-3">
					<input type="text" name="ips1" id="ips1" size=15 class="form-control" required  />
				</div>
				<label class="col-xs-2 col-form-label">IPS semester 3</label>
				<div class="col-xs-3">
					<input type="text" name="ips3" id="ips3" size=15 class="form-control" required  />
				</div>
			</div>
			<div class="form-group row">
				<label class="col-xs-2 col-form-label">IPS semester 2</label>
				<div class="col-xs-3">
					<input type="text" name="ips2" id="ips2" size=15 class="form-control" required  />
				</div>
				<label class="col-xs-2 col-form-label">IPS semester 4</label>
				<div class="col-xs-3">
					<input type="text" name="ips4" id="ips4" size=15 class="form-control" required  />
				</div>
			</div>
			<div class="form-group row ">				
				<div class="col-xs-2">
					<button type="submit" name="submit" class="btn btn-success" >Proses</button>
					
				</div>
			</div>
		</form>
	</div>
</div>
