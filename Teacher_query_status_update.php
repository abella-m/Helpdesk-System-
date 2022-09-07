

<?php
	include('connection.php');
	
	session_start();
if(!isset($_SESSION['user_id']))
{
 header("location:login.php");
}


	if (isset($_POST['status_update'])) {
	
	$id = $_POST['query_id'];
	$status = 'Completed';

   $query_status = "UPDATE tbl_answer set query_status = '$status' where answer_id = '$id' ";

            $query_run = mysqli_query($conn,$query_status) or die(mysqli_error($conn,$query_status));
	
	if($query_run){
		header( "location:Teacher_page.php");

	}

	
}
?>