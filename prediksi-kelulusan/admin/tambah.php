<?php		
include('koneksi.php');

if (isset($_POST['submit']))
    {
        $nim            = $_POST['nim'];
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
        $sk             = $_POST['sk'];
        $ms             = $_POST['ms'];
        $ipk_lulus             = $_POST['ipk_lulus'];
        $rataipk = (($ipk1+$ipk2+$ipk3+$ipk4)/4);


        $sama="SELECT * FROM tb_datatraining  where nim ='$nim'";
        $result=mysqli_query($konek_db, $sama);
        $cek_nim = mysqli_num_rows($result);
        
        if ($cek_nim>0)
            {
                $arrayDb = mysqli_fetch_array($result);
                $sudahAda_nim           = $arrayDb["nim"];
                $sudahAda_nama           = $_POST['nama'];
                $sudahAda_jk             = $_POST['jk'];
                $sudahAda_sm             = $_POST['sm'];
                $sudahAda_ipk1            = $_POST['ipk1'];
                $sudahAda_ipk2            = $_POST['ipk2'];
                $sudahAda_ipk3            = $_POST['ipk3'];
                $sudahAda_ipk4            = $_POST['ipk4'];
                $sudahAda_ips1            = $_POST['ips1'];
                $sudahAda_ips2            = $_POST['ips2'];
                $sudahAda_ips3            = $_POST['ips3'];
                $sudahAda_ips4            = $_POST['ips4'];
                $sudahAda_sk             = $_POST['sk'];
                $sudahAda_ms             = $_POST['ms'];
                $sudahAda_ipk_lulus             = $_POST['ipk_lulus'];


                echo "<script>
                    alert('Data sudah ada!');
                        window.location='form-sudahada.php?nim=".$sudahAda_nim."&nama=".$sudahAda_nama."&jk=".$sudahAda_jk."&sm=".$sudahAda_sm."&ipk1=".$sudahAda_ipk1."&ipk2=".$sudahAda_ipk2."&ipk3=".$sudahAda_ipk3."&ipk4=".$sudahAda_ipk4."&ips1=".$sudahAda_ips1."&ips2=".$sudahAda_ips2."&ips3=".$sudahAda_ips3."&ips4=".$sudahAda_ips4."&ms=".$sudahAda_ms."&sk=".$sudahAda_sk."&ipk_lulus=".$sudahAda_ipk_lulus."';
                    </script>";
                    if (($ipk1 > 4) || ($ipk2 > 4)|| ($ipk3 > 4) || ($ipk4 > 4) || ($ips1 > 4) || ($ips2 > 4)|| ($ips3 > 4)|| ($ips4 > 4)|| ($ipk_lulus>4) )
                    {
                        echo "<script>alert('IPK dan IPS berlebihan');window.location='idata-alumni.php'</script>";
                    } else
                    {
                        $query="INSERT INTO tb_datatraining SET nim='$nim', nama='$nama', jk='$jk',status_mahasiswa='$sm',ipk_1=$ipk1,ipk_2=$ipk2,ipk_3=$ipk3,ipk_4=$ipk4,rataipk=$rataipk,ips_1=$ips1,ips_2=$ips2,ips_3=$ips3,ips_4=$ips4,masa_studi ='$ms',status_kelulusan='$sk',ipk_lulus='$ipk_lulus'";
                        $result=mysqli_query($konek_db, $query);
                            echo "<script>alert('Data telah ditambahkan');window.location='data-alumni.php'</script>";  
                    }
            }
        elseif (($ipk1 > 4) || ($ipk2 > 4)|| ($ipk3 > 4) || ($ipk4 > 4) || ($ips1 > 4) || ($ips2 > 4)|| ($ips3 > 4)|| ($ips4 > 4))
        {
            echo "<script>alert('IPK dan IPS berlebihan');window.location='idata-alumni.php'</script>";
        }
        else
        {
            $query="INSERT INTO tb_datatraining SET nim='$nim', nama='$nama', jk='$jk',status_mahasiswa='$sm',ipk_1=$ipk1,ipk_2=$ipk2,ipk_3=$ipk3,ipk_4=$ipk4,rataipk=$rataipk,ips_1=$ips1,ips_2=$ips2,ips_3=$ips3,ips_4=$ips4,masa_studi='$ms',status_kelulusan='$sk',ipk_lulus='$ipk_lulus'";
                        $result=mysqli_query($konek_db, $query);
                            echo "<script>alert('Data telah ditambahkan');window.location='data-alumni.php'</script>";    
        }
    }
    elseif (isset($_POST['tambah-testing']))
    {
        $nim            = $_POST['nim'];
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
        $rataipk = (($ipk1+$ipk2+$ipk3+$ipk4)/4);


        $sama="SELECT * FROM tb_datatest  where nim ='$nim'";
        $result=mysqli_query($konek_db, $sama);
        $cek_nim = mysqli_num_rows($result);
        
        if ($cek_nim>0)
            {
                $arrayDb = mysqli_fetch_array($result);
                $sudahAda_nim           = $arrayDb["nim"];
                $sudahAda_nama           = $_POST['nama'];
                $sudahAda_jk             = $_POST['jk'];
                $sudahAda_sm             = $_POST['sm'];
                $sudahAda_ipk1            = $_POST['ipk1'];
                $sudahAda_ipk2            = $_POST['ipk2'];
                $sudahAda_ipk3            = $_POST['ipk3'];
                $sudahAda_ipk4            = $_POST['ipk4'];
                $sudahAda_ips1            = $_POST['ips1'];
                $sudahAda_ips2            = $_POST['ips2'];
                $sudahAda_ips3            = $_POST['ips3'];
                $sudahAda_ips4            = $_POST['ips4'];


                echo "<script>
                    alert('Data sudah ada!');
                        window.location='form-sudahada-datatesting.php?nim=".$sudahAda_nim."&nama=".$sudahAda_nama."&jk=".$sudahAda_jk."&sm=".$sudahAda_sm."&ipk1=".$sudahAda_ipk1."&ipk2=".$sudahAda_ipk2."&ipk3=".$sudahAda_ipk3."&ipk4=".$sudahAda_ipk4."&ips1=".$sudahAda_ips1."&ips2=".$sudahAda_ips2."&ips3=".$sudahAda_ips3."&ips4=".$sudahAda_ips4."';
                    </script>";
                    if (($ipk1 > 4) || ($ipk2 > 4)|| ($ipk3 > 4) || ($ipk4 > 4) || ($ips1 > 4) || ($ips2 > 4)|| ($ips3 > 4)|| ($ips4 > 4)|| ($ipk_lulus>4) )
                    {
                        echo "<script>alert('IPK dan IPS berlebihan');window.location='idata-tunggal.php'</script>";
                    } else
                    {
                        $query="INSERT INTO tb_datatest SET nim='$nim', nama='$nama', jk='$jk',status_mahasiswa='$sm',ipk_1=$ipk1,ipk_2=$ipk2,ipk_3=$ipk3,ipk_4=$ipk4,rataipk=$rataipk,ips_1=$ips1,ips_2=$ips2,ips_3=$ips3,ips_4=$ips4";
                        $result=mysqli_query($konek_db, $query);
                            echo "<script>alert('Data telah ditambahkan');window.location='lihat-data-testing.php'</script>";  
                    }
            }
        elseif (($ipk1 > 4) || ($ipk2 > 4)|| ($ipk3 > 4) || ($ipk4 > 4) || ($ips1 > 4) || ($ips2 > 4)|| ($ips3 > 4)|| ($ips4 > 4))
        {
            echo "<script>alert('IPK dan IPS berlebihan');window.location='idata-alumni.php'</script>";
        }
        else
        {
            $query="INSERT INTO tb_datatest SET nim='$nim', nama='$nama', jk='$jk',status_mahasiswa='$sm',ipk_1=$ipk1,ipk_2=$ipk2,ipk_3=$ipk3,ipk_4=$ipk4,rataipk=$rataipk,ips_1=$ips1,ips_2=$ips2,ips_3=$ips3,ips_4=$ips4";
                        $result=mysqli_query($konek_db, $query);
                            echo "<script>alert('Data telah ditambahkan');window.location='lihat-data-testing.php'</script>";   
        }
    }
?>	
