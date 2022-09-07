<?php

include('connection.php');
session_start();
if(!isset($_SESSION['user_id']))
{
 header("location:login.php");
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <link  href="User_HP.css?v=<?php echo time(); ?>" rel="stylesheet">
  <script src="https://kit.fontawesome.com/3ed79b4fb5.js" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Help Desk System </title>
</head>
<body>
    <div class="container">
        <div class="top-bar">
          <ul>
            <li class="logo"><img src="logo.png"></li>
            <li><p class="old-english">Saint Louis College</p></li>
            <li><p class="title">HELP DESK SYSTEM - MANAGEMENT INFORMATION SYSTEM</p></li>
          </ul>
        </div>
        <nav class="navbar">
            <ul>
              <div class="items">
                <li><a href="Student_page.php"><!--<i class="fas fa-home fa-color-hm "></i>-->Home</a></li>
                <div class="dropdown-req">

                 <?php
                   $pdo = new PDO("mysql:host=localhost;dbname=db_helpdesk", "root", "");
                       $Lastname = $_SESSION['lastname']; $Firstname = $_SESSION['firstname']; $Middlename = $_SESSION['middlename'];
                   $data = $pdo->query("select * from tbl_answer where Lastname = '$Lastname'AND Firstname = '$Firstname'AND Middlename = '$Middlename' AND query_status='Pending'");
                   $count = $data->rowCount();
                  ?>
                  <button class="btn-req" onclick="show_Request()">Query Management<i class="fa fa-caret-down"></i><span class="badge"><?php if ($count > 0){echo " ".$count." "; }?></span></button>
                  
                  <div id="myDropdown-req" class="dropdown-content-req">
                    <a href="#" class="Request-Query" onclick="show_Request_Query()">Request Query</a>
                    <a href="#" class="Returned-Query" onclick="show_Returned_Query()">Returned Query<span class="badge"><?php if ($count > 0){echo " ".$count." ";}?></span></a>
                    <a href="#" class="Request-History" onclick="show_History_Query()">Request History</a>
                  </div>
                </div>
                <?php
                   $pdo2 = new PDO("mysql:host=localhost;dbname=db_helpdesk", "root", "");

                   $id = $_SESSION['user_id'];

                   $data2 = $pdo2->query("select * from tbl_chat_message where to_user_id = $id and status = '1'");
                   $count2 = $data2->rowCount();
                   ?>
                <li><a href="studentchat.php" id="Message" class="button" class="Message_notification">Message <span class="badge"><?php if ($count2 > 0){echo"".$count2."";}?></span></a></li>
                <li><a href="#" id="FAQ" class="button" onclick="show_Faq()"><!--<i class="fas fa-question fa-color-fq"></i>-->FAQ</a></li>
              </div>
             <li><p class="wc">Welcome <strong><i> <?php  echo $_SESSION['lastname'], '&nbsp;', $_SESSION['firstname']; ?>  </i></strong></p></li><p class="logged-in-as"> &nbsp;logged in as  <strong><i><?php echo $_SESSION['User_Level']; ?></i></strong></p>
              <a href="logout.php" class="logout"><i class="fas fa-sign-out-alt"></i>
              <span class="tooltiptext">Logout</span></a>
          </ul>
          </nav>
           <div class="bg-modal-bg" id="bg">  
          
            <article>
            <h2>Vision-Mission</h2>
            <p>
              We, the Saint Louis College of the City of San Fernando, La Union, a collaborative Missionary community
              commit to the integral human formation of the Youth to become Christ-centered and competent leaders responsive to the needs of Church and society by providing quality and transformative instruction, animating campus ministry, engaging in relevant researches and sustainable extension programs, forging ties with partner agencies, and fostering justice, peace, and integrity of creation.
            </p>
          </article>
          <article class="Cv">
            <h2>Core Values</h2>
            <p>
              Christ-centeredness<br>
              Excellence<br>
              Missionary
            </p>
          </article>
          <div class="Tagline">
              <h3>
               <i>" Beacon of Wisdom<br> in the North "</i>
              </h3>
            </div>
        </div>
       <div class="bg-img"></div>
      <div class="bg-opacity"></div> 
    <div class="bg-modal-request" id="req">
      <div class="modal-content-request">
        <div class="modal-header-request">
          <span class="close-request">&times;</span>
          <div class="p-header-request"><p></i>REQUEST QUERY</p></div>
          <div class="request-container">
            <div class="request-content">
            
           <form class="request-form" action="request.php" method="POST">
             
              <input type="hidden" name="ID_Number"  value="<?php echo $_SESSION['user_id']; ?>" />
             
              <input type="hidden" name="Lastname" value="<?php echo $_SESSION['lastname']; ?>" />
        
              <input type="hidden" name="Firstname" value="<?php echo $_SESSION['firstname']; ?>" />
          
              <input type="hidden" name="Middlename"  value="<?php echo $_SESSION['middlename']; ?>" />
           
              <input type="hidden" name="email" value="<?php echo $_SESSION['Email']; ?>">
       
              <input list="Category" type="hidden"  name="category" value="<?php echo $_SESSION['User_Level']; ?>">
               

              <label>Date</label>
              <input type="text" name="Date" value="<?php date_default_timezone_set('Asia/Manila'); echo date('Y/m/d'); ?>"  ><br>
              <label>Time</label>
              <input type="text" name="Timee" value="<?php date_default_timezone_set('Asia/Manila'); echo date('H:i a'); ?>"  ><br>
              <label>Department/<br>Location</label>
              <input type="text" name="DO" required="" ><br>
              <label>Priority Level</label>
              <div class="rd_button">
              <input type="radio" class="urg"  name="radio" value="Urgent"/><br>
              <label class="lbl_urg">Urgent</label>
              </div>
              <div class="rd_button">
              <input type="radio" class="norm" name="radio" value="Normal"/><br>
              <label class="lbl_norm">Normal</label>
             </div><br>
              <label>Request Type</label>
                <select onchange="yesnoCheck(this);" id="Request Type" class="select" name="Request-type" required placeholder="Request Type" autocomplete="off">
                  <option value=""> </option>
                  <option value="Computer (Hardware)">Computer (Hardware)</option>
                  <option value="Program (Software)">Program (Software)</option>
                  <option value="Internet (Network)">Internet (Network)</option>
                  <option value="Technical Assistance (End User Support)">Technical Assistance (End User Support)</option>
                  <?php
                 $conn = mysqli_connect("localhost","root","","db_helpdesk");

                      $sql = "SELECT * FROM tbl_req_type ORDER BY req_type_id DESC";
                      $result = $conn-> query($sql);

                      if ($result->num_rows >0)  {
                        while($row = $result-> fetch_assoc() ){
                         ?><option value="<?php echo $row['Add_request_type']; ?>"> <?php echo $row['Add_request_type']; ?></option>
                        <?php } ?>
                     <?php }              
                      ?>
                  <option value="Others">Others</option>

                  <script type="text/javascript">
                    function yesnoCheck(that) {
                      if (that.value == "Others") {
                          document.getElementById("ifYes").style.display = "block";
                      } else {
                          document.getElementById("ifYes").style.display = "none";
                      }
                  }
                  </script>
                </select>
              <div id="ifYes" style="display: none;" >
                  <label for="other">Please Specify</label> 
                  <input class="pls_specify" type="text" id="other" name="other" placeholder="Type your specific request type here" /> <br />
              </div>
              <label>Problem/s & <br> Concern/s</label>
              <textarea rows="5" name="details" class="details" placeholder="Type your message here"></textarea>
              
              <div>

              <button class="Request" type="Submit" name="Request">Request Now</button>
              
              </div>                                                  
            </form>
            <br>
           <i class="far fa-sticky-note far-note"></i> <i class="note"><b>NOTE:</b> We only answer queries during 8:00 a.m - 5:00 p.m on Monday to Saturday only, Thank You! </i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="bg-modal-return" id="return">
        <div class="modal-content-return">
          <div class="modal-header-return">
          <span class="close-return">&times;</span>
            <div class="p-header-return"><p></i>RETURNED QUERY</p></div>
              <div class="return-container">
                  <table class="table-return">
                    <tr class="tr-return">
                      <th>Answered By</th>
                      <th>Category</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                    <tr>
                       <?php
                     $conn = mysqli_connect("localhost","root","","db_helpdesk");
                      $Lastname = $_SESSION['lastname']; $Firstname = $_SESSION['firstname']; $Middlename = $_SESSION['middlename'];

                      $sql = "SELECT * FROM tbl_answer WHERE Lastname = '$Lastname' AND Firstname = '$Firstname' AND Middlename = '$Middlename'  ORDER BY query_status DESC, answer_id DESC";
                      $result = $conn-> query($sql);

                      if ($result->num_rows >0)  {
                        while($row = $result-> fetch_assoc() ){
                          echo "<tr><td>" . $row['Answered_by'] . "</td>
                          <td>"  . $row['Category']. "</td>
                          <td>". $row['query_status']. "</td>
                          <td>" ?>
                      <a href="#" onclick="show_Answered_Query('<?php echo $row['Answered_by']?>', '<?php echo $row['Answer']?>', '<?php echo $row['answer_id']?>')"><button class="btn-Open"><i class="far fa-eye fa-color-open"></i></button></a>

                       <a href="#" onclick="show_remarks('<?php echo $row['answer_id']?>')"><button class="btn-comm"><i class="fas fa-comment-alt fa-color-comm"></i></button></a>
                       <?php

                      "</td></tr>";
                        }

                      }   else{
                        echo "No Data Found";
                      }    
                      $conn->close();           
                      ?>

                </table>
             </div>
            </div>
         </div>
      </div>
    </div>
  </div>
     <div class="bg-modal-return-query" id="Return">
      <div class="modal-content-return-query">
        <div class="modal-header-return-query">
          <span class="close-return-query">&times;</span>
            <div class="p-header-return-query"><p>Returned Query</p></div>
              <div class="return-query-container">
                <div class="return-query-content">
                  <div class="return-query" > 
                    <form action="Student_query_status_update.php" method="POST">
                      <input type="hidden" name="query_id" id="query_id">
                      <label class="Ans-by">Noted by</label>
                      <input type="text" name="Answer_by" id="Answered_by"><br>
                      <label class="Ans">Answer</label>
                      <textarea rows="5" name="Answer" class="answer" id="Answer"></textarea>
                      <button class="btn-ok" type="submit" name="status_update">OK</button>
                      
                     </form>                                             
                  </div>
                </div>
             </div>
        </div>
      </div>
    </div>
    <div class="bg-modal-history" id="history">
        <div class="modal-content-history">
          <div class="modal-header-history">
          <span class="close-history">&times;</span>
            <div class="p-header-history"><p></i>REQUEST HISTORY QUERY</p></div>
              <div class="history-container">
                  <table class="table-history" id="">
                    <tr class="tr-history">
                      
                      <th>Details</th>
                      <th>Request Type</th>
                      <th>Date & Time</th>
                      <th>Status</th>
                       <th>Validity</th>

                    </tr>
                    <tr>
                        <?php
                     $conn = mysqli_connect("localhost","root","","db_helpdesk");
                     $id = $_SESSION['user_id'];

                      $sql = "SELECT * FROM tbl_request WHERE ID_Number = '$id' ORDER BY query_status DESC, PriorityLevel DESC, ID DESC";
                      $result = $conn-> query($sql);

                      if ($result->num_rows >0)  {
                        while($row = $result-> fetch_assoc() ){
                          echo "<tr>
                          <td>". $row['Details']."</td>
                          <td>" . $row['Request_Type'] . "</td>
                          <td>"  . $row['Date']. "  " . $row['Time'] . "</td>
                          <td>". $row['query_status']."</td>                         
                          <td>"?><?php
             
                                    if($row['Validity']==1){
                                      echo '<p class="act">Valid</p>';
                                    }else{
                                      echo '<p class="dis">Invalid</p>';
                                    }
                                  
                                  "</td>?>
                          </tr>";
                        }
                                                                         
                      }   else{
                        echo "No Data Found";
                      }    
                      $conn->close();           
                      ?>
                      </tr>
                </table>
             </div>
            </div>
         </div>
      </div>
    </div>
  </div>
    <div class="bg-modal-return-remarks" id="remarks">
      <div class="modal-content-return-remarks">
        <div class="modal-header-return-remarks">
          <span class="close-return-remarks">&times;</span>
            <div class="p-header-return-remarks"><p>Remarks</p></div>
              <div class="return-remarks-container">
                <div class="return-remarks-content">
                  <div class="return-remarks" > 
                    <form action="Student_remarks.php" method="POST">                                                       
                      <div><input type="hidden" name="req_id" id = "reqs_id"></div>                      
                      <label>Remarks</label>
                       <div class="rd_button_rm">
                        <input type="radio" class="urg_rm"  name="radio_remarks" value="Work Completed" / required="">
                        <label class="lbl_urg_rm">Work Completed</label>
                        </div>
                        <div class="rd_button_rm">
                        <input type="radio" class="norm_rm" name="radio_remarks" value="Endorsed for Job Order Request" / required=""><br>
                        <label class="lbl_norm_rm">Endorsed for Job Order Request</label><br>
                       </div><br>
                       
                       <input type="text" name="remarks"><br><br>


                       <label >Date & Time</label>
                       <input type="text" name="date" value="<?php date_default_timezone_set('Asia/Manila'); echo date('Y/m/d   H:i a'); ?>">                  
                       <button class="btn-rm" type="submit" name="Remarks">Send</button>
                     </form>                                             
                  </div>
                </div>
             </div>
        </div>
      </div>
    </div> 
    <div class="bg-modal-faq" id="faq">
      <div class="modal-content-faq">
        <div class="modal-header-faq">
          <span class="close-faq">&times;</span>
          <div class="p-header-faq"><p>FREQUENTLY ASK QUESTIONS</p></div>
         
                     <div class="filter_select">  
                      <select id="filter-faq" class="filter" name="filter-faq"  >
                        <option value="" disabled="" selected="">Select Filter</option>
                        <option value="Hardware">Hardware</option>
                        <option value="Software">Software</option>
                        <option value="Network">Network</option>
                        <option value="Technical Assistance">Technical Assistance </option>
                        <?php
                         $conn = mysqli_connect("localhost","root","","db_helpdesk");

                         $sql = "SELECT * FROM tbl_req_type ORDER BY req_type_id DESC";
                          $result = $conn-> query($sql);

                            if ($result->num_rows >0)  {
                             while($row = $result-> fetch_assoc() ){
                              ?><option value="<?php echo $row['Add_request_type']; ?>"> <?php echo $row['Add_request_type']; ?></option>
                              <?php } ?>
                          <?php }              
                        ?>
                        <option value="Others">Others</option>
                      </select>
                   
                     <!--<button class="Generate-report" id="Greport"><a href="admin_report.php" >Print Report</a></button>-->
                     </div>
              
              <div class="faq-container" id="faq_container">
                <?php
                 $conn = mysqli_connect("localhost","root","","db_helpdesk");

                      $sql = "SELECT * FROM tbl_faq ORDER BY faq_id DESC";
                      $result = $conn-> query($sql);

                      if ($result->num_rows >0)  {
                        while($row = $result-> fetch_assoc() ){
                         ?> <div class="faqs_content">
                             <details class="details">  
                              <summary><?php echo $row['Faq_Question']; ?> ? </summary><br>
                                  <p class="faq_answer"><?php echo $row['Faq_Answer']; ?>
                                  <input type="hidden" value="<?php echo $row['Faq_Category']; ?>"></p>
                              </details>

                              </div>
                        <?php } ?>
                     <?php }              
                      ?>
            </div>
              <script type="text/javascript">
                $(document).ready(function(){
                  $("#filter-faq").on('change', function(){
                      var value = $(this).val();
                      $.ajax({
                        url:"faq_filter.php",
                        type:"POST",
                        data:'request=' + value,
                        beforeSend:function(){
                          $(".faq-container").html("<label>Filtering...</span>");
                        },
                        success:function(data){
                          $(".faq-container").html(data);
                        }
                      });
                  });
                });
              </script>
            </div>
        </div>
      </div>
   </div>
    <script type="text/javascript">; 
   


      function show_Request(){
        document.getElementById("myDropdown-req").classList.toggle("show"); 
        document.querySelector('.bg-modal-return').style.display = 'none';
        document.querySelector('.bg-modal-faq').style.display = 'none';
        document.querySelector('.bg-modal-history').style.display = 'none';
       

       
            window.onclick = function(e) {
        if (!e.target.matches('.btn-req')) {
        var myDropdown_req = document.getElementById("myDropdown-req");
          if (myDropdown_req.classList.contains('show')) {
            myDropdown_req.classList.remove('show');
          }
        }
      } 
    }

   function show_Request_Query(){
      document.querySelector('.bg-modal-request').style.display = 'flex';
      document.querySelector('.bg-modal-faq').style.display = 'none';
      document.querySelector('.bg-modal-return').style.display = 'none';
      document.querySelector('.bg-modal-bg').style.display = 'none';
      document.querySelector('.bg-modal-history').style.display = 'none';
    }
      //close button
        var req = document.getElementById("req");
        var span = document.getElementsByClassName("close-request")[0];
        span.onclick = function() {
        req.style.display = "none";
        }
    function show_Returned_Query(){
      document.querySelector('.bg-modal-return').style.display = 'flex';
      document.querySelector('.bg-modal-faq').style.display = 'none';
      document.querySelector('.bg-modal-request').style.display = 'none';
      document.querySelector('.bg-modal-bg').style.display = 'none';
      document.querySelector('.bg-modal-history').style.display = 'none';
    }
    //close button
      var ret = document.getElementById("return");
      var span = document.getElementsByClassName("close-return")[0];
      span.onclick = function() {
      ret.style.display = "none";
      }
      function show_History_Query(){
      document.querySelector('.bg-modal-history').style.display = 'flex';
      document.querySelector('.bg-modal-faq').style.display = 'none';
      document.querySelector('.bg-modal-request').style.display = 'none';
      document.querySelector('.bg-modal-bg').style.display = 'none';
     
    }
    //close button
      var his = document.getElementById("history");
      var span = document.getElementsByClassName("close-history")[0];
      span.onclick = function() {
      his.style.display = "none";
      }   

   function show_Answered_Query(Answered_by,Answer,Id){                                             // TAS ETONG FUNCTION NA ITO

      Returned = document.getElementById('Return');

      Answered_by = document.getElementById('Answered_by').value = Answered_by;
      Answer = document.getElementById('Answer').value = Answer;
      query_id = document.getElementById('query_id').value = Id;
      
      document.querySelector('.bg-modal-return-query').style.display = 'flex';
      document.querySelector('.bg-modal-faq').style.display = 'none';
       document.querySelector('.bg-modal-bg').style.display = 'none';
       document.querySelector('.bg-modal-history').style.display = 'none';
      }
      //close button
      var returns = document.getElementById("Return");
      var span = document.getElementsByClassName("close-return-query")[0];
      span.onclick = function() {
      returns.style.display = "none";
      }
       document.querySelector('.btn-ok').addEventListener('click', function(){
      document.querySelector('.bg-modal-return-query').style.display = 'none';
      });
    
       function show_remarks(answer_id){  

      req_id = document.getElementById('reqs_id').value = answer_id;                                         

      document.querySelector('.bg-modal-return-remarks').style.display = 'flex';
      document.querySelector('.bg-modal-faq').style.display = 'none';
       document.querySelector('.bg-modal-bg').style.display = 'none';
       document.querySelector('.bg-modal-history').style.display = 'none';
      }
      //close button
      var remark = document.getElementById("remarks");
      var span = document.getElementsByClassName("close-return-remarks")[0];
      span.onclick = function() {
      remark.style.display = "none";
      }
       
    function show_Faq(){
      document.querySelector('.bg-modal-faq').style.display = 'flex'; 
      document.querySelector('.bg-modal-bg').style.display = 'none';
      document.querySelector('.bg-modal-request').style.display = 'none';
      document.querySelector('.bg-modal-return').style.display = 'none'; 
      document.querySelector('.bg-modal-history').style.display = 'none';   
     }
      //close button
      var faq = document.getElementById("faq");
      var span = document.getElementsByClassName("close-faq")[0];
      span.onclick = function() {
      faq.style.display = "none";
      }
    

    const faqs = document.querySelectorAll(".faq_content");

      faqs.forEach(faq_content => {
        faq_content.addEventListener("click", () => {
            faq_content.classList.toggle("active");
        });

      });


    </script>
</body>
<footer>
  <p>Copyright 2021<br>All Rights Reserved</p>
</footer>
</html>
