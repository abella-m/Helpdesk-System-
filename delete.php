<?php

include "connection.php"; // Using database connection file here

//$Id = $_GET['Id'];  get id through query string
$select = "Delete from tbl_login where user_id='".$_GET['del_id']."'";
$query = mysqli_query($conn, $select) or die ($select);

 echo "<script>alert('Succesfully Deleted.'); window.location = 'admin_page.php';</script>";


//$del = mysqli_query($conn,"delete from tbl_users where Id = '$Id'"); // delete query


?>