<?php
include 'PHP/connect.php';

$userImage = "/Pictures/no-user-images.png";

if (isset($_SESSION['id']) && isset($_SESSION['role']) && isset($_SESSION['school_id'])) {
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <link rel="stylesheet" href="CSS/StudentPage-Notifications.css?v=<?php echo time(); ?>">
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
                    <li class="active">
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
                <h1 class="text-center">Notification</h1>
            </div>
            <div class="table">
                <table style="width: 100%">
                    <thead>
                    <tr>
                        <th style="width:42px;"><input type="checkbox" id="check-all" /></th>
                        <th>Name</th>
                        <th style="width:800px;">Message</th>
                        <th style="width:20px;"><button type='button' class='delete-btn' id="delete-Selected"><i class='bx bx-trash'></i></button></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    $student_id = $school_id;
                    $sql = "SELECT * FROM notification WHERE student_id = '$student_id'";
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

                            echo "<tr>";
                            echo "<td><input type='checkbox' class='row-check' data-notification-id='$notification_id' /></td>";
                            echo "<td class='user-info'><img src='data:image/jpeg;base64,$admin_picture' alt='User Image'> $admin_name</td>";
                            echo "<td>
                            <h3 class='notification-title'>$title</h3>
                            <p class='message'>$message</p>
                            </td>";
                            echo "<td><button type='button' class='delete-btn' data-notification-id='$notification_id'><i class='bx bx-trash'></i></button></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No notifications found.</td></tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <div class="clearfix">
                <div class="hint-text">
                    <p>Showing 1-50 of 500 </p>
                </div>
                <ul class="pagination">
                    <li class="page-item previous">
                        <a href="#">Previous</a>
                    </li>
                    <li class="page-item">
                        <a href="#" class="page-link">1</a>
                    </li>
                    <li class="page-item">
                        <a href="#" class="page-link">2</a>
                    </li>
                    <li class="page-item">
                        <a href="#" class="page-link">3</a>
                    </li>
                    <li class="page-item">
                        <a href="#" class="page-link">4</a>
                    </li>
                    <li class="page-item next">
                        <a href="#">Next</a>
                    </li>
                </ul>
            </div>
        </div>
    </main>
    <div id="circle-menu" class="circle-menu">
        <div id="menu-toggle" class="menu-toggle">
            <div class="menu-icon"><i class="icon ph ph-bell"></i></div>
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
<script src="JAVASCRIPT/StudentPage-Notifications.js?v=<?php echo time(); ?>"></script>
<script src="JAVASCRIPT/StudentPage-Sidebar.js?v=<?php echo time(); ?>"></script>
</body>
</html>

<script>
$(document).ready(function() {
    $('.delete-btn').click(function() {
        var notificationID = $(this).data('notification-id');
        var deleteBtn = $(this);
        
        $.ajax({
            url: 'PHP/delete_notification.php',
            method: 'POST',
            data: {
                notificationID: notificationID
            },
            success: function(response) {
                if (response === 'success') {
                    deleteBtn.closest('tr').remove();
                    console.log("Notification deleted successfully.");
                } else {
                    console.error("Error deleting notification.");
                }
            },
            error: function(xhr, status, error) {
                console.error("Error deleting notification:", error);
            }
        });
    });
});

$(document).ready(function() {
    $('#delete-Selected').click(function() {
        var selectedNotifications = [];
        
        $('.row-check').each(function() {
            // Check if the checkbox is checked
            if ($(this).is(':checked')) {
                var notificationID = $(this).data('notification-id');
                selectedNotifications.push(notificationID);
            }
        });
        
        $.ajax({
            url: 'PHP/delete_selected_notifications.php',
            method: 'POST',
            data: {
                notificationIDs: selectedNotifications
            },
            success: function(response) {
                if (response === 'success') {
                    selectedNotifications.forEach(function(notificationID) {
                        $('[data-notification-id="' + notificationID + '"]').closest('tr').remove();
                    });
                    console.log("Selected notifications deleted successfully.");
                } else {
                    console.error("Error deleting selected notifications.");
                }
            },
            error: function(xhr, status, error) {
                console.error("Error deleting selected notifications:", error);
            }
        });
    });
});
</script>