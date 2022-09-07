<?php


session_start();

if(!isset($_SESSION['user_id']))
{
 header("location:login.php");
}

include('connection.php');
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <link  href="Mis_Staff_HP.css?v=<?php echo time(); ?>" rel="stylesheet">
 <script src="https://kit.fontawesome.com/3ed79b4fb5.js" crossorigin="anonymous"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>  
   <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"> 

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
                <li class="hover"><a href="Mis_Staff_page.php"><!--<i class="fas fa-home fa-color-hm "></i>-->Home</a></li>
               <?php
                 $pdo = new PDO("mysql:host=localhost;dbname=db_helpdesk", "root", "");

                 $data = $pdo->query("select * from tbl_request where query_status='Pending'");
                 $count = $data->rowCount();
                ?>
                 <li><a href="#" id="Queries" class="button" onclick="show_Queries()">Queries <span class="badge"><?php if ($count > 0){echo "".$count." "; }?></span></a></li>
                <?php
                   $pdo2 = new PDO("mysql:host=localhost;dbname=db_helpdesk", "root", "");

                   $id = $_SESSION['user_id'];

                   $data2 = $pdo2->query("select * from tbl_chat_message where to_user_id = $id and status = '1'");
                   $count2 = $data2->rowCount();
                   ?>
                <li><a href="MISchat.php" id="Message" class="button" class="Message_notification">Message <span class="badge"><?php if ($count2 > 0){echo"".$count2."";}?></span></a></li>
            
                 <li><a href="#" id="Reports" class="button" onclick="show_Reports()"><!--<i class="fas fa-plus"></i>-->Reports</a></li>
              </div>
            <!--
              <li class="search-bar">
                <input type="search"  name="Search" placeholder="SEARCH">
                <label >
                  <button class="icon"><i class="fas fa-search"></i><span class="tooltiptext-search">Search</span></button>
                </label>
              </li> -->
              <li><p class="wc">Welcome <strong><i><?php  echo $_SESSION['lastname'], '&nbsp;', $_SESSION['firstname']; ?> </i></strong></p></li><p class="logged-in-as"> &nbsp;logged in as  <strong><i><?php echo $_SESSION['User_Level']; ?></i></strong></p>
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
          <!--<div class="bg-img-container">
            <div class="image-container">
              <h3>MIS Gallery</h3>
              <img src="Images/bg-slc.jpg" id="content1" class="active">
              <img src="Images/image1.jpg" id="content2">
              <img src="Images/image2.jpg" id="content3">
            </div>
            <div class="dot-container">
                <button></button>
                <button></button>
                <button></button>
            </div>
            <div id="prev" onclick="prev()"><i class="fas fa-chevron-left"></i></div>
            <div id="next" onclick="next()"><i class="fas fa-chevron-right"></i></div>
          </div>-->
        </div> 
       <div class="bg-img"></div>
      <div class="bg-opacity"></div> 
    <div class="bg-modal-queries" id="que">
      <div class="modal-content-queries">
        <span class="close-queries">&times;</span>
        <div class="modal-header-queries">
              <form class="search-bar" action="" method="GET">
                  <input type="search"  name="Search" id="search" placeholder="SEARCH">
                  <!--<button class="icon" name="btn-search" ><i class="fas fa-search"></i><span class="tooltiptext-search">Search</span></button> -->
              </form>           
              <div class="p-header-queries"><p>MANAGE QUERIES</p> </div>
              <div class="queries-container">
                  <table class="table-queries" id="tblque">
                    <tr class="tr-Queries">
                      <th>Name</th>
                       <th>Email</th>
                      <th>Category</th>
                       <th>Department / Location</th>
                       <th>Date & Time</th>
                      <th>Request Type</th>
                      <th>Priority Level</th>
                      <th>Status</th>
                       <th>Validity</th>
                      <th>Action</th>
                    </tr>
                    <tr>
                        <?php
                     $conn = mysqli_connect("localhost","root","","db_helpdesk");

                      $sql = "SELECT * FROM tbl_request ORDER BY  Validity DESC, query_status DESC, PriorityLevel DESC, ID DESC";
                      $result = $conn-> query($sql);

                      if ($result->num_rows >0)  {
                        while($row = $result-> fetch_assoc() ){
                          echo "<tr><td>" . $row['Lastname'] . " " . $row['Firstname'] . " " . $row['Middlename'] . "</td>
                          <td>" . $row['Email'] . "</td>
                          <td>"  . $row['Category'] . "</td>
                          <td>"  . $row['Department_Office'] . "</td>
                          <td>"  . $row['Date']. "  " . $row['Time'] . "</td>
                          <td>" . $row['Request_Type'] . "</td>
                           <td>" . $row['PriorityLevel'] . "</td>
                          <td>". $row['query_status']."</td>
                          <td>"?><?php
             
                                    if($row['Validity']==1){
                                      echo '<p class="act-query"><a href="misvalidity.php?Id='.$row['Id'].'&Validity=0"><button>Valid</button></a></p>';
                                    }else{
                                      echo '<p class="dis-query"><a href="misvalidity.php?Id='.$row['Id'].'&Validity=1"><button >Invalid</button></a></p>';
                                    }
                                  
                                  ?> </td>

                          <td>
                          <a href="#"onclick="show_Open('<?php echo $row['Id']?>','<?php echo $row['ID_Number']?>','<?php echo $row['Lastname']?>','<?php echo $row['Firstname']?>', '<?php echo $row['Middlename']?>', '<?php echo $row['Category']?>', '<?php echo $row['Request_Type']?>','<?php echo $row['Date']?>', '<?php echo $row['Time']?>', '<?php echo $row['Details']?>', '<?php echo $row['PriorityLevel']?>','<?php echo $row['Department_Office']?>' )"><button class="btn-Open-mis"><i class="far fa-eye fa-color-open"></i></button></a>

                          <button class="btn-rmarks"  id="rmarks" onclick="show_remarks('<?php echo $row['radio_remark']?>','<?php echo $row['date_time']?>','<?php echo $row['remark']?>')"><a href="#"><i class="fas fa-comment-alt fa-color-comm"></i></a></button><?php 
                           "</td></tr>";
                        }
                                                                           // ETONG BUONG PHP BLOCK

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
    <div class="bg-modal-open" id="open">
      <div class="modal-content-open">
        <span class="close-open">&times;</span>
        <div class="modal-header-open">
          <div class="p-header-open"><p>OPENED QUERY</p></div>
            <div class="open-container">
           <form class="open-form" action="admin_answered_query.php" method="POST">
              <input type="hidden" name="Answered_by" value="<?php echo $_SESSION['firstname'], '&nbsp;', $_SESSION['lastname'] ; ?>">
              <div class="first_div">             
              <label class="rn">Request No.</label>
              <input type="text" name="request_id" id = "request_id">
              <label class="idn">ID Number</label>
              <input type="text" name="idnum" id="IDnum" >
              <label class="do">Department /<br>Location</label>
              <input type="text" name="DO" id="DO" >
              </div>
              <div class="second_div">
              <label class="ln">Lastname</label>
              <input type="text" name="Lastname" id="lname_answer" >
              <label class="fn">Firstname</label>
              <input type="text" name="Firstname" id="fname_answer" >
              <label class="mn">Middlename</label>
              <input type="text" name="Middlename" id="mname_answer"> 
              </div>
              <div class="third_div">
              <label class="cg">Category</label>
              <input type="text"  name="Category" id="Category_hsa" >
              <label class="rt">Request Type</label>
              <input list="Request Type" type="text"  name="Request_Type" id="Request_Type">
                <datalist >
                 <option value=""> </option>
                  <option value="Computer (Hardware)">Computer (Hardware)</option>
                  <option value="Program (Software)">Program (Software)</option>
                  <option value="Internet (Network)">Internet (Network)</option>
                  <option value="Technical Assistance (End User Support)">Technical Assistance (End User Support)</option>
                  <option value="Others">Others</option>
                </datalist>
              <label class="dt">Date & Time</label>
              <input type="text" name="OQ_date" id="OQ_date">
               <input type="hidden" name="OQ_time" id="OQ_time">
              </div>
              <div class="fourth_div">
              <label class="pl">Priority Level</label>
              <input class="pl_input" type="text" name="Priority_level" id="PL"></div>
              <label class="ds">Details</label>
              <textarea rows="5" name="Details" class="details" id="Details" ></textarea>

              <br><br>
              <div class="Solution"> 
              <hr class="hr"><br>
              <label class="tcd">Target Completion Date</label><br>
              <input class="tcd_input" type="text" name="Target_completion_Date" id="Target_completion_Date" required=""><br>
              <label class="Ans">Answer Here</label>
              <textarea rows="5" name="Answer" class="answer" id="Answer" placeholder="Type your answer here"></textarea>
              </div>
              <div><button class="Submit-queries" type="Submit" name="Submit">Submit</button></div>
             </form>
          </div>
        </div>
      </div>
    </div>   
   <div class="bg-modal-remarks" id="remarks">
      <div class="modal-content-remarks">
        <span class="close-remarks">&times;</span>
        <div class="modal-header-remarks">
          <div class="p-header-remarks"><p>OPENED REMARKS</p></div>
            <div class="remarks-container">
            <div class="remarks-content">                 
                    <form action="" method="" class="remarks_form">
                      <label>Remarks</label>
                       <input type="text" id = "rremarks" name="radio_remarks"><br>
                       <input type="text" name="remark" id = "Remark"> <br>               
                       <label>Date & Time</label>
                       <input type="text" name="date_time" id="Date_Time">
                     </form>                                             
                </div>
            </div>
          </div>
        </div>
      </div>
 <div class="bg-modal-reports" id="rep">
      <div class="modal-content-reports">
        <span class="close-reports">&times;</span>
        <div class="modal-header-reports">
          <div class="p-header-reports"><p><i id="close-reports" class=""></i>REPORTS</p></div>
            
                  <form method="POST" action="Mis_report.php">
                     <input type="text" name="from_date" id="from_date" class="filter" placeholder="From Date" autocomplete="off"autocomplete="off"/>  
                     <input type="text" name="to_date" id="to_date" class="filter-to" placeholder="To Date" autocomplete="off" /> 
                     <select id="filter_report" class="select_filter" name="filter_report"  >
                        <option value="" disabled="" selected="">Select Filter</option>
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
                      </select>
                     <input type="button" name="filter" id="filter" value="Generate" class="btn-filter btn-info" /> 
                     <input type="submit" class="Generate-report" style="cursor:pointer;" value="Print Report">


                  </form>
                
           </div>
            <div class="reports-container"> 
              <table class="table-reports" id="tbl_rep"> 
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
                    <tr>
                        <?php
                     $conn = mysqli_connect("localhost","root","","db_helpdesk");

                      $sql = "SELECT * FROM  tbl_answer ORDER BY answer_id DESC";
                      $result = $conn-> query($sql);

                      if ($result->num_rows >0)  {
                        while($row = $result-> fetch_assoc() ){
                          echo "
                          <tr>
                            <td>" . $row['Lastname'] . " " . $row['Firstname'] . " " . $row['Middlename'] . "</td>
                            <td>" . $row['Request_Type'] . "</td>
                            <td>"  . $row['Category'] . "</td>
                            <td>"  . $row['Department_Office'] . "</td>
                            <td>"  . $row['Date_answer']. "</td>
                            <td>" . $row['Time_answer'] . "</td>
                             <td>"  . $row['query_status']. "</td>
                            <td>"  . $row['Answered_by']. "</td>
                         </tr>";
                        }
                                                                         
                      }   else{
                        echo "No Data Found";
                      }    
                      $conn->close();           
                      ?>
                      </tr>
                </table>
             
             
             
            
                
                <script type="text/javascript">
                     $(document).ready(function(){  
                     $.datepicker.setDefaults({  
                          dateFormat: 'yy-mm-dd'   
                     });  
                     $(function(){  
                          $("#from_date").datepicker();  
                          $("#to_date").datepicker();  
                     });  
                     $('#filter').click(function(){  
                          var from_date = $('#from_date').val();  
                          var to_date = $('#to_date').val(); 
                          var filter_report = $('#filter_report option:selected').val(); 
                          
                               $.ajax({  
                                    url:"filter.php",  
                                    method:"POST",  
                                    data:{from_date:from_date, to_date:to_date, filter_report},  
                                    success:function(data)  
                                    {  
                                         $('#tbl_rep').html(data);
                                    }
                               });  
                         
                     });  
                });   
               
                     
               </script>


              </div>
            </div>
        </div>
      </div>
  </div>
  
    <script type="text/javascript">
  
    
    var cont1 = document.getElementById('que'); 
    var cont2 = document.getElementById('msg');
    var cont3 = document.getElementById('faq');
    var cont4 = document.getElementById('rep');
    var cont5 = document.getElementById('pro');
    var cont6 = document.getElementById('open');
    var cont7 = document.getElementById('cont');

  /*This line of code is to live search*/
  $(function() {
      $(document).on('input', '#search', function() {
        var search = $(this).val();
        $.ajax({
        url: 'searchqueries.php',
        type: 'POST',
        async: false,
        data:{
          shows: 1, 'search':search
        },
        success: function(response){
          $('#tblque').html(response);
        }
      });
      })
    });
    function show_Queries(){
      document.querySelector('.bg-modal-queries').style.display = 'flex';
       document.querySelector('.bg-modal-bg').style.display = 'none';
      document.querySelector('.bg-modal-reports').style.display = 'none';
      document.querySelector('.bg-modal-msg').style.display = 'none';
      document.querySelector('.bg-modal-faq').style.display = 'none';
      document.querySelector('.bg-modal-profile').style.display = 'none';
      document.querySelector('.bg-modal-open').style.display = 'none';
      document.querySelector('.content').style.display = 'none';
      }
       //close button
        var que = document.getElementById("que");
        var span = document.getElementsByClassName("close-queries")[0];
        span.onclick = function() {
        que.style.display = "none";
      } 
    
       function show_Open(Id,ID_Number,Lastname,Firstname,Middlename,Category,Request_Type,Date,Time,Details,PriorityLevel,Department_Office){

      answer = document.getElementById('open');

       request_id = document.getElementById('request_id').value = Id;
      idnum = document.getElementById('IDnum').value = ID_Number;
      lname_answer = document.getElementById('lname_answer').value = Lastname;
      fname_answer = document.getElementById('fname_answer').value = Firstname;
      mname_answer = document.getElementById('mname_answer').value = Middlename;
      Category_hsa = document.getElementById('Category_hsa').value = Category;
      Request_Type = document.getElementById('Request_Type').value = Request_Type;            // ETONG BUONG FUNCTION
        OQ_date   = document.getElementById('OQ_date').value = Date + " "+ Time;
        OQ_time = document.getElementById('OQ_time').value = Time;
      Details = document.getElementById('Details').value = Details;
        Priority_level= document.getElementById('PL').value = PriorityLevel; 
        DO= document.getElementById('DO').value = Department_Office;

      document.querySelector('.bg-modal-open').style.display = 'flex';
       document.querySelector('.bg-modal-bg').style.display = 'none';
      document.querySelector('.bg-modal-reports').style.display = 'none';
      document.querySelector('.bg-modal-msg').style.display = 'none';
      document.querySelector('.bg-modal-faq').style.display = 'none';
      document.querySelector('.bg-modal-profile').style.display = 'none';
      document.querySelector('.content').style.display = 'none';

       }
       //close button
      var open = document.getElementById("open");
        var span = document.getElementsByClassName("close-open")[0];
        span.onclick = function() {
       open.style.display = "none";
        } 
   
     function show_remarks(radio_remark,date_time,remark){
       
        
      radio_remarks = document.getElementById('rremarks').value = radio_remark;
     Date_Time = document.getElementById('Date_Time').value = date_time;
     remark = document.getElementById('Remark').value = remark;

        document.querySelector('.bg-modal-remarks').style.display = 'flex';
        document.querySelector('.bg-modal-add-faq').style.display = 'none';
        document.querySelector('.bg-modal-bg').style.display = 'none';
        document.querySelector('.bg-modal-restore').style.display = 'none';
        document.querySelector('.bg-modal-add-req').style.display = 'none';
        document.querySelector('.bg-modal-help').style.display = 'none';
        document.querySelector('.bg-modal-reports').style.display = 'none';
        document.querySelector('.bg-modal-msg').style.display = 'none';
        document.querySelector('.bg-modal-faq').style.display = 'none';
        document.querySelector('.content').style.display = 'none';
        document.querySelector('.bg-modal-queries').style.display = 'none';
      }

       //close button
      var rmarks = document.getElementById("remarks");
        var span = document.getElementsByClassName("close-remarks")[0];
        span.onclick = function() {
       rmarks.style.display = "none";
        } 
     function show_Reports(){
      document.querySelector('.bg-modal-reports').style.display = 'flex';
       document.querySelector('.bg-modal-bg').style.display = 'none';
      document.querySelector('.bg-modal-queries').style.display = 'none';
      document.querySelector('.bg-modal-msg').style.display = 'none';
      document.querySelector('.bg-modal-faq').style.display = 'none';
      document.querySelector('.bg-modal-profile').style.display = 'none';
      document.querySelector('.bg-modal-open').style.display = 'none';
      document.querySelector('.content').style.display = 'none';
       }
        var rep = document.getElementById("rep");
        var span = document.getElementsByClassName("close-reports")[0];
        span.onclick = function() {
        rep.style.display = "none";
      } 
    </script>
</body>
<footer>
  <p>Copyright 2021<br>All Rights Reserved</p>
</footer>
</html>
