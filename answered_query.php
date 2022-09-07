<?php
$server = "localhost";
$username = "root";
$password = "";
$dbname = "db_helpdesk";

$conn = mysqli_connect($server , $username , $password , $dbname);
if(isset($_POST['Submit'])){

  if(!empty($_POST['Answered_by']) && !empty($_POST['Lastname']) && !empty($_POST['Firstname']) && !empty($_POST['Middlename']) && !empty($_POST['Category']) && !empty($_POST['Request_Type']) && !empty($_POST['Details']) && !empty($_POST['Answer'])){

    $request_id = $_POST['request_id'];
    $Answered_by = $_POST['Answered_by'];
    $Lastname = $_POST['Lastname'];
    $Firstname = $_POST['Firstname'];
    $Middlename = $_POST['Middlename'];
    $Category = $_POST['Category'];
    $Request_Type = $_POST['Request_Type'];
    $OQ_date = $_POST['OQ_date'];
    $Details = $_POST['Details'];
    $Answer = $_POST['Answer'];
     $status = 'Pending';

   

          $query = "insert into tbl_answer(Answered_by,Lastname,Firstname,Middlename,Category,Request_Type,Date_Answer,Details,Answer,query_status) values ('$Answered_by','$Lastname','$Firstname','$Middlename','$Category','$Request_Type','$OQ_date','$Details','$Answer','$status')";
           $run = mysqli_query($conn,$query) or die (mysqli_error($conn,$query));

            if($run){

               echo "<script>alert('Query Has Been Answered Succesfully.'); window.location = 'Admin_page.php';</script>";
               
               $query_status = "UPDATE tbl_request set query_status = 'Completed' where Id = '$request_id' ";

            $query_run = mysqli_query($conn,$query_status) or die(mysqli_error($conn,$query_status));
                    }

             else{
               echo "<script>alert('Something Went Wrong.'); window.location = 'Admin_page.php';</script>";
                     }
    }
    
  }

?>