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
    $name = $row['name'];
    $role = $row['role'];
    $imageData = base64_encode($row['picture']);
} else {
    header("Location: ../LoginForm.php");
    exit();
}

$sqlCountPC = "SELECT COUNT(*) AS total FROM `pc_activity`";
$resultCountPC = mysqli_query($con, $sqlCountPC);
$countRowPC = mysqli_fetch_assoc($resultCountPC);
$totalPC = $countRowPC['total'];

$sqlCountBoardGames = "SELECT COUNT(*) AS total FROM `boardgames_activity`";
$resultCountBoardGames = mysqli_query($con, $sqlCountBoardGames);
$countRowBoardGames = mysqli_fetch_assoc($resultCountBoardGames);
$totalBoardGames = $countRowBoardGames['total'];

$sqlCountPS4 = "SELECT COUNT(*) AS total FROM `ps4_activity`";
$resultCountPS4 = mysqli_query($con, $sqlCountPS4);
$countRowPS4 = mysqli_fetch_assoc($resultCountPS4);
$totalPS4 = $countRowPS4['total'];

$sqlPC = "SELECT * FROM `pc_activity` ORDER BY id DESC LIMIT 5";
$resultPC = mysqli_query($con, $sqlPC);

if (!$resultPC) {
    die("Error executing query: " . mysqli_error($con));
}

$sqlBoardGames = "SELECT * FROM `boardgames_activity` ORDER BY id DESC LIMIT 5";
$resultBoardGames = mysqli_query($con, $sqlBoardGames);

if (!$resultBoardGames) {
    die("Error executing query: " . mysqli_error($con));
}

$sqlPS4 = "SELECT * FROM `ps4_activity` ORDER BY id DESC LIMIT 5";
$resultPS4 = mysqli_query($con, $sqlPS4);

