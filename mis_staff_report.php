<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <link  href="Admin_HP.css?v=<?php echo time(); ?>" rel="stylesheet">
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <!--<script src="https://kit.fontawesome.com/3ed79b4fb5.js" crossorigin="anonymous"></script>-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style type="text/css" media="print">
  @media print{
    .noprint, .noprint  *{
      display: none; !important;
    }
  }

</style>
</head>
<body onload="print()">
   <center>
    <div class="report-container">
   
      <h1>REPORT LIST</h1>
      <br>
    
    <table id="ready" class="table-report" >
      <thead>
          <tr>
             <th>Name</th>
             <th>Request Type</th>
             <th>Category</th>
             <th>Date</th>
             <th>Answered By</th>
          </tr>
      </thead>
      <tbody>

          <?php
              if(isset($_POST["from_date"], $_POST["to_date"]))  
              { 
            
                $conn = mysqli_connect("localhost","root","","db_helpdesk");

                //$sql = "SELECT * FROM  tbl_answer ORDER BY Id DESC";
                $sql = "SELECT * FROM tbl_answer  WHERE Date_Answer BETWEEN '".$_POST["from_date"]."' AND '".$_POST["to_date"]."' ORDER BY answer_id DESC"; 
                  
                $result = $conn-> query($sql);

                if ($result->num_rows >0)  
                {
                  while($row = $result-> fetch_assoc() ){
                      echo "
                          <tr>
                           <td>". $row["Lastname"] ."  ". $row["Firstname"] ." ". $row["Middlename"] ."</td>  
                            <td>" . $row['Request_Type'] . "</td>
                            <td>"  . $row['Category'] . "</td>
                            <td>"  . $row['Date_answer']. "</td>
                            <td>"  . $row['Answered_by']. "</td>
                         </tr>";
                    }
                                                                         
                }
                 else
                {
                  echo "no result";
                } 

                $conn->close(); 
                }          
          ?>
      </tbody>
    </table>



 <button class="noprint"><a href="Mis_Staff_page.php">Back</a></button>
  </div>
</center> 
</body>
</html>