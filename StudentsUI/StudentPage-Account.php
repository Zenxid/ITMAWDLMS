<?php
include 'PHP/connect.php';

$userImage = "/Pictures/no-user-images.png";

if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
    $userId = $_SESSION['id'];
    $userRole = $_SESSION['role'];
    $school_id = $_SESSION['school_id'];

    $userName = "";
    $userTitle = "";

    switch ($userRole) {
        case 'student':
            $sql = "SELECT name, grade, section, picture FROM student WHERE id = $userId";
            break;
        case 'teacher':
            $sql = "SELECT name, faculty_name, picture FROM teacher WHERE id = $userId";
            break;
        default:
            break;
    }

    $result = mysqli_query($con, $sql);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $userName = $row['name'];

            switch ($userRole) {
                case 'student':
                    $userTitle = $row['grade'] . " - " . $row['section'];
                    break;
                case 'teacher':
                    $userTitle = $row['faculty_name'];
                    break;
                default:
                    break;
            }

            if (!empty($row['picture'])) {
                $base64Image = base64_encode($row['picture']);
                $userImage = "data:image/jpeg;base64," . $base64Image;
            }
        } else {
            echo "User data not found.";
        }
    } else {
        echo "Error executing SQL query: " . mysqli_error($con);
    }
} else {
    echo "Session variables are not set.";
}

$bookQuery = "SELECT COUNT(*) AS book_count FROM borrow_archive WHERE user_id = '$userId'";
$bookResult = mysqli_query($con, $bookQuery);
$bookCount = mysqli_fetch_assoc($bookResult)['book_count'];

$boardGamesPS4Query = "SELECT COUNT(*) AS board_games_ps4_count FROM boardgames_activity_archive WHERE user_id = '$userId'";
$boardGamesPS4Result = mysqli_query($con, $boardGamesPS4Query);
$boardGamesPS4Count = mysqli_fetch_assoc($boardGamesPS4Result)['board_games_ps4_count'];

$pcTimeQuery = "SELECT COUNT(*)  AS total_pc_time FROM pc_activity_archive WHERE user_id = '$userId'";
$pcTimeResult = mysqli_query($con, $pcTimeQuery);
$pcTime = mysqli_fetch_assoc($pcTimeResult)['total_pc_time'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Home</title>
    <link rel="stylesheet" href="CSS/StudentPage-sidebar.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="CSS/StudentPage-Account.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="CSS/toast.css?v=<?php echo time(); ?>">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.1.0/remixicon.css" rel="stylesheet">
    
</head>
<body>
<div class="container">
    <div class="sidebar">
        <div class="menu-btn">
            <i class="ph-bold ph-caret-left"></i>
        </div>
        <div class="head">
            <div class="user-img">
                <img src="<?php echo $userImage; ?>" alt="" />
            </div>
            <div class="user-details">
                <p class="title"><?php echo $userTitle; ?></p>
                <p class="name"><?php echo $userName; ?></p>
            </div>
        </div>
        <div class="nav">
            <div class="menu">
                <p class="title">Main</p>
                <ul>
                    <li>
                        <a href="StudentPage-ProfileHome.php">
                            <i class="icon ph-bold ph-house-simple"></i>
                            <span class="text">Home</span>
                        </a>
                    </li>
                    <li>
                        <a>
                            <i class="icon ph ph-heart"></i>
                            <span class="text">Favorite</span>
                            <i class="arrow ph-bold ph-caret-down"></i>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="StudentPage-FavoriteBook.php">
                                    <span class="text">Books Collection</span>
                                </a>
                            </li>
                            <li>
                                <a href="StudentPage-FavoritePS4.php">
                                    <span class="text">PS4 Games Collection</span>
                                </a>
                            </li>
                            <li>
                                <a href="StudentPage-FavoriteBoard.php">
                                    <span class="text">Board Games Collection</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="StudentPage-Borrowing.php">
                            <i class="icon ph ph-books"></i>
                            <span class="text">Borrow</span>
                        </a>
                    </li>
                    <li>
                        <a>
                        <i class="icon ph ph-arrow-u-up-left"></i>
                        <span class="text">Retrieval</span>
                        <i class="arrow ph-bold ph-caret-down"></i>
                        </a>
                        <ul class="sub-menu">
                        <li>
                            <a href="StudentPage-RetrievalBoardGames.php">
                            <span class="text">Board Games Retrieval</span>
                            </a>
                        </li>
                        <li>
                            <a href="StudentPage-RetrievalPS4.php">
                            <span class="text">PS4 Games Retrieval</span>
                            </a>
                        </li>
                        <li>
                            <a href="StudentPage-RetrievalPC.php">
                            <span class="text">PC Retrieval</span>
                            </a>
                        </li>
                        </ul>
                    </li>
                    <li>
                        <a href="StudentPage-Notifications.php">
                            <i class="icon ph ph-bell"></i>
                            <span class="text">Notification</span>
                        </a>
                    </li>
                    <li>
                        <a href="StudentPage-DueDate.php">
                            <i class="icon ph-bold ph-calendar-blank"></i>
                            <span class="text">Due Date</span>
                        </a>
                    </li>
                    <li>
                        <a href="StudentPage-Fines.php">
                            <i class="icon ph ph-money"></i>
                            <span class="text">Fines</span>
                        </a>
                    </li>
                    <li>
                        <a>
                            <i class="icon ph ph-clock-counter-clockwise"></i>
                            <span class="text">History</span>
                            <i class="arrow ph-bold ph-caret-down"></i>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="StudentPage-BookHistory.php">
                                    <span class="text">Book Returned</span>
                                </a>
                            </li>
                            <li>
                                <a href="StudentPage-BoardHistory.php">
                                    <span class="text">Board Games Returned</span>
                                </a>
                            </li>
                            <li>
                                <a href="StudentPage-PS4History.php">
                                    <span class="text">PS4 Games Returned</span>
                                </a>
                            </li>
                            <li>
                                <a href="StudentPage-PCHistory.php">
                                    <span class="text">PC History</span>
                                </a>
                            </li>
                            <li>
                                <a href="StudentPage-FinesHistory.php">
                                    <span class="text">Fines</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="menu">
                <p class="title">Settings</p>
                <ul>
                    <li>
                        <a href="StudentPage-Settings.php">
                            <i class="icon ph-bold ph-gear"></i>
                            <span class="text">Settings</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="menu">
            <p class="title">Account</p>
            <ul>
                <li class="active">
                    <a href="StudentPage-Account.php">
                        <i class="icon ph ph-user-rectangle"></i>
                        <span class="text">My Account</span>
                    </a>
                </li>
                <li>
                    <a href="StudentPage-Help.php">
                        <i class="icon ph-bold ph-info"></i>
                        <span class="text">Help</span>
                    </a>
                </li>
                <li>
                    <a href="../PHP/logout.php">
                        <i class="icon ph-bold ph-sign-out"></i>
                        <span class="text">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <main>
        <div class="header_wrapper">
            <header style=" background: url(../Pictures/blueBackground.jpg) no-repeat 50% 20% / cover;"></header>
            <div class="cols_container">
                <div class="left_col">
                    <div class="img_container">
                        <img src="<?php echo $userImage; ?>" alt="">
                    </div>
                    <h2><?php echo $_SESSION['name'] ?></h2>
                    <p><?php echo $school_id ?></p>
                    <p><?php echo $userTitle ?></p>

                    <ul class="about">
                        <?php
                            echo '<li><span>' . $bookCount . '</span> Books</li>';
                            echo '<li><span>' . $boardGamesPS4Count . '</span> Board Games & PS4</li>';
                            echo '<li><span>' . $pcTime . ' hours</span> PC Time</li>';
                        ?>
                    </ul>

                </div>
                <div class="right_col">
                    <nav>
                        <ul>
                            <li><button id="bookButton" onclick="openBook()">Edit Profile</button></li>
                            <li><button id="ps4Button" onclick="openPS4()">To Be Continued</button></li>
                            <span id="linespan"></span>
                        </ul>
                    </nav>

                    <div id="content1" class="photos">
                        <h4 class="title">Edit Profile</h4>
                        <div class="input-container">
                        <form id="profileForm" enctype="multipart/form-data">
                            <div class="input-container">
                                <div class="profile-pic">
                                    <img id="profileImage" src="<?php echo $userImage ?>"/>
                                    <div class="layer"></div>
                                    <a class="image-wrapper" href="#">
                                        <input class="hidden-input" id="changePicture" type="file" name="profilePicture" onchange="previewImage(event)"/>
                                        <label class="edit" for="changePicture" title="Change picture"><i class='bx bx-pencil'></i></label>
                                    </a>
                                </div>

                                <div class="password-container">
                                    <label for="passwordInput" style="font-weight: 500;">Password:</label>
                                    <input type="password" name="passwordInput" id="password"><br>
                                    <label for="ConfirmpasswordInput" style="font-weight: 500;">Confirm Password:</label>
                                    <input type="password" name="ConfirmpasswordInput" id="ConfirmpasswordInput">
                                </div>
                            </div>

                            <div class="button-data">
                                <button class="ConfirmBtn" type="submit">Confirm</button>
                                <button class="ClearBtn" type="button" onclick="clearPasswordFields()">Clear</button>
                            </div>
                        </form>
                    </div>

                    <div id="content2" class="photos">

                    </div>

                </div>
            </div>
        </div>
        <div class="toast"></div>
    </main>
    <div id="circle-menu" class="circle-menu">
        <div id="menu-toggle" class="menu-toggle">
            <div class="menu-icon"><i class="icon ph ph-user-rectangle"></i></div>
            </div>
            <div class="menu-items">
            <div class="top-icons">
            </div>
            <div class="left-icons">
                <a href="StudentPage-ProfileHome.php"><div class="menu-icon" id="icon-a"><i class="icon ph-bold ph-house-simple"></i></div></a>
                <div class="menu-icon" id="icon-b"><i class="icon ph ph-heart"></i></div>
                <a href="StudentPage-Borrowing.php"><div class="menu-icon" id="icon-c"><i class="icon ph ph-books"></i></div></a>
                <div class="menu-icon" id="icon-d"><i class="icon ph ph-arrow-u-up-left"></i></div>
                <a href="StudentPage-Notifications.php"><div class="menu-icon" id="icon-e"><i class="icon ph ph-bell"></i></div></a>
                <a href="StudentPage-DueDate.php"><div class="menu-icon" id="icon-f"><i class="icon ph-bold ph-calendar-blank"></i></div></a>
                <a href="StudentPage-Fines.php"><div class="menu-icon" id="icon-g"><i class="icon ph ph-money"></i></div></a>
                <div class="menu-icon" id="icon-h"><i class="icon ph ph-clock-counter-clockwise"></i></div>
                <a href="StudentPage-Settings.php"><div class="menu-icon" id="icon-i"><i class="icon ph-bold ph-gear"></i></div></a>
                <a href="StudentPage-Account.php"><div class="menu-icon" id="icon-j"><i class="icon ph ph-user-rectangle"></i></div></a>
                <a href="StudentPage-Help.php"><div class="menu-icon" id="icon-k"><i class="icon ph-bold ph-info"></i></div></a>
                <a href="../PHP/logout.php"><div class="menu-icon" id="icon-l"><i class="icon ph-bold ph-sign-out"></i></div></a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.js"></script>
<script src="JAVASCRIPT/StudentPage-Sidebar.js?v=<?php echo time() ?>"></script>
<script src="JAVASCRIPT/ProfilePage.js"></script>
</body>
</html>

<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('profileImage');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    $(document).ready(function() {
        $('#profileForm').submit(function(event) {
            event.preventDefault();

            var password = $('#password').val().trim();
            var confirmPassword = $('#ConfirmpasswordInput').val().trim();

            if (password !== confirmPassword) {
                showCustomToast("Passwords do not match!", false);
                return;
            }

            var formData = new FormData($(this)[0]);

            $.ajax({
                url: 'PHP/update_profile.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    showCustomToast("Profile updated successfully!", true);
                    window.location.href = "StudentPage-Account.php";
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
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

function clearPasswordFields() {
    $('#password').val('');
    $('#ConfirmpasswordInput').val('');
}
</script>