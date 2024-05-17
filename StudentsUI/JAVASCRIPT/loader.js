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