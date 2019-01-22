

<?php

/**
 * @Author: Rick
 * @Date:   2018-11-08 08:51:45
 * @Last Modified by:   Rick
 * @Last Modified time: 2018-11-17 01:51:34
 */
include('koneksi.php');
include('include/header.php');

    $nim=$_GET['id'];
  $output="SELECT * FROM tb_datatest WHERE nim='$nim'";
  $query=mysqli_query($konek_db,$output) or die (mysqli_error());
  $r=mysqli_fetch_array($query);
?>


    <!-- Main content -->
    
    <div class="row content">
        <form name="form" id="myForm" method="post" enctype="multipart/form-data" action="" >
        <div class="form-group has-feedback">
            <label class="control-label col-sm-3" for="nim">NIM :</label>
            <div class="col-sm-8">
                <input type="text" name="nim" class="form-control" required name="nim" data-error="Isi kolom dengan benar" value="<?php echo $r['nim']; ?> " readonly>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors" role="alert"></div>
            </div>
        </div>                        
        <div class="form-group has-feedback">
            <label class="control-label col-sm-3" for="nama">Nama :</label>
            <div class="col-sm-8">
                <input type="text" name="nama" value="<?php echo $r['nama']; ?>" class="form-control" required name="nama" data-error="Isi kolom dengan benar">
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors" role="alert"></div>
            </div>
        </div>
        <label class="control-label col-sm-3" for="jk">Jenis Kelamin :</label>
        <div class="col-sm-8">
            <div class="form-group has-feedback">       
                <label class="radio-inline" required>
                  <input type="radio" id="laki-laki" name="jk" class="radio" alt="" title="" value="LAKI-LAKI" <?php  if($r['jk']=='LAKI-LAKI'){echo "checked";} ?>>Laki-laki
                <label class="radio-inline">    
                  <input type="radio" id="perempuan" name="jk" class="radio" alt="" title="" value="PEREMPUAN" <?php  if($r['jk']=='PEREMPUAN'){echo "checked";} ?> >Perempuan    
            </div>   
        </div>                    
        <label class="control-label col-sm-3" for="sm">Status Mahasiswa :</label>
        <div class="col-sm-8">
            <select name="sm" class="form-control" id="inlineFormCustomSelectPref" required data-error="Isi kolom dengan benar">
                <option selected>Choose...</option>
                <option value="MAHASISWA" <?php if( $r['status_mahasiswa'] =='MAHASISWA'){echo "selected"; } ?>>Mahasiswa</option>
                <option value="PEKERJA" <?php if( $r['status_mahasiswa'] =='PEKERJA'){echo "selected"; } ?>>Pekerja</option>
            </select>
            <span class="glyphicon form-control-feedback"  aria-hidden="true"></span>
            <div class="help-block with-errors" role="alert"></div>
        </div>
        <label class="control-label col-sm-12" for="ipk">IPK :</label>
        <div class="form-group-row">
            <label class="col-sm-3 col-form-label">IPK semester 1</label>
            <div class="col-sm-3">
              <input type="text" value="<?php echo $r['ipk_1']; ?>" name="ipk1" id="ipk1" size=15 class="form-control" required  />
            </div>
              <label class="col-sm-2 col-form-label">IPK semester 2</label>
            <div class="col-sm-3">
              <input type="text" value="<?php echo $r['ipk_2']; ?>" name="ipk2" id="ipk2" size=15 class="form-control" required  />
            </div>
        </div>
        <div class="form-group-row">
            <label class="col-sm-3 col-form-label">IPK semester 3</label>
            <div class="col-sm-3">
                <input type="text" name="ipk3" value="<?php echo $r['ipk_3']; ?>" id="ipk3" size=15 class="form-control" required  />
            </div>
            <label class="col-sm-2 col-form-label">IPK semester 4</label>
            <div class="col-sm-3">
                <input type="text" name="ipk4" value="<?php echo $r['ipk_4']; ?>" id="ipk4" size=15 class="form-control" required  />
            </div>
        </div>

        <label class="control-label col-sm-12" for="ips">IPS :</label>
        <div class="form-group-row">
            <label class="col-sm-3 col-form-label">IPS semester 1</label>
            <div class="col-sm-3">
                <input type="text" name="ips1" value="<?php echo $r['ips_1']; ?>" id="ips1" size=15 class="form-control" required  />
            </div>
            <label class="col-sm-2 col-form-label">IPS semester 2</label>
            <div class="col-sm-3">
                <input type="text" value="<?php echo $r['ips_2']; ?>" name="ips2" id="ips2" size=15 class="form-control" required  />
            </div>
        </div>
        <div class="form-group-row">
            <label class="col-sm-3 col-form-label">IPS semester 3</label>
            <div class="col-sm-3">
                <input type="text" name="ips3" value="<?php echo $r['ips_3']; ?>" id="ips3" size=15 class="form-control" required  />
            </div>
            <label class="col-sm-2 col-form-label">IPS semester 4</label>
            <div class="col-sm-3">
                <input type="text" name="ips4" value="<?php echo $r['ips_4']; ?>" id="ips4" size=15 class="form-control" required  />
            </div>
        </div>
       
        <div class="col-sm-8">
            <button type="submit" name="submit" class="btn btn-success" onclick="return checkInput()">Simpan</button>
            <input type="button" name="Batal" id="Batal" class="btn" value="Batal" onclick="self.history.back()">
        </div>
        <br>                      
                        <!-- Proses input data training -->
                        <!-- Proses edit data training -->                     
                        <?php 
                            if(isset($_POST['submit']))
                            {                           

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
                                $ms             = $_POST['ms'];
                                $sk             = $_POST['sk'];
                                $ipk_lulus             = $_POST['ipk_lulus'];
                                $rataipk = (($ipk1+$ipk2+$ipk3+$ipk4)/4);

                                if(($ipk1 > 4) || ($ipk2 > 4)|| ($ipk3 > 4) || ($ipk4 > 4) || ($ips1 > 4) || ($ips2 > 4)|| ($ips3 > 4)|| ($ips4 > 4) || ($ipk_lulus > 4))
                                {
                                    echo "<script>alert('Data gagal ');window.location='edata-testing.php?id=".$r[0]."'</script>";
                                    
                                }
                                    else
                                    {
                                        $query="UPDATE tb_datatest SET nama='$nama', jk='$jk',status_mahasiswa='$sm',ipk_1=$ipk1,ipk_2=$ipk2,ipk_3=$ipk3,ipk_4=$ipk4,rataipk=$rataipk,ips_1=$ips1,ips_2=$ips2,ips_3=$ips3,ips_4=$ips4 where nim='$nim'";
                                        $result=mysqli_query($konek_db, $query);
                                        if($result)
                                        {
                                            echo "<script>alert('Data telah diedit');window.location='lihat-data-testing.php'</script>";
                                        }
                                    }
                            }
                        ?>  
                    </form>
    </div>






    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Developer</b>
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>

 
</div>
<!-- ./wrapper -->



<!-- JAVASCRIPT ADMIN LTE -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script type="text/javascript">
            $(function() {
                $("#datepicker").datepicker();
            });

            function checkInput() {
                return confirm('Data sudah benar ?');
            }
        </script>
</body>
</html>
