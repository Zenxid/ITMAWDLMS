<?php
include 'PHP/connect.php';

if (isset($_POST['retrieval'])) {
    $id = $_POST['id'];

    $fetch_sql = "SELECT * FROM `pc_archive` WHERE id=$id";
    $fetch_result = mysqli_query($con, $fetch_sql);
    $row = mysqli_fetch_assoc($fetch_result);

    $insert_sql = "INSERT INTO `pc` (id, cover, name) VALUES (?, ?, ?)";
    $insert_stmt = mysqli_prepare($con, $insert_sql);
    if ($insert_stmt) {
        mysqli_stmt_bind_param($insert_stmt, "iss", $row['id'], $row['cover'], $row['name']);
        if (!mysqli_stmt_execute($insert_stmt)) {
            echo "Error restoring data: " . mysqli_stmt_error($insert_stmt);
        } else {

            $delete_sql = "DELETE FROM `pc_archive` WHERE id=$id";
            $delete_result = mysqli_query($con, $delete_sql);
            if (!$delete_result) {
                echo "Error deleting data from archive: " . mysqli_error($con);
            }
        }
        mysqli_stmt_close($insert_stmt);
    } else {
        echo "Error preparing statement: " . mysqli_error($con);
    }

    header('location: PC-Archive.php');
    exit();
}


if(isset($_GET['deleteid'])){
    $id=$_GET['deleteid'];

    $sql="delete from `pc_archive` where id=$id";
    $result=mysqli_query($con,$sql);
    if($result){
        header('location:PS4-Archive.php');
    } else {
        die(mysqli_error($con));
    }
}

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

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PC Archive</title>
    <link rel="stylesheet" href="CSS/Book-Database.css">
    <link rel="stylesheet" href="CSS/sidebar.css?v=<?php echo time(); ?>">
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
                <div class="top-title">PC Archive</div>
            </div>
            <!------- END OF TOP-BAR ------>
            <div class="table">
                <div class="table_header">
                    <p>PC Information Table:</p>
                    <div>
                        <form action="" method="GET">
                            <input type="text" name="search" value="<?php if(isset($_GET['search'])){echo $_GET['search'];} ?>" placeholder="Search" />
                            <button type="submit" class="search" style="padding:10px 20px; background-color:#0298cf; color:#fff;">Search</button>
                        </form>
                    </div>
                </div>
                <div class="table_section">
                    <table id="bookTable">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Cover</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <?php

                            $whereClause = "";

                            if (isset($_GET['search'])) {
                                $searchTerm = mysqli_real_escape_string($con, $_GET['search']);
                                $whereClause = "WHERE name LIKE '%$searchTerm%'";
                            }

                            $sql="Select * from `pc_archive` $whereClause";
                            $result=mysqli_query($con,$sql);

                            if($result){
                                while($row=mysqli_fetch_assoc($result)) {
                                    $id=$row['id'];
                                    $cover=$row['cover'];
                                    $name=$row['name'];
                                    
                                    $decodedCover = base64_decode($row['cover']);
                                    echo '<tr>
                                    <td class="user_id">'.$id.'</td>
                                    <td><img src="data:image;base64,' . base64_encode($decodedCover) . '" alt="PC Cover" style="width:80px; height:80px;"></td>
                                    <td>'.$name.'</td>
                                    
                                    <td class="button-container">
                                    <button type="submit" name="view" class="view-btn" style="background-color: #242223;"><i class="fa-solid fa-eye" style="color: white;"></i></button>
                                    <form method="post" action="PC-Archive.php">
                                    <input type="hidden" name="id" value="'.$row['id'].'">
                                        <button type="submit" name="retrieval" class="retrieval-btn" style="background-color: rgb(192, 64, 0);">
                                            <i class="fa-solid fa-arrow-turn-up" style="color: white;"></i>
                                        </button>
                                    </form>
                                    <form method="post" action="PC-Archive.php?deleteid='.$id.'">
                                        <button type="submit" name="delete" class="delete-btn" style="background-color: #f80000;"><i class="fa-solid fa-trash" style="color: white;"></i></button>
                                    </form>
                                    </td>
                                    </tr>';
                                }
                                
                            }

                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-------- END OF TABLE --------->
            <div class="popup">
                <div class="close-btn">&times;</div>
                <h2>PC Details</h2>
                <div class="form">
                    <div class="img-card">
                        <img id="previewImage" src="../Pictures/pcCover.png" alt="" width="200" height="200">
                    </div>
                    <div class="form-card">
                        <div class="form-element">
                            <input type="hidden" id="user_id" name="id" autocomplete="off">
                        </div>
                        <div class="form-element">
                            <label>Name:</label>
                            <div class="readonly" id="name" name="name"></div>
                        </div>
                    </div>
                </div>
            </div>
             <!-------- END OF POP-UP --------->
             
            </div>
        </div>
    </div>


    

    <script src="https://kit.fontawesome.com/5eaa044e5f.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="JAVASCRIPT/Book-Database.js"></script>
</body>
</html>


<script>
        document.querySelectorAll(".view-btn").forEach(btn => {
            btn.addEventListener("click", function() {
                document.querySelector(".popup").classList.add("active");
            });
        });

        document.querySelector(".popup .close-btn").addEventListener("click", function(){
            document.querySelector(".popup").classList.remove("active");
        });

    function display_image(file) 
    {
        var img = document.getElementById("previewImage");
        img.src = URL.createObjectURL(file);

    }


</script>


<script>

$(document).ready(function () {

$('.view-btn').click(function (e){
    e.preventDefault();

    var user_id = $(this).closest('tr').find('.user_id').text();
    console.log(user_id);

    $.ajax({
        method: "POST",
        url: "PHP/retrievalPCArchive.php",
        data: {
            'click_update_btn':true,
            'user_id':user_id,
        },
        success:function(response) {

            $.each(response, function(Key, value){
                
                $('#previewImage').attr('src', 'data:image/png;base64,' + value['cover']);
                $('#user_id').text(value['id']);
                $('#name').text(value['name']);



            })

        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText); 
        }
    })

});

});




</script>