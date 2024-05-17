<?php
include "PHP/connect.php";

$profilePicture = "";

if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
    $userId = $_SESSION['id'];
    $userRole = $_SESSION['role'];
    $school_id = $_SESSION['school_id'];

    switch ($userRole) {
        case 'student':
            $sql = "SELECT picture FROM student WHERE id = $userId";
            break;
        case 'teacher':
            $sql = "SELECT picture FROM teacher WHERE id = $userId";
            break;
        default:
            break;
    }

    $result = mysqli_query($con, $sql);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $profilePicture = $row['picture'];

            if (!empty($profilePicture) && is_string($profilePicture)) {
                $base64Image = base64_encode($profilePicture);
                $imageSrc = "data:image/jpeg;base64," . $base64Image;
            } else {
                $imageSrc = "../Pictures/no-user-images.png";
            }
        } else {
            echo "No profile picture found for the user.";
        }
    } else {
        echo "Error executing SQL query: " . mysqli_error($con);
    }
} else {
    echo "Session variables are not set.";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Board Games</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css'>
    <link rel="stylesheet" href="CSS/StudentPage-BoardGames.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="CSS/notification.css?v=<?php echo time(); ?>">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="home">
        <header class="header">
            <div class="header-1">
                <div class="logo-details">
                <img src="../Pictures/STI-Small.png" class="logo">
                <p>STI College Muñoz-EDSA Library</p>
                </div>

                <div class="icons">
                    <i class='bx bx-bell notification'></i>
                    <a href="StudentPage-RetrievalBoardGames.php"><i class='bx bxs-cube-alt book-notification'></i></a>
                    <a href="StudentPage-ProfileHome.php"><img src="<?php echo $imageSrc; ?>" class="profile"></a>
                </div>
            </div>

            <div class="header-2">
                <div class="navbar">
                    <a href="StudentPage-Home.php">Home</a>
                    <a href="StudentPage-Book.php">Book</a>
                    <a href="StudentPage-BoardGames.php">Board Games</a>
                    <a href="StudentPage-PS4.php">PS4</a>
                    <a href="StudentPage-PC.php">PC</a>
                </div>
            </div>

            <div class="notifications_dd">
                <ul class="notifications_ul">
                    <li class="success">
                        <?php

                            $student_id = $school_id;
                            $sql = "SELECT * FROM notification WHERE student_id = '$student_id' LIMIT 5";
                            $result = $con->query($sql);

                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    $notification_id = $row["id"];
                                    $admin_id = $row["admin_id"];
                                    $admin_name = $row["admin_name"];
                                    $admin_picture = $row["admin_picture"];
                                    $student_id = $row["student_id"];
                                    $title = $row['title'];
                                    $name = $row["name"];
                                    $message = $row["message"];
                                    
                                    echo "<li>";
                                    echo "<div class='notify_icon'><img src='data:image/jpeg;base64," . $admin_picture . "'></div>";
                                    echo "<div class='notify_data'>";
                                    echo "<div class='title'>".$title."</div>";
                                    echo "<div class='sub_title'>".$message."</div>";
                                    echo "</div>";
                                    echo "</li>";
                                }
                            } else {
                                echo "No notifications found.";
                            }
                            ?>
                    <li class="show_all">
                        <a href="StudentPage-Notifications.php" class="link">Show All Notifications</a>
                    </li>
                </ul>
            </div>

        </header>

        <!------------------------------- END OF HEADER ------------------------->

        <div class="bottom-navbar">
            <a href="StudentPage-Home.php"><i class='bx bxs-home'></i></a>
                <a href="StudentPage-Book.php"><i class='bx bxs-book-alt'></i></a>
                <a href="StudentPage-BoardGames.php"><i class='bx bxs-cube-alt'></i></a>
                <a href="StudentPage-PS4.php"><i class='bx bxs-joystick'></i></a>
                <a href="StudentPage-PC.php"><i class='bx bx-desktop'></i></a>
        </div>

        <!------------------------------- END OF BOTTOM NAVBAR ------------------------->

        <div class="slider">
            <div class="list">
                <div class="item active">
                    <img src="../Pictures/Chess.jpeg" alt="Chess">
                    <div class="content">
                        <p>Chess</p>
                        <h2>Genius Player Strikes!</h2>
                        <p>
                            Chess is a two-player strategy board game that originated in India around the 6th century. It is played on an 8x8 grid with pieces representing medieval characters 
                            such as kings, queens, bishops, knights, rooks, and pawns. The objective of the game is to checkmate the opponent's king, a situation in which the king is in a position 
                            to be captured and cannot escape capture.
                        </p>
                    </div>
                </div>
                <div class="item">
                    <img src="../Pictures/SnL.jpg" alt="Snake and Ladder">
                    <div class="content">
                        <p>Snake and Ladder</p>
                        <h2>Slithering Through Win</h2>
                        <p>
                            Snake and Ladder, also known as Chutes and Ladders, is a classic board game played by two or more players. 
                            The game features a grid with numbered squares, and players take turns rolling a dice and moving their token along the grid. 
                            The goal is to reach the final square first. The game incorporates ladders that allow players to advance quickly and snakes that force players to move backward.
                    </div>
                </div>
                <div class="item">
                    <img src="../Pictures/uno.png" alt="Uno">
                    <div class="content">
                        <p>Uno</p>
                        <h2>Caught You! UNO</h2>
                        <p>
                            UNO is a popular card game designed for two or more players. Each player starts with a hand of cards, and the objective is to be the first to get rid of all cards. 
                            Players take turns matching a card from their hand to the card on top of the discard pile based on either color, number, or action. 
                            Special action cards introduce elements such as skipping turns, reversing the order of play, or forcing opponents to draw additional cards.
                        </p>
                    </div>
                </div>
                <div class="item">
                    <img src="../Pictures/guessWho.jpg" alt="Guess Who">
                    <div class="content">
                        <p>Guess Who</p>
                        <h2>Who Is The Missing Link?</h2>
                        <p>
                            Guess Who is a two-player guessing game where each player selects a character card from a set of cards depicting different people. 
                            Players take turns asking yes or no questions to narrow down the possibilities and guess the opponent's character. 
                            The first player to correctly guess the opponent's character wins the game.
                        </p>
                    </div>
                </div>
                <div class="item">
                    <img src="../Pictures/scrabble.png" alt="scrabble">
                    <div class="content">
                        <p>Scrabble</p>
                        <h2>Scrabble Letters</h2>
                        <p>
                            Scrabble is a word game where players use letter tiles to form words on a game board. 
                            Each letter tile has a point value, and players score points by creating words that intersect with existing words on the board. 
                            The game requires strategy and vocabulary skills, as players aim to create high-scoring words while blocking their opponents from doing the same.
                        </p>
                    </div>
                </div>
            </div>

            <div class="arrows">
                <button id="prev"><</button>
                <button id="next">></button>
            </div>

            <div class="thumbnail">
                <div class="item active">
                    <img src="../Pictures/chessThumbnail.png" alt="">
                    <div class="content">
                        Chess
                    </div>
                </div>
                <div class="item">
                    <img src="../Pictures/SnLThumbnails.png" alt="">
                    <div class="content">
                        Snake and Ladder
                    </div>
                </div>
                <div class="item">
                    <img src="../Pictures/UNOThumbnail.png" alt="">
                    <div class="content">
                        UNO!
                    </div>
                </div>
                <div class="item">
                    <img src="../Pictures/GuessWhoThumbnail.png" alt="">
                    <div class="content">
                        Guess Who
                    </div>
                </div>
                <div class="item">
                    <img src="../Pictures/ScrabbleThumbnail.png" alt="">
                    <div class="content">
                        Scrabble
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="listing-container">
        <div class="search-container">
            <input type="text" id="search" placeholder="Search...">
            <i class="fas fa-search search-icon"></i>
        </div>
        <div class="listing">
        <?php
        function isBoardGameFavorited($userId, $boardGameId, $con) {
            $query = "SELECT * FROM favorite_board WHERE user_id = $userId AND board_id = $boardGameId";
            $result = mysqli_query($con, $query);
            return mysqli_num_rows($result) > 0;
        }
        
        $userId = isset($_SESSION['id']) ? $_SESSION['id'] : null;
        
        $query = "SELECT id, cover, name, description, quantity FROM board_games";
        $result = mysqli_query($con, $query);
        
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $availability = ($row['quantity'] > 0) ? 'available' : 'unavailable';
                $boardGameId = $row['id'];
        
                $isFavorited = $userId ? isBoardGameFavorited($userId, $boardGameId, $con) : false;
        
                echo '<div class="card">';
                echo '<div class="wrapper">';
                echo '<div class="colorProd"></div>';
                echo '<a href="#">';
                echo '<div class="imgProd" id="image_' . $row['id'] . '" style="background-image: url(data:image/jpeg;base64,' . $row['cover'] . ');"></div>';
                echo '</a>';
                echo '<div class="infoProd">';
                echo '<p class="nombreProd" id="name_' . $row['id'] . '">' . $row['name'] . '</p>';
                echo '<p class="extraInfo ' . $availability . '">' . (($availability == 'available') ? 'Available' : 'Unavailable') . '</p>';
                echo '<div class="actions">';
                echo '<div class="preciosGrupo">';
                echo '<p class="precio precioOferta">Quantity</p>';
                echo '<p class="precio precioProd" id="quantity_' . $row['id'] . '">' . $row['quantity'] . '</p>';
                echo '</div>';
                echo '<div class="icono action aFavs" 
                data-board-id="' . $row['id'] . '" 
                data-cover="' . $row['cover'] . '" 
                data-name="' . $row['name'] . '" 
                data-description="' . $row['description'] . '">';
                echo '<i id="heartIcon_' . $row['id'] . '" class="bx bx-heart' . ($isFavorited ? ' red-heart' : '') . '"></i>';
                echo '</div>';
                echo '<div class="icono action alCarrito" 
                      data-board-id="' . $row['id'] . '" 
                      data-name="' . $row['name'] . '" 
                      data-message="You have chosen the board game. Please proceed to the librarian to receive the board." 
                      data-picture="' . $row['cover'] . '" 
                      onclick="reduceQuantity(' . $row['id'] . ')" >';
                echo '<i class="bx bx-dice-3 outCart"></i>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "No games found!";
        }
        ?>
        </div>
        <div class="notification-container"></div>
        <div class="toast"></div>
    </div>
    <script src="JAVASCRIPT/StudentPage-BoardGames.js?v=<?php echo time(); ?>"></script>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

