let borrowBook = document.querySelector('.borrow-book');

document.querySelector('.book-notification').onclick = () => {
    borrowBook.classList.toggle('active');
}

let notification = document.querySelector('.notifications_dd');

document.querySelector('.notification').onclick = () => {
    notification.classList.toggle('active');
}

var swiper = new Swiper(".home .swiper", {
  effect: "coverflow",
  grabCursor: true,
  spaceBetween: 30,
  centeredSlides: false,
  coverflowEffect: {
    rotate: 0,
    stretch: 0,
    depth: 0,
    modifier: 1,
    slideShadows: false
  },
  loop: true,
  pagination: {
    el: ".swiper-pagination",
    clickable: true
  },
  keyboard: {
    enabled: true
  },
  mousewheel: {
    thresholdDelta: 70
  },
  breakpoints: {
    460: {
      slidesPerView: 3
    },
    768: {
      slidesPerView: 3
    },
    1024: {
      slidesPerView: 3
    },
    1600: {
      slidesPerView: 3.6
    }
  }
});


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


/* ------------------- loader ----------------- */

var loader = document.getElementById("preloader");

window.addEventListener("load", function() {
  loader.style.display = "none";
})