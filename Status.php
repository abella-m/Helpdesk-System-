<?php
include('connection.php');

$id=$_GET['user_id'];
$Status=$_GET['Status'];

$admin_status="update tbl_login set Status=$Status where user_id=$id";

mysqli_query($conn, $admin_status);

if($Status == 0){
 echo "<script>alert('Account has been sucessfully Deactivated.'); window.location = 'Admin_page.php';</script>";
}
else if($Status == 1){
	echo "<script>alert('Account has been sucessfully Activated.'); window.location = 'Admin_page.php';</script>";
}
?>