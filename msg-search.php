<?php
    include('connection.php');
   

    if(isset($_POST['msg_search'])){
        ?>
        <table class = "table table-bordered text-center">
            <thead class="bg-info">
                <th>Username</th>
                <th>Status</th>
                <th>Action</th>
            </thead>
                <tbody>
                    <?php
                        $search_msg_user = $_POST['search_msg_user']; //search credential
                        $quser=mysqli_query($conn,"select * from `login` inner join `chat_message` on login.user_id=chat_message.id LIKE '%$search_msg_user%' OR Username LIKE '%$search_msg_user%' ORDER BY user_id DESC"); //search id
                        while($row=mysqli_fetch_array($quser)){ //looping
                            ?>
                                <tr>
                                   
                                    <td><?php echo $row['Username']; ?></td>
                                    <td><?php echo $row['status']; ?></td>
                                    
                                    
                                   <td>
                                    <button type="button" class="message-btn btn-info btn-xs start_chat" data-touserid="'.$row['user_id'].'" data-tousername="'.$row['Username'].'">Start Chat</button>

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