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
