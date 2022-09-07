<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <link  href="Admin_HP.css?v=<?php echo time(); ?>" rel="stylesheet">
  <script src="https://kit.fontawesome.com/3ed79b4fb5.js" crossorigin="anonymous"></script>
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
    <div class="report-container"><br>
        <h3 class="admin_report_header">
          Saint Louis College
          <br>Carlatan, City of San Fernando, La Union
        </h3><br><br>
      <h1>LIST OF ANSWERED QUERIES</h1>&nbsp;  
       <h2>  <?php //echo " ".$_POST["from_date"]." ".$_POST["to_date"]." "?></h2>
      <br>
    
    <table id="ready" class="table-report" >
      <thead>
          <tr>
                      <th>Name</th>
                      <th>Request Type</th>
                      <th>Category</th>
                      <th>Department / Location</th>
                      <th>Date</th>
                      <th>Time</th>
                      <th>Status</th>
                      <th>Answered By</th>
          </tr>
      </thead>
      <tbody>

          <?php
              if(isset($_POST["from_date"], $_POST["to_date"]))
              { 
            
                $conn = mysqli_connect("localhost","root","","db_helpdesk");

              
                $sql = "SELECT * FROM tbl_answer  WHERE  Date_Answer BETWEEN '".$_POST["from_date"]."' AND '".$_POST["to_date"]."' ORDER BY answer_id DESC"; 
                  
                $result = $conn-> query($sql);

                if ($result->num_rows >0)  
                {
                  while($row = $result-> fetch_assoc() ){
                      echo "
                          <tr>
                           <td>". $row["Lastname"] ."  ". $row["Firstname"] ." ". $row["Middlename"] ."</td>  
                            <td>" . $row['Request_Type'] . "</td>
                            <td>"  . $row['Category'] . "</td>
                            <td>"  . $row['Department_Office'] . "</td>
                            <td>"  . $row['Date_answer']. "</td>
                            <td>" . $row['Time_answer'] . "</td>
                             <td>"  . $row['query_status']. "</td>
                            <td>"  . $row['Answered_by']. "</td>
                         </tr>";
                    }
                                                                         
                }
                 

                $conn->close(); 
                } 
                        
          ?>
          <?php
              if(isset($_POST["filter_report"]))
              { 
            
                $conn = mysqli_connect("localhost","root","","db_helpdesk");

              
                $sql = "SELECT * FROM tbl_answer  WHERE  Request_Type = '".$_POST["filter_report"]."' ORDER BY answer_id DESC"; 
                  
                $result = $conn-> query($sql);

                if ($result->num_rows >0)  
                {
                  while($row = $result-> fetch_assoc() ){
                      echo "
                          <tr>
                           <td>". $row["Lastname"] ."  ". $row["Firstname"] ." ". $row["Middlename"] ."</td>  
                            <td>" . $row['Request_Type'] . "</td>
                            <td>"  . $row['Category'] . "</td>
                            <td>"  . $row['Department_Office'] . "</td>
                            <td>"  . $row['Date_answer']. "</td>
                            <td>" . $row['Time_answer'] . "</td>
                             <td>"  . $row['query_status']. "</td>
                            <td>"  . $row['Answered_by']. "</td>
                         </tr>";
                    }
                                                                         
                }
                 

                $conn->close(); 
                } 
                        
          ?>
      </tbody><a href="admin_page.php" class="back"><button class="noprint"><i class="fas fa-arrow-left fa-arrow"></i></button></a>
    </table>



 
  </div>
 
</body>
</html>