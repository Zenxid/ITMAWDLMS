let borrowBook = document.querySelector('.borrow-book');

document.querySelector('.book-notification').onclick = () => {
    borrowBook.classList.toggle('active');
}

let notification = document.querySelector('.notifications_dd');

document.querySelector('.notification').onclick = () => {
    notification.classList.toggle('active');
}



var swiper = new Swiper(".books-slider", {
    loop:true,
    centeredSlides:true,
    autoplay:{
        delay:9500,
        disableOnInteraction:false,
    },
    breakpoints: {
     0: {
        slidesPerView: 1,   
      },
      768: {
        slidesPerView: 2, 
      },
      1024: {
        slidesPerView: 3, 
      },
    },
  });

  /* ----------------------- SLIDER ------------------------- */

