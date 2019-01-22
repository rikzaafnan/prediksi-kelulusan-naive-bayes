<?php
  
  require('PHPExcel/PHPExcel.php');
  include('koneksi.php');

  if (isset($_POST['import'])) {
    $file = $_FILES['file']['name'];
    $ekstensi = explode(".", $file);
    $file_name = "file-".round(microtime(true)).".".end($ekstensi);
    $sumber = $_FILES['file']['tmp_name'];
    $target_dir ="../_file/";
    $target_file = $target_dir.$file_name;
    move_uploaded_file($sumber,$target_file);
    
    $obj = PHPExcel_IOFactory::load($target_file);
    $all_data = $obj->getActiveSheet()->toArray(null, true, true, true);

    $sql = " INSERT into tb_datatraining (nim, nama, jk, status_mahasiswa, ipk_1, ipk_2, ipk_3, ipk_4,rataipk, ips_1, ips_2, ips_3, ips_4, masa_studi, status_kelulusan, ipk_lulus) VALUES";
      for ($i=2; $i<= count($all_data); $i++){
        $nim = $all_data[$i]['A'];
        $nama = $all_data[$i]['B']; 
        $jk = $all_data[$i]['C']; 
        $status_mahasiswa = $all_data[$i]['D']; 
        $ipk_1 = $all_data[$i]['E']; 
        $ipk_2 = $all_data[$i]['F']; 
        $ipk_3 = $all_data[$i]['G']; 
        $ipk_4 = $all_data[$i]['H']; 
        $ips_1 = $all_data[$i]['I']; 
        $ips_2 = $all_data[$i]['J']; 
        $ips_3 = $all_data[$i]['K']; 
        $ips_4 = $all_data[$i]['L']; 
        $masa_studi = $all_data[$i]['M']; 
        $status_kelulusan = $all_data[$i]['N'];
        $ipk_lulus = $all_data[$i]['O'];
        $rataipk = (($ipk_1+$ipk_2+$ipk_3+$ipk_4)/4);
        $sql .= "('$nim','$nama','$jk','$status_mahasiswa','$ipk_1','$ipk_2','$ipk_3','$ipk_4', '$rataipk', '$ips_1', '$ips_2', '$ips_3', '$ips_4', '$masa_studi','$status_kelulusan','$ipk_lulus'),"; 
      }
      $sql = substr($sql, 0, -1);

      mysqli_query( $konek_db, $sql ) or die(mysqli_error($konek_db));
    

    unlink($target_file);
    echo" <script>window.location='data-alumni.php';</script> "; 

  }elseif (isset($_POST['import-testing'])) {
    $file = $_FILES['file']['name'];
    $ekstensi = explode(".", $file);
    $file_name = "file-".round(microtime(true)).".".end($ekstensi);
    $sumber = $_FILES['file']['tmp_name'];
    $target_dir ="../_file/";
    $target_file = $target_dir.$file_name;
    move_uploaded_file($sumber,$target_file);
    
    $obj = PHPExcel_IOFactory::load($target_file);
    $all_data = $obj->getActiveSheet()->toArray(null, true, true, true);

    $sql = "INSERT into tb_datatest (nim, nama, jk, status_mahasiswa, ipk_1, ipk_2, ipk_3, ipk_4,rataipk, ips_1, ips_2, ips_3, ips_4) VALUES";
      for ($i=2; $i<= count($all_data); $i++){
        $nim = $all_data[$i]['A'];
        $nama = $all_data[$i]['B']; 
        $jk = $all_data[$i]['C']; 
        $status_mahasiswa = $all_data[$i]['D']; 
        $ipk_1 = $all_data[$i]['E']; 
        $ipk_2 = $all_data[$i]['F']; 
        $ipk_3 = $all_data[$i]['G']; 
        $ipk_4 = $all_data[$i]['H']; 
        $ips_1 = $all_data[$i]['I']; 
        $ips_2 = $all_data[$i]['J']; 
        $ips_3 = $all_data[$i]['K']; 
        $ips_4 = $all_data[$i]['L']; 
        $rataipk = (($ipk_1+$ipk_2+$ipk_3+$ipk_4)/4);
        $sql .= "('$nim','$nama','$jk','$status_mahasiswa','$ipk_1','$ipk_2','$ipk_3','$ipk_4', '$rataipk', '$ips_1', '$ips_2', '$ips_3', '$ips_4'),"; 
      }
      $sql = substr($sql, 0, -1);

      mysqli_query( $konek_db, $sql ) or die(mysqli_error($konek_db));
    

    unlink($target_file);
    echo" <script>window.location='lihat-data-testing.php';</script> "; 
  }   
    // AWAL Pengujian
  
    elseif (isset($_POST['import-pengujian'])) {
    $file = $_FILES['file']['name'];
    $ekstensi = explode(".", $file);
    $file_name = "file-".round(microtime(true)).".".end($ekstensi);
    $sumber = $_FILES['file']['tmp_name'];
    $target_dir ="../_file/";
    $target_file = $target_dir.$file_name;
    move_uploaded_file($sumber,$target_file);
    
    $obj = PHPExcel_IOFactory::load($target_file);
    $all_data = $obj->getActiveSheet()->toArray(null, true, true, true);

    $sql = " INSERT into tb_pengujian (nim, nama, jk, status_mahasiswa, ipk_1, ipk_2, ipk_3, ipk_4,rataipk, ips_1, ips_2, ips_3, ips_4, masa_studi, status_kelulusan, ipk_lulus) VALUES";
      for ($i=2; $i<= count($all_data); $i++){
        $nim = $all_data[$i]['A'];
        $nama = $all_data[$i]['B']; 
        $jk = $all_data[$i]['C']; 
        $status_mahasiswa = $all_data[$i]['D']; 
        $ipk_1 = $all_data[$i]['E']; 
        $ipk_2 = $all_data[$i]['F']; 
        $ipk_3 = $all_data[$i]['G']; 
        $ipk_4 = $all_data[$i]['H']; 
        $ips_1 = $all_data[$i]['I']; 
        $ips_2 = $all_data[$i]['J']; 
        $ips_3 = $all_data[$i]['K']; 
        $ips_4 = $all_data[$i]['L']; 
        $masa_studi = $all_data[$i]['M']; 
        $status_kelulusan = $all_data[$i]['N'];
        $ipk_lulus = $all_data[$i]['O'];
        $rataipk = (($ipk_1+$ipk_2+$ipk_3+$ipk_4)/4);
        $sql .= "('$nim','$nama','$jk','$status_mahasiswa','$ipk_1','$ipk_2','$ipk_3','$ipk_4', '$rataipk', '$ips_1', '$ips_2', '$ips_3', '$ips_4', '$masa_studi','$status_kelulusan','$ipk_lulus'),"; 
      }
      $sql = substr($sql, 0, -1);

      mysqli_query( $konek_db, $sql ) or die(mysqli_error($konek_db));
    

    unlink($target_file);
    echo" <script>window.location='pengujian/lihat-data-pengujian.php';</script> "; 

  } elseif (isset($_POST['import-pengujian-test'])) {
    $file = $_FILES['file']['name'];
    $ekstensi = explode(".", $file);
    $file_name = "file-".round(microtime(true)).".".end($ekstensi);
    $sumber = $_FILES['file']['tmp_name'];
    $target_dir ="../_file/";
    $target_file = $target_dir.$file_name;
    move_uploaded_file($sumber,$target_file);
    
    $obj = PHPExcel_IOFactory::load($target_file);
    $all_data = $obj->getActiveSheet()->toArray(null, true, true, true);

    $sql = " INSERT into tb_pengujian_test (nim, nama, jk, status_mahasiswa, ipk_1, ipk_2, ipk_3, ipk_4,rataipk, ips_1, ips_2, ips_3, ips_4, masa_studi, status_kelulusan, ipk_lulus) VALUES";
      for ($i=2; $i<= count($all_data); $i++){
        $nim = $all_data[$i]['A'];
        $nama = $all_data[$i]['B']; 
        $jk = $all_data[$i]['C']; 
        $status_mahasiswa = $all_data[$i]['D']; 
        $ipk_1 = $all_data[$i]['E']; 
        $ipk_2 = $all_data[$i]['F']; 
        $ipk_3 = $all_data[$i]['G']; 
        $ipk_4 = $all_data[$i]['H']; 
        $ips_1 = $all_data[$i]['I']; 
        $ips_2 = $all_data[$i]['J']; 
        $ips_3 = $all_data[$i]['K']; 
        $ips_4 = $all_data[$i]['L']; 
        $masa_studi = $all_data[$i]['M']; 
        $status_kelulusan = $all_data[$i]['N'];
        $ipk_lulus = $all_data[$i]['O'];
        $rataipk = (($ipk_1+$ipk_2+$ipk_3+$ipk_4)/4);
        $sql .= "('$nim','$nama','$jk','$status_mahasiswa','$ipk_1','$ipk_2','$ipk_3','$ipk_4', '$rataipk', '$ips_1', '$ips_2', '$ips_3', '$ips_4', '$masa_studi','$status_kelulusan','$ipk_lulus'),"; 
      }
      $sql = substr($sql, 0, -1);

      mysqli_query( $konek_db, $sql ) or die(mysqli_error($konek_db));
    

    unlink($target_file);
    echo" <script>window.location='pengujian/lihat-data-pengujian.php';</script> "; 

  } 
 ?>