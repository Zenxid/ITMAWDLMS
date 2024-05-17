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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrowing</title>
    <link rel="stylesheet" href="CSS/sidebar.css">
    <link rel="stylesheet" href="CSS/Borrowing.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="CSS/toast.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
                <div class="top-title">Borrowing</div>
            </div>

            <div class="board">
                <div class="table-wrap">
                    <div class="table_container">
                        <div class="table_header">
                            <p class="title">Borrowing Table:</p>
                            <div>
                                <input id="searchInput" placeholder="Search" onkeyup="filterTable()" />
                            </div>
                        </div>
                    </div>
                    <table id="myTable" width="100%">
                        <thead>
                            <tr>
                                <td>School ID</td>
                                <td>Name</td>
                                <td style="width: 10%;">Role</td>
                                <td>Dept/Gr-Section</td>
                                <td>Book Name</td>
                                <td style="width: 8%;">Quantity</td>
                                <td>Due Date</td>
                                <td style="width: 2%"></td>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                            <?php
                                $select_query = "SELECT * FROM `borrow`";
                                $result = mysqli_query($con, $select_query);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td><p>" .$row['school_id']. "</p></td>";
                                    echo "<td><p>". $row['name'] ."</p></td>";
                                    echo "<td><p>". $row['role'] ."</p></td>";
                                    echo "<td><p>".$row['dept_section']."</p></td>";
                                    echo "<td><p>".$row['book_name']."</p></td>";
                                    echo "<td><p>".$row['quantity']."</p></td>";
                                    echo "<td><p>".$row['due_date']."</p></td>";
                                    echo "<td><button class='insert-button data-buttons' data-id='" . $row['id'] . "'><i class='ph ph-arrow-bend-up-left'></i></button></td>";
                                    echo "</tr>";
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="remark-container"></div>
            <div class="toast"></div>
        </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://kit.fontawesome.com/5eaa044e5f.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="JAVASCRIPT/Borrowing.js?v=<?php echo time(); ?>"></script>
    <script src="JAVASCRIPT/sidebar.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
</body>
</html>

<script>

$(document).ready(function() {
    $('.insert-button').click(function() {
        event.stopPropagation();
        var id = $(this).data('id');
        $.ajax({
            type: 'POST',
            url: 'PHP/Borrowing_fetch_remark.php',
            data: { id: id },
            success: function(response) {
                $('.remark-container').html(response);
                $('.remark-container').addClass('show');

                const availableOption = [
                    "Successfully Received in Perfect Condition"
                ];

                $(".successInput").autocomplete({
                    source: availableOption,
                    minLength: 2,
                    delay: 300,
                    autoFocus: true,
                });

                const finesOption = [
                    "Missing Pieces",
                    "Badly Condition Board Game",
                    "Broken Board",
                    "Broken Pieces"
                ];

                $("#finesInput").autocomplete({
                    source: finesOption,
                    minLength: 2,
                    delay: 300,
                    autoFocus: true,
                });

                $('.ui-autocomplete').on('click', function(event) {
                    event.stopPropagation();
                });
            },
            error: function() {
                alert('Error retrieving remark data');
            }
        });
    });

    $(document).on('click', '#successCheck', function() {
        var id = $(this).data('book-id');
        var remark = $('.successInput').val();
        var row_id = $(this).data('row-id');
        $.ajax({
            type: 'POST',
            url: 'PHP/insert_borrowing_archive.php',
            data: { id: id, remark: remark },
            success: function(response) {
                showCustomToast("Book successfully archive", true)
                $('#' + row_id).remove();
                reloadTable();
            },
            error: function() {
                alert('Error inserting data into archive');
            }
        });
    });

    $(document).on('click', '#failedCheck', function() {
        var id = $(this).data('book-id');
        var remark = $('#finesInput').val();
        var price = $('#fines').val();
        var row_id = $(this).data('row-id');
        $.ajax({
            type: 'POST',
            url: 'PHP/insert_to_Borrowfines.php',
            data: { id: id, remark: remark, price: price },
            success: function(response) {
                showCustomToast("Book successfully notify to student fines", true)
                $('#' + row_id).remove();
                reloadTable();
            },
            error: function() {
                alert('Error inserting data into archive');
            }
        });
    });

    function reloadTable() {
        $.ajax({
            type: 'GET',
            url: 'PHP/Borrowing_reload_table.php',
            success: function(response) {
                $('#table-body').html(response);
            },
            error: function() {
                alert('Error reloading table');
            }
        });
    }

    $(document.body).click(function(event) {
        if (!$(event.target).closest('.remark-container').length) {
            $('.remark-container').removeClass('show');
        }
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

function filterTable() {
    var input, filter, table, tr, td, i, j, txtValue;
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("table-body");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        var matchFound = false;
        for (j = 1; j < tr[i].getElementsByTagName("td").length; j++) {
            td = tr[i].getElementsByTagName("td")[j];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    matchFound = true;
                    break;
                }
            }
        }
        if (matchFound) {
            tr[i].style.display = "";
        } else {
            tr[i].style.display = "none";
        }
    }
}

</script>