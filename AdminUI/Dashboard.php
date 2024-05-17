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

$sqlCountTeachers = "SELECT COUNT(*) AS total FROM `teacher`";
$resultCountTeachers = mysqli_query($con, $sqlCountTeachers);
$countRowTeachers = mysqli_fetch_assoc($resultCountTeachers);
$totalTeachers = $countRowTeachers['total'];

$sqlCountStudents = "SELECT COUNT(*) AS total FROM `student`";
$resultCountStudents = mysqli_query($con, $sqlCountStudents);
$countRowStudents = mysqli_fetch_assoc($resultCountStudents);
$totalStudents = $countRowStudents['total'];

$totalUsers = $totalTeachers + $totalStudents;


$sqlCountBoardGames = "SELECT COUNT(*) AS total FROM `boardgames_activity`";
$resultCountBoardGames = mysqli_query($con, $sqlCountBoardGames);
$countRowBoardGames = mysqli_fetch_assoc($resultCountBoardGames);
$totalBoardGames = $countRowBoardGames['total'];

$sqlCountPC = "SELECT COUNT(*) AS total FROM `pc_activity`";
$resultCountPC = mysqli_query($con, $sqlCountPC);
$countRowPC = mysqli_fetch_assoc($resultCountPC);
$totalPC = $countRowPC['total'];

$sqlCountPS4 = "SELECT COUNT(*) AS total FROM `ps4_activity`";
$resultCountPS4 = mysqli_query($con, $sqlCountPS4);
$countRowPS4 = mysqli_fetch_assoc($resultCountPS4);
$totalPS4 = $countRowPS4['total'];

$totalActivities = $totalBoardGames + $totalPC + $totalPS4;

$sqlCountRegistration = "SELECT COUNT(*) AS total FROM `registration`";
$resultCountRegistration = mysqli_query($con, $sqlCountRegistration);
$countRowRegistration = mysqli_fetch_assoc($resultCountRegistration);
$totalRegistration = $countRowRegistration['total'];

$sqlCountBorrow = "SELECT COUNT(*) AS total FROM `borrow`";
$resultCountBorrow = mysqli_query($con, $sqlCountBorrow);
$countRowBorrow = mysqli_fetch_assoc($resultCountBorrow);
$totalBorrow = $countRowBorrow['total'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="CSS/Dashboard.css?v=<?php echo time() ?>">
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
                        <div class="profile_name"><?php echo $name; ?></div>
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
                <div class="top-title">Dashboard</div>
            </div>
            <div class="cardBox">
                <div class="card">
                    <div>
                        <div class="numbers"><?php echo $totalRegistration ?></div>
                        <div class="cardName">Total Register</div>
                    </div>

                    <div class="iconBx">
                        <i class='bx bxs-user-badge'></i>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers"><?php echo $totalBorrow  ?></div>
                        <div class="cardName">Total Borrowed Books</div>
                    </div>

                    <div class="iconBx">
                        <i class='bx bxs-book'></i>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers"><?php echo $totalActivities ?></div>
                        <div class="cardName">Total Activities Played</div>
                    </div>

                    <div class="iconBx">
                        <i class='bx bxs-joystick'></i>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers"><?php echo $totalUsers ?></div>
                        <div class="cardName">Total Users</div>
                    </div>

                    <div class="iconBx">
                        <i class='bx bxs-user-account'></i>
                    </div>
                </div>
            </div>

            <div class="details">
                <div class="recentActivities">
                    <div class="cardHeader">
                        <h2>Recent Registration</h2>
                        <a href="Registration.php" class="btn">View All</a>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <td>Name</td>
                                <td>Role</td>
                                <td>Time</td>
                                <td>Date</td>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $query = "SELECT `name`, `role`, `time`, `date` FROM `registration` LIMIT 25";
                            $result = mysqli_query($con, $query);

                            if (!$result) {
                                die("Query failed: " . mysqli_error($con));
                            }

                            while ($row = mysqli_fetch_assoc($result)) {
                                $formattedTime = date('h:i A', strtotime($row['time']));
                                $formattedDate = date('F jS, Y', strtotime($row['date']));

                                echo "<tr>";
                                echo "<td>{$row['name']}</td>";
                                echo "<td>{$row['role']}</td>";
                                echo "<td>{$formattedTime}</td>";
                                echo "<td>{$formattedDate}</td>";
                                echo "</tr>";
                            }

                            mysqli_free_result($result);
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="recentBorrower">
                    <div class="cardHeader">
                        <h2>Recent Borrower</h2>
                    </div>

                    <table>
                    <?php
                        $query = "SELECT `id`, `name`, `user_id`, `role` FROM `borrow` LIMIT 15";
                        $result = mysqli_query($con, $query);

                        if (!$result) {
                            die("Query failed: " . mysqli_error($con));
                        }

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>";
                            echo "<h4>{$row['name']}<br><span>{$row['role']}</span></h4>";
                            echo "</td>";
                            echo "</tr>";
                        }

                        mysqli_free_result($result);
                        ?>

                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/5eaa044e5f.js" crossorigin="anonymous"></script>
    <script src="JAVASCRIPT/Dashboard.js"></script>
</body>
</html>