$(document).ready(function() {
    $(".aFavs").click(function(event) {
        var heartIcon = $(this).find(".bx-heart");
        var boardGameId = $(this).data("board-id");
        var isFavorited = heartIcon.hasClass("red-heart");
        var cover = $(this).data("cover");
        var name = $(this).data("name");
        var description = $(this).data("description");

        var action = isFavorited ? "remove" : "add";

        var title = name;
        var message = action === "add" ? "You have favorited " + title + "." : "You have removed " + title + " from favorites.";
        var image = cover;

        var notification = $('<div class="add-to-notification">\
                                <div class="notification-img">\
                                    <img src="data:image/jpeg;base64,' + image + '" alt="">\
                                </div>\
                                <div class="notification-description">\
                                    <h4>' + title + '</h4>\
                                    <p>' + message + '</p>\
                                </div>\
                                <div class="progress-bar">\
                                    <div class="progress"></div>\
                                </div>\
                            </div>');

        $(".notification-container").prepend(notification);

        notification.slideDown();

        setTimeout(function() {
            notification.slideUp(function() {
                $(this).remove();
            });
        }, 5000);

        toggleFavorite(boardGameId, action === "remove", cover, name, description, function(response) {
            console.log("Toggle favorite response:", response);
            heartIcon.toggleClass("red-heart", action === "add" && response === "added");
        });
    });
});



