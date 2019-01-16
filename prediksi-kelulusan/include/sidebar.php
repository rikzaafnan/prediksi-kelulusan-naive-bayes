<?php 
error_reporting(0);
?>
<nav class="navbar-default navbar-side" role="navigation">
  <div class="sidebar-collapse">
    <ul class="nav" id="main-menu">
      <?php $page = $_GET['page']; ?>
      <li <?php if(!$page== 'dashboard'){   ?> class="active-link" <?php }  ?> >
        <a href="index.php?page=dashboard" ><i class="fa fa-desktop "></i>Home</a>
      </li>
      <li <?php if($page == 'lulusan'){   ?> class="active-link" <?php } else{}?> >
        <a href="index.php?page=lulusan" ><i class="fa fa-mobile "></i>Lihat Data Lulusan</a>
      </li>       
      <li <?php if($page == 'naivebayes'){   ?> class="active-link" <?php } else{}?> >
        <a href="index.php?page=naivebayes" ><i class="fa fa-rocket "></i>Uji coba Metode Naive Bayes</a>
      </li>
      <li <?php if(!$page== 'prediksi-kelulusan'){   ?> class="active-link" <?php } ?> >
        <a href="index.php?page=prediksi-kelulusan" ><i class="fa fa-desktop "></i>Prediksi Lulusan</a>
      </li>
      </ul>
    </div>
  </nav>