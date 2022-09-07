<?php
$server = "localhost";
$username = "root";
$password = "";
$dbname = "db_helpdesk";

$conn = mysqli_connect($server , $username , $password , $dbname);
if(isset($_POST['submit_reqtype'])){

  if(!empty($_POST['add_req'])){

    $ADD_req = $_POST['add_req'];
  
          $query = "insert into tbl_req_type (Add_request_type) values ('$ADD_req')";
           $run = mysqli_query($conn,$query) or die (mysqli_error($conn,$query));

            if($run){
               echo "<script>alert('New Request type Has Been Add Succesfully.'); window.location = 'admin_page.php';</script>";
               
                    }

             else{
               echo "<script>alert('Adding New Request type Has Been Failed.'); window.location = 'admin_page.php';</script>";
                     }
  
  }

}
?>