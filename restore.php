<?php
sleep(2);
$connection = mysqli_connect('localhost','root','','db_helpdesk');
$filename = 'db_helpdesk.sql';
$handle = fopen($filename,"r+");
$contents = fread($handle,filesize($filename));
$sql = explode(';',$contents);
foreach($sql as $query){
  $result = mysqli_query($connection,$query);
  if($result){
      
    
      echo "<script>alert('Succesfully imported.'); window.location = 'admin_page.php';</script>";

  }
}
fclose($handle);
 