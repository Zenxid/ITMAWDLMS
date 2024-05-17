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
    <title>Admin Notification</title>
    <link rel="stylesheet" href="CSS/Notification.css?V=<?php echo time() ?>">
    <link rel="stylesheet" href="CSS/toast.css?V=<?php echo time() ?>">
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
                <div class="top-title">Notifications</div>
            </div>
            <div class="flex">
                <div class="history-chat">
                    <div class="history-title">
                        <i class='bx bx-history'></i>
                        <p style="margin-left: 5px;">History</p>
                    </div>
                    <div class='card-container'>
                    <?php
                    $sql = "SELECT * FROM notification ORDER BY id DESC LIMIT 10";
                    $result = $con->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            $admin_id = $row["admin_id"];
                            $admin_name = $row["admin_name"];
                            $admin_picture = $row["admin_picture"];
                            $student_id = $row["student_id"];
                            $title = $row['title'];
                            $name = $row["name"];
                            $message = $row["message"];

                            echo "<div class='card'>";
                            echo "<div class='profile'>";
                            echo "<p class='number'>$student_id</p>";
                            echo "<p class='name'>$name</p>";
                            echo "</div>";
                            echo "<div class='message'>";
                            echo "<div class='message-title'>";
                            echo "<p>Title:</p>";
                            echo "</div>";
                            echo "<h4 class='message-content'>$title</p>";
                            echo "</div>";
                            echo "<div class='message'>";
                            echo "<div class='message-title'>";
                            echo "<p>Message:</p>";
                            echo "</div>";
                            echo "<p class='message-content'>$message</p>";
                            echo "</div>";
                            echo "</div>";
                        }
                    } else {
                        echo "<p>No notifications found.</p>";
                    }
                    ?>
                    </div>
                </div>
                <div class="input-data">
                    <div class="input-title">
                        <p><i class='bx bx-chat'></i>Send a Message</p>
                    </div>
                    <div class="inputs">
                        <input type="text" class="autocomplete" name="schoolID" id="schoolID" placeholder="Enter School ID"/>
                        <input type="text" class="autocomplete" name="user" id="user" placeholder="Enter Name"/>
                    </div>
                    <input type="text" class="autocomplete title" name="title" id="title" placeholder="Enter Title">
                    <textarea cols="30" rows="10" placeholder="Enter Message"></textarea>
                    <div class="button-data">
                        <button class="check">Submit</button>
                        <button class="clear">Clear</button>
                    </div>
                </div>
            </div>
            <div class="toast"></div>
        </div>
    </div>
    
    <script src="https://kit.fontawesome.com/5eaa044e5f.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery.devbridge-autocomplete/1.2.24/jquery.autocomplete.min.js'></script>
    <script src="JAVASCRIPT/sidebar.js"></script>
</body>
</html>


<script>
<?php include 'PHP/fetch_user_data.php'; ?>
</script>

<script>
<?php include 'PHP/fetch_user.php'; ?>
</script>

<script>
<?php include 'PHP/fetch_school-ID.php'; ?>
</script>

<script>
$(document).ready(function(){
    $('#schoolID').autocomplete({
        lookup: schoolIDArray,
        onSelect: function(suggestion) {
            var selectedSchoolID = suggestion.value;
            $('#user').val('');
            $.ajax({
                url: 'PHP/fetch_user.php?school_id=' + selectedSchoolID,
                dataType: 'json',
                success: function(data) {
                    console.log("User data:", data);
                    if(data.length > 0) {
                        $('#user').val(data[0].value);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching user data:", error);
                }
            });
        }
    });

    $('#user').autocomplete({
        lookup: userArray,
        onSelect: function(suggestion) {
            $('#selction-ajax').html('You selected: ' + suggestion.value);
            var selectedUser = suggestion.value;
            $.ajax({
                url: 'PHP/fetch_school_id_by_user.php?name=' + selectedUser,
                data: { user: selectedUser },
                dataType: 'json',
                success: function(data) {
                    if(data.length > 0) {
                        $('#schoolID').val(data[0]);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching school ID:", error);
                }
            });
        }
    });
});

$(document).ready(function(){
    $('.check').click(function() {
        var currentUser = '<?php echo $admin_name; ?>';
        var currentUserId = '<?php echo $id; ?>';
        var currentUserPicture = '<?php echo $imageData ?>'

        var schoolID = $('#schoolID').val();
        var user = $('#user').val();
        var title = $('#title').val();
        var message = $('textarea').val();

        if (schoolID === '' || user === '' || title === '' || message === '') {
            alert("Please fill in all fields.");
            return;
        }

        $.ajax({
            url: 'PHP/insert_notification.php',
            method: 'POST',
            data: {
                currentUser: currentUser,
                currentUserId: currentUserId,
                currentUserPicture: currentUserPicture,
                schoolID: schoolID,
                user: user,
                title: title,
                message: message
            },
            success: function(response) {
                showCustomToast("Notification inserted successfully:", true);
                $('#schoolID').val('');
                $('#user').val('');
                $('textarea').val('');
                $('#title').val();
            },
            error: function(xhr, status, error) {
                showCustomToast("Error inserting notification:", false);
            }
        });
    });

    $('.clear').click(function() {
        $('#schoolID').val('');
        $('#user').val('');
        $('textarea').val('');
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


</script>