<?php
	include('connection.php');
	session_start();
if(!isset($_SESSION['user_id']))
{
 header("location:login.php");
}


	if (isset($_POST['Update_reqtype'])) {

	$id = $_POST['reqtype_id'];
	$slash2 = $_POST['reqtype'];
    $reqtype = str_replace("'", "\'", $slash2);
  



    $query = "UPDATE tbl_req_type SET Add_request_type = '$reqtype' WHERE req_type__id = '$id' ";

	$query_run = mysqli_query($conn,$query);
	
	if($query_run){
		echo "<script>alert('Successfully Updated'); window.location = 'admin_page.php';</script>";

	}

	else{
		echo "<script>alert('Update Failed'); window.location = 'admin_page.php'; </script>";

	}
}
?>