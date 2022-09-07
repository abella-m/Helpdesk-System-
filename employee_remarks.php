<?php
$server = "localhost";
$username = "root";
$password = "";
$dbname = "db_helpdesk";

$conn = mysqli_connect($server , $username , $password , $dbname);
if(isset($_POST['Remarks'])){

 
  
    $id = $_POST['req_id'];
    $rremarks = $_POST['radio_remarks'];
    $date = $_POST['date'];
    $remarks = $_POST['remarks'];
    

   

       
            $query = "UPDATE tbl_request SET radio_remark = '$rremarks',date_time = '$date', remark = '$remarks' WHERE Id = '$id' ";

           

           $run = mysqli_query($conn,$query) or die (mysqli_query($conn,$query));

            if($run){

               echo "<script>alert('Remarks has been sucessfully submitted.'); window.location = 'Employee_page.php';</script>";
               
        
                    }

             else{
               echo "<script>alert('Something Went Wrong.'); window.location = 'Employee_page.php';</script>";
                     }
    }
    
  

?>