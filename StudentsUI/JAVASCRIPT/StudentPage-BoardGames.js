let borrowBook = document.querySelector('.borrow-book');

document.querySelector('.book-notification').onclick = () => {
  borrowBook.classList.toggle('active');
}

let notification = document.querySelector('.notifications_dd');

document.querySelector('.notification').onclick = () => {
  notification.classList.toggle('active');
}


/* ----------------------- END OF NOTIFICATION JS ---------------------- */

let items = document.querySelectorAll('.slider .list .item');
let next = document.getElementById('next');
let prev = document.getElementById('prev');
let thumbnails = document.querySelectorAll('.thumbnail .item');

let countItem = items.length;
let itemActive = 0;

next.onclick = function() {
    itemActive = itemActive + 1;
    if(itemActive >= countItem) {
        itemActive = 0;
    }
    showSlider();
}

prev.onclick = function() {
    itemActive = itemActive - 1;
    if(itemActive < 0) {
        itemActive = countItem - 1;
    }
    showSlider()
}

let refreshInterval = setInterval(() => {
    next.click();

}, 3000)
function showSlider() {
    let itemActiveOld = document.querySelector('.slider .list .item.active');
    let thumbnailActiveOld = document.querySelector('.thumbnail .item.active');
    if (itemActiveOld) {
        itemActiveOld.classList.remove('active');
    }
    if (thumbnailActiveOld) {
        thumbnailActiveOld.classList.remove('active');
    }

    items[itemActive].classList.add('active');
    thumbnails[itemActive].classList.add('active');
    
    clearInterval(refreshInterval);
    refreshInterval = setInterval(() => {
        next.click();
    }, 5000)
}

thumbnails.forEach((thumbnail, index) => {
    thumbnail.addEventListener('click', () => {
        itemActive = index;
        showSlider();
    })
})

/* ------------------------------ END OF THUMBNAILS -------------------------------- */


document.addEventListener("DOMContentLoaded", function() {
    const games = [
      {
        name: "Chess Set",
        description: "Classic strategy board game originating from ancient India. This set includes a wooden chessboard and intricately designed pieces.",
        quantity: 5,
        inUsed: 2,
        users: [
        { username: "John", profilePic: "../Pictures/profile.jpg" },
        { username: "Emma", profilePic: "../Pictures/profile.jpg" },
        ],
        image: "../Pictures/Chess.jpeg"
      },
      {
        name: "Snake and Ladder Board Game",
        description: "A family-friendly board game with a classic gameplay mechanism of snakes and ladders. Roll the dice, climb ladders, and watch out for slippery snakes!",
        quantity: 8,
        inUsed: 2,
        users: [
        { username: "Sophia", profilePic: "sophia.jpg" },
        { username: "William", profilePic: "william.jpg" }
        ],
        image: "../Pictures/SnL.jpg"
      },
      {
        name: "UNO Card Game",
        description: "The classic card game for family fun and entertainment. Play cards strategically to be the first to get rid of all your cards!",
        quantity: 5,
        inUsed: 2,
        users: [
        { username: "John", profilePic: "../Pictures/profile.jpg" },
        { username: "Emma", profilePic: "../Pictures/profile.jpg" },
        ],
        image: "../Pictures/uno.png"
      },
      {
        name: "Guess Who Board Game",
        description: "A classic guessing game where players try to guess their opponent's character card by asking yes or no questions. Fun for all ages!",
        quantity: 5,
        inUsed: 2,
        users: [
        { username: "John", profilePic: "../Pictures/profile.jpg" },
        { username: "Emma", profilePic: "../Pictures/profile.jpg" },
        ],
        image: "../Pictures/guessWho.jpg"
      },
      {
        name: "Scrabble Word Game",
        description: "Test your vocabulary and strategic skills with this classic word game. Form words on the game board and score points to emerge victorious!",
        quantity: 5,
        inUsed: 2,
        users: [
        { username: "John", profilePic: "../Pictures/profile.jpg" },
        { username: "Emma", profilePic: "../Pictures/profile.jpg" },
        ],
        image: "../Pictures/scrabble.png"
      }
    ];
  
    const listing = document.querySelector(".listing");
    const searchInput = document.getElementById("search");
    const toastContainer = document.querySelector(".toast");

    function filterGames(searchTerm) {
        const filteredGames = games.filter(game => {
          return game.name.toLowerCase().includes(searchTerm.toLowerCase());
        });
        renderGames(filteredGames);
      }



      searchInput.addEventListener("input", function() {
        filterGames(this.value);
      });

      listing.addEventListener("click", function(event) {
        if (event.target.classList.contains("play-btn")) {
          const gameName = event.target.dataset.name;
          showCustomToast(gameName);
        } else if (event.target.classList.contains("detail-btn")) {
            const gameName = event.target.parentElement.querySelector("h3").textContent;
            const gameDetails = games.find(game => game.name === gameName);
            showModal(gameDetails);
        }
      });
  });
