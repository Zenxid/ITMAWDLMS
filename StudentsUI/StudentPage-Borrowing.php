<?php
include "..\PHP\connect.php";

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
    <title>Borrow Page</title>
    <link rel="stylesheet" href="CSS/StudentPage-Borrowing.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="CSS/StudentPage-sidebar.css?v=<?php echo time(); ?>">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
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
                    <li class="active">
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
        <div class="single-cart">
            <div class="container">
                <div class="wrapper">
                    <div class="page-title">
                        <h1>Borrowing Books</h1>
                    </div>
                    <div class="products one cart">
                        <div class="flexwrap">
                            <form action="" class="form-cart">
                                <div class="item">
                                    <table id="cart-table">
                                        <thead>
                                            <tr>
                                                <th>Book</th>
                                                <th>Qty</th>
                                                <th>Date</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        include 'PHP/connect.php';

                                        if (!isset($_SESSION['role'])) {
                                            echo json_encode(["success" => false, "message" => "User role not set"]);
                                            exit;
                                        }

                                        if ($_SESSION['role'] === 'student') {
                                            $idColumn = 'student_id';
                                        } elseif ($_SESSION['role'] === 'teacher') {
                                            $idColumn = 'faculty_id';
                                        } else {
                                            echo json_encode(["success" => false, "message" => "Invalid user role"]);
                                            exit;
                                        }

                                        $user_id = $_SESSION['id'];

                                        $select_query = "SELECT id, book_id, cover, title, author, quantity, date
                                                        FROM add_book 
                                                        WHERE $idColumn = ?";
                                        $stmt = $con->prepare($select_query);
                                        $stmt->bind_param("i", $user_id);
                                        $stmt->execute();
                                        $result = $stmt->get_result();

                                        if ($result) {
                                            while ($row = $result->fetch_assoc()) {
                                                $rowId = $row['id'];
                                                echo '<tr data-row-id="' . $rowId . '" data-max-quantity="' . $row['quantity'] . '">';
                                                echo '<td class="flexitem">';
                                                echo '<div class="thumbnail object-cover">';
                                                echo '<a href="sbook.php?id=' . $row['book_id'] . '"><img src="data:image/jpeg;base64,' . $row['cover'] . '" alt=""></a>';
                                                echo '</div>';
                                                echo '<div class="content">';
                                                echo '<strong><a href="#">' . $row['title'] . '</a></strong>';
                                                echo '<p>Author: ' . $row['author'] . '</p>';
                                                echo '</div>';
                                                echo '</td>';
                                                echo '<td>';
                                                echo '<div class="qty-control flexitem">';
                                                echo '<button type="button" class="minus">-</button>';
                                                echo '<input type="number" name="selected_quantity" value="1" min="1" max="' . $row['quantity'] . '">';
                                                echo '<button type="button" class="plus">+</button>';
                                                echo '</div>';
                                                echo '</td>';
                                                echo '<td>' . $row['date'] . '</td>';
                                                echo '<td><a class="delete-row"><i class="ri-close-line"></i></a></td>';
                                                echo '</tr>';
                                            }
                                        } else {
                                            echo "Error fetching data: " . mysqli_error($con);
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                            <button class="secondary-button" id="Borrow-Button">Borrow</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="validation-container">
          <div class="validation-wrapper" id="validation-wrapper">
              <div class="validation-content">
                  <img src="../Pictures/checkmark.png" class="validation-img" alt="illustration"/>
                  <h2 class="validation-title">Congratulations!</h2>
                  <p class="validation-description"><br>You Have Sucessfully Borrowed Book <br/><br> Please Proceed to the Librarian</p>

                  <button class="validation-button validation-width">OK</button>
              </div>
          </div>
        </div>
    </main>
    <div id="circle-menu" class="circle-menu">
        <div id="menu-toggle" class="menu-toggle">
            <div class="menu-icon"><i class="icon ph ph-books"></i></div>
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
    <script src="JAVASCRIPT/StudentPage-Borrowing.js?v=<?php echo time(); ?>"></script>
    <script src="JAVASCRIPT/StudentPage-Sidebar.js?v=<?php echo time(); ?>"></script>
</body>
</html>

<script>
    $(document).ready(function() {
    $("#Borrow-Button").click(function() {
        var selectedQuantity = $('[name="selected_quantity"]').val();

        $.ajax({
            url: "PHP/borrow_book.php",
            method: "POST",
            dataType: "json",
            data: {
                selected_quantity: selectedQuantity
            },
            success: function(response) {
                if (response.success) {
                    var rowToRemove = $('[name="selected_quantity"]').closest('tr');
                    rowToRemove.remove();

                    $("#validation-wrapper").show();
                } else {
                    alert("Failed to borrow book: " + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});

</script>