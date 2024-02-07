let arrow = document.querySelectorAll(".drop-down");
for (var i = 0; i < arrow.length; i++) {
    arrow[i].addEventListener("click", (e)=>{
        console.log(e)
    let arrowParent = e.target.parentElement.parentElement;
    arrowParent.classList.toggle("showMenu");
    });
}


const menuLinks = document.querySelectorAll('.menu-link');
const dropDowns = document.querySelectorAll('.drop-down');


menuLinks.forEach((link, index) => {

  link.addEventListener('mouseover', function() {
    dropDowns[index].style.color = 'rgb(94, 87, 87)';
  });


  link.addEventListener('mouseout', function() {
    dropDowns[index].style.color = ''; 
  });
});



window.onload = function(){
    const sidebar = document.querySelector(".sidebar");
    const closeBtn = document.querySelector("#btn");
    
    closeBtn.addEventListener("click", function(){
        sidebar.classList.toggle("open");
        menuBtnChange();
    })

    function menuBtnChange() {
        if(sidebar.classList.contains("open")) {
            closeBtn.classList.replace("bx-menu", "bx-menu-alt-right")
        } else {
            closeBtn.classList.replace("bx-menu-alt-right", "bx-menu")
        }
    }
}