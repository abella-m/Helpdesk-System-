
<?php  
 //filter.php  
 if(isset($_POST["from_date"], $_POST["to_date"], $_POST["filter_report"]))  
 {  
      $connect = mysqli_connect("localhost", "root", "", "db_helpdesk");  
      $output = '';  
      $query = "SELECT * FROM tbl_answer  WHERE  Request_Type = '".$_POST["filter_report"]."' OR Date_answer BETWEEN '".$_POST["from_date"]."' AND '".$_POST["to_date"]."' ORDER BY answer_id DESC";  
      $result = mysqli_query($connect, $query);  
      $output .= '  
      
              <table class="table-reports" > 
                    <tr class="tr-reports">
                      <th>Name</th>
                      <th>Request Type</th>
                      <th>Category</th>
                       <th>Department / Location</th>
                      <th>Date</th>
                      <th>Time</th>
                       <th>Status</th>
                      <th>Answered By</th>
                    </tr>
      ';  
      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '  
                     <tr>  
                          <td>'. $row["Lastname"] .' '. $row["Firstname"] .' '. $row["Middlename"] .'</td>  
                          <td>'. $row["Request_Type"] .'</td>  
                          <td>'. $row["Category"] .'</td>  
                          <td>'  . $row['Department_Office'] . '</td>
                            <td>'  . $row['Date_answer']. '</td>
                            <td>' . $row['Time_answer'] . '</td>
                          <td> '. $row["query_status"] .'</td>    
                          <td>'. $row["Answered_by"] .'</td>  
                     </tr>  
                ';  
           }  
      }   
      else  
      {  
           $output .= '  
                <tr>  
                     <td colspan="8">No Data Found</td>  
                </tr>  
           ';  
      }  
      $output .= '</table></div>';  
      
      echo $output; 


 }


 ?>
      
