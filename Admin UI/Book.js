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
        title: "Basic Ways",
        author: "Alex Adams",
        genre: "POV",
        year: "1997",
        quantity: "69",
        isbn: "152151241241"
    },
    {
        title: "Advanced Ways",
        author: "Johnny Sins",
        genre: "Third Person",
        year: "1997",
        quantity: "69",
        isbn: "152151241241"
    },
    {
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

function filterTable() {
    const searchInput = document.getElementById("searchInput");
    const searchTerm = searchInput.value.toLowerCase();
    const filteredArray = array.filter(book => {
        return (
            book.title.toLowerCase().includes(searchTerm) ||
            book.author.toLowerCase().includes(searchTerm) ||
            book.genre.toLowerCase().includes(searchTerm) ||
            book.year.toLowerCase().includes(searchTerm) ||
            book.quantity.toLowerCase().includes(searchTerm) ||
            book.isbn.toLowerCase().includes(searchTerm)
        );
    });
    showtable(filteredArray);
}

document.getElementById("searchInput").addEventListener("input", filterTable);

$('.delete-btn').click(function() {
    const bookId = $(this).attr('data-id');
    const index = curArray.findIndex(book => book.id == bookId);
    
    if (index !== -1) {
        curArray.splice(index, 1);
        showtable(curArray);
    }
});

showtable(array);

let books = [];

function addBook(book){
    let table = $("#bookTable tbody");
    table.append(`<tr id="${book.id}">
        <td>${book.title}</td>
        <td>${book.author}</td>
        <td>${book.genre}</td>
        <td>${book.year}</td>
        <td>${book.quantity}</td>
        <td>${book.isbn}</td>
        <td>
        <button><i class="fa-solid fa-pen-to-square" data-id="${book.id}"></i></button>
        <button><i class="fa-solid fa-trash data-id="${book.id}"></i></button>
        </td>
    `); 
}

function clearForm(){
    $("#bookTitle").val("");
    $("#bookAuthor").val("");
    $("#bookGenre").val("");
    $("#bookYear").val("");
    $("#bookQuantity").val("");
    $("#bookISBN").val("");
}
function generateId() {
    return Math.floor(Math.random() * 1000000);
}

$(document).on("click", "#clearBtn", function(){
    clearForm();
});

$("#bookForm").submit(function(e){
    e.preventDefault();

    let book = {
        id: generateId(),
        title: $("#bookTitle").val(),
        author: $("#bookAuthor").val(),
        genre: $("#bookGenre").val(),
        year: $("#bookYear").val(),
        quantity: $("#bookQuantity").val(),
        isbn: $("#bookISBN").val(),
    };

    books.push(book);
    addBook(book);

    clearForm()
})

$("#editForm").submit(function (e) {
    e.preventDefault();

    let bookId = $("#editBookId").val();
    let bookIndex = books.findIndex((book)=>book.id==bookId);
    let book =[bookIndex];

    book.title = $("#editBookTitle").val();

});

/* ------------------------------------------ END OF BOOK TABLE JAVASCRIPT CODE ------------------------------ */