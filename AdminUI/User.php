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

$sqlTeachers = "SELECT * FROM `teacher` ORDER BY id DESC LIMIT 5";
$resultTeachers = mysqli_query($con, $sqlTeachers);

if (!$resultTeachers) {
    die("Error executing query: " . mysqli_error($con));
}

$sqlStudents = "SELECT * FROM `student` ORDER BY id DESC LIMIT 5";
$resultStudents = mysqli_query($con, $sqlStudents);

if (!$resultStudents) {
    die("Error executing query: " . mysqli_error($con));
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="CSS/User.css?v=<?php echo time(); ?>">
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
        <!------- END OF SIDEBAR ------>
        <div class="main">
            <div class="top-bar">
                <div class="top-title">User Management</div>
            </div>
        
            <div class="cardBox">

                <div class="card">
                    <div>
                        <div class="numbers"><?php echo $totalUsers; ?></div>
                        <div class="cardName">Total Users</div>
                    </div>

                    <div class="iconBx">
                        <i class='bx bxs-user-account'></i>
                    </div>
                </div>

                <a href="Teacher.php">
                    <div class="card">
                        <div>
                            <div class="numbers"><?php echo $totalTeachers; ?></div>
                            <div class="cardName">Teachers</div>
                        </div>

                        <div class="iconBx">
                            <i class='bx bxs-user-pin'></i>
                        </div>
                    </div>
                </a>

                <a href="Student.php">
                    <div class="card">
                        <div>
                            <div class="numbers"><?php echo $totalStudents; ?></div>
                            <div class="cardName">Students</div>
                        </div>

                        <div class="iconBx">
                            <i class='bx bxs-user-pin'></i>
                        </div>
                    </div>
                </a>
            </div>
            <div class="board">
                <div class="table-wrap">
                    <p class="title">Teachers</p>
                    <table width="100%">
                         <thead>
                            <tr>
                                <td style="width: 9%;">Picture</td>
                                <td>Name</td>
                                <td>Faculty</td>
                                
                            </tr>
                         </thead>
                         <tbody>
                         <?php
                            if (mysqli_num_rows($resultTeachers) > 0) {
                                while ($row = mysqli_fetch_assoc($resultTeachers)) {
                                    $profilePicture = base64_encode($row['picture']);
                                    $name = $row['name'];
                                    $faculty = $row['faculty_name'];
                                    echo '<tr>
                                            <td class="profile">
                                                <img src="data:image;base64,' . $profilePicture . '">
                                            </td>
                                            <td class="name">
                                                <p>' . $name . '</p>
                                            </td>
                                            <td class="department">
                                                <p>' . $faculty . '</p>
                                            </td>
                                        </tr>';
                                }
                            } else {
                                echo "<tr><td colspan='3'>No teachers found.</td></tr>";
                            }
                            ?>
                         </tbody>
                    </table>
                        <div class="more">
                            <a href="Teacher.php">More Info</a>
                        </div>
                    </div>
                    <div class="table-wrap">
                        <p class="title">Students</p>
                        <table width="100%">
                             <thead>
                                <tr>
                                    <td style="width: 9%;">Picture</td>
                                    <td>Name</td>
                                    <td style="width: 12%;">Year Level</td>
                                    <td style="width: 8%;">Grade/Year</td>
                                    <td>Track/Course</td>
                                    <td style="width: 20%;">Section</td>
                                </tr>
                             </thead>
                             <tbody>
                             <?php
                                if (mysqli_num_rows($resultStudents) > 0) {
                                    while ($row = mysqli_fetch_assoc($resultStudents)) {
                                        $profilePicture = base64_encode($row['picture']);
                                        $name = $row['name'];
                                        $year = $row['acad_year'];
                                        $grade = $row['grade'];
                                        $track_course = $row['track_course'];
                                        $section = $row['section'];
                                        echo '<tr>
                                                <td class="profile">
                                                    <img src="data:image;base64,' . $profilePicture . '">
                                                </td>
                                                <td class="name">
                                                    <p>' . $name . '</p>
                                                </td>
                                                <td class="year">
                                                    <p>' . $year . '</p>
                                                </td>
                                                <td class="grade">
                                                    <p>' . $grade . '</p>
                                                </td>
                                                <td class="track_course">
                                                    <p>' . $track_course . '</p>
                                                </td>
                                                <td class="section">
                                                    <p>' . $section . '</p>
                                                </td>
                                            </tr>';
                                    }
                                } else {
                                    echo "<tr><td colspan='3'>No student found.</td></tr>";
                                }
                                ?>
                             </tbody>
                        </table>
                            <div class="more">
                                <a href="#">More Info</a>
                            </div>
                        </div>
            </div>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/5eaa044e5f.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="JAVASCRIPT/User.js"></script>
</body>
</html>