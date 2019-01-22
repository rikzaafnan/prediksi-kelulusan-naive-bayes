<?php
    include('koneksi.php');
    $query="DELETE from tb_datatraining where nim='".$_GET['id']."'";
    mysqli_query($konek_db, $query);
    header("location:data-alumni.php");
?>