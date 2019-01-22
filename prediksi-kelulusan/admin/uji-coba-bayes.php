<?php 

    include "include/header.php";
?>




<div class="row content">
		<form name="form" id="myForm" method="post" enctype="multipart/form-data" action="metode-bayes.php" >
		


                        <div class="form-group has-feedback">
                            <label class="control-label col-sm-3" for="nim">NIM :</label>
                            <div class="col-sm-8">
                                <input type="text" name="nim" class="form-control" required name="nim" data-error="Isi kolom dengan benar" value="">
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors" role="alert"></div>
                            </div>
                        </div>                        
                        <div class="form-group has-feedback">
                            <label class="control-label col-sm-3" for="nama">Nama :</label>
                            <div class="col-sm-8">
                                <input type="text" name="nama" class="form-control" required name="nama" data-error="Isi kolom dengan benar">
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors" role="alert"></div>
                            </div>
                        </div>

                            <label class="control-label col-sm-3" for="jk">Jenis Kelamin :</label>
                            <div class="col-sm-8">
                                <div class="form-group has-feedback">       
                                    <label class="radio-inline" required>
                                        <input type="radio" id="laki-laki" name="jk" class="radio" alt="" title="" value="LAKI-LAKI">Laki-laki
                                    <label class="radio-inline">    
                                        <input type="radio" id="perempuan" name="jk" class="radio" alt="" title="" value="PEREMPUAN" >Perempuan    
                                </div>   
                            </div>
                      		
                            <label class="control-label col-sm-3" for="sm">Status Mahasiswa :</label>
                            <div class="col-sm-8">
                                <select name="sm" class="form-control" id="inlineFormCustomSelectPref" required data-error="Isi kolom dengan benar">
                                    <option selected>Choose...</option>
                                    <option value="MAHASISWA">Mahasiswa</option>
                                    <option value="PEKERJA">Pekerja</option>
                                </select>
                                <span class="glyphicon form-control-feedback"  aria-hidden="true"></span>
                                <div class="help-block with-errors" role="alert"></div>
                            </div>
                            <label class="control-label col-sm-12" for="ipk">IPK :</label>
                            <div class="form-group-row">
                            	<label class="col-sm-3 col-form-label">IPK semester 1</label>
								<div class="col-sm-3">
									<input type="text" name="ipk1" id="ipk1" size=15 class="form-control" required  />
								</div>
								<label class="col-sm-2 col-form-label">IPK semester 2</label>
								<div class="col-sm-3">
									<input type="text" name="ipk2" id="ipk2" size=15 class="form-control" required  />
								</div>
                            </div>
                            <div class="form-group-row">
                            	<label class="col-sm-3 col-form-label">IPK semester 3</label>
								<div class="col-sm-3">
									<input type="text" name="ipk3" id="ipk3" size=15 class="form-control" required  />
								</div>
								<label class="col-sm-2 col-form-label">IPK semester 4</label>
								<div class="col-sm-3">
									<input type="text" name="ipk4" id="ipk4" size=15 class="form-control" required  />
								</div>
                            </div>

                            <label class="control-label col-sm-12" for="ips">IPS :</label>
                            <div class="form-group-row">
                            	<label class="col-sm-3 col-form-label">IPS semester 1</label>
								<div class="col-sm-3">
									<input type="text" name="ips1" id="ips1" size=15 class="form-control" required  />
								</div>
								<label class="col-sm-2 col-form-label">IPS semester 2</label>
								<div class="col-sm-3">
									<input type="text" name="ips2" id="ips2" size=15 class="form-control" required  />
								</div>
                            </div>
                            <div class="form-group-row">
                            	<label class="col-sm-3 col-form-label">IPS semester 3</label>
								<div class="col-sm-3">
									<input type="text" name="ips3" id="ips3" size=15 class="form-control" required  />
								</div>
								<label class="col-sm-2 col-form-label">IPS semester 4</label>
								<div class="col-sm-3">
									<input type="text" name="ips4" id="ips4" size=15 class="form-control" required  />
								</div>
                            </div>
                            

                            <div class="col-sm-8">
                                <button type="submit" name="submit" class="btn btn-success" onclick="return checkInput()">Proses</button>
                            <input type="button" name="Batal" id="Batal" class="btn" value="Batal" onclick="self.history.back()">
                            </div>

                           
                            <br>
                        </div>                       
                        <!-- Proses input data training -->
                    </form>
		





	
    <!-- /.content -->




<?php 

    include "include/footer.php";
?>