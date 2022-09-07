<?php
$server = "localhost";
$username = "root";
$password = "";
$dbname = "db_helpdesk";

$conn = mysqli_connect($server , $username , $password , $dbname);


if(isset($_POST['Request'])){

  
    $idnum = $_POST['ID_Number'];
    $fname = $_POST['Firstname'];
    $lname = $_POST['Lastname'];
    $mname = $_POST['Middlename'];
    $prioritylevel = $_POST['radio'];
    $email = $_POST['email'];
    $category = $_POST['category'];
    $date = $_POST['Date'];
    $time = $_POST['Timee'];
    $req = $_POST['Request-type'];
    $other = $_POST['other'];
    $requesttype = $req . "  ". $other;
    $d = $_POST['details'];
     $details = str_replace("'", "\'", $d);
    $status = 'Pending';
    $DO = $_POST['DO'];
    $NA = 'N/A';

    
    


          $query = "insert into tbl_request(ID_Number,Lastname,Firstname,Middlename,Email,Category,Date,Time,Request_Type,Details,PriorityLevel,query_status,radio_remark,date_time,remark,Department_Office,Validity) values ('$idnum','$lname','$fname','$mname','$email','$category','$date','$time','$requesttype','$details','$prioritylevel', '$status','$NA','$NA','$NA','$DO','1')";
           $run = mysqli_query($conn,$query) or die (mysqli_error($conn,$query));

            if($run){
               echo "<script>alert('New Request Has Been Sent Succesfully.'); window.location = 'Teacher_page.php';</script>";
               
                    }

             else{
               echo "<script>alert('Something Went Wrong.'); window.location = 'Teacher_page.php';</script>";
                     }
    
   
  }
?>