function toggleFavorite(boardGameId, isFavorited, cover, name, description, callback) {
    $.ajax({
        url: "PHP/board_toggle_favorite.php",
        method: "POST",
        data: { 
            boardGameId: boardGameId, 
            isFavorited: isFavorited,
            cover: cover,
            name: name,
            description: description
        },
        success: function(response) {
            callback(response);
        },
        error: function(xhr, status, error) {
            console.error("Error:", error);
        }
    });
}


$(document).ready(function() {
    $(".alCarrito").click(function() {
        var id = $(this).data("board-id");    
        var title = $(this).data("name");
        var message = $(this).data("message");
        var image = $(this).data("picture");
        
        $(this).toggleClass("active");
        
        if ($(this).hasClass("active")) {
            
            var notification = $('<div class="add-to-notification">\
                                    <div class="notification-img">\
                                        <img src="data:image/jpeg;base64,' + image + '" alt="">\
                                    </div>\
                                    <div class="notification-description">\
                                        <h4>' + title + '</h4>\
                                        <p>' + message + '</p>\
                                    </div>\
                                    <div class="progress-bar">\
                                        <div class="progress"></div>\
                                    </div>\
                                </div>');

            $(".notification-container").prepend(notification);

            notification.slideDown();

            setTimeout(function() {
                notification.slideUp(function() {
                    $(this).remove();
                });
            }, 5000);

        } else {
            
        }
    });
});

