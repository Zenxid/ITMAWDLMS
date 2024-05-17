<?php
include "..\PHP\connect.php";

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
        case 'admin':
            $sql = "SELECT picture FROM admin WHERE id = $userId";
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
    <title>PC</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400..900&display=swap" rel="stylesheet">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css'>
    <link rel="stylesheet" href="CSS/StudentPage-PC.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="CSS/notification.css?v=<?php echo time(); ?>">

    <style>
          .pc-image {
            background-image: url('../Pictures/pc.png');
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
                    <a href="StudentPage-RetrievalPC.php"><i class='bx bx-desktop book-notification'></i></a>
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

            <div class="borrow-book">
                <div class="book-box">
                    <i class='bx bxs-trash trash' ></i>
                    <img src="../Pictures/Book2.png" alt="image">
                    <div class="book-content">
                        <h3>Book</h3>
                        <span class="quantity">Quantity: 1</span>
                    </div>
                </div>
                <div class="book-box">
                    <i class='bx bxs-trash trash' ></i>
                    <img src="../Pictures/Book3.png" alt="image">
                    <div class="book-content">
                        <h3>Book</h3>
                        <span class="quantity">Quantity: 1</span>
                    </div>
                </div>
                <div class="book-box">
                    <i class='bx bxs-trash trash' ></i>
                    <img src="../Pictures/Book4.png" alt="image">
                    <div class="book-content">
                        <h3>Book</h3>
                        <span class="quantity">Quantity: 1</span>
                    </div>
                </div>
                <div class="book-box">
                    <i class='bx bxs-trash trash' ></i>
                    <img src="../Pictures/Book5.png" alt="image">
                    <div class="book-content">
                        <h3>Book</h3>
                        <span class="quantity">Quantity: 1</span>
                    </div>
                </div>
                <div class="book-box">
                    <i class='bx bxs-trash trash' ></i>
                    <img src="../Pictures/Book6.png" alt="image">
                    <div class="book-content">
                        <h3>Book</h3>
                        <span class="quantity">Quantity: 1</span>
                    </div>
                </div>
                <a href="#" class="borrow-btn">Borrow</a>
                <a href="StudentPage-Borrowing.html" class="view-btn">View Books</a>
            </div>

        </header>

        <!------------------------------- END OF HEADER ------------------------->

        <div class="bottom-navbar">
            <a href="StudentPage-Home.html"><i class='bx bxs-home'></i></a>
                <a href="StudentPage-Book.html"><i class='bx bxs-book-alt'></i></a>
                <a href="StudentPage-BoardGames.php"><i class='bx bxs-cube-alt'></i></a>
                <a href="StudentPage-PS4.php"><i class='bx bxs-joystick'></i></a>
                <a href="StudentPage-PC.html"><i class='bx bx-desktop'></i></a>
        </div>

        <!------------------------------- END OF BOTTOM NAVBAR ------------------------->

        <div class="clock">
            <div class="clock-container">
                <div id="clock"></div>
            </div>
        </div>
        <?php
        $sql = "SELECT pc.id, pc.cover, pc.name, pa.user_pic, pa.user_name, pa.timestamp, pa.date
                FROM pc
                LEFT JOIN pc_activity pa ON pc.id = pa.pc_id";
        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $time = strtotime($row['timestamp']);
                $date = strtotime($row['date']);
                $formattedDate = date("F j, Y", $date);
                $formattedTime = date("h:i A", $time);
                $pcCurrentlyInUse = ($row['user_name'] !== null && $row['user_name'] !== '') ? true : false;
        ?>
                <div class="doppel-container">
                    <div class="container">
                        <div class="left-section">
                            <div class="pc-image" style="background-image: url(data:image/jpeg;base64,'<?php echo $row['cover']; ?>');"></div>
                            <div class="profile-info">
                            <?php if ($row['user_name'] !== null && $row['user_name'] !== '') { ?>
                                <img src="<?php echo $row['user_pic']; ?>" alt="Profile Picture" class="profile-pic">
                                <span class="profile-name"><?php echo $row['user_name']; ?></span>
                            <?php } else { ?>
                                <img src="../Pictures/no-user-images.png" alt="Profile Picture" class="profile-pic">
                                <span class="profile-name">No User</span>
                            <?php } ?>
                            </div>
                        </div>
                        <div class="right-section">
                            <div class="pc-details">
                                <span class="pc-name"><?php echo $row['name']; ?></span>
                                <button class="timer-btn"><i class='bx bx-timer timer'></i></button>
                            </div>
                            <div class="center">
                            <?php if ($pcCurrentlyInUse) { ?>
                                <span class="pc-status" style="color: red;">CURRENTLY NOT AVAILABLE</span>
                            <?php } else { ?>
                                <span class="pc-status" style="color: green;">AVAILABLE</span>
                                <button class="use-pc-button" data-pc-id="<?php echo $row['id']; ?>" data-picture="<?php echo $row['cover']; ?>" data-name="<?php echo $row['name']; ?>" data-message="You have chosen a pc and started the timer">Use This PC</button>
                            <?php } ?>
                            </div>
                            <div class="timestamp"><?php echo $formattedDate . " " . $formattedTime; ?></div>
                        </div>
                    </div>
                    <div class="timer-container">
                        <div class="timer-content">
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
                    </div>
                </div>
        <?php
            }
        } else {
            echo "0 results";
        }
        ?>
        <div class="notification-container"></div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>   
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="JAVASCRIPT/StudentPage-PC.js?v=<?php echo time(); ?>"></script>
</body>
</html>

<script>

$(document).ready(function() {
    $(".use-pc-button").click(function() {
        var id = $(this).data("pc-id");    
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

$(document).ready(function() {
    $('.timer-btn').click(function() {
        var timerContainer = $(this).closest('.doppel-container').find('.timer-container');
        toggleTimerContainer(timerContainer);
    });

    function toggleTimerContainer(timerContainer) {
        var timerContent = timerContainer.find('.timer-content');

        if (!timerContainer.hasClass('show')) {
            timerContainer.addClass('show');
            timerContent.each(function(i) {
                $(this).css('animation-delay', i * 0.2 + 's');
            });
        } else {
            timerContainer.removeClass('show');
            timerContainer.addClass('slide-out');
            timerContent.addClass('slide-out');
            setTimeout(function() {
                timerContainer.removeClass('show');
                timerContainer.removeClass('slide-out');
                timerContent.removeClass('slide-out');
            }, 500);
        }
    }
});
$(document).ready(function() {
    $(".use-pc-button").click(function() {
        var pcId = $(this).data("pc-id");
        var picture = $(this).data("picture");
        var name = $(this).data("name");
        
        var userPic = <?php echo isset($imageSrc) ? json_encode($imageSrc) : "''"; ?>;
        var userName = <?php echo isset($_SESSION['name']) ? json_encode($_SESSION['name']) : "''"; ?>;
        var userId = <?php echo isset($_SESSION['id']) ? json_encode($_SESSION['id']) : "''"; ?>;
        
        $.post("PHP/insert_to_PCactivity.php", {
            pc_id: pcId,
            picture: picture,
            name: name,
            user_pic: userPic,
            user_name: userName,
            user_id: userId
        }, function(response) {
            showCustomToast("You have started PC", true);
        });
    });
});

$(document).ready(function() {
    $.ajax({
        type: 'GET',
        url: 'PHP/pc_fetch_user_timer_data.php',
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
        }
    });
});

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

</script>