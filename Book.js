var array = [
    {
        title: "Basic Ways",
        author: "Hello Kitty",
        genre: "Kaboom",
        year: "1997",
        quantity: "1",
        isbn: "152151241241"
    },
    {
        title: "Advanced Ways",
        author: "Hello Kitty",
        genre: "Kaboom",
        year: "1997",
        quantity: "1",
        isbn: "152151241241"
    },
    {
        title: "Hardcore Ways",
        author: "Hello Kitty",
        genre: "Kaboom",
        year: "1997",
        quantity: "1",
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
                <button><i class="fa-solid fa-pen-to-square" data-id="${book.id}"></i></button>
                <button><i class="fa-solid fa-trash data-id="${book.id}"></i></button>
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