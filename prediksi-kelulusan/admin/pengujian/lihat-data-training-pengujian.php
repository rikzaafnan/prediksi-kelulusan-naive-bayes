<?php

/**
 * @Author: Rick
 * @Date:   2018-11-08 08:17:20
 * @Last Modified by:   Rick
 * @Last Modified time: 2018-11-23 16:36:20
 */
?>

<?php

/**
 * @Author: Rick
 * @Date:   2018-11-08 07:36:38
 * @Last Modified by:   Rick
 * @Last Modified time: 2018-11-08 08:14:45
 */
include('../koneksi.php');
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
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="../bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="../bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

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
    <a href="../index.php" class="logo">
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
            <a href="../logout.php" class="btn btn-danger">
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
          <a href="../index.php">
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
            <li><a href="../data-alumni.php"><i class="fa fa-circle-o"></i> Lihat Data Alumni</a></li>
            <li><a href="../idata-alumni.php"><i class="fa fa-circle-o"></i> Input Data Alumni</a></li>
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
            <li class="active"><a href="lihat-data-training-pengujian.php"><i class="fa fa-circle-o"></i> lihat data training pengujian</a></li>         
            <li><a href="lihat-data-testing-pengujian.php"><i class="fa fa-circle-o"></i> lihat data test pengujian</a></li>         
            <li  ><a href="hasil-data-pengujian.php"><i class="fa fa-circle-o"></i> Hasil Pengujian Aplikasi</a></li>         
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Metode Naive bayes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../idata-tunggal.php"><i class="fa fa-circle-o"></i>Input  data testing tunggal</a></li>
            <li><a href="../idata-banyak.php"><i class="fa fa-circle-o"></i>Input Data testing banyak</a></li>
          </ul>
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
        <li class="active" >lihat data Training pengujian</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
    	<div class="row">
        
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Pengujian menggunakan confusion matrix</h3>
              <!-- <div class="pull-right">
                <a href="form-import.php" class="btn btn-info btn-xs">
                <span class="glyphicon glyphicon-import"></span> Import Data
                </a>
               
              </div> -->
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            	<div class="table-responsive" >
                <!-- tabel data training pengujian -->
                    <h3>Tabel data training untuk pengujian</h3>     		
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                            <th >NO</th>
                            <th >NIM</th>
                            <th >NAMA</th>
                            <th >Jenis Kelamin</th>
                            <th >Status Mahasiswa</th>
                            <th >IPK-1</th>
                            <th >IPK-2</th>
                            <th >IPK-3</th>
                            <th >IPK-4</th>
                            <th >IPS-1 </th>
                            <th >IPS-2 </th>
                            <th >IPS-3 </th>
                            <th >IPS-4 </th>
                            <th >Masa Studi </th>
                            <th >Status Kelulusan</th>
                            <th >Predikat kelulusan</th>
                        </tr>
                        
                        </thead>
                        <tbody>
                        <?php
                                        $queri="Select * From tb_pengujian";
                                        $hasil=mysqli_query ($konek_db,$queri);   
                                        $id = 0;
                                        while ($data = mysqli_fetch_array ($hasil))
                                        {
                                        $ipk_lulus = $data[15];
                                            
                                                    $id++;
                                        ?> 
                                                        
                                                    <tr>  
                                                        <td><?php echo $id ?></td>
                                                        <td><?php echo $data[0] ?></td>
                                                        <td><?php echo $data[1] ?></td>
                                                        <td><?php echo $data[2] ?></td>
                                                        <td><?php echo $data[3] ?></td>
                                                        <td><?php echo $data[4] ?></td>
                                                        <td><?php echo $data[5] ?></td>
                                                        <td><?php echo $data[6] ?></td>
                                                        <td><?php echo $data[7] ?></td>
                                                        <td><?php echo $data[9] ?></td>
                                                        <td><?php echo $data[10]?></td>
                                                        <td><?php echo $data[11]?></td>
                                                        <td><?php echo $data[12]?></td>
                                                        <td><?php echo $data[13]?></td>
                                                        <td><?php echo $data[14]?></td>
                                                        <td>
                                                        <?php
                                                            if ($ipk_lulus > 3.51 and $ipk_lulus<4.00) {
                                                            $predikat_kelulusan = "CUMLAUDE";
                                                            echo $predikat_kelulusan;
                                                        }elseif ($ipk_lulus >2.76 and $ipk_lulus<3.50) {
                                                            $predikat_kelulusan = "SGT MEMUASKAN";
                                                            echo $predikat_kelulusan;
                                                        }elseif ($ipk_lulus >2.00 and $ipk_lulus < 2.75) {
                                                            $predikat_kelulusan = "MEMUASKAN";
                                                            echo $predikat_kelulusan;
                                                        }
                                                        else {
                                                            $predikat_kelulusan = "CUKUP";
                                                            echo $predikat_kelulusan;
                                                        }
                                                        ?>
                                                        </td>
                                                    </tr>   
                                                    
                                    <?php                   
                                        }
                                    ?>   
                        
                        
                        </tbody>
                        
                    </table>

                </div>
                <!-- akhir div table responsive -->
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
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
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
   $(function () {
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   :false,
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
