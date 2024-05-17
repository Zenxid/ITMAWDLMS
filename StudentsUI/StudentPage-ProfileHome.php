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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Home</title>
    <link rel="stylesheet" href="CSS/StudentPage-sidebar.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="CSS/StudentPage-ProfileHome.css?v=<?php echo time(); ?>">
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
                    <li class="active">
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
     <section class="content">
        <div class="left-content">
          <div class="activities">
            <h1>Check Out!</h1>
            <div class="activity-container">

                <a href="StudentPage-Book.php" class="image-container img-one">
                    <img src="../Pictures/bento-img-1.jpg" alt="book" />
                    <div class="overlay">
                    <h3>Book</h3>
                    </div>
                </a>

              <a href="StudentPage-BoardGames.php" class="image-container img-two">
                <img src="../Pictures/bento-img-2.webp" alt="board games" />
                <div class="overlay">
                  <h3>Board</h3>
                </div>
            </a>

              <div class="image-container img-three">
                <img src="../Pictures/bento-img-3.jpg" alt="favorites" />
                <div class="overlay">
                  <h3>Favorites</h3>
                </div>
              </div>

            <a href="StudentPage-PS4.php" class="image-container img-four">
                <img src="../Pictures/bento-img-4.jpg" alt="ps4" />
                <div class="overlay">
                    <h3>PS4</h3>
                </div>
            </a>

            <a href="StudentPage-PC.php" class="image-container img-five">
                <img src="../Pictures/bento-img-5.webp" alt="pc" />
                <div class="overlay">
                  <h3>PC</h3>
                </div>
            </a>

              <div class="image-container img-six">
                <img src="../Pictures/bento-img-6.png" alt="history" />
                <div class="overlay">
                  <h3>History</h3>
                </div>
              </div>
            </div>
          </div>

          <div class="left-bottom">
            <div class="weekly-schedule">
              <h1>Due Dates</h1>
              <div class="calendar">
                <?php
                $query = "SELECT id, school_id, user_id, name, role, dept_section, book_name, quantity, due_date, date FROM borrow WHERE user_id = '$userId'";

                $result = mysqli_query($con, $query);

                if ($result && mysqli_num_rows($result) > 0) {
                    $activityClasses = ['activity-one', 'activity-two', 'activity-three', 'activity-four'];

                    while ($row = mysqli_fetch_assoc($result)) {
                        $bookName = $row['book_name'];
                        $dueDate = $row['due_date'];

                        $randomClass = $activityClasses[array_rand($activityClasses)];

                        echo '<div class="day-and-activity ' . $randomClass . '">';
                        echo '<div class="day">';
                        echo '<h1>' . date('d', strtotime($dueDate)) . '</h1>';
                        echo '<p>' . date('D', strtotime($dueDate)) . '</p>';
                        echo '</div>';
                        echo '<div class="activity">';
                        echo '<h2>' . $bookName . '</h2>';
                        echo '</div>';
                        echo '<a href="StudentPage-DueDate.php"><button class="btn">Check</button></a>';
                        echo '</div>';
                    }

                    mysqli_free_result($result);
                } else {
                    echo '<div class="no-data-message">';
                    echo '<p>No due dates found.</p>';
                    echo '</div>';  
                }

                ?>

              </div>
            </div>
          </div>
        </div>

        <div class="right-content">

          <div class="friends-activity">
            <a href="StudentPage-Notifications.php"><h1>Notification</h1></a>
           <div class="card-container">
              <?php
              $user_id = $school_id;
              $query = "SELECT id, admin_id, admin_name, admin_picture, student_id, title, name, message FROM notification WHERE student_id = $user_id LIMIT 15";

              $result = mysqli_query($con, $query);

              if ($result) {
                  while ($row = mysqli_fetch_assoc($result)) {
                      $adminName = $row['admin_name'];
                      $adminPicture = $row['admin_picture'];
                      $messageTitle = $row['title'];
                      $messageContent = $row['message'];

                      echo '<div class="card">';
                      echo '<div class="card-user-info">';
                      echo '<img src="data:image/jpeg;base64,' . $adminPicture . '" alt="' . $adminName . '" />';
                      echo '<h2>' . $adminName . '</h2>';
                      echo '</div>';
                      echo '<p>' . $messageContent . '</p>';
                      echo '</div>';
                  }

                  mysqli_free_result($result);
              } else {
                  echo "Error: " . mysqli_error($con);
              }
              ?>
            </div>
          </div>
        </div>
      </section>
    </main>
    <div id="circle-menu" class="circle-menu">
        <div id="menu-toggle" class="menu-toggle">
            <div class="menu-icon"><i class="icon ph-bold ph-house-simple"></i></div>
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