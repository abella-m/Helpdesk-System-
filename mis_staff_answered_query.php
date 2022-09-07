<?php
$server = "localhost";
$username = "root";
$password = "";
$dbname = "db_helpdesk";

$conn = mysqli_connect($server , $username , $password , $dbname);
if(isset($_POST['Submit'])){

    $request_id = $_POST['request_id'];
    $Answered_by = $_POST['Answered_by'];
    $Lastname = $_POST['Lastname'];
    $Firstname = $_POST['Firstname'];
    $Middlename = $_POST['Middlename'];
    $Category = $_POST['Category'];
       $Request_Type = $_POST['Request_Type'];
    $OQ_date = $_POST['OQ_date'];
     $OQ_time = $_POST['OQ_time'];
    $Details = $_POST['Details'];
    $Answer = $_POST['Answer'];
    $DO = $_POST['DO'];
    $TCD = $_POST['Target_completion_Date'];
     $status = 'Pending';


     $query = "INSERT INTO tbl_answer (answer_id,Answered_by,Lastname,Firstname,Middlename,Department_Office,Request_Type,Details,Answer,Target_completion_Date,Date_answer,Time_answer,Category,query_status) VALUES ('$request_id','$Answered_by','$Lastname','$Firstname','$Middlename','$DO','$Request_Type','$Details','$Answer','$TCD','$OQ_date','$OQ_time','$Category','$status')";
           $run = mysqli_query($conn,$query) or die (mysqli_error($conn,$query));

            if($run){

               echo "<script>alert('Query Has Been Answered Succesfully.'); window.location = 'Mis_Staff_page.php';</script>";
               
               $query_status = "UPDATE tbl_request set query_status = 'Completed' where Id = '$request_id' ";

            $query_run = mysqli_query($conn,$query_status) or die(mysqli_error($conn,$query_status));
                    }

             else{
               echo "<script>alert('Something Went Wrong.'); window.location = 'Mis_Staff_page.php';</script>";
                     }

   

       
    }
    
  

?>