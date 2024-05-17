<?php
include 'PHP/connect.php';

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
    <title>PS4 Games</title>
    <link rel="stylesheet" href="CSS/StudentPage-PS4.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="CSS/notification.css?v=<?php echo time(); ?>">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css'>
    <style>
        .banner {
            background: url(../Pictures/spiderman_background.jpeg) no-repeat;
            background-size: cover;
            background-position: center;
        }
    </style>
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
                    <a href="StudentPage-RetrievalPS4.php"><i class='bx bx-joystick book-notification'></i></a>
                    <a href="StudentPage-ProfileHome.php"><img src="<?php echo $imageSrc; ?>"></a>
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

        <div class="banner">
            <div class="content spidermanPS4 active">
                <img src="../Pictures/Spiderman-Title.png" alt="" class="game-title">
                <h4>
                    <span>2020</span><span><i>PG-13</i></span>
                    <span>Action</span>
                </h4>
                <p>
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. 
                    Nemo ipsam inventore quam temporibus veritatis 
                    tempora tempore voluptatum saepe numquam minus.
                </p>
                <div class="button">
                    <a href="#"><i class='bx bx-game'></i> Play</a>
                    <a href="#"><i class='bx bx-star'></i> Add to Favorite</a>
                </div>
            </div>
            <div class="content GodOfWar">
                <img src="../Pictures/A_God_of_War_logo.webp" alt="" class="game-title">
                <h4>
                    <span>2018</span><span><i>M</i></span>
                    <span>Action</span>
                </h4>
                <p>
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. 
                    Nemo ipsam inventore quam temporibus veritatis 
                    tempora tempore voluptatum saepe numquam minus.
                </p>
                <div class="button">
                    <a href="#"><i class='bx bx-game'></i> Play</a>
                    <a href="#"><i class='bx bx-star'></i> Add to Favorite</a>
                </div>
            </div>
            <div class="content Tekken7">
                <img src="../Pictures/Tekken7-console-logo.webp" alt="" class="game-title">
                <h4>
                    <span>2015</span><span><i>M</i></span>
                    <span>Action</span>
                </h4>
                <p>
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. 
                    Nemo ipsam inventore quam temporibus veritatis 
                    tempora tempore voluptatum saepe numquam minus.
                </p>
                <div class="button">
                    <a href="#"><i class='bx bx-game'></i> Play</a>
                    <a href="#"><i class='bx bx-star'></i> Add to Favorite</a>
                </div>
            </div>

            <div class="content JustDance">
                <img src="../Pictures/JustDanceLogo.webp" alt="" class="game-title">
                <h4>
                    <span>2017</span><span><i>E</i></span>
                    <span>Rhythm</span>
                </h4>
                <p>
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. 
                    Nemo ipsam inventore quam temporibus veritatis 
                    tempora tempore voluptatum saepe numquam minus.
                </p>
                <div class="button">
                    <a href="#"><i class='bx bx-game'></i> Play</a>
                    <a href="#"><i class='bx bx-star'></i> Add to Favorite</a>
                </div>
            </div>
            <div class="content MilesMorales">
                <img src="../Pictures/Marvel's_Spider-Man_Miles_Morales_Logo.png" alt="" class="game-title">
                <h4>
                    <span>2023</span><span><i>PG-13</i></span>
                    <span>Action</span>
                </h4>
                <p>
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. 
                    Nemo ipsam inventore quam temporibus veritatis 
                    tempora tempore voluptatum saepe numquam minus.
                </p>
                <div class="button">
                    <a href="#"><i class='bx bx-game'></i> Play</a>
                    <a href="#"><i class='bx bx-star'></i> Add to Favorite</a>
                </div>
            </div>
            <div class="carousel-box">
                <div class="carousel">
                    <div class="carousel-item"
                    data-trailer-id="https://www.youtube.com/watch?v=8pR0o2fGyHg"
                    onclick="changeBg('spiderman_background.jpeg', 'spidermanPS4', 'https://www.youtube.com/watch?v=8pR0o2fGyHg')">
                        <img src="../Pictures/Spider-Man_PS4_cover.jpg" alt="">
                    </div>
                    <div class="carousel-item"
                    data-trailer-id="https://www.youtube.com/watch?v=K0u_kAWLJOA"
                    onclick="changeBg('GodOfWar_Background.png', 'GodOfWar', 'https://www.youtube.com/watch?v=K0u_kAWLJOA')">
                        <img src="../Pictures/God_of_War_4_cover.jpg" alt="">
                    </div>
                    <div class="carousel-item"
                    data-trailer-id="https://www.youtube.com/watch?v=uEnz36xOSs4"
                    onclick="changeBg('Tekken7_Background.jpg', 'Tekken7', 'https://www.youtube.com/watch?v=uEnz36xOSs4')">
                        <img src="../Pictures/Tekken7_cover.jpg" alt="">
                    </div>
                    <div class="carousel-item"
                    data-trailer-id="https://www.youtube.com/watch?v=ImyPgavCOG4"
                    onclick="changeBg('JustDance_Background.jpg', 'JustDance', 'https://www.youtube.com/watch?v=ImyPgavCOG4')">
                        <img src="../Pictures/justDance_cover_.jpg" alt="">
                    </div>
                    <div class="carousel-item"
                    data-trailer-id="https://www.youtube.com/watch?v=oZXyrAfuHOo"
                    onclick="changeBg('SpiderMan_MilesMorales_Background.jpg', 'MilesMorales', 'https://www.youtube.com/watch?v=oZXyrAfuHOo')">
                        <img src="../Pictures/Spider-Man_Miles_Morales_cover.jpeg" alt="">
                    </div>
                </div>
            </div>
            <a href="#" class="play" id="playTrailer" data-trailer-id=""><i class='bx bx-slideshow'></i> Watch Trailer</a>

        </div>
        <!-------------------- END OF BANNER --------------->
        <main>
            <p class="reminder">PS4 is Currently In Used</p>
            <div class="container">
                <aside>
                    <input type="text" id="search" placeholder="Search...">
                    <h2>Filter by Genre</h2>
                    <ul>
                    <?php
                        $sql = "SELECT DISTINCT genre FROM ps4";

                        $result = mysqli_query($con, $sql);

                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $genre = $row['genre'];
                                echo '<li><input type="checkbox" id="' . strtolower($genre) . '" onclick="updateDisplayedGames()"><label for="' . strtolower($genre) . '" onclick="toggleBold(\'' . strtolower($genre) . '\')">' . $genre . '</label></li>';
                            }
                        } else {
                            echo "Error fetching genres: " . mysqli_error($con);
                        }

                        ?>
                    </ul>
                </aside>
                <section id="games-list">
                    <?php
                    
                    function isBoardGameFavorited($userId, $ps4GameId, $con) {
                        $query = "SELECT * FROM favorite_ps4 WHERE user_id = $userId AND ps4_id = $ps4GameId";
                        $result = mysqli_query($con, $query);
                        return mysqli_num_rows($result) > 0;
                    }
                    
                    $userId = isset($_SESSION['id']) ? $_SESSION['id'] : null;

                    $select_query = "SELECT * FROM `ps4`";
                    $result = mysqli_query($con, $select_query);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {

                            $ps4GameId = $row['id'];
                            $isFavorited = $userId ? isBoardGameFavorited($userId, $ps4GameId, $con) : false;

                            echo '<div class="game" data-id="' . $row['id'] . '" data-genre="' . $row['genre'] . '" data-title="' . $row['name'] . '" data-description="' . $row['description'] . '" data-image="data:image/jpeg;base64,' . $row['cover'] . '">';
                            echo '<div class="photo">';
                            echo '<img src="data:image/jpeg;base64,' . $row['cover'] . '" alt="' . $row['name'] . '">';
                            echo '</div>';
                            echo '<div class="description">';
                            echo '<svg class="heart" version="1.1" viewBox="0 0 512 512" width="512px" xml:space="preserve" stroke="#727272" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            data-ps4-id="' . $row['id'] . '" 
                            data-cover="' . $row['cover'] . '" 
                            data-name="' . $row['name'] . '" 
                            data-description="' . $row['description'] . '" >';
                            echo '<path id="heartIcon_' . $row['id'] . '" class="heart-path ' . ($isFavorited ? ' red-heart' : '') . '" d="M340.8,98.4c50.7,0,91.9,41.3,91.9,92.3c0,26.2-10.9,49.8-28.3,66.6L256,407.1L105,254.6c-15.8-16.6-25.6-39.1-25.6-63.9  c0-51,41.1-92.3,91.9-92.3c38.2,0,70.9,23.4,84.8,56.8C269.8,121.9,302.6,98.4,340.8,98.4 M340.8,83C307,83,276,98.8,256,124.8  c-20-26-51-41.8-84.8-41.8C112.1,83,64,131.3,64,190.7c0,27.9,10.6,54.4,29.9,74.6L245.1,418l10.9,11l10.9-11l148.3-149.8  c21-20.3,32.8-47.9,32.8-77.5C448,131.3,399.9,83,340.8,83L340.8,83z" stroke="#727272"/>';
                            echo '</svg>';
                            echo '<h2>' . $row['name'] . '</h2>';
                            echo '<h4>' . $row['genre'] . '</h4>';
                            echo '<p>' . $row['description'] . '</p>';
                            echo '<button class="borrow-button">Play</button>';
                            echo '<button>Details</button>';
                            echo '</div>';
                            echo '</div>';
                        }
                    }
                    ?>
                </section>
            </div>
            <div class="validation-overlay" id="validation-overlay"></div>
            <div class="validation-container" id="validation-container">
                <div class="validation-card">
                    <div class="validation-card-header">
                        <div class="validation-image">
                            <img src="/Pictures/Spider-Man_PS4_cover.jpg" alt="">
                        </div>
                
                        <div class="validation-info">
                            <h3 class="validation-name">Marvel Spider-Man</h3>
                            <p class="validation-desc">Action</p>
                        </div>
                    </div>
                
                    <div class="validation-card-body">
                        <p class="description_text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem fugit repellendus voluptate aut rem ipsa eligendi earum suscipit sit, ea alias sed expedita vitae ad cum accusamus, exercitationem optio natus.</p>
                        <div class="action">
                            <button class="btn btn-pink">Confirm</button>
                            <button class="btn btn-gray-outline">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="timer-container" id="timerButton">
                <i class='bx bx-timer timer'></i>
            </div>

            <div class="timer-modal" id="timerModal">
                <div class="container-segment">
                    <div class="segment-title">Hours</div>
                    <div class="segment">
                        <div class="flip-card" data-hours-tens>
                        <div class="top">0</div>
                        <div class="bottom">0</div>
                        </div>
                        <div class="flip-card" data-hours-ones>
                        <div class="top">0</div>
                        <div class="bottom">0</div>
                        </div>
                    </div>
                    </div>
                    <div class="container-segment">
                    <div class="segment-title">Minutes</div>
                    <div class="segment">
                        <div class="flip-card" data-minutes-tens>
                        <div class="top">0</div>
                        <div class="bottom">0</div>
                        </div>
                        <div class="flip-card" data-minutes-ones>
                        <div class="top">0</div>
                        <div class="bottom">0</div>
                        </div>
                    </div>
                    </div>
                    <div class="container-segment">
                    <div class="segment-title">Seconds</div>
                    <div class="segment">
                        <div class="flip-card" data-seconds-tens>
                        <div class="top">0</div>
                        <div class="bottom">0</div>
                        </div>
                        <div class="flip-card" data-seconds-ones>
                        <div class="top">0</div>
                        <div class="bottom">0</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="notification-container"></div>
            <div class="toast"></div>
        </main>
        <footer>
            <div class="container">
                <p>&copy; 2023 Library Management System</p>
            </div>
        </footer>
        
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="JAVASCRIPT/StudentPage-PS4.js?v=<?php echo time(); ?>"></script>
    <script>
        $(document).ready(function () {
            $('.carousel').carousel();
        });

    </script>
    
</body>
</html>

<script>

$(document).ready(function() {
    $(".heart").click(function(event) {
        var heartIcon = $(this).find(".heart-path");
        var ps4GameId = $(this).data("ps4-id");
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

        toggleFavorite(ps4GameId, action === "remove", cover, name, description, function(response) {
            console.log("Toggle favorite response:", response);
            heartIcon.toggleClass("red-heart", action === "add" && response === "added");
        });
    });
});


function toggleFavorite(ps4GameId, isFavorited, cover, name, description, callback) {
    $.ajax({
        url: "PHP/ps4_toggle_favorite.php",
        method: "POST",
        data: { 
            ps4GameId: ps4GameId, 
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
    $('.btn-pink').on('click', function() {
        var gameId = $('#validation-container').data('game-id');
        var gamePicture = $('#validation-container .validation-image img').attr('src');
        var gameName = $('#validation-container .validation-name').text();
        
        var userPic = "<?php echo $imageSrc; ?>";
        var userName = "<?php echo $_SESSION['name']; ?>";
        var userId = "<?php echo $_SESSION['id']; ?>";
        
        var timestamp = new Date().toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', second: 'numeric', hour12: false });
        var date = new Date().toISOString().split('T')[0];
        
        $.ajax({
            type: 'POST',
            url: 'PHP/insert_PS4.php',
            data: {
                game_id: gameId,
                picture: gamePicture,
                name: gameName,
                user_pic: userPic,
                user_name: userName,
                user_id: userId,
                timestamp: timestamp,
                date: date
            },
            success: function(response) {
                console.log(response);
                showCustomToast("PS4 Game has been added successfully.", true);
                startCountdown(response);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                showCustomToast("Error inserting data.", false);
            }
        });
    });
});

$(document).ready(function() {
    $.ajax({
        type: 'GET',
        url: 'PHP/ps4_fetch_user_timer_data.php',
        dataType: 'json',
        success: function(response) {
            if (response.due_time) {
                startCountdown(response.due_time);
            } else {
                console.error('Error fetching user timer data:', response.error);
            }
        },
        error: function(xhr, status, error) {
            console.error('Ajax error:', error);
            showCustomToast("Ajax error.", false);
        }
    });
});

$(document).ready(function() {
    function checkPS4Usage() {
        $.ajax({
            type: 'GET',
            url: 'PHP/check_ps4_usage.php',
            dataType: 'json',
            success: function(response) {
                if (response.isActive) {
                    $('.reminder').show();
                } else {
                    $('.reminder').hide();
                }
            },
            error: function(xhr, status, error) {
                console.error('Error checking PS4 usage:', error);
            }
        });
    }

    checkPS4Usage();

    setInterval(checkPS4Usage, 5000);
});


function startCountdown(dueTime) {
    const countToDate = new Date();
    const [hours, minutes, seconds] = dueTime.split(':').map(Number);

    countToDate.setHours(hours, minutes, seconds);

    let previousTimeBetweenDates;

    setInterval(() => {
        const currentTime = new Date();
        const timeDifference = Math.ceil((countToDate - currentTime) / 1000);

        if (timeDifference <= 0) {
            clearInterval(intervalId);
            showCustomToast("Countdown stopped. Due time reached.", false);
            return;
        }

        flipAllCards(timeDifference);

        previousTimeBetweenDates = timeDifference;
    }, 250);
}



function flipAllCards(time) {
    const seconds = time % 60;
    const minutes = Math.floor(time / 60) % 60;
    const hours = Math.floor(time / 3600);

    flip(document.querySelector("[data-hours-tens]"), Math.floor(hours / 10));
    flip(document.querySelector("[data-hours-ones]"), hours % 10);
    flip(document.querySelector("[data-minutes-tens]"), Math.floor(minutes / 10));
    flip(document.querySelector("[data-minutes-ones]"), minutes % 10);
    flip(document.querySelector("[data-seconds-tens]"), Math.floor(seconds / 10));
    flip(document.querySelector("[data-seconds-ones]"), seconds % 10);
}

function flip(flipCard, newNumber) {
    const topHalf = flipCard.querySelector(".top");
    const startNumber = parseInt(topHalf.textContent);
    if (newNumber === startNumber) return;

    const bottomHalf = flipCard.querySelector(".bottom");
    const topFlip = document.createElement("div");
    topFlip.classList.add("top-flip");
    const bottomFlip = document.createElement("div");
    bottomFlip.classList.add("bottom-flip");

    topFlip.textContent = startNumber;
    bottomFlip.textContent = newNumber;

    topFlip.addEventListener("animationstart", e => {
        topHalf.textContent = newNumber;
    });
  
    topFlip.addEventListener("animationend", e => {
        topFlip.remove();
    });
    bottomFlip.addEventListener("animationend", e => {
        bottomHalf.textContent = newNumber;
        bottomFlip.remove();
    });
    flipCard.append(topFlip, bottomFlip);
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

