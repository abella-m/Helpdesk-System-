
<?php

if(isset($_POST["view"]))
{
 include("connection.php");
 if($_POST["view"] != '')
 {
  $update_query = "UPDATE tbl_request SET query_status=1 WHERE query_status=0";
  mysqli_query($connect, $update_query);
 }
 $query = "SELECT * FROM tbl_request ORDER BY Id DESC LIMIT 10";
 $result = mysqli_query($connect, $query);
 $output = '';
 
 if(mysqli_num_rows($result) > 0)
 {
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
   <li>
    <a href="#">
     <strong>'.$row["Name"].'</strong><br />
     <small><em>'.$row["Request_Type"].'</em></small><br />
     <small><em>'.$row["Date"].'</em></small>
    </a>
   </li>
   <li class="divider"></li>
   ';
  }
 }
 else
 {
  $output .= '<li><a href="#" class="text-bold text-italic">No Notification Found</a></li>';
 }
 
 $query_1 = "SELECT * FROM tbl_request WHERE query_status=0";
 $result_1 = mysqli_query($connect, $query_1);
 $count = mysqli_num_rows($result_1);
 $data = array(
  'notification'   => $output,
  'unseen_notification' => $count
 );
 echo json_encode($data);
}
?>
