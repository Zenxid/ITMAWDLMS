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

/* ------------------------------------------ END OF SIDEBAR JAVASCRIPT CODE ------------------------------ */

var array = [
    {
        number: "1",
        cover: "/Pictures/Book1.png",
        title: "Basic Ways",
        author: "Alex Adams",
        genre: "POV",
        year: "1997",
        quantity: "69",
        isbn: "152151241241"
    },
    {   
        number: "2",
        cover: "/Pictures/Book2.png",
        title: "Advanced Ways",
        author: "Johnny Sins",
        genre: "Third Person",
        year: "1997",
        quantity: "69",
        isbn: "152151241241"
    },
    {   
        number: "3",
        cover: "/Pictures/Book3.png",
        title: "Hardcore Ways",
        author: "Jordi El Nino",
        genre: "Fantasy",
        year: "1997",
        quantity: "69",
        isbn: "152151241241"
    }
]

function showtable(curarray) {
    let tableContent = '';

    curarray.forEach(book => {
        tableContent += `
            <tr>
                <td>${book.number}</td>
                <td><img src="${book.cover}" alt="Book Cover" class="cover-image"></td>
                <td>${book.title}</td>
                <td>${book.author}</td>
                <td>${book.genre}</td>
                <td>${book.year}</td>
                <td>${book.quantity}</td>
                <td>${book.isbn}</td>
                <td>
                <button class="edit-btn"><i class="fa-solid fa-pen-to-square" data-id="${book.id}"></i></button>
                <button class="delete-btn"><i class="fa-solid fa-trash data-id="${book.id}"></i></button>
                </td>
            </tr>`;
    });
    document.getElementById("tableBody").innerHTML = tableContent;
}



/* ------------------------------------------ END OF TABLE JAVASCRIPT CODE ------------------------------ */

document.querySelector(".add_new").addEventListener("click", function(){
    document.querySelector(".popup").classList.add("active");
});

document.querySelector(".popup .close-btn").addEventListener("click", function(){
    document.querySelector(".popup").classList.remove("active");
});

document.querySelectorAll(".update-btn").forEach(btn => {
    btn.addEventListener("click", function() {
        document.querySelector(".update-popup").classList.add("active");
    });
});

document.querySelector(".update-popup .close-btn").addEventListener("click", function(){
    document.querySelector(".update-popup").classList.remove("active");
});




