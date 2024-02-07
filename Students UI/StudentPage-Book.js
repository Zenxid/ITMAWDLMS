let borrowBook = document.querySelector('.borrow-book');

document.querySelector('.book-notification').onclick = () => {
    borrowBook.classList.toggle('active');
}

let notification = document.querySelector('.notifications_dd');

document.querySelector('.notification').onclick = () => {
    notification.classList.toggle('active');
}