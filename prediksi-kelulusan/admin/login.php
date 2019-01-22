<?php

/**
 * @Author: Rick
 * @Date:   2018-01-11 04:31:12
 * @Last Modified by:   Rick
 * @Last Modified time: 2018-11-08 15:02:51
 */

session_start();

if (isset($_SESSION["login"])) {
  header("Location:index.php");
  exit;
}

require ('koneksi.php');

if (isset($_POST["login"])) {
    
    $username =  $_POST["username"];
    $password =  $_POST["password"];

    $result = mysqli_query($konek_db, "SELECT * FROM tb_user WHERE username = '$username' AND password = '$password'");

    //cek username
    if (mysqli_num_rows($result) === 1) {
      //cek password
      $row = mysqli_fetch_assoc($result);
          //set session
          $_SESSION["login"] = true;
          header("Location:index.php");
          exit;
      }else{
        echo "<script>
          alert('maaf, password salah');
          window.location='login.php';
        </script>";
      }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login Admin</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
  <link rel="stylesheet" href="css/csslogin.css">
  <link rel="stylesheet" href="css/bootstrap.css">
  <style type="text/css">
    body,td,th {
      color: #000;
    }
  </style>
  <script src="js/jslogin.js"></script>
</head>
<body>
  <div class="container">
    <div class="login-container">        
      <img id="avatar" src="images/login.png" alt="">    
        <div class="form-box">
          <form action="" method="post">
            <input name="username" type="text" placeholder="username">
            <input name="password" type="password" placeholder="password">
            <button class="btn btn-info btn-block login" type="submit" name="login">Login</button>
          </form>
        </div>
    </div>    
  </div>
</body>
</html>