<?php
    include('koneksi.php');
    $query="DELETE from tb_datatest where nim='".$_GET['id']."'";
    mysqli_query($konek_db, $query);
    header("location:lihat-data-testing.php");
?>