<?php
    include('connection.php');
    if(isset($_POST['shows'])){
        ?>
        <table class = "table table-bordered text-center">
            <thead class="bg-info">
               
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
            </thead>
                <tbody>
                    <?php
                        $search = $_POST['search']; //search credential
                        $quser=mysqli_query($conn,"select * from `tbl_request` WHERE ID_Number LIKE '%$search%' OR Lastname LIKE '%$search%' OR Firstname LIKE '%$search%' OR Middlename LIKE '%$search%' OR Email LIKE '%$search%' OR Category LIKE '%$search%' OR Date LIKE '%$search%' OR Request_Type LIKE '%$search%' OR Department_Office LIKE '%$search%'  OR PriorityLevel LIKE '%$search%'  OR query_status LIKE '%$search%' ORDER BY query_status DESC, PriorityLevel DESC, ID DESC"); //search id
                        while($row=mysqli_fetch_array($quser)){ //looping
                            ?>
                                <tr>
                                    
                                    <td><?php echo $row['Lastname']?> <?php echo $row['Firstname']?> <?php echo $row['Middlename']?> </td>
                                    <td><?php echo $row['Email']; ?></td>
                                    <td><?php echo $row['Category']; ?></td>
                                     <td><?php echo $row['Department_Office']; ?></td>
                                    <td><?php echo $row['Date']?> <?php echo $row['Time']?></td>
                                    <td><?php echo $row['Request_Type']; ?></td>
                                     <td><?php echo $row['PriorityLevel']; ?></td>
                                    <td><?php echo $row['query_status']; ?></td>
                                    <td><?php
             
                                    if($row['Validity']==1){
                                      echo '<p class="act-query"><a href="Validity.php?Id='.$row['Id'].'&Validity=0"><button>Valid</button></a></p>';
                                    }else{
                                      echo '<p class="dis-query"><a href="Validity.php?Id='.$row['Id'].'&Validity=1"><button >Invalid</button></a></p>';
                                    }
                                  
                                  ?> </td>


                                    <td> <a href="#" ><button class="btn-Open-mis"  id="openbtn" onclick="show_Open('<?php echo $row['Id']?>','<?php echo $row['ID_Number']?>','<?php echo $row['Lastname']?>','<?php echo $row['Firstname']?>', '<?php echo $row['Middlename']?>', '<?php echo $row['Category']?>', '<?php echo $row['Request_Type']?>','<?php echo $row['Date']?>', '<?php echo $row['Time']?>', '<?php echo $row['Details']?>', '<?php echo $row['PriorityLevel']?>','<?php echo $row['Department_Office']?>')"><a href="#"><i class="far fa-eye fa-color-open"></i></a></button></a> 
                                   <button class="btn-rmarks"  id="rmarks" onclick="show_remarks('<?php echo $row['radio_remark']?>','<?php echo $row['date_time']?>','<?php echo $row['remark']?>')"><a href="#"><i class="fas fa-comment-alt fa-color-comm"></i></a></button>

                                    </td>

                                </tr>
                            <?php
                        }
                    
                    ?>
                </tbody>
            </table>
        <?php
    }

?>