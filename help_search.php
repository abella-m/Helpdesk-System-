<?php
    include('connection.php');
  

    if(isset($_POST['search_help'])){
        ?>
       
                    <?php
                   
                        $search = $_POST['search']; //search credential
                        $quser=mysqli_query($conn,"select * from `tbl_user_manual` WHERE Help_id LIKE '%$search%' OR Help_Question LIKE '%$search%'  ORDER BY Help_id ASC"); //search id
                        while($row=mysqli_fetch_array($quser)){ //looping
                            ?>
                                <div class="faqs_content">                            
                                   <details class="details">  
                                        <summary><?php echo $row['Help_Question']; ?></summary><br>
                                                <p class="faq_answer"><?php echo $row['Help_Answer']; ?></p><br>
                                                <?php echo '<img   src  ="data:Image/png;base64,'.base64_encode( $row['Help_Image'] ).'"/>' ?><br>
                                                <?php echo '<img   src ="data:Image/png;base64,'.base64_encode( $row['Help_Image2'] ).'"/>' ?><br>
                                                <?php echo '<img  src ="data:Image/png;base64,'.base64_encode( $row['Help_Image3'] ).'"/>' ?>
                                    </details>
                                </div>
                                
                            <?php
                        }
                    
                    ?>
              
        <?php
    }

?>