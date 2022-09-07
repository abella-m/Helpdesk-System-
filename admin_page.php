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
  <link  href="Admin_HP.css?v=<?php echo time(); ?>" rel="stylesheet">
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
            <li><p class="old-english">Saint Louis College</p>
            <p class="title">HELP DESK SYSTEM - MANAGEMENT INFORMATION SYSTEM</p>
          </li>
          </ul>
        </div>
          
        <nav class="navbar">
            <ul>
              <div class="items">
                <li><a href="admin_page.php"><!--<i class="fas fa-home fa-color-hm "></i>-->Home</a></li>
                  <div class="dropdown">
                  <button class="btn-acc" onclick="show_Account()">User Management<i class="fa fa-caret-down"></i></button>
                  <div id="myDropdown_acc" class="dropdown-content">
                    <a href="#" class="Add_User" onclick="show_Add_User()">Add Users</a>
                    <a href="#" class="View_list" onclick="show_List_User()">View List</a>
                  </div>
                </div>
                <?php
                   $pdo = new PDO("mysql:host=localhost;dbname=db_helpdesk", "root", "");

                   $data = $pdo->query("select * from tbl_request where query_status='Pending'");
                   $count = $data->rowCount();
                ?>
                 <li><a href="#" id="Queries" class="button" onclick="show_Queries()" class="Query_notification">Queries <span class="badge"><?php if ($count > 0){echo"".$count."";}?></span></a></li>
                <?php
                   $pdo2 = new PDO("mysql:host=localhost;dbname=db_helpdesk", "root", "");

                   $id = $_SESSION['user_id'];

                   $data2 = $pdo2->query("select * from tbl_chat_message where to_user_id = $id and status = '1'");
                   $count2 = $data2->rowCount();
                   ?>
                <li><a href="chat.php" id="Message" class="button" class="Message_notification">Message <span class="badge"><?php if ($count2 > 0){echo"".$count2."";}?></span></a></li>
                
                <li><a href="#" id="Reports" class="button" onclick="show_Reports()"><!--<i class="fas fa-question fa-color-fq"></i>-->Reports</a></li>
                
                  <div class="dropdown-utilities">
                  <button class="btn-utilities" onclick="show_Utilities()">Utilities<i class="fa fa-caret-down"></i></button>
                  <div id="myDropdown-utilities" class="dropdown-content-utilities">
                    <a href="#" class="add_faq" onclick="show_add_Faq()">ADD FAQ</a>
                     <a href="#" class="add_req" onclick="show_add_req()">ADD<br>REQUEST<br>TYPE</a>
                     <a href="#" class="Update-Utilities" onclick="show_up_utl()">UPDATE<br>UTILITIES</a>
                    <a href="backup_file.php" class="backup" onclick="()">BACKUP</a>
                    <a href="restoresample.php" class="restore" >RESTORE</a>
                    <a href="#" class="help" onclick="show_help()">HELP</a>
                  </div>
                </div>
              </li>
            </div>
              <li><p class="wc">Welcome <strong><i> <?php  echo $_SESSION['lastname'], '&nbsp;', $_SESSION['firstname']; ?>   </i></strong></p></li><p class="logged-in-as"> &nbsp;logged in as  <strong><i><?php echo $_SESSION['User_Level']; ?></i></strong></p>
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
    <div class="bg-modal-user" id="user">
      <div class="modal-content-user">
        <span class="close">&times;</span>
        <div class="modal-header-user">
          <div class="p-header-user"><p>ADD USERS</p></div>
            <div class="user-container">
              <div class="user-content">
                <form action="add_user.php" method="POST" class="user-form">
                   
                    <label>ID Number</label>
                    <input type="text" name="ID_Number" placeholder="ID Number" required="" maxlength="8" minlength="8"  /><br>
                    <label>Lastname</label>
                    <input type="text" name="Lastname" placeholder="Lastname" required="" /><br>
                    <label>Firstname</label>
                    <input type="text" name="Firstname" placeholder="Firstname" required="" /><br>
                    <label>Middlename</label>
                    <input type="text" name="Middlename" placeholder="Middlename" required="" /><br>
                    <label>Email</label>
                    <input type="Email" name="Add_Email" placeholder="Email" required="" /><br>
                    <label>Category</label>
                    <input list="Category" name="add_UserLevel" type="text" placeholder="Category" autocomplete="off" required="" />
                    <datalist id="Category">
                      <option value=""> </option>
                      <option value="Student">Student</option>
                      <option value="Employee">Employee</option>
                      <option value="Teacher">Teacher</option>
                      <option value="Admin">Admin</option>
                      <option value="MIS Staff">MIS Staff</option>
                    </datalist><br>
                    <label>Password</label>
                    <input type="password" name="add_Password" id="password" placeholder="Password" required="" /><br>
                     <span class="eye"><i class="fas fa-eye" id="eye" onclick="show_password()"></i></span>
                    <label>Confirm Password</label>
                    <input type="password" name="add_CPassword" id="cpassword" placeholder="Confirm Password" required="" /><br>
                    <span class="eye"><i class="fas fa-eye" id="eyes" onclick="show_cpassword()"></i></span>

                    <div class="buttons">
                      <button class="add-user" name="submituser" type="Submit">Add</button>
                      <button class="clear-user" type="Reset">Clear</button>

                    </div>
              </form>
              <button class="add_multiple" name="submit_multiple" type="Submit" onclick="show_Upload()">Add Multiple</button>
                <!--<form method="post" action="file-upload.php" enctype="multipart/form-data">
                  <div class="">
                    <label class="">Select File</label>
                    <div class="">
                  <input type="file" name="uploadfile" class="form-control"/>
                    </div>
                  </div>

                  <div class="">
                    <label class=""></label>
                    <div class="">
                    <input type="submit" name="submit" class="btn btn-primary">
                  </div>
                </div>
              </form>-->
              </div>
             </div>
        </div>
      </div>
    </div>
    <div class="bg-modal-upload" id="upload">
      <div class="modal-content-upload">
        <span class="close-upload">&times;</span>
        <div class="modal-header-upload">
          <div class="p-header-upload"><p>UPLOAD EXCEL FILE </p></div>
           <div class="upload-container">
            <div class="upload-content">
              <form class="upload-form"  method="post" action="file-upload.php" enctype="multipart/form-data">
               <div class="">
                  <label class="">Select Excel File</label>
                  <div class="">
                  <input type="file" class="choose" name="uploadfile" class="form-control" required="" />
                  </div>
                </div>
                <div class="">
                  <label class=""></label>
                <div class="">
                  <input type="submit" name="upload" class="btn-upload" value="Upload">
                </div>
                </div>
             </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="bg-modal-user-list" id="user-list">
      <div class="modal-content-user-list">
        <span class="close-user-list">&times;</span>
        <div class="modal-header-user-list">
          <form class="search-bar" action="" method="GET">

                <input type="search"  name="Search" id="search" placeholder="SEARCH" >
                <!--<button class="icon"><i class="fas fa-search"></i><span class="tooltiptext-search">Search</span></button>-->
          </form>
          <div class="p-header-user-list"><p>LIST OF USERS</p></div>
            <div class="user-list-container">
                  <table class="table-user-list" id="admin_tbl">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                       <?php
                     $conn = mysqli_connect("localhost","root","","db_helpdesk");

                      $sql = "SELECT * FROM tbl_login ORDER BY user_id DESC";
                      $result = $conn-> query($sql);

                      if ($result->num_rows >0)  {
                        while($row = $result-> fetch_assoc() ){
                          echo "<tr>
                             
                              <td>" . $row['Lastname'] . " " . $row['Firstname'] . " " . $row['Middlename'] . "</td>
                              <td>"  . $row['Email'] . "</td>
                              <td>" . $row['Password'] . "</td>
                              <td>"  . $row['User_Level'] . "</td>
                              <td>"?> <?php 
                                    if($row['Status']==1){
                                      echo '<p class="act"><a href="Status.php?user_id='.$row['user_id'].'&Status=0"><button>Active</button></a></p>';
                                    }else{
                                      echo '<p class="dis"><a href="Status.php?user_id='.$row['user_id'].'&Status=1"><button >DeActivated</button></a></p>';
                                    }
                                  ?> </td>

                              <td>
                                 <a href="#" onclick="show_Edit('<?php echo $row['user_id']?>', '<?php echo $row['Lastname']?>','<?php echo $row['Firstname']?>','<?php echo $row['Middlename']?>', '<?php echo $row['Email']?>', '<?php echo  $row['User_Level']?>', '<?php echo $row['unhashedpassword']?>' )">
                                  <button class="btn-Edit"><i class="fas fa-edit fa-color-edit"></i></button></a><?php  
                                "</td></tr>";
                        }
                      }   else{
                        echo "No Data Found";
                      }    
                      $conn->close();           
                      ?>
                       </tr>
                    </tbody>
                </table>
                
            </div>
        </div>
      </div>
    </div>
    <div class="bg-modal-list" id="update">
      <div class="modal-content-list">
        <span class="close-list">&times;</span>
        <div class="modal-header-list">
          <div class="p-header-list"><p>UPDATE USER</p></div>
            <div class="list-container">
              <div class="list-content">
                <form action="Update_User.php" method="POST" class="list-form">
                   <input type="hidden" name="id" id="Update_id"> 
                  
                  <label>Lastname</label>
                  <input type="text" name="Lastname" id="Update_lname" placeholder="Lastname" required="" /><br>
                  <label>Firstname</label>
                  <input type="text" name="Firstname" id="Update_fname"id="Update_username" placeholder="Firstname" required="" /><br>
                  <label>Middlename</label>
                  <input type="text" name="Middlename" id="Update_mname" placeholder="Middlename" required="" /><br>
                  <label>Email</label>
                  <input type="text"  name="Email" id="Update_email" placeholder="Email"/><br>
                  <label>Category</label>
                  <input list="Category" type="text" id="Update_category" name="User_Level" placeholder="Category" autocomplete="off" />
                  <datalist>
                    <option value=""> </option>
                    <option value="Student">Student</option>
                    <option value="Employee">Employee</option>
                    <option value="Teacher">Teacher</option>
                    <option value="Admin">Admin</option>
                    <option value="MIS Staff">MIS Staff</option>
                  </datalist><br>
                 <label>Password</label>
                  <input type="password"  name="Password" id="Update_password" placeholder="Password"/><br>
                  <span class="eye"><i class="fas fa-eye fa-color-update" id="eye" onclick="show_upassword()"></i></span>
                  <div class="buttons">
                  <button class="Update" type="submit" name="Update_user">Update</button>
                 
                 </div>

              </form>
              </div>
             </div>
        </div>
      </div>

    </div>
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
                  <table class="table-queries" id="tbl">
                    <tr class="tr-queries">
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
                          echo "<tr>
                          <td>" . $row['Lastname'] . " " . $row['Firstname'] . " " . $row['Middlename'] . "</td>
                          <td>" . $row['Email'] . "</td>
                          <td>"  . $row['Category'] . "</td>
                          <td>"  . $row['Department_Office'] . "</td>
                          <td>"  . $row['Date']. "  " . $row['Time'] . "</td>
                          <td>" . $row['Request_Type'] . "</td>
                           <td>" . $row['PriorityLevel'] . "</td>
                          <td>". $row['query_status']."</td>
                          <td>"?><?php
             
                                    if($row['Validity']==1){
                                      echo '<p class="act-query"><a href="Validity.php?Id='.$row['Id'].'&Validity=0"><button>Valid</button></a></p>';
                                    }else{
                                      echo '<p class="dis-query"><a href="Validity.php?Id='.$row['Id'].'&Validity=1"><button >Invalid</button></a></p>';
                                    }
                                  
                                  ?> </td>
                          <td><button class="btn-Open"  id="openbtn" onclick="show_Open('<?php echo $row['Id']?>','<?php echo $row['ID_Number']?>','<?php echo $row['Lastname']?>','<?php echo $row['Firstname']?>', '<?php echo $row['Middlename']?>', '<?php echo $row['Category']?>', '<?php echo $row['Request_Type']?>','<?php echo $row['Date']?>', '<?php echo $row['Time']?>', '<?php echo $row['Details']?>', '<?php echo $row['PriorityLevel']?>', '<?php echo $row['Department_Office']?>')"><a href="#"><i class="far fa-eye fa-color-open"></i></a></button>                                                                               
                      <button class="btn-rmarks"  id="rmarks" onclick="show_remarks('<?php echo $row['radio_remark']?>','<?php echo $row['date_time']?>','<?php echo $row['remark']?>')"><a href="#"><i class="fas fa-comment-alt fa-color-comm"></i></a></button>

        
                            <?php 
                           "</td></tr>";
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
              <input class="tcd_input" type="date" name="Target_completion_Date" id="Target_completion_Date" required=""><br>
              <label class="Ans">Answer Here</label>
              <textarea rows="5" name="Answer" class="answer" id="Answer" placeholder="Type your answer here"></textarea>
              </div>


              <div>
                 </div>
              <div><button class="Submit-queries" type="Submit" name="Submit">Submit</button></div>
             </form>

            </div>
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
            
                  <form method="POST" action="admin_report.php">
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
  <div class="bg-modal-add-faq" id="add-faq">
      <div class="modal-content-add-faq">
        <span class="close-add-faq">&times;</span>
        <div class="modal-header-add-faq">
          <div class="p-header-add-faq"><p>ADD FREQUENTLY ASK QUESTIONS</p></div>
           <div class="add-faq-container">
            <div class="add-faq-content">
              <form action="add_faq.php" method="POST" class="add-faq-form">
                <label>FAQ Category</label>
                <select id="faq_category" class="select" name="faq_category" required placeholder="FAQ Category" autocomplete="off">
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
                </select>
                <label>Question</label>
                <input type="text" name="faq_question" placeholder="Common Questions "><br>
                <label>Answer</label>
                <textarea rows="5" name="faq_answer" class="solution" id="sol" placeholder="Answer of the Questions "></textarea>
                <div class="buttons">
                  <button class="add" name="submitfaq" type="Submit">Add</button>
                  <button class="clear" type="Reset">Clear</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="bg-modal-add-req" id="add_req">
      <div class="modal-content-add-req">
        <span class="close-add-req">&times;</span>
        <div class="modal-header-add-req">
          <div class="p-header-add-req"><p>ADD REQUEST TYPE</p></div>
           <div class="add-req-container">
            <div class="add-req-content">
              <form class="add-req-form" method="POST" action="add_req.php">
               <label class="add_lbl">Add Request Type</label>
                <input type="text" class="add-req-input" name="add_req" placeholder="Add Request Type" autocomplete="off">
                <button class="btn-add-req" name="submit_reqtype" type="Submit">Add</button>
             </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="bg-modal-update-utilities" id="up-utl">
      <div class="modal-content-update-utilities">
        <span class="close-update-utilities">&times;</span>
        <div class="modal-header-update-utilities">
              <form class="search-bar" action="" method="GET">
                  <!--<input type="search"  name="Search" id="search" placeholder="SEARCH">
                  <button class="icon" name="btn-search" ><i class="fas fa-search"></i><span class="tooltiptext-search">Search</span></button> -->
              </form>
          <div class="p-header-update-utilities"><p>UPDATE UTILITIES</p> </div>
            <div class="update-utilities-container">       
                  <table class="table-update-utilities" id="update-utilities">
                    <tr class="tr-update-utilities">
                          <th>Id</th>
                      <th>FAQ Question</th>
                      <th>FAQ Answer</th>
                      <th>FAQ Category</th>
                      <th>Action</th>
                    </tr>
                    <tr>
                      <?php
                     $conn = mysqli_connect("localhost","root","","db_helpdesk");

                      $up_utl = "SELECT * FROM  tbl_faq ORDER BY faq_id DESC";
                      $result = $conn-> query($up_utl);

                      if ($result->num_rows >0)  {
                        while($row = $result-> fetch_assoc() ){
                          echo "
                          <tr>
                          <td>" .$row['faq_id'] . "</td>
                            <td>" .$row['Faq_Question'] . "</td>
                            <td>" .$row['Faq_Answer']. "</td>
                            <td>"  .$row['Faq_Category']. "</td>
                            <td>"?><a href="#" onclick="show_update_utilities('<?php echo $row['faq_id']?>','<?php echo $row['Faq_Question']?>','<?php echo $row['Faq_Answer']?>','<?php echo $row['Faq_Category']?>' )">
                                  <button class="btn-Edit-utl"><i class="fas fa-edit fa-color-edit"></i></button></a></td>
                         </tr><?php
                        }
                                                                         
                      }   else{
                        echo "No Data Found";
                      }    
                      $conn->close();           
                      ?>
                      
                    </tr>
                </table>
              </div>
              <div class="update-utilities-containers">
                <table class="table-update-utilities" id="update-utilities">
                    <tr class="tr-update-utilities">
                      <th>Id</th>
                      <th>Request Type</th>
                      <th>Action</th>
                    </tr>
                    <tr>
                      <?php
                     $conn = mysqli_connect("localhost","root","","db_helpdesk");

                      $up_utl = "SELECT * FROM  tbl_req_type ORDER BY req_type_id DESC";
                      $result = $conn-> query($up_utl);

                      if ($result->num_rows >0)  {
                        while($row = $result-> fetch_assoc() ){
                          echo "
                          <tr>
                             <td>"  .$row['req_type_id']. "</td>
                            <td>"  .$row['Add_request_type']. "</td>
                            <td>"?><a href="#" onclick="show_updates_utilities('<?php echo $row['Add_request_type']?>','<?php echo $row['req_type_id']?>')">
                                  <button class="btn-Edit-utl"><i class="fas fa-edit fa-color-edit"></i></button></a></td>
                         </tr><?php
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
    <div class="bg-modal-update-utl" id="update-utl">
      <div class="modal-content-update-utl">
        <span class="close-update-utl">&times;</span>
        <div class="modal-header-update-utl">
          <div class="p-header-update-utl"><p>UPDATE FAQ</p></div>
            <div class="update-utl-container">
              <div class="update-utl-content">
                <form action="faq_update.php" method="POST" class="update-utl-form">
                   
                   <input type="hidden" name="faq_id" id="faq_id">
                  
                  <label>FAQ Question</label>
                  <input type="text" name="faq_quest" id="faq_quest"  /><br>
                  <label>FAQ Answer</label>
                   <textarea rows="5" name="faq_ans" class="solution" id="faq_ans" placeholder="Answer of the Questions "></textarea>
             
                  <label>FAQ Category</label>
                  
                  <select id="faq_cat" class="select" name="faq_cat" required placeholder="FAQ Category" autocomplete="off">
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
                </select>

                                
                  <button class="Update" type="submit" name="Update_faq">Update</button>
                 
                 </div>

              </form>
              </div>
             </div>
        </div>
      </div>
 <div class="bg-modal-update-utlts" id="update-utlts">
      <div class="modal-content-update-utlts">
        <span class="close-update-utlts">&times;</span>
        <div class="modal-header-update-utlts">
          <div class="p-header-update-utlts"><p>UPDATE REQUEST TYPE</p></div>
            <div class="update-utlts-container">
              <div class="update-utlts-content">
                <form action="reqty_update.php" method="POST" class="update-utlts-form">
                   
                  <input type="hidden" name="reqtype_id" id= "reqtype_id">
                  <label>Request Type</label>
                  <input type="text" name="reqtype" id="reqtype"/><br>               
                  <button class="Update-utlts" type="submit" name="Update_reqtype">Update</button>
                 
                 </div>

              </form>
              </div>
             </div>
        </div>
      </div>
    </div>
     <div class="bg-modal-restore" id="res">
      <div class="modal-content-restore">
        <span class="close-restore">&times;</span>
        <div class="modal-header-restore">
          <div class="p-header-restore"><p>RESTORE</p></div>
           <div class="restore-container">
            <div class="restore-content">
              <form class="restore-form">
               <input type="file" class="choose" name="file" value="RESTORE"><br>
               <a href="restore.php"><input type="button" class="btn-restore" name="restore" value="RESTORE"></a>
             </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="bg-modal-help" id="help">
      <div class="modal-content-help">
        <span class="close-help">&times;</span>
        <div class="modal-header-help">
          <form class="search-bars" action="" method="GET">
                   
                 <input type="search"  name="search_help" id="search_help" placeholder="SEARCH">
                  <?php // <button class="icon" name="btn-search" ><i class="fas fa-search"></i></button> ?>
              </form>
          <div class="p-header-help"><p>USER MANUAL</p></div>
           <div class="help-container">
            <div class="help-content" id="help_search">
               <?php
                 $conn = mysqli_connect("localhost","root","","db_helpdesk");

                      $sql = "SELECT * FROM tbl_user_manual ORDER BY Help_id ASC";
                      $result = $conn-> query($sql);

                      if ($result->num_rows >0)  {
                        while($row = $result-> fetch_assoc() ){
                         ?> 
                         <div class="faqs_content" >    
                         <details class="details">  
                              <summary><?php echo $row['Help_Question']; ?></summary><br>
                                         <p class="faq_answer"><?php echo $row['Help_Answer']; ?></p><br>
                                        <?php echo '<img   src  ="data:Image/png;base64,'.base64_encode( $row['Help_Image'] ).'"/>' ?><br>
                                         <?php echo '<img  src ="data:Image/png;base64,'.base64_encode( $row['Help_Image2'] ).'"/>' ?><br>
                                        <?php echo '<img  src ="data:Image/png;base64,'.base64_encode( $row['Help_Image3'] ).'"/>' ?>
                          </details>
                      </div>
                        
                        <?php } ?>
                     <?php }              
                      ?>
              
            </div>
          </div>
          
        </div>
      </div>
    </div>
   
  </div>
   <!--<script src="Javascript/password-show-hide.js"></script>-->
   

    <script src="Javascript/password-show-hide-update.js"></script>
    <script src="Javascript/Gallery.js"></script>
    <!--<script src="Javascript/search.js"></script>-->
    <script type="text/javascript">
      var states = false;
    function  show_password(){
      if (states) {
        document.getElementById("password").setAttribute("type", "password");
        
        states = false;
      }
      else{
        document.getElementById("password").setAttribute("type", "text");
       
        states = true;
      }
    }
    var show = false;
    function  show_cpassword(){
      if (show) {
       
        document.getElementById("cpassword").setAttribute("type", "password");
        show = false;
      }
      else{
       
        document.getElementById("cpassword").setAttribute("type", "text");
        show = true;
      }
    }
    var update = false;
    function  show_upassword(){
      if (update) {
        document.getElementById("Update_password").setAttribute("type", "password");
        
        update = false;
      }
      else{
        document.getElementById("Update_password").setAttribute("type", "text");
       
        update = true;
      }
    } 
 $(function() {
      $(document).on('input', '#search', function() {
        var search = $(this).val();
        $.ajax({
        url: 'admin_search.php',
        type: 'POST',
        async: false,
        data:{
          show_search: 1, 'search':search
        },
        success: function(response){
          $('#admin_tbl').html(response);
        }
      });
      })
    });

 $(function() {
      $(document).on('input', '#search', function() {
        var search = $(this).val();
        $.ajax({
        url: 'search.php',
        type: 'POST',
        async: false,
        data:{
          show: 1, 'search':search
        },
        success: function(response){
          $('#tbl').html(response);
        }
      });
      })
    });
 $(function() {
      $(document).on('input', '#search_help', function() {
        var search = $(this).val();
        $.ajax({
        url: 'help_search.php',
        type: 'POST',
        async: false,
        data:{
          search_help: 1, 'search':search
        },
        success: function(response){
          $('#help_search').html(response);
        }
      });
      })
    });
             
      var cont1 = document.getElementById('user');
      var cont2 = document.getElementById('user-list');
      var cont3 = document.getElementById('update');
      var cont4 = document.getElementById('que');
      var cont5 = document.getElementById('open');
      var cont6 = document.getElementById('rep');
      var cont7 = document.getElementById('add-faq');
      var cont8= document.getElementById('help');
      var cont9= document.getElementById('bg');
      var cont10= document.getElementById('myDropdown_acc');
      var cont11= document.getElementById('myDropdown_utilities');
       var cont12= document.getElementById('upload');
       var cont13= document.getElementById('add_req');
      
      
     
      function show_Account(){
        document.getElementById("myDropdown_acc").classList.toggle("show");
        document.querySelector('.bg-modal-bg').style.display = 'none';
        document.querySelector('.bg-modal-add-faq').style.display = 'none';
        document.querySelector('.bg-modal-msg').style.display = 'none';
        document.querySelector('.bg-modal-restore').style.display = 'none';
        document.querySelector('.bg-modal-add-req').style.display = 'none';
        document.querySelector('.bg-modal-help').style.display = 'none';
        document.querySelector('.bg-modal-reports').style.display = 'none'
        document.querySelector('.bg-modal-user').style.display = 'none';
        document.querySelector('.bg-modal-user-list').style.display = 'none';
        document.querySelector('.bg-modal-list').style.display = 'none';
        document.querySelector('.bg-modal-queries').style.display = 'none';
        }
       
       window.onclick = function(e) {
        if (!e.target.matches('.btn-acc')) {
        var myDropdown_acc = document.getElementById("myDropdown_acc");
          if (myDropdown_acc.classList.contains('show')) {
            myDropdown_acc.classList.remove('show');
          }
        }
      } 
    
    
     
      function show_Utilities(){
        document.getElementById("myDropdown-utilities").classList.toggle("show");
        document.querySelector('.bg-modal-bg').style.display = 'none';
        document.querySelector('.bg-modal-msg').style.display = 'none';
        document.querySelector('.bg-modal-restore').style.display = 'none';
        document.querySelector('.bg-modal-add-req').style.display = 'none';
        document.querySelector('.bg-modal-help').style.display = 'none';
        document.querySelector('.bg-modal-reports').style.display = 'none'
        document.querySelector('.bg-modal-user').style.display = 'none';
        document.querySelector('.bg-modal-user-list').style.display = 'none';
        document.querySelector('.bg-modal-list').style.display = 'none';
        document.querySelector('.bg-modal-queries').style.display = 'none';
       }
         window.onclick = function(e) {
        if (!e.target.matches('.btn-utilities')) {
        var myDropdown_utilities = document.getElementById("myDropdown-utilities");
          if (myDropdown_utilities.classList.contains('show')) {
            myDropdown_utilities.classList.remove('show');
          }
        }
      } 
    
    
 
   
    function show_Add_User(){
      document.querySelector('.bg-modal-user').style.display = 'flex';
      document.querySelector('.bg-modal-queries').style.display = 'none';
      document.querySelector('.bg-modal-add-faq').style.display = 'none';
      document.querySelector('.bg-modal-restore').style.display = 'none';
      document.querySelector('.bg-modal-add-req').style.display = 'none';
      document.querySelector('.bg-modal-bg').style.display = 'none';
      document.querySelector('.bg-modal-help').style.display = 'none';
      document.querySelector('.bg-modal-reports').style.display = 'none';
      document.querySelector('.bg-modal-user-list').style.display = 'none';
      document.querySelector('.bg-modal-list').style.display = 'none';
      document.querySelector('.content').style.display = 'none';
   
      }
       //close button
        var user = document.getElementById("user");
        var span = document.getElementsByClassName("close")[0];
        span.onclick = function() {
        user.style.display = "none";
        }
      
    function show_List_User(){
      document.querySelector('.bg-modal-user-list').style.display = 'flex';
      document.querySelector('.bg-modal-reports').style.display = 'none';
      document.querySelector('.bg-modal-user').style.display = 'none';
      document.querySelector('.bg-modal-add-faq').style.display = 'none';
      document.querySelector('.bg-modal-queries').style.display = 'none';
      document.querySelector('.bg-modal-restore').style.display = 'none';
      document.querySelector('.bg-modal-add-req').style.display = 'none';
      document.querySelector('.bg-modal-bg').style.display = 'none';
      document.querySelector('.bg-modal-help').style.display = 'none';
      document.querySelector('.bg-modal-list').style.display = 'none';
      document.querySelector('.content').style.display = 'none';
      }
       //close button
      var user_list = document.getElementById("user-list");
      var span = document.getElementsByClassName("close-user-list")[0];
        span.onclick = function() {
       user_list.style.display = "none";
        }
    
     
    function show_Edit(id,Lastname,Firstname,Middlename,Email,User_Level,unhashedpassword){
      update = document.getElementById('update');

      Update_id = document.getElementById('Update_id').value = id;
      Update_lname = document.getElementById('Update_lname').value = Lastname;
      Update_fname = document.getElementById('Update_fname').value = Firstname;
      Update_mname = document.getElementById('Update_mname').value = Middlename;
      Update_email = document.getElementById('Update_email').value = Email;
      Update_category = document.getElementById('Update_category').value = User_Level;
      Update_password = document.getElementById('Update_password').value = unhashedpassword;


      document.querySelector('.bg-modal-list').style.display = 'flex';
      document.querySelector('.bg-modal-add-faq').style.display = 'none';
      document.querySelector('.bg-modal-bg').style.display = 'none';
      document.querySelector('.bg-modal-restore').style.display = 'none';
      document.querySelector('.bg-modal-help').style.display = 'none';
      document.querySelector('.bg-modal-add-req').style.display = 'none';
      document.querySelector('.bg-modal-msg').style.display = 'none';
      document.querySelector('.bg-modal-reports').style.display = 'none';
      document.querySelector('.bg-modal-user').style.display = 'none';
      document.querySelector('.content').style.display = 'none';
      document.querySelector('.bg-modal-queries').style.display = 'none';
      }

       //close button
        var list = document.getElementById("update");
        var span = document.getElementsByClassName("close-list")[0];
        span.onclick = function() {
        list.style.display = "none";
        }


        function show_update_utilities(faq_id,Faq_Question,Faq_Answer,Faq_Category){

 
                 

      faq_id = document.getElementById('faq_id').value = faq_id;
      faq_quest = document.getElementById('faq_quest').value = Faq_Question;

      faq_ans = document.getElementById('faq_ans').value = Faq_Answer;

      faq_cat = document.getElementById('faq_cat').value = Faq_Category;





      
      document.querySelector('.bg-modal-update-utl').style.display = 'flex';
      document.querySelector('.bg-modal-list').style.display = 'none';
      document.querySelector('.bg-modal-list').style.display = 'none';
      document.querySelector('.bg-modal-add-faq').style.display = 'none';
      document.querySelector('.bg-modal-bg').style.display = 'none';
      document.querySelector('.bg-modal-restore').style.display = 'none';
      document.querySelector('.bg-modal-help').style.display = 'none';
      document.querySelector('.bg-modal-add-req').style.display = 'none';
      document.querySelector('.bg-modal-msg').style.display = 'none';
      document.querySelector('.bg-modal-reports').style.display = 'none';
      document.querySelector('.bg-modal-user').style.display = 'none';
      document.querySelector('.content').style.display = 'none';
      document.querySelector('.bg-modal-queries').style.display = 'none';
      }

       //close button
        var utl = document.getElementById("update-utl");
        var span = document.getElementsByClassName("close-update-utl")[0];
        span.onclick = function() {
        utl.style.display = "none";
        }
    
      function show_updates_utilities(Add_request_type,req_type_id){
        

    reqtype_id = document.getElementById('reqtype_id').value = req_type_id;
      reqtype = document.getElementById('reqtype').value = Add_request_type;
      
      document.querySelector('.bg-modal-update-utlts').style.display = 'flex';
      document.querySelector('.bg-modal-list').style.display = 'none';
      document.querySelector('.bg-modal-list').style.display = 'none';
      document.querySelector('.bg-modal-add-faq').style.display = 'none';
      document.querySelector('.bg-modal-bg').style.display = 'none';
      document.querySelector('.bg-modal-restore').style.display = 'none';
      document.querySelector('.bg-modal-help').style.display = 'none';
      document.querySelector('.bg-modal-add-req').style.display = 'none';
      document.querySelector('.bg-modal-msg').style.display = 'none';
      document.querySelector('.bg-modal-reports').style.display = 'none';
      document.querySelector('.bg-modal-user').style.display = 'none';
      document.querySelector('.content').style.display = 'none';
      document.querySelector('.bg-modal-queries').style.display = 'none';
      }

       //close button
        var utlts = document.getElementById("update-utlts");
        var span = document.getElementsByClassName("close-update-utlts")[0];
        span.onclick = function() {
        utlts.style.display = "none";
        }
      function show_Delete(delid){
        if(confirm ("Delete this Record?"))
          window.location.href='delete.php?del_id='+delid+'';
          return true;
      }    
    
    function show_Queries(){
      document.querySelector('.bg-modal-queries').style.display = 'flex';
      document.querySelector('.bg-modal-add-faq').style.display = 'none';
      document.querySelector('.bg-modal-bg').style.display = 'none';
      document.querySelector('.bg-modal-restore').style.display = 'none';
      document.querySelector('.bg-modal-help').style.display = 'none';
      document.querySelector('.bg-modal-add-req').style.display = 'none';
      document.querySelector('.bg-modal-user-list').style.display = 'none';
      document.querySelector('.bg-modal-reports').style.display = 'none';
      document.querySelector('.bg-modal-msg').style.display = 'none';
      document.querySelector('.bg-modal-faq').style.display = 'none';
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
      document.querySelector('.bg-modal-add-faq').style.display = 'none';
      document.querySelector('.bg-modal-bg').style.display = 'none';
      document.querySelector('.bg-modal-add-req').style.display = 'none';
      document.querySelector('.bg-modal-restore').style.display = 'none';
      document.querySelector('.bg-modal-help').style.display = 'none';
      document.querySelector('.bg-modal-reports').style.display = 'none';
      document.querySelector('.bg-modal-msg').style.display = 'none';
      document.querySelector('.bg-modal-faq').style.display = 'none';
      document.querySelector('.content').style.display = 'none';
      document.querySelector('.bg-modal-queries').style.display = 'none';
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
        function  show_Upload(){
          document.querySelector('.bg-modal-upload').style.display = 'flex';
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
          var up = document.getElementById("upload");
            var span = document.getElementsByClassName("close-upload")[0];
            span.onclick = function() {
           up.style.display = "none";
            } 
    function show_Reports(){ 
      document.querySelector('.bg-modal-reports').style.display = 'flex';
      document.querySelector('.bg-modal-user').style.display = 'none';
      document.querySelector('.bg-modal-user-list').style.display = 'none';
      document.querySelector('.bg-modal-add-faq').style.display = 'none';
      document.querySelector('.bg-modal-queries').style.display = 'none';
      document.querySelector('.bg-modal-add-req').style.display = 'none';
      document.querySelector('.bg-modal-bg').style.display = 'none';
      document.querySelector('.bg-modal-help').style.display = 'none';
      document.querySelector('.bg-modal-restore').style.display = 'none';
      document.querySelector('.bg-modal-list').style.display = 'none';
      document.querySelector('.content').style.display = 'none';
      }
        var rep = document.getElementById("rep");
        var span = document.getElementsByClassName("close-reports")[0];
        span.onclick = function() {
        rep.style.display = "none";
      } 
    
    function show_add_Faq(){
      document.querySelector('.bg-modal-add-faq').style.display = 'flex';
      document.querySelector('.bg-modal-restore').style.display = 'none'; 
       document.querySelector('.bg-modal-help').style.display = 'none';
       document.querySelector('.bg-modal-list').style.display = 'none';
       document.querySelector('.bg-modal-user-list').style.display = 'none';
      document.querySelector('.bg-modal-queries').style.display = 'none';
      document.querySelector('.bg-modal-bg').style.display = 'none';
       document.querySelector('.bg-modal-add-req').style.display = 'none';
      document.querySelector('.bg-modal-user').style.display = 'none';
      document.querySelector('.bg-modal-reports').style.display = 'none';
      document.querySelector('.bg-modal-msg').style.display = 'none';
      document.querySelector('.bg-modal-open').style.display = 'none';
      document.querySelector('.content').style.display = 'none';
     } 
     //close button
      var add_faq = document.getElementById("add-faq");
        var span = document.getElementsByClassName("close-add-faq")[0];
        span.onclick = function() {
        add_faq.style.display = "none";
      } 
       function show_add_req(){
      document.querySelector('.bg-modal-add-req').style.display = 'flex';
      document.querySelector('.bg-modal-restore').style.display = 'none'; 
       document.querySelector('.bg-modal-help').style.display = 'none';
       document.querySelector('.bg-modal-list').style.display = 'none';
       document.querySelector('.bg-modal-user-list').style.display = 'none';
      document.querySelector('.bg-modal-queries').style.display = 'none';
      document.querySelector('.bg-modal-bg').style.display = 'none';
       document.querySelector('.bg-modal-add-faq').style.display = 'none';
      document.querySelector('.bg-modal-user').style.display = 'none';
      document.querySelector('.bg-modal-reports').style.display = 'none';
      document.querySelector('.bg-modal-open').style.display = 'none';
      document.querySelector('.content').style.display = 'none';
     } 
     //close button
      var add_req = document.getElementById("add_req");
        var span = document.getElementsByClassName("close-add-req")[0];
        span.onclick = function() {
        add_req.style.display = "none";
      }
       function show_up_utl(){
      document.querySelector('.bg-modal-update-utilities').style.display = 'flex';
      document.querySelector('.bg-modal-restore').style.display = 'none'; 
       document.querySelector('.bg-modal-help').style.display = 'none';
       document.querySelector('.bg-modal-list').style.display = 'none';
       document.querySelector('.bg-modal-user-list').style.display = 'none';
      document.querySelector('.bg-modal-queries').style.display = 'none';
      document.querySelector('.bg-modal-bg').style.display = 'none';
       document.querySelector('.bg-modal-add-faq').style.display = 'none';
      document.querySelector('.bg-modal-user').style.display = 'none';
      document.querySelector('.bg-modal-reports').style.display = 'none';
      document.querySelector('.bg-modal-open').style.display = 'none';
      document.querySelector('.content').style.display = 'none';
     } 
     //close button
      var up_utl = document.getElementById("up-utl");
        var span = document.getElementsByClassName("close-update-utilities")[0];
        span.onclick = function() {
        up_utl.style.display = "none";
      } 
     function show_help(){
      document.querySelector('.bg-modal-help').style.display = 'flex'; 
      document.querySelector('.bg-modal-user').style.display = 'none';
       document.querySelector('.bg-modal-list').style.display = 'none';
       document.querySelector('.bg-modal-user-list').style.display = 'none';
      document.querySelector('.bg-modal-restore').style.display = 'none';
      document.querySelector('.bg-modal-queries').style.display = 'none';
      document.querySelector('.bg-modal-bg').style.display = 'none';
     document.querySelector('.bg-modal-add-faq').style.display = 'none';
      document.querySelector('.bg-modal-reports').style.display = 'none';
      document.querySelector('.bg-modal-msg').style.display = 'none';
      document.querySelector('.bg-modal-open').style.display = 'none';
      document.querySelector('.content').style.display = 'none';
     } 
     //close button
      var help = document.getElementById("help");
        var span = document.getElementsByClassName("close-help")[0];
        span.onclick = function() {
        help.style.display = "none";
      } 
   function show_restore(){
      document.querySelector('.bg-modal-restore').style.display = 'flex';
      document.querySelector('.bg-modal-user').style.display = 'none';
       document.querySelector('.bg-modal-list').style.display = 'none';
       document.querySelector('.bg-modal-user-list').style.display = 'none';
      document.querySelector('.bg-modal-help').style.display = 'none';
      document.querySelector('.bg-modal-add-faq').style.display = 'none';
      document.querySelector('.bg-modal-queries').style.display = 'none';
      document.querySelector('.bg-modal-bg').style.display = 'none';
      document.querySelector('.bg-modal-reports').style.display = 'none';
      document.querySelector('.bg-modal-msg').style.display = 'none';
      document.querySelector('.bg-modal-open').style.display = 'none';
      document.querySelector('.content').style.display = 'none';
     } 
     //close button
      var res = document.getElementById("res");
        var span = document.getElementsByClassName("close-restore")[0];
        span.onclick = function() {
        res.style.display = "none";
      } 
    </script>
  
</body>
<footer>
  <p>Copyright 2021<br>All Rights Reserved</p>
</footer>
</html>