let borrowBook = document.querySelector('.borrow-book');

document.querySelector('.book-notification').onclick = () => {
    borrowBook.classList.toggle('active');
}

let notification = document.querySelector('.notifications_dd');

document.querySelector('.notification').onclick = () => {
    notification.classList.toggle('active');
}

/* ------------------------- END OF NOTIFICATION AND BORROW BOOK JS ------------------- */

function changeBg(bg, title, trailerLink) {
    const banners = document.querySelectorAll('.banner');
    const contents = document.querySelectorAll('.content');
    const playTrailerLink = document.getElementById('playTrailer');

    banners.forEach(banner => {
        banner.style.background = `url(../Pictures/${bg})`;
        banner.style.backgroundSize = 'cover';
        banner.style.backgroundPosition = 'center';
    });

    contents.forEach(content => {
        content.classList.remove('active');
        if (content.classList.contains(title)) {
            content.classList.add('active');
        }
    });

    
    playTrailerLink.dataset.trailerId = trailerLink;
}
document.getElementById('playTrailer').addEventListener('click', function(event) {
    event.preventDefault();
    const trailerId = this.dataset.trailerId;
    if (trailerId) {
        window.open(trailerId, '_blank');
    } else {
        console.log('Trailer link not found.');
    }
});

/* ------------------------------- END OF BANNNER JS ----------------------- */



function updateDisplayedGames() {
    const searchInput = document.getElementById('search').value.toLowerCase();
    const checkedGenres = Array.from(document.querySelectorAll('input[type="checkbox"]:checked')).map(checkbox => checkbox.id);
    const games = Array.from(document.querySelectorAll('.game'));
    
    games.forEach(game => {
        const gameGenre = game.getAttribute('data-genre').toLowerCase();
        const gameTitle = game.getAttribute('data-title').toLowerCase();
        const isVisible = (checkedGenres.length === 0 || checkedGenres.includes('all') || checkedGenres.includes(gameGenre)) && 
                         (gameTitle.includes(searchInput) || searchInput.trim() === '');

        if (isVisible) {
            game.style.display = 'block';
        } else {
            game.style.display = 'none';
        }
    });
}

document.getElementById('search').addEventListener('input', updateDisplayedGames);

document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
    checkbox.addEventListener('change', updateDisplayedGames);
});


function toggleBold(id) {
    var label = document.querySelector('label[for="' + id + '"]');
    label.classList.toggle('bold-label');
}

document.addEventListener('DOMContentLoaded', function() {
    const gamesList = document.getElementById('games-list');
    const overlay = document.getElementById('validation-overlay');
    const modal = document.getElementById('validation-container');
    const modalTitle = modal.querySelector('.validation-name');
    const modalDescription = modal.querySelector('.description_text');
    const modalImage = modal.querySelector('.validation-image img');

    gamesList.addEventListener('click', function(event) {
        const target = event.target;
        if (target && target.classList.contains('borrow-button')) {
            const gameItem = target.closest('.game');
            if (gameItem) {
                const gameId = gameItem.dataset.id;
                const gameTitle = gameItem.dataset.title;
                const gameDescription = gameItem.dataset.description;
                const gameImage = gameItem.dataset.image;

                modalTitle.textContent = gameTitle;
                modalDescription.textContent = gameDescription;
                modalImage.src = gameImage;

                modal.dataset.gameId = gameId;
                overlay.style.display = 'block';
                modal.style.display = 'flex';
            }
        }
    });

    const cancelButton = document.querySelector('.btn-gray-outline');

    cancelButton.addEventListener('click', function() {
        overlay.style.display = 'none';
        modal.style.display = 'none';
    });

    overlay.addEventListener('click', function() {
        overlay.style.display = 'none';
        modal.style.display = 'none';
    });

    
});




/* ------------------------ TIMER MODAL JS ------------------ */

document.addEventListener("DOMContentLoaded", function() {
    var button = document.getElementById("timerButton");
    var modal = document.getElementById("timerModal");

    button.addEventListener("click", function() {
        modal.classList.toggle("show");
    });

    window.addEventListener("click", function(event) {
        if (event.target == modal) {
            modal.classList.remove("show");
        }
    });
});