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
include('include/header.php');

?>



    <!-- Main content -->
    <section class="content">
      

    	<div class="row">

        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
            	
             	<!-- membuat tombol cancel -->
				<a href="data-alumni.php" class="btn btn-danger pull-right">
					<span class="glyphicon glyphicon-remove"></span>cancel
				</a>
				<h3 class="box-title">Form Import Data</h3>
				<hr>
            </div>

			
            <!-- /.box-header -->
            <div class="box-body text-center ">
              <div class="row">
                <div class="col-lg-6 col-lg-offset-3">
                  <!-- buat download format excel nya -->
                    <form method="post" action="import.php" enctype="multipart/form-data">
                      <div class="form-group">
                        <a href="../_file/sample/Format.xlsx" class="btn btn-default">
                          <span class="glyphicon glyphicon-download"></span> Download Format
                        </a>
                        <br><br>
                        <!-- input type file  -->
                        <label for="file">File Excel</label>
                        <input type="file" name="file" id="file" class="form-control">
                      </div>
                      <div class="form-group">
                        <button type='submit' name='import' class='btn btn-primary'><span class='glyphicon glyphicon-upload'></span> Import</button>"    
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