function reduceQuantity(gameId) {
    var userId = <?php echo json_encode($_SESSION['id']); ?>;
    var userName = <?php echo json_encode($_SESSION['name']); ?>;
    var gameNameElem = document.getElementById('name_' + gameId);
    var gameImageElem = document.getElementById('image_' + gameId);
    var gameName = gameNameElem ? gameNameElem.innerText : '';
    var gameImage = gameImageElem ? getBackgroundImageURL(gameImageElem) : '';

    if (gameName) {
        console.log("Game Name:", gameName);
        console.log("Game Image:", gameImage);

        var currentDate = new Date();
        var hours = currentDate.getHours();
        var minutes = currentDate.getMinutes();
        var ampm = hours >= 12 ? 'PM' : 'AM';
        hours = hours % 12;
        hours = hours ? hours : 12;
        var timestamp = hours + ':' + minutes + ' ' + ampm;
        var date = currentDate.toISOString().slice(0, 10);

        $.ajax({
            type: 'POST',
            url: 'PHP/insert_activity.php',
            data: {
                game_id: gameId,
                user_id: userId,
                user_name: userName,
                timestamp: timestamp,
                date: date
            },
            success: function(response) {
                console.log(response);
                var quantityElem = $('#quantity_' + gameId);
                var currentQuantity = parseInt(quantityElem.text());
                if (currentQuantity > 0) {
                    var newQuantity = currentQuantity - 1;
                    quantityElem.text(newQuantity);
                    showCustomToast(`The '${gameName}' has been received. Please go to the librarian to receive the item.`, true);
                } else {
                    showCustomToast("The item you are trying to get is already run out and in use.", false);
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    } else {
        console.log("Could not find game name element.");
    }
}

function getBackgroundImageURL(element) {
    var backgroundImage = element.style.backgroundImage;
    if (backgroundImage) {
        var matches = backgroundImage.match(/url\(['"]?(.*?)['"]?\)/);
        if (matches && matches.length > 1) {
            return matches[1];
        }
    }
    return null;
}


function showCustomToast(message, isSuccess) {
    const toastContainer = document.querySelector('.toast');
    const toast = document.createElement("div");
    toast.classList.add("custom-toast");

    if (isSuccess) {
        toast.classList.add("success");
    } else {
        toast.classList.add("failed");
    }

    const iconClass = isSuccess ? "fa-check-circle" : "fa-times-circle";

    toast.innerHTML = `
        <i class="fas ${iconClass}"></i>
        <p>${message}</p>
    `;

    toastContainer.appendChild(toast);

    setTimeout(function() {
        toast.remove();
    }, 5000);
}

</script>