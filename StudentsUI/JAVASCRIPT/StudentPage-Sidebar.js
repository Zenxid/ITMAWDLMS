$(document).ready(function () {
  $(".menu > ul > li").click(function (e) {
      $(this).siblings().removeClass("active");
      $(this).toggleClass("active");
      $(this).find("ul").slideToggle();
      $(this).siblings().find("ul").slideUp();
      $(this).siblings().find("ul").find("li").removeClass("active");
  });

  $(".menu-btn").click(function () {
      $(".sidebar").toggleClass("active");
      $("main").toggleClass("sidebar-active");
  });
});

function toggleSidebar() {
  var sidebar = document.querySelector('.sidebar');
  if (window.innerWidth <= 768) {
    sidebar.classList.add('active');
  } else {
    sidebar.classList.remove('active');
  }
}

window.onload = toggleSidebar;
window.onresize = toggleSidebar;

const menuToggle = document.getElementById('menu-toggle');
const menuItems = document.querySelector('.menu-items');
const topIcons = document.querySelector('.top-icons');
const leftIcons = document.querySelector('.left-icons');

menuToggle.addEventListener('click', () => {
  menuItems.classList.toggle('show');
  topIcons.classList.toggle('spin-animation');
  leftIcons.classList.toggle('spin-animation');
});

const iconB = document.getElementById('icon-b');
const iconD = document.getElementById('icon-d');
const iconH = document.getElementById('icon-h');


iconB.addEventListener('click', () => {
  topIcons.innerHTML = `
    <a href="StudentPage-FavoriteBook.php"><div class="menu-icon"><i class="ph ph-book"></i></div></a>
    <a href="StudentPage-FavoritePS4.php"><div class="menu-icon"><i class="ph ph-game-controller"></i></div></a>
    <a href="StudentPage-FavoriteBoard.php"><div class="menu-icon"><i class="ph ph-puzzle-piece"></i></div></a>
  `;
});

iconD.addEventListener('click', () => {
  topIcons.innerHTML = `
    <a href="StudentPage-RetrievalBoardGames.php"><div class="menu-icon"><i class="ph ph-puzzle-piece"></i></div></a>
    <a href="StudentPage-RetrievalPS4.php"><div class="menu-icon"><i class="ph ph-game-controller"></i></div></a>
    <a href="StudentPage-RetrievalPC.php"><div class="menu-icon"><i class="ph ph-desktop-tower"></i></div></a>
  `;
});

iconH.addEventListener('click', () => {
  topIcons.innerHTML = `
    <a href="StudentPage-BookHistory.php"><div class="menu-icon"><i class="ph ph-book"></i></div></a>
    <a href="StudentPage-BoardHistory.php"><div class="menu-icon"><i class="ph ph-puzzle-piece"></i></div></a>
    <a href="StudentPage-PS4History.php"><div class="menu-icon"><i class="ph ph-game-controller"></i></div></a>
    <a href="StudentPage-PCHistory.php"><div class="menu-icon"><i class="ph ph-desktop-tower"></i></div></a>
    <a href="StudentPage-FinesHistory.php"><div class="menu-icon"><i class="icon ph ph-money"></i></div></a>
  `;
});