<?php
$server = "localhost";
$username = "root";
$password = "";
$dbname = "db_helpdesk";

$conn = mysqli_connect($server , $username , $password , $dbname);
if(isset($_POST['submituser'])){

  if(!empty($_POST['ID_Number']) && !empty($_POST['Lastname']) && !empty($_POST['Firstname']) && !empty($_POST['Middlename']) && !empty($_POST['Add_Email']) && !empty($_POST['add_Password']) && !empty($_POST['add_UserLevel'])){

   
    $ID_Number = $_POST['ID_Number'];
    $Lastname = $_POST['Lastname'];
    $Firstname = $_POST['Firstname'];
    $Middlename = $_POST['Middlename'];
    $addemail = $_POST['Add_Email'];
    $addpassword = $_POST['add_Password'];
     $hashpword = password_hash($addpassword, PASSWORD_DEFAULT);
    $addcpassword = $_POST['add_CPassword'];
    $adduserlevel = $_POST['add_UserLevel'];
    $Status = '1';
    if($addpassword == $addcpassword){

          $query = "insert into tbl_login (user_id,Lastname,Firstname,Middlename,Password,Email,User_Level,unhashedpassword,Status) values ('$ID_Number','$Lastname','$Firstname','$Middlename','$hashpword','$addemail','$adduserlevel','$addpassword', '$Status') ORDER BY user_id DESC";
           $run = mysqli_query($conn,$query) or die (mysqli_error($conn,$query));

            if($run){
               echo "<script>alert('New User Has Been Registered Succesfully.'); window.location = 'admin_page.php';</script>";
               
                    }

             else{
               echo "<script>alert('Registering New User Has Been Failed.'); window.location = 'admin_page.php';</script>";
                     }
    }
    else{
      echo "<script>alert('Password MisMatch.'); window.location = 'admin_page.php';</script>";
      }
  }
  else
  {
    echo "<script>alert('Please fill up every thing!'); window.location = 'admin_page.php';</script>";
  }
}
?>