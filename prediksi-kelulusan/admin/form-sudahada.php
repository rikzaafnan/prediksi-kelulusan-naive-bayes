

<?php

/**
 * @Author: Rick
 * @Date:   2018-11-08 08:51:45
 * @Last Modified by:   Rick
 * @Last Modified time: 2018-11-12 17:37:18
 */
include('koneksi.php');
    $nim=$_GET['nim'];
$output="SELECT * FROM tb_datatraining WHERE nim='$nim'";
$query=mysqli_query($konek_db,$output) or die (mysqli_error());
$r=mysqli_fetch_array($query);
?>



<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>


<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

   <header class="main-header">
    <!-- Logo -->
    <a href="index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs">Alexander Pierce</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  Alexander Pierce - Web Developer
                  <small>Member since Nov. 2012</small>
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="#" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li>
          <a href="index.php">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Data Alumni</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="data-alumni.php"><i class="fa fa-circle-o"></i> Lihat Data Alumni</a></li>
            <li  class="active"><a href="idata-alumni.php"><i class="fa fa-circle-o"></i> Input Data Alumni</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Data Training</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> Lihat Datatraining</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Input Data training</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Data Testing</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="idata-tunggal.php"><i class="fa fa-circle-o"></i>Input  data testing tunggal</a></li>
            <li><a href="idata-banyak.php"><i class="fa fa-circle-o"></i>Input Data testing banyak</a></li>
            <li><a href="lihat-data-testing.php"><i class="fa fa-circle-o"></i>Lihat data testing</a></li>
          </ul>
        </li>
        <li >
          <a href="hasil-prediksi.php">
            <i class="fa fa-dashboard"></i> <span>hasil Prediksi</span>
          </a>
        </li>
        <li >
          <a href="uji-coba-bayes.php">
            <i class="fa fa-dashboard"></i> <span>Uji Coba Metode Naive Bayes</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    
    <div class="row content">
        <form name="form" id="myForm" method="post" enctype="multipart/form-data" action="tambah.php" >
        


                        <div class="form-group has-feedback">
                            <label class="control-label col-sm-3" for="nim">NIM :</label>
                            <div class="col-sm-8">
                                <input type="text" name="nim" class="form-control" required name="nim" data-error="Isi kolom dengan benar" value="<?php echo $r['nim']; ?>">
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
                                        <input type="radio" id="perempuan" name="jk" class="radio" alt="" title="" value="PEREMPUAN" <?php  if($r['jk']=='LAKI-LAKI'){echo "checked";} ?> >Perempuan    
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
                            <div class="form-group has-feedback">
                            <label class="control-label col-sm-3" for="ms">Masa Studi :</label>
                            <div class="col-sm-8">
                                <input type="text" name="ms" class="form-control" required name="ms" data-error="Isi kolom dengan benar" value="<?php echo $r['masa_studi']; ?>">
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors" role="alert"></div>
                            </div>
                            </div>
                            <label class="control-label col-sm-3" for="sk">Status Kelulusan :</label>
                            <div class="col-sm-8">
                                <select name="sk" class="form-control" id="inlineFormCustomSelectPref" required data-error="Isi kolom dengan benar">
                                    <option selected>Choose...</option>
                                    <option <?php if( $r['status_kelulusan'] =='TEPAT'){echo "selected"; } ?> value="TEPAT">Tepat</option>
                                    <option <?php if( $r['status_kelulusan'] =='TERLAMBAT'){echo "selected"; } ?> value="TERLAMBAT">Terlambat</option>
                                </select>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors" role="alert"></div>
                            </div>
                            <div class="form-group has-feedback">
                              <label class="control-label col-sm-3" for="ipk_lulus">IPK lulus :</label>
                              <div class="col-sm-8">
                                <input type="text" name="ipk_lulus" class="form-control" required name="ipk_lulus" data-error="Isi kolom dengan benar" value="<?php echo $r['ipk_lulus']; ?>">
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors" role="alert"></div>
                              </div>
                            </div>

                            <div class="col-sm-8">
                                <button type="submit" name="submit" class="btn btn-success" onclick="return checkInput()">Simpan</button>
                            <input type="button" name="Batal" id="Batal" class="btn" value="Batal" onclick="self.history.back()">
                            </div>

                           
                            <br>
                        </div>                       
                        <!-- Proses input data training -->
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
