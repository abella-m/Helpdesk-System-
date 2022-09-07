<?php
    include('connection.php');
  

    if(isset($_POST['show_search'])){
        ?>
        <table class = "table table-bordered text-center">
            <thead class="bg-info">
                
                <th>Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>Category</th>
                <th>Status</th>
                <th>Action</th>
            </thead>
                <tbody>
                    <?php
                   
                        $search = $_POST['search']; //search credential
                        $quser=mysqli_query($conn,"select * from `tbl_login` WHERE user_id LIKE '%$search%' OR Lastname LIKE '%$search%' OR Firstname LIKE '%$search%' OR Middlename LIKE '%$search%' OR Email LIKE '%$search%' OR Password LIKE '%$search%' OR User_Level LIKE '%$search%'  OR Status LIKE '%$search%' ORDER BY user_id DESC"); //search id
                        while($row=mysqli_fetch_array($quser)){ //looping
                            ?>
                                <tr>
                                    
                                   
                                    <td><?php echo $row['Lastname']?>, <?php echo $row['Firstname']?>, <?php echo $row['Middlename']?> </td>
                                    <td><?php echo $row['Email']; ?></td>
                                    <td><?php echo $row['Password']; ?></td>
                                    <td><?php echo $row['User_Level']; ?></td>
                                    <td><?php 
                                    if($row['Status']==1){
                                      echo '<p class="act"><a href="Status.php?user_id='.$row['user_id'].'&Status=0"><button>Active</button></a></p>';
                                    }else{
                                      echo '<p class="dis"><a href="Status.php?user_id='.$row['user_id'].'&Status=1"><button >DeActive</button></a></p>';
                                    }


                                  ?></td>
                                   <td><a href="#" ><button class="btn-delete" onclick="show_Delete(<?php echo $row['user_id']; ?>)" name="delete" value="delete"><i class="fas fa-trash-alt fa-color-delete"></i></button></a>
                                    <a href="#" onclick="show_Edit('<?php echo $row['user_id']?>', '<?php echo $row['Lastname']?>','<?php echo $row['Firstname']?>', '<?php echo $row['Middlename']?>', '<?php echo $row['Email']?>', '<?php echo  $row['User_Level']?>', '<?php echo $row['Password']?>' )">
                                        <button class="btn-Edit"><i class="fas fa-edit fa-color-edit"></i></button></a></td>

                                </tr>
                            <?php
                        }
                    
                    ?>
                </tbody>
            </table>
        <?php
    }

?>