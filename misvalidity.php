<?php
include('connection.php');

$id=$_GET['Id'];
$validity=$_GET['Validity'];

$admin_status="update tbl_request set Validity=$validity where Id=$id";

mysqli_query($conn, $admin_status);

if($validity == 0){
 echo "<script>alert('Has been sucessfully Invalidated'); window.location = 'Mis_Staff_page.php';</script>";
   $query_status = "UPDATE tbl_request set query_status = 'Completed' where Id = '$id' ";

            $query_run = mysqli_query($conn,$query_status) or die(mysqli_error($conn,$query_status));
}
else if($validity == 1){
	echo "<script>alert('Has been sucessfully Validated'); window.location = 'Mis_Staff_page.php';</script>";
}
?>