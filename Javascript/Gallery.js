  let x = 0;
  let y = 3;

    const dots = document.querySelectorAll(".dot-container button");


    function next(){
      document.getElementById("content" + (x+1)).classList.remove("active");
      x = (y + x + 1) % y;
      document.getElementById("content" + (x+1)).classList.add("active");
      indicator(x+1);
      }
      function prev(){
      document.getElementById("content" + (x+1)).classList.remove("active");
      x = (y + x - 1) % y;
      document.getElementById("content" + (x+1)).classList.add("active");
      }

      function indicator(num){
      dots.forEach(function(dot){
        dot.style.backgroundColor = "transparent";
        });
        document.querySelector(".dot-container button:nth-child(" + num + ")").style.backgroundColor = "#0084ff";
     }