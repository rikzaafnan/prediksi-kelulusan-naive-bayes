
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <?php include 'include/head.php'; ?>
</head>
<body>
  <div id="wrapper">
    <!-- /. NAV TOP  -->
    <?php include 'include/topbar.php'; ?>
    <!-- /. NAV TOP  -->
    <!-- /. NAV SIDE  -->
    <?php include 'include/sidebar.php'; ?>
    <!-- /. NAV SIDE  -->
    <div id="page-wrapper" >
      <!-- /. PAGE INNER  -->
      <div id="page-inner" style="overflow: hidden;">
        <?php
        if($page == 'dashboard'){
         include 'body/dashboard.php'; 
       } 
        elseif($page == 'lulusan'){
         include 'body/lulusan.php'; 
       }
       elseif($page == 'naivebayes'){
         include 'body/naivebayes.php'; 
       }
       elseif($page == 'cara-test'){
         include 'body/cara-test.php'; 
       }
       elseif($page == 'carahitungms'){
         include 'body/carahitungms.php'; 
       }
       elseif($page == 'carahitungipk'){
         include 'body/carahitungipk.php'; 
       }
       elseif($page == 'detail-lulusan'){
         include 'body/detail-lulusan.php'; 
       }
       elseif($page == 'prediksi-kelulusan'){
         include 'body/prediksi-kelulusan.php'; 
       }
       else{
         include 'body/dashboard.php'; 
       }
       ?>
     </div>
     <!-- /. PAGE INNER  -->
   </div>
   <!-- /. PAGE WRAPPER  -->
   <?php include 'include/footer.php'; ?>
 </div>

</body>
</html>
