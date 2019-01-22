<?php

/**
 * @Author: Rick
 * @Date:   2018-11-15 00:15:55
 * @Last Modified by:   Rick
 * @Last Modified time: 2018-11-23 17:30:48
 */
?>

<?php

/**
 * @Author: Rick
 * @Date:   2018-11-08 08:17:20
 * @Last Modified by:   Rick
 * @Last Modified time: 2018-11-15 00:15:10
 */

include('koneksi.php');
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
            <a href="logout.php" class="btn btn-danger">
              <?php 

                $output="SELECT user FROM tb_user ";

                $query=mysqli_query($konek_db,$output) or die (mysqli_error());
                $r=mysqli_fetch_array($query); 
               ?>
              <span class="hidden-xs">Sign out</span>
            </a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li >
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
            <li><a href="idata-alumni.php"><i class="fa fa-circle-o"></i> Input Data Alumni</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Teknik Pengujian</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pengujian/lihat-data-training-pengujian.php"><i class="fa fa-circle-o"></i> lihat data training pengujian</a></li>         
            <li><a href="pengujian/lihat-data-testing-pengujian.php"><i class="fa fa-circle-o"></i> lihat data test pengujian</a></li>         
            <li><a href="pengujian/hasil-data-pengujian.php"><i class="fa fa-circle-o"></i> Hasil Pengujian Aplikasi</a></li>         
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
            <li class="active"><a href="idata-banyak.php"><i class="fa fa-circle-o"></i>Input Data testing banyak</a></li>
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
    <section class="content">
      

    	<div class="row">

        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
            	
             	<!-- membuat tombol cancel -->
				<a href="lihat-data-testing.php" class="btn btn-danger pull-right">
					<span class="glyphicon glyphicon-remove"></span>cancel
				</a>
				<h3 class="box-title">Form Import Data Testing</h3>
				<hr>
            </div>

			
            <!-- /.box-header -->
            <div class="box-body text-center ">
              <div class="row">
                <div class="col-lg-6 col-lg-offset-3">
                  <!-- buat download format excel nya -->
                    <form method="post" action="import.php" enctype="multipart/form-data">
                      <div class="form-group">
                        <a href="../_file/sample-test/Format.xlsx" class="btn btn-default">
                          <span class="glyphicon glyphicon-download"></span> Download Format
                        </a>
                        <br><br>
                        <!-- input type file  -->
                        <label for="file">File Excel</label>
                        <input type="file" name="file" id="file" class="form-control">
                      </div>
                      <div class="form-group">
                        <button type='submit' name='import-testing' class='btn btn-primary'><span class='glyphicon glyphicon-upload'></span> Import</button>"    
                      </div>
                    </form>
                </div>
              </div>
    	      


    	      <br><hr>
             
              
            	
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
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Developer</b>
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>

  
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->



<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
  })
  function checkDelete() {
            return confirm('Yakin menghapus data ini?');
        }
</script>
</body>
</html>
