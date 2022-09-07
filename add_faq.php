<?php
$server = "localhost";
$username = "root";
$password = "";
$dbname = "db_helpdesk";

$conn = mysqli_connect($server , $username , $password , $dbname);
if(isset($_POST['submitfaq'])){

  if(!empty($_POST['faq_question']) && !empty($_POST['faq_answer'])){
    $slash2 = $_POST['faq_question'];
    $FAQ_question = str_replace("'", "\'", $slash2);
    $slash = $_POST['faq_answer'];
    $FAQ_answer = str_replace("'", "\'", $slash);
    $FAQ_category = $_POST['faq_category'];
    

   

          $query = "insert into tbl_faq (Faq_Question, Faq_Answer, Faq_Category) values ('$FAQ_question','$FAQ_answer','$FAQ_category')";
           $run = mysqli_query($conn,$query) or die (mysqli_error($conn,$query));

            if($run){
               echo "<script>alert('New FAQ Has Been Add Succesfully.'); window.location = 'admin_page.php';</script>";
               
                    }

             else{
               echo "<script>alert('Adding New FAQ Has Been Failed.'); window.location = 'admin_page.php';</script>";
                     }
  
  }
}
?>