<?php
	include('connection.php');
	session_start();
if(!isset($_SESSION['user_id']))
{
 header("location:login.php");
}


	if (isset($_POST['Update_user'])) {
	
	$id = $_POST['id'];
    $Lastname = $_POST['Lastname'];
    $Firstname = $_POST['Firstname'];
    $Middlename = $_POST['Middlename'];
    $email = $_POST['Email'];
    $password = $_POST['Password'];
    $hashpword = password_hash($password, PASSWORD_DEFAULT);

    $userlevel = $_POST['User_Level'];

    $query = "UPDATE tbl_login SET Lastname = '$Lastname', Firstname = '$Firstname', Middlename = '$Middlename', Password = '$hashpword', Email = '$email', User_Level = '$userlevel' , unhashedpassword = '$password' WHERE user_id = '$id' ";

	$query_run = mysqli_query($conn,$query);
	
	if($query_run){
		echo "<script>alert('Successfully Updated'); window.location = 'admin_page.php';</script>";

	}

	else{
		echo "<script>alert('Update Failed'); window.location = 'admin_page.php'; </script>";

	}
}
?>