if (!$resultPS4) {
    die("Error executing query: " . mysqli_error($con));
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activities</title>
    <link rel="stylesheet" href="CSS/Activities.css">
    <link rel="stylesheet" href="CSS/sidebar.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
<body>
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
                            <li><a href="Borrowing-Archive.php">Borrowing</a></li>
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
                        <div class="profile_name"><?php echo $name; ?></div>
                        <div class="profile_status"><?php echo $role; ?></div>
                    </div>
                    <i class='bx bx-log-out'></i>
                </div>
                </li>
            </ul>
        </div>
        <!------- END OF SIDEBAR ------>
        <div class="main">
            <div class="top-bar">
                <div class="top-title">Activity Management</div>
            </div>
            <div class="cardBox">
                <div class="card">
                    <div>
                        <div class="numbers"><?php echo $totalPC; ?></div>
                        <div class="cardName">PC</div>
                    </div>

                    <div class="iconBx">
                        <i class='bx bx-desktop'></i>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers"><?php echo $totalBoardGames; ?></div>
                        <div class="cardName">Board Games</div>
                    </div>

                    <div class="iconBx">
                        <i class='bx bx-dice-3'></i>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers"><?php echo $totalPS4; ?></div>
                        <div class="cardName">PS4 Games</div>
                    </div>

                    <div class="iconBx">
                        <i class='bx bx-joystick' ></i>
                    </div>
                </div>

                
            </div>
            <div class="board">
                <div class="table-wrap">
                <p class="title">PC</p>
                <table width="100%">
                     <thead>
                        <tr>
                            <td style="width: 9%;">Picture</td>
                            <td>Name</td>
                            <td>User</td>
                            <td>Timestamp</td>
                            <td>Due Time</td>
                            <td>Date</td>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                            if (mysqli_num_rows($resultPC) > 0) {
                                while ($row = mysqli_fetch_assoc($resultPC)) {
                                    $profilePicture = base64_encode($row['picture']);
                                    $name = $row['name'];
                                    $user = $row['user_name'];
                                    $date = $row['date'];
                                    echo '<tr>
                                            <td class="profile">
                                                <img src="data:image;base64,' . $row['picture'] . '">
                                            </td>
                                            <td class="name">
                                                <p>' . $name . '</p>
                                            </td>
                                            <td class="user_name">
                                                <p>' . $user . '</p>
                                            </td>
                                            <td class="timestamp">
                                                <p>' . date('h:i A', strtotime($row['timestamp'])) . '</p>
                                            </td>
                                            <td class="dueTime">
                                                <p>' . date('h:i A', strtotime($row['due_time'])) . '</p>
                                            </td>
                                            <td class="date">
                                                <p>' . $date . '</p>
                                            </td>
                                        </tr>';
                                }
                            } else {
                                echo "<tr><td colspan='3'>No PC Users found.</td></tr>";
                            }
                            ?>
                     </tbody>
                </table>
                    <div class="more">
                        <a href="PC_Activity.php">More Info</a>
                    </div>
                </div>

                <div class="table-wrap">
                    <p class="title">Board Games</p>
                    <table width="100%">
                         <thead>
                            <tr>
                                <td style="width: 9%;">Picture</td>
                                <td>Name</td>
                                <td>User</td>
                                <td>Timestamp</td>
                                <td>Date</td>
                            </tr>
                         </thead>
                         <tbody>
                            <?php
                            if (mysqli_num_rows($resultBoardGames) > 0) {
                                while ($row = mysqli_fetch_assoc($resultBoardGames)) {
                                    $profilePicture = base64_encode($row['picture']);
                                    $name = $row['name'];
                                    $user = $row['user_name'];
                                    $date = $row['date'];
                                    echo '<tr>
                                            <td class="profile">
                                                <img src="data:image;base64,' . $row['picture'] . '">
                                            </td>
                                            <td class="name">
                                                <p>' . $name . '</p>
                                            </td>
                                            <td class="user_name">
                                                <p>' . $user . '</p>
                                            </td>
                                            <td class="timestamp">
                                                <p>' . date('h:i A', strtotime($row['timestamp'])) . '</p>
                                            </td>
                                            <td class="date">
                                                <p>' . $date . '</p>
                                            </td>
                                        </tr>';
                                }
                            } else {
                                echo "<tr><td colspan='3'>No Board Games Users found.</td></tr>";
                            }
                            ?>
                         </tbody>
                    </table>
                        <div class="more">
                            <a href="BoardGames_Activity.php">More Info</a>
                        </div>
                    </div>
                    <div class="table-wrap">
                        <p class="title">PS4 Games</p>
                        <table width="100%">
                             <thead>
                                <tr>
                                    <td style="width: 9%;">Picture</td>
                                    <td>Name</td>
                                    <td>User</td>
                                    <td>Timer</td>
                                    <td>Date</td>
                                </tr>
                             </thead>
                             <tbody>
                                <?php
                                if (mysqli_num_rows($resultPS4) > 0) {
                                    while ($row = mysqli_fetch_assoc($resultPS4)) {
                                        $profilePicture = base64_encode($row['picture']);
                                        $name = $row['name'];
                                        $user = $row['user_name'];
                                        $date = $row['date'];
                                        echo '<tr>
                                                <td class="profile">
                                                    <img src="data:image;base64,' . $row['picture'] . '">
                                                </td>
                                                <td class="name">
                                                    <p>' . $name . '</p>
                                                </td>
                                                <td class="user_name">
                                                    <p>' . $user . '</p>
                                                </td>
                                                <td class="timestamp">
                                                    <p>' . date('h:i A', strtotime($row['timestamp'])) . '</p>
                                                </td>
                                                <td class="dueTime">
                                                    <p>' . date('h:i A', strtotime($row['due_time'])) . '</p>
                                                </td>
                                                <td class="date">
                                                    <p>' . $date . '</p>
                                                </td>
                                            </tr>';
                                    }
                                } else {
                                    echo "<tr><td colspan='3'>No PS4 Users found.</td></tr>";
                                }
                                ?>
                             </tbody>
                        </table>
                            <div class="more">
                                <a href="PS4_Activity">More Info</a>
                            </div>
                        </div>
            </div>
        </div>
    </div>

    <script src="JAVASCRIPT/sidebar.js"></script>
</body>
</html>