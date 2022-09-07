
<?php
include"connection.php";
if(isset($_GET['search_word']))
{
 $search_word=$_GET['search_word']; 
 $query = "SELECT * FROM tbl_user_manual WHERE Help_Question LIKE '%".$search_word."%' ORDER BY help_id ASC";
 $result = mysqli_query($conn, $query);
 if(mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_array($result)){

   $bold_word='<b>'.$search_word.'</b>';
   ?><div class="faqs_content">
                             
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
  }else{
 echo "<li>No Results</li>";
 } 
}
?>