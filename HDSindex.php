  <?php 

session_start();
include ('connection.php');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/2fdb267817.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="style.css?v=<?php echo-time(); ?>">
  <title> Help Desk System </title>
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
          <form action="index.php" method="POST" class="login-email">
            <input type="text" name="email" placeholder="Email" required="">
            <input type="password" name="pword"  id="password" placeholder="Password" required="">
            <span><i class="fas fa-eye" id="eye" onclick="show_password()"></i></span> <br>
            <button type="submit" class="btn" value="login" name="login">login</button>
            <p class="message">Not registered? <a href="register.php">Create an account</a></p>
          </form> 
      </div>
    </div>
  <script src="Javascript/password-show-hide.js"></script>

<?php
  if(isset($_POST['login'])){

  $email=$_POST['email'];
  $pword=$_POST['pword'];
  

  //Query to check if the record exist in th database
  $select = mysqli_query($conn, "SELECT * FROM tbl_users WHERE Email = '$email' AND Password = '$pword'"); 

  $row = mysqli_fetch_array($select);

  if(is_array($row)){

    $_SESSION["Email"] = $row['Email'];
    $_SESSION["Password"] = $row['Password'];
    $_SESSION["Username"] = $row['Username'];
    $_SESSION["User_Level"] = $row['User_Level'];
  }
  else{
    echo '<script type = "text/javascript">';
    echo 'alert("invalid Email or Password.");';
    echo 'window.location.href = "index.php"';
    echo '</script>';
  }

}

if (isset($_SESSION['Email'])){
  if ($row['User_Level']=='Admin'){

  header("Location:admin_page.php");
}
elseif($row['User_Level']=='Student'){
  header("Location:User_page.php");
}
elseif($row['User_Level']=='Employee'){
  header("Location:User_page.php");
}
elseif($row['User_Level']=='Teacher'){
  header("Location:User_page.php");
}
elseif($row['User_Level']=='MIS Staff'){
  header("Location:Mis_Staff_page.php");
}
}
?>


</body>
</html>