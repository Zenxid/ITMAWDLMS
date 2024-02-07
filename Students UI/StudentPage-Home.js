let swiperNew = new Swiper('.book-swiper', {
    loop:true,
    spaceBetween: 16,
    slidesPerView: 'auto',

   breakpoints: {
    1150: {
        slidesPerView: 3,
    }
   }
})

let borrowBook = document.querySelector('.borrow-book');

document.querySelector('.book-notification').onclick = () => {
    borrowBook.classList.toggle('active');
}

let notification = document.querySelector('.notifications_dd');

document.querySelector('.notification').onclick = () => {
    notification.classList.toggle('active');
}

/* ------------------- SWIPER NO SWIPING SWIPER NO SWIPING ----------------- */

const header = document.querySelector("header .header-2");
var offset = header.offsetTop;

function handleScroll() {
    if (window.scrollY >= offset) {
      header.classList.add("fixed");
    } else {
      header.classList.remove("fixed");
    }
}

window.onscroll = function() {
    handleScroll();
  };