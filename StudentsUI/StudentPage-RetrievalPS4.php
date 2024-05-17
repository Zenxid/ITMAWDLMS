<?php
include 'PHP/connect.php';

$userImage = "/Pictures/no-user-images.png";

if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
    $userId = $_SESSION['id'];
    $userRole = $_SESSION['role'];

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
            echo "Invalid user role.";
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PS4 Timer Table</title>
    <link rel="stylesheet" href="CSS/StudentPage-RetrievalPS4.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="CSS/StudentPage-sidebar.css?v=<?php echo time(); ?>">
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
                        <li class="active">
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
                <li>
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
        <div class="container">
            <div class="title">
                <h1 class="text-center">PS4 Games Timer Table</h1>
            </div>
            <div class="small-container cart-page">
                <table>
                    <thead>
                        <tr>
                        <th>PS4 Game</th>
                        <th>Timestamp</th>
                        <th>Date</th>
                        <th>Due Time</th>
                        </tr>
                    </thead>
                    <tbody class="table-body">
                        <?php
                        if (isset($_SESSION['id'])) {
                            $userId = $_SESSION['id'];
                        
                            $query = "SELECT id, game_id, picture, name, user_name, user_id, timestamp, date, due_time
                                      FROM ps4_activity 
                                      WHERE user_id = '$userId'";
                            $result = mysqli_query($con, $query);
                        
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $timestamp = date("h:i A", strtotime($row['timestamp']));
                                    $dueTime = date("h:i A", strtotime($row['due_time']));
                                    echo '<tr id="row_' . $row['id'] . '">';
                                    echo '<td>';
                                    echo '<div class="cart-info">';
                                    echo '<img src="' . $row['picture'] . '" alt="" />';
                                    echo '<div>';
                                    echo '<p>' . $row['name'] . '</p>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</td>';
                                    echo '<td><p class="timestamp">' . $timestamp .  '</p></td>';
                                    echo '<td>' . $row['date'] . '</td>';
                                    echo '<td>' . $dueTime . '</td>';
                                    echo '</tr>';
                                }
                            } else {
                                echo "<tbody id='table-body'><tr><td colspan='4' style='text-align:center;'>No Data Found!</td></tr></tbody>";
                            }
                        } else {
                            echo "<tbody id='table-body'><tr><td colspan='4' style='text-align:center;'>No User Login!</td></tr></tbody>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="toast"></div>
    </main>
    <div id="circle-menu" class="circle-menu">
        <div id="menu-toggle" class="menu-toggle">
            <div class="menu-icon"><i class="icon ph ph-arrow-u-up-left"></i></div>
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
<script src="JAVASCRIPT/StudentPage-Sidebar.js?v=<?php echo time(); ?>"></script>
</body>
</html>

<script>

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