<!--
//login.php
!-->

<?php

include('database_connection.php');

session_start();

$message = '';


if(isset($_POST["login"]))
{
 $query = "
   SELECT * FROM tbl_login 
    WHERE Email = :email
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
    array(
      ':email' => $_POST["email"]
     )
  );
  $count = $statement->rowCount();
  if($count > 0)
 {
  $result = $statement->fetchAll();
    foreach($result as $row)
    {

      if(password_verify($_POST["password"], $row["Password"]))
      {
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['lastname'] = $row['Lastname'];
        $_SESSION['firstname'] = $row['Firstname'];
        $_SESSION['middlename'] = $row['Middlename'];
        $_SESSION['User_Level'] = $row['User_Level'];
         $_SESSION['Email'] = $row['Email'];

        $sub_query = "
        INSERT INTO tbl_login_details 
        (user_id) 
        VALUES ('".$row['user_id']."')
        ";
        $statement = $connect->prepare($sub_query);
        $statement->execute();
        $_SESSION['login_details_id'] = $connect->lastInsertId();

        if($row['Status']=='1'){
        if ($row['User_Level']=='Admin'){

        header("Location:admin_page.php");
      }
      elseif($row['User_Level']=='Student'){
        header("Location:Student_page.php");
      }
      elseif($row['User_Level']=='Employee'){
        header("Location:Employee_page.php");
      }
      elseif($row['User_Level']=='Teacher'){
        header("Location:Teacher_page.php");
      }
      elseif($row['User_Level']=='MIS Staff'){
        header("Location:Mis_Staff_page.php");
      }
    }
    else{

  echo "<script>alert('The account you are trying to log-in has been deactivated.'); window.location = 'login.php'; </script>";

    }
      }
      else
      {
        $message = "<label>Invalid Password!</label>";  //echo "<script>alert('Wrong Password!');</script>";
      }
    }
 }
 else
 {
  $message = "<label>Invalid Email!</label>";
 }
}

?>

<html>  
    <head>  
        <title>Help Desk System</title>  
 <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
        <link rel="stylesheet" type="text/css" href="style.css?v=<?php echo-time(); ?>">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://kit.fontawesome.com/2fdb267817.js" crossorigin="anonymous"></script>
    </head>  
    <body>
    <div class="login-page">
        <div class="form-login">
          <div class="login">
            <div class="login-logo">
              <img src="logo.png" alt="">
            </div>
            <div class="login-header">
              <label class="slc">Saint Louis College</label><br>
              <label class="hds"> Help Desk System</label> <br>
              <label class="mis"> Management Information System</label>
            </div>
          </div>
          <form method="POST" class="login-email">
            <input type="text" name="email" placeholder="Email" required="">
            <input type="password" name="password"  id="password" placeholder="Password" required="">
            <span><i class="fas fa-eye" id="eye" onclick="show_password()"></i></span>
            <center><div class="error-bg"><p class="messages"><?php echo $message; ?></p></div></center>  
            <button type="submit" class="btn" value="login" name="login">login</button>
            
          </form> 
      </div>
    </div>
  <script src="Javascript/password-show-hide.js"></script>
    </body>  
</html>
