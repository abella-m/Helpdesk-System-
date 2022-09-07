<?php
	include('connection.php');
	session_start();
if(!isset($_SESSION['user_id']))
{
 header("location:login.php");
}


	if (isset($_POST['Update_faq'])) {
	$id = $_POST['faq_id'];
	$slash2 = $_POST['faq_quest'];
    $FAQ_question = str_replace("'", "\'", $slash2);
    $slash = $_POST['faq_ans'];
    $FAQ_answer = str_replace("'", "\'", $slash);
    $FAQ_category = $_POST['faq_cat'];



    $query = "UPDATE tbl_faq SET FAQ_question = '$FAQ_question', FAQ_answer = '$FAQ_answer', FAQ_category = '$FAQ_category' WHERE faq_id = '$id' ";

	$query_run = mysqli_query($conn,$query);
	
	if($query_run){
		echo "<script>alert('Successfully Updated'); window.location = 'admin_page.php';</script>";

	}

	else{
		echo "<script>alert('Update Failed'); window.location = 'admin_page.php'; </script>";

	}
}
?>