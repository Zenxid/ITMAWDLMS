<?php
include 'PHP/connect.php';
if (!isset($_SESSION['id'])) {
    header("Location: ../LoginForm.php");
    exit();
}



$id = $_SESSION['id'];
$sql = "SELECT * FROM admin WHERE id = '$id'";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $school_id = $row['school_id'];
    $admin_name = $row['name'];
    $role = $row['role'];
    $imageData = base64_encode($row['picture']);
} else {
    header("Location: ../LoginForm.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timer</title>
    <link rel="stylesheet" href="CSS/toast.css?V=<?php echo time() ?>">
    <link rel="stylesheet" href="CSS/sidebar.css?v=<?php echo time() ?>">
    <link rel="stylesheet" href="CSS/Timer.css?v=<?php echo time() ?>">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
<body>
<script>

let notificationTriggered = false;
function startCountdown(dueTime) {
    const countToDate = new Date();
    const [hours, minutes, seconds] = dueTime.split(':').map(Number);

    countToDate.setHours(hours, minutes, seconds);

    let previousTimeBetweenDates;

    setInterval(() => {
        const currentTime = new Date();
        const timeDifference = Math.ceil((countToDate - currentTime) / 1000);
        

        if (timeDifference <= -1) {
            clearInterval(intervalId);
            return;
        }

        flipAllCards(timeDifference, 'third');

        previousTimeBetweenDates = timeDifference;

        if (!notificationTriggered && timeDifference === 300) {
            insertNotification();
            notificationTriggered = true;
        }
    }, 250);
}

function startCountdownFirstTimer(dueTime) {
    const countToDate = new Date();
    const [hours, minutes, seconds] = dueTime.split(':').map(Number);

    countToDate.setHours(hours, minutes, seconds);

    let previousTimeBetweenDates;

    const intervalId = setInterval(() => {
        const currentTime = new Date();
        const timeDifference = Math.ceil((countToDate - currentTime) / 1000);
        
        if (timeDifference <= -1) {
            clearInterval(intervalId);
            return;
        }

        flipAllCards(timeDifference, 'first');

        previousTimeBetweenDates = timeDifference;
        
        if (timeDifference <= 300 & previousTimeBetweenDates > 300) {
            insertNotification();
        }
    }, 250);
}

function startCountdownSecondTimer(dueTime) {
    const countToDate = new Date();
    const [hours, minutes, seconds] = dueTime.split(':').map(Number);

    countToDate.setHours(hours, minutes, seconds);

    let previousTimeBetweenDates;

    const intervalId = setInterval(() => {
        const currentTime = new Date();
        const timeDifference = Math.ceil((countToDate - currentTime) / 1000);
            
        if (timeDifference <= -1) {
            clearInterval(intervalId);
            return;
        }

        flipAllCards(timeDifference, 'second');

        previousTimeBetweenDates = timeDifference;

        if (timeDifference <= 300) {
            insertNotification();
        }
    }, 250);
}

function insertNotification() {
    
    $.ajax({
        type: "POST",
        url: "PHP/check_timer.php",
        data: { 
            user_id: <?php echo $school_id; ?>,
            student_name: "<?php echo $admin_name; ?>",
        },
        success: function(response) {
            console.log("Notification inserted successfully.");
        },
        error: function(xhr, status, error) {
            console.error("Error inserting notification:", error);
        }
    });

}
</script>
<div class="container">
        <div class="sidebar">
            <div class="logo_details">
                <img src="../Pictures/STI-Small.png">
                <div class="logo_name">Admin Office</div>
                <i class="bx bx-menu" id="btn"></i>
            </div>
            <div class="nav-container">
                <ul class="nav-list">
                    <li>
                        <div class="icon-link">
                            <a href="Dashboard.php">
                                <i class="bx bx-grid-alt"></i>
                                <span class="link_name">Dashboard</span>
                            </a>
                            <i class='bx bx-chevron-down drop-down'></i>
                        </div>
                        <ul class="sub-menu">
                            <li><p class="link_name">Dashboard</p></li>
                            <li><a href="Registration.php">Registration</a></li>
                            <li><a href="Borrowing.php">Borrowing</a></li>
                        </ul>
                    </li>

                    <li>
                        <div class="icon-link">
                            <a href="Book.php" class="menu-link book-link">
                                <i class='bx bxs-book'></i>
                                <span class="link_name">Book Management</span>
                            </a>
                            <i class='bx bx-chevron-down drop-down'></i>
                        </div>
                        <ul class="sub-menu">
                            <li><p class="link_name">Book Management</p></li>
                            <li><a href="Book-Database.php">Books Database</a></li>
                        </ul>
                    </li>

                    <li>
                        <div class="icon-link">
                            <a href="Activities.php" class="menu-link book-link">
                                <i class='bx bx-joystick'></i>
                                <span class="link_name">Activities Management</span>
                            </a>
                            <i class='bx bx-chevron-down drop-down'></i>
                        </div>
                        <ul class="sub-menu">
                            <li><p class="link_name">Activities Management</p></li>
                            <li><a href="PC-Database.php">PC Database</a></li>
                            <li><a href="PS4-Database.php">PS4 Database</a></li>
                            <li><a href="BoardGames-Database.php">Board Games Database</a></li>
                            <li><a href="PC_Activity.php">PC Activity</a></li>
                            <li><a href="PS4_Activity.php">PS4 Activity</a></li>
                            <li><a href="BoardGame_Activity.php">Board Games Activity</a></li>
                        </ul>
                    </li>

                    <li>
                        <div class="icon-link">
                            <a href="User.php" class="menu-link book-link">
                                <i class='bx bx-user'></i>
                                <span class="link_name">User Management</span>
                            </a>
                            <i class='bx bx-chevron-down drop-down'></i>
                        </div>
                        <ul class="sub-menu">
                            <li><p class="link_name">User Management</p></li>
                            <li><a href="Teacher.php">Teacher</a></li>
                            <li><a href="Student.php">Student</a></li>
                        </ul>
                    </li>

                    <li>
                        <div class="icon-link">
                            <a href="Message.php">
                                <i class='bx bx-message-rounded-dots'></i>
                                <span class="link_name">Message</span>
                            </a>
                            <i class='bx bx-chevron-down drop-down'></i>
                        </div>
                        <ul class="sub-menu">
                            <li><p class="link_name">Message</p></li>
                            <li><a href="Notification.php">Notify</a></li>
                            <li><a href="SMS.php">SMS</a></li>
                            <li><a href="Email.php">Email</a></li>
                        </ul>
                    </li>

                    <li>
                        <div class="icon-link">
                            <a>
                                <i class='bx bx-archive'></i>
                                <span class="link_name">Archive</span>
                            </a>
                            <i class='bx bx-chevron-down drop-down'></i>
                        </div>
                        <ul class="sub-menu">
                            <li><p class="link_name">Archive</p></li>
                            <li><a href="Book-Archive.php">Book</a></li>
                            <li><a href="Borrowing-Archive.php">Borrow</a></li>
                            <li><a href="BoardGames-Archive.php">Board Games</a></li>
                            <li><a href="PS4-Archive.php">PS4</a></li>
                            <li><a href="PC-Archive.php">PC</a></li>
                            <li><a href="BoardGames_Activity-Archive.php">Board Games Activity</a></li>
                            <li><a href="PS4_Activity-Archive.php">PS4 Activity</a></li>
                            <li><a href="PC_Activity-Archive.php">PC Activity</a></li>
                            <li><a href="Fines-Archive.php">Fines</a></li>
                        </ul>
                    </li>
                    <li>
                        <div class="icon-link">
                            <a href="Timer.php">
                                <i class='bx bx-timer' ></i>
                                <span class="link_name">Timer</span>
                            </a>
                        </div>
                        <div class="tooltip">
                            <p>Timer</p>
                        </div>
                    </li>
                    <li>
                        <div class="icon-link">
                            <a href="Fines.php">
                                <i class='bx bx-dollar-circle' ></i>
                                <span class="link_name">Fines</span>
                            </a>
                        </div>
                        <div class="tooltip">
                            <p>Fines</p>
                        </div>
                    </li>  
                </ul>
            </div>
            <ul>
                <li>
                <div class="profile-details">
                    <div class="profile-content">
                        <img src="data:image/jpeg;base64,<?php echo $imageData; ?>" alt="profile">
                    </div>
                    <div class="name-job">
                        <div class="profile_name"><?php echo $admin_name; ?></div>
                        <div class="profile_status"><?php echo $role; ?></div>
                    </div>
                    <i class='bx bx-log-out'></i>
                </div>
                </li>
            </ul>
        </div>
        <!------------------- END OF SIDEBAR ------------------>
        <div class="main">
            <div class="top-bar">
                <div class="top-title">Timer</div>
                <div class="icon">
                    <svg class="bell" xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor">
                    <path class="bellHead" d="M21.2,18.2v-5.9c0-3.6-1.9-6.7-5.3-7.5V4c0-1-0.8-1.8-1.8-1.8S12.3,3,12.3,4c0,0,0,0,0,0v0.8C8.9,5.6,7,8.6,7,12.3v5.9l-2.4,2.3v1.2h18.9v-1.2L21.2,18.2z" />
                    <path class="bellTongue" d="M14.1,25.2c1.3,0,2.4-1.1,2.4-2.4h-4.7C11.7,24.2,12.8,25.2,14.1,25.2z" />
                    </svg>
                </div>
            </div>
            <div class="notification-container hidden">
            <?php
                if (isset($_SESSION['school_id'])) {
                    $school_id = $_SESSION['school_id'];
                    
                    $notificationQuery = "SELECT * FROM notification WHERE student_id = $school_id LIMIT 5";
                    $notificationResult = $con->query($notificationQuery);

                    if ($notificationResult->num_rows > 0) {
                        while ($notificationData = $notificationResult->fetch_assoc()) {
                            $adminName = $notificationData['admin_name'];
                            $title = $notificationData['title'];
                            $message = $notificationData['message'];
                            $imageData = $notificationData['admin_picture'];

                            echo '<div class="notification-card">';
                            echo '<div class="notification-user-info">';
                            echo '<img src="../Pictures/AI_picture.png" alt="Admin Picture">';
                            echo '<h2>' . $title . '</h2>';
                            echo '</div>';
                            echo '<div class="message">';
                            echo '<p>' . $message . '</p>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p>No notifications found.</p>';
                    }
                } else {
                    echo '<p>School ID not set.</p>';
                }
                ?>

            </div>
            <div class="grid-container">
                <div class="timer">
                    <div class="profile-container">
                        <?php
                        $userIdQuery = "SELECT user_id, due_time FROM pc_activity LIMIT 1";
                        $userIdResult = $con->query($userIdQuery);

                        if ($userIdResult->num_rows > 0) {
                            $firstRow = $userIdResult->fetch_assoc();
                            $userId = $firstRow['user_id'];
                            $dueTime = $firstRow['due_time'];

                            $profileQuery = "SELECT user_name, name, user_pic FROM pc_activity WHERE user_id = $userId LIMIT 1";
                            $profileResult = $con->query($profileQuery);

                            if ($profileResult->num_rows > 0) {
                                $profileRow = $profileResult->fetch_assoc();
                                $userName = $profileRow['user_name'];
                                $fullName = $profileRow['name'];
                                $profilePicture = $profileRow['user_pic'];
                                
                                echo '<div class="profile-information">
                                        <img src="' . $profilePicture . '" alt="">
                                        <p class="name">' . $userName . '</p>
                                    </div>';

                                echo '<script>';
                                echo 'startCountdownFirstTimer("' . $dueTime . '");';
                                echo '</script>';
                            } else {
                                echo "No user data found";
                            }
                        } else {
                            echo "No user ID found";
                        }
                        ?>
                        <p class="timer-title">PC Timer</p>
                    </div>
                    <div class="timer-container">
                        <div class="timer-content">
                            <div class="container-segment">
                                <div class="segment-title">Hours</div>
                                <div class="segment">
                                    <div class="flip-card" data-hours-tens-first>
                                        <div class="top">0</div>
                                        <div class="bottom">0</div>
                                    </div>
                                    <div class="flip-card" data-hours-ones-first>
                                        <div class="top">0</div>
                                        <div class="bottom">0</div>
                                    </div>
                                </div>
                            </div>
                            <div class="container-segment">
                                <div class="segment-title">Minutes</div>
                                <div class="segment">
                                    <div class="flip-card" data-minutes-tens-first>
                                        <div class="top">0</div>
                                        <div class="bottom">0</div>
                                    </div>
                                    <div class="flip-card" data-minutes-ones-first>
                                        <div class="top">0</div>
                                        <div class="bottom">0</div>
                                    </div>
                                </div>
                            </div>
                            <div class="container-segment">
                                <div class="segment-title">Seconds</div>
                                <div class="segment">
                                    <div class="flip-card" data-seconds-tens-first>
                                        <div class="top">0</div>
                                        <div class="bottom">0</div>
                                    </div>
                                    <div class="flip-card" data-seconds-ones-first>
                                        <div class="top">0</div>
                                        <div class="bottom">0</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="timer">
                    <div class="profile-container">
                        <?php
                        $userIdQuery = "SELECT user_id, due_time FROM pc_activity LIMIT 1 OFFSET 1";
                        $userIdResult = $con->query($userIdQuery);

                        if ($userIdResult->num_rows > 0) {
                            $secondRow = $userIdResult->fetch_assoc();
                            $userId = $secondRow['user_id'];
                            $dueTime = $secondRow['due_time'];

                            $profileQuery = "SELECT user_name, name, user_pic FROM pc_activity WHERE user_id = $userId LIMIT 1";
                            $profileResult = $con->query($profileQuery);

                            if ($profileResult->num_rows > 0) {
                                $profileRow = $profileResult->fetch_assoc();
                                $userName = $profileRow['user_name'];
                                $fullName = $profileRow['name'];
                                $profilePicture = $profileRow['user_pic'];
                                
                                echo '<div class="profile-information">
                                        <img src="' . $profilePicture . '" alt="">
                                        <p class="name">' . $userName . '</p>
                                    </div>';

                                echo '<script>';
                                echo 'startCountdownSecondTimer("' . $dueTime . '");';
                                echo '</script>';
                            } else {
                                echo "No user data found";
                            }
                        } else {
                            echo "No second user ID found";
                        }
                        ?>
                        <p class="timer-title">PC Timer</p>
                    </div>
                    <div class="timer-container">
                        <div class="timer-content">
                            <div class="container-segment">
                                <div class="segment-title">Hours</div>
                                <div class="segment">
                                    <div class="flip-card" data-hours-tens-second>
                                        <div class="top">0</div>
                                        <div class="bottom">0</div>
                                    </div>
                                    <div class="flip-card" data-hours-ones-second>
                                        <div class="top">0</div>
                                        <div class="bottom">0</div>
                                    </div>
                                </div>
                            </div>
                            <div class="container-segment">
                                <div class="segment-title">Minutes</div>
                                <div class="segment">
                                    <div class="flip-card" data-minutes-tens-second>
                                        <div class="top">0</div>
                                        <div class="bottom">0</div>
                                    </div>
                                    <div class="flip-card" data-minutes-ones-second>
                                        <div class="top">0</div>
                                        <div class="bottom">0</div>
                                    </div>
                                </div>
                            </div>
                            <div class="container-segment">
                                <div class="segment-title">Seconds</div>
                                <div class="segment">
                                    <div class="flip-card" data-seconds-tens-second>
                                        <div class="top">0</div>
                                        <div class="bottom">0</div>
                                    </div>
                                    <div class="flip-card" data-seconds-ones-second>
                                        <div class="top">0</div>
                                        <div class="bottom">0</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="timer">
                    <div class="profile-container">
                    <?php
                        $userIdQuery = "SELECT user_id, due_time FROM ps4_activity LIMIT 1";
                        $userIdResult = $con->query($userIdQuery);

                        if ($userIdResult->num_rows > 0) {
                            $firstRow = $userIdResult->fetch_assoc();
                            $userId = $firstRow['user_id'];
                            $dueTime = $firstRow['due_time'];

                            $profileQuery = "SELECT user_name, name, user_pic FROM ps4_activity WHERE user_id = $userId LIMIT 1";
                            $profileResult = $con->query($profileQuery);

                            if ($profileResult->num_rows > 0) {
                                $profileRow = $profileResult->fetch_assoc();
                                $userName = $profileRow['user_name'];
                                $fullName = $profileRow['name'];
                                $profilePicture = $profileRow['user_pic'];
                                
                                echo '<div class="profile-information">
                                        <img src="' . $profilePicture . '" alt="">
                                        <p class="name">' . $userName . '</p>
                                    </div>';

                                echo '<script>';
                                echo 'startCountdown("' . $dueTime . '");';
                                echo '</script>';
                            } else {
                                echo "No user data found";
                            }
                        } else {
                            echo "No user ID found";
                        }
                        ?>
                        <p class="timer-title">PS4 Timer</p>
                    </div>
                    <div class="timer-container">
                        <div class="timer-content">
                            <div class="container-segment">
                                <div class="segment-title">Hours</div>
                                <div class="segment">
                                    <div class="flip-card" data-hours-tens-third>
                                        <div class="top">0</div>
                                        <div class="bottom">0</div>
                                    </div>
                                    <div class="flip-card" data-hours-ones-third>
                                        <div class="top">0</div>
                                        <div class="bottom">0</div>
                                    </div>
                                </div>
                            </div>
                            <div class="container-segment">
                                <div class="segment-title">Minutes</div>
                                <div class="segment">
                                    <div class="flip-card" data-minutes-tens-third>
                                        <div class="top">0</div>
                                        <div class="bottom">0</div>
                                    </div>
                                    <div class="flip-card" data-minutes-ones-third>
                                        <div class="top">0</div>
                                        <div class="bottom">0</div>
                                    </div>
                                </div>
                            </div>
                            <div class="container-segment">
                                <div class="segment-title">Seconds</div>
                                <div class="segment">
                                    <div class="flip-card" data-seconds-tens-third>
                                        <div class="top">0</div>
                                        <div class="bottom">0</div>
                                    </div>
                                    <div class="flip-card" data-seconds-ones-third>
                                        <div class="top">0</div>
                                        <div class="bottom">0</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="JAVASCRIPT/sidebar.js?v=<?php echo time() ?>"></script>
</body>
</html>

<script>


function flipAllCards(time, prefix) {
    const seconds = time % 60;
    const minutes = Math.floor(time / 60) % 60;
    const hours = Math.floor(time / 3600);

    flip(document.querySelector("[data-hours-tens-" + prefix + "]"), Math.floor(hours / 10));
    flip(document.querySelector("[data-hours-ones-" + prefix + "]"), hours % 10);
    flip(document.querySelector("[data-minutes-tens-" + prefix + "]"), Math.floor(minutes / 10));
    flip(document.querySelector("[data-minutes-ones-" + prefix + "]"), minutes % 10);
    flip(document.querySelector("[data-seconds-tens-" + prefix + "]"), Math.floor(seconds / 10));
    flip(document.querySelector("[data-seconds-ones-" + prefix + "]"), seconds % 10);
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