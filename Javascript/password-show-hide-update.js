//show & hide password for update
var update = false;
    function  show_password(){
      if (update) {
        document.getElementById("Update_password").setAttribute("type", "password");
        
        update = false;
      }
      else{
        document.getElementById("Update_password").setAttribute("type", "text");
       
        update = true;
      }
    }