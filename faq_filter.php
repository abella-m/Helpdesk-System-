
<?php 
sleep(1);
if(isset($_POST['request'])){

	 ?>
                       <?php
                    $conn = mysqli_connect("localhost","root","","db_helpdesk");
                      $request = $_POST['request'];
                      $sql = "SELECT * FROM tbl_faq WHERE Faq_Category ='$request' ORDER BY faq_id DESC";
                      $result = $conn-> query($sql);

                     if ($result->num_rows >0)  {
                        while($row = $result-> fetch_assoc() ){
                        ?> 
                         <div class="faqs_content">
                             <details class="details">  
                              <summary><?php echo $row['Faq_Question']; ?> ? </summary><br>
                                  <p class="faq_answer"><?php echo $row['Faq_Answer']; ?>
                                  <input type="hidden" value="<?php echo $row['Faq_Category']; ?>"></p>
                              </details>

                              </div>
                     
                       <?php

                      "</td></tr>";
                        } 

                      } else{
                          echo"No Records Found";
                        }  
                      $conn->close();           
                      ?>

                
<?php }
	
?>

