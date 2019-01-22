

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
              <h3 class="box-title">Data Table With Full Features</h3>
              <div class="pull-right">
                <a href="form-import.php" class="btn btn-info btn-xs">
                <span class="glyphicon glyphicon-import"></span> Import Data
              </a>
              <a href="idata-alumni.php" class="btn btn-success btn-xs">
                <span class="glyphicon glyphicon-plus"></span> Tambah Data
              </a>  
              </div>
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              
            	<div class="table-responsive" >
            		
            	
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
                  <th>aksi</th>
                </tr>
                
                </thead>
                <tbody>
                <?php
                                $queri="Select * From tb_datatraining";
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
                                                <td>
                                                  <a href="edata-alumni.php?id=<?php echo $data[0]?>"><i class='glyphicon glyphicon-pencil'></i></a> &nbsp; &nbsp;
                                                  <a href="delete.php?id=<?php echo $data[0] ?>" onclick='return checkDelete()'><i class='glyphicon glyphicon-trash'></i></a>
                                                  <?php
                                                    // $hasil_predikat= "CUMLAUDE";
                                                    // if ($hasil_predikat === $predikat_kelulusan) {
                                                    //   echo ;
                                                    // }else{
                                                    //   echo "beda bro";
                                                    // }
                                                  ?>
                                                </td>
                                              </tr>   
                                            
                              <?php                   
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