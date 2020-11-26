// function random_bg_color() {
//     var x = Math.floor(Math.random() * 256);
//     var y = Math.floor(Math.random() * 256);
//     var z = Math.floor(Math.random() * 256);
//     var bgColor = "rgb(" + x + "," + y + "," + z + ")";
  
//     document.getElementsByClassName("card-header").style.background = bgColor;
// }
// random_bg_color();
function myAccFunc() {
    var x = document.getElementById("demoAcc");
    if (x.className.indexOf("my-show") == -1) {
      x.className += " my-show";
    } else {
      x.className = x.className.replace(" my-show", "");
    }
  }

  // Click on the "apple" link on page load to open the accordion for demo purposes
  document.getElementById("myBtn").click();


  // Open and close sidebar
  function my_open() {
    document.getElementById("mySidebar").style.display = "block";
    document.getElementById("myOverlay").style.display = "block";
  }
   
  function my_close() {
    document.getElementById("mySidebar").style.display = "none";
    document.getElementById("myOverlay").style.display = "none";
  }
  
      // Get the modal
      var modal = document.getElementById('id01');

      // When the user clicks anywhere outside of the modal, close it
      window.onclick = function(event) {
          if (event.target == modal) {
              modal.style.display = "none";
          }
      }
      
  function myFunction() {
      document.getElementById("myDropdown").classList.toggle("show");
  }

      // Close the dropdown if the user clicks outside of it
      window.onclick = function(event) {
          if (!event.target.matches('.dropbtn')) {
              var dropdowns = document.getElementsByClassName("dropdown-content");
              var i;
              for (i = 0; i < dropdowns.length; i++) {
                  var openDropdown = dropdowns[i];
                  if (openDropdown.classList.contains('show')) {
                      openDropdown.classList.remove('show');
                  }
              }
          }
      }