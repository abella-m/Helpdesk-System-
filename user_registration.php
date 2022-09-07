<?php
$server = "localhost";
$username = "root";
$password = "";
$dbname = "db_helpdesk";

$conn = mysqli_connect($server , $username , $password , $dbname);
if(isset($_POST['submit'])){

  if(!empty($_POST['Username']) && !empty($_POST['Email']) && !empty($_POST['Password']) && !empty($_POST['User_Level'])){
    $username = $_POST['Username'];
    $email = $_POST['Email'];
    $userlevel = $_POST['User_Level'];
    $password = $_POST['Password'];
    $hashpword = password_hash($password, PASSWORD_DEFAULT);
    $cpassword = $_POST['CPassword'];
   

    if($password == $cpassword){

          $query = "insert into login(Username,Password,Email,User_Level,unhashedpassword) values ('$username','$hashpword','$email','$userlevel','$password')";
           $run = mysqli_query($conn,$query) or die (mysqli_error($conn,$query));

             if($run){
               echo "<script>alert('New User Has Been Registered Succesfully.'); window.location = 'register.php';</script>";
               
                    }

             else{
               echo "<script>alert('Registering New User Has Been Failed!'); window.location = 'register.php';</script>";
                     }


    }else{
      echo "<script>alert('Password MisMatch.'); window.location = 'register.php';</script>";
      }
  }
}
?>
