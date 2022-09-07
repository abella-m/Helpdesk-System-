
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/2fdb267817.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="style.css?v=<?php echo-time(); ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  </head>
  <body>
    <div class="Register-page">
      <div class="form">
        <div class="Register">
          <div class="Register-logo">
            <img src="logo.png" alt="">
          </div>
          <div class="Register-header">
            <label class="slc">Saint Louis College</label><br>
            <label class="hds"> Help Desk System</label> <br>
            <label class="mis"> Management Information System</label>
          </div>
        </div>
        <form action= "user_registration.php" method="POST" class="Register-form">
          <input type="text" name="Username" placeholder="Username"/>
          <input type="text" name="Email" placeholder="Email"/><br>
          <input list="Category" type="text" name="User_Level" placeholder="Category" autocomplete="off" />
          <datalist id="Category">
            <option value=""> </option>
            <option value="Student">Student</option>
            <option value="Teacher">Teacher</option>
            <option value="Employee">Employee</option>
            <option value="MIS Staff">MIS Staff</option>
          </datalist>
          <span class="eyes"><i class="fas fa-eye" id="eye" onclick="show_password()"></i></span>
          <input type="password" name="Password" id="password" placeholder="Password"/>
          <span class="eyes"><i class="fas fa-eye" id="eyes" onclick="show_cpassword()"></i></span>
          <input type="password" name="CPassword" id="cpassword" placeholder="Confirm Password"/>
          <button type="Submit" name="submit" class="btn">Register</button>

          <p class="message">Already have an account? <a href="login.php">Log-in here</a></p>
        </form>
      </div>
    </div>
     <script src="Javascript/password-show-hide.js"></script>
</body>
</html>