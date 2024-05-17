<?php
include "..\PHP\connect.php";

$profilePicture = "";

if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
    $userId = $_SESSION['id'];
    $userRole = $_SESSION['role'];
    $school_id = $_SESSION['school_id'];

    switch ($userRole) {
        case 'student':
            $sql = "SELECT picture FROM student WHERE id = $userId";
            break;
        case 'teacher':
            $sql = "SELECT picture FROM teacher WHERE id = $userId";
            break;
        default:
            break;
    }

    $result = mysqli_query($con, $sql);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $profilePicture = $row['picture'];

            if (!empty($profilePicture) && is_string($profilePicture)) {
                $base64Image = base64_encode($profilePicture);
                $imageSrc = "data:image/jpeg;base64," . $base64Image;
            } else {
                $imageSrc = "../Pictures/no-user-images.png";
            }
        } else {
            echo "No profile picture found for the user.";
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
    <title>Home</title>
    <link rel="stylesheet" href="CSS/StudentPage-Home.css?v=<?php echo time() ?>">
    <link rel="stylesheet" href="CSS/footer.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css'><link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/flickity/1.0.0/flickity.css'><link rel="stylesheet" href="./style.css">
    <style>
        .home {
            background: url(../Pictures/background.jpg);
        }
    </style>
</head>
<body>
   <div class="container">
    <div id="preloader">
        <div class="book">
            <div class="inner">
                <div class="left"></div>
                <div class="middle"></div>
                <div class="right"></div>
            </div>
            <ul>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>
    </div>
        <header class="header">
            <div class="header-1">
                <div class="logo-details">
                <img src="../Pictures/STI-Small.png" class="logo">
                <p>STI College Muñoz-EDSA Library</p>
                </div>

                <div class="icons">
                    <i class='bx bx-bell notification'></i>
                    <i class='bx bx-star book-notification'></i>
                    <a href="StudentPage-ProfileHome.php"><img src="<?php echo $imageSrc; ?>" class="profile"></a>
                </div>
            </div>

            <div class="header-2">
                <div class="navbar">
                    <a href="StudentPage-Home.php">Home</a>
                    <a href="StudentPage-Book.php">Book</a>
                    <a href="StudentPage-BoardGames.php">Board Games</a>
                    <a href="StudentPage-PS4.php">PS4</a>
                    <a href="StudentPage-PC.php">PC</a>
                </div>
            </div>

            <div class="notifications_dd">
                <ul class="notifications_ul">
                    <li class="success">
                        <?php

                            $student_id = $school_id;
                            $sql = "SELECT * FROM notification WHERE student_id = '$student_id' LIMIT 5";
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
                                    
                                    echo "<li>";
                                    echo "<div class='notify_icon'><img src='data:image/jpeg;base64," . $admin_picture . "'></div>";
                                    echo "<div class='notify_data'>";
                                    echo "<div class='title'>".$title."</div>";
                                    echo "<div class='sub_title'>".$message."</div>";
                                    echo "</div>";
                                    echo "</li>";
                                }
                            } else {
                                echo "No notifications found.";
                            }
                            ?>
                    <li class="show_all">
                        <a href="StudentPage-Notifications.php" class="link">Show All Notifications</a>
                    </li>
                </ul>
            </div>

            <div class="borrow-book">
                <?php

                $sql = "(SELECT * FROM favorite_board WHERE user_id = '$userId' LIMIT 5)
                        UNION
                        (SELECT * FROM favorite_book WHERE user_id = '$userId' LIMIT 5)
                        UNION
                        (SELECT * FROM favorite_ps4 WHERE user_id = '$userId' LIMIT 5)";
                $result = $con->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $cover = $row['cover'];
                        $name = $row['name'];
                        
                        echo "<div class='book-box'>";
                        echo "<img src='data:image/jpeg;base64," . $cover . "'>";
                        echo "<div class='notify_data'>";
                        echo "<div class='book-content'>";
                        echo "<h3>$name</h3>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "No favorites found.";
                }
                ?>
                

            </div>

        </header>

        <!------------------------------- END OF HEADER ------------------------->

        <div class="bottom-navbar">
            <a href="StudentPage-Home.php"><i class='bx bxs-home'></i></a>
            <a href="StudentPage-Book.php"><i class='bx bxs-book-alt'></i></a>
            <a href="StudentPage-BoardGames.php"><i class='bx bxs-cube-alt'></i></a>
            <a href="StudentPage-PS4.php"><i class='bx bxs-joystick'></i></a>
            <a href="StudentPage-PC.php"><i class='bx bx-desktop'></i></a>
        </div>

        <!------------------------------- END OF BOTTOM NAVBAR ------------------------->

        <section class="home" id="home">

            <div class="content">
                <h2>Popular Books</h2>
                <p> A Popular Books</p>
                <ul class="counter">
                  <li>
                    <h3><i class="fa-solid fa-book"></i>800</h3>
                    <span>Book Collections</span>
                  </li>
                </ul>
                <a href="StudentPage-Book.php">
                <button class="btn">Go to Book <i class="fa-solid fa-arrow-right"></i></button>
                </a>
              </div>
            
              <div class="swiper-container">
                <div class="swiper">
                  <div class="swiper-wrapper">
                    <div class="swiper-slide swiper-slide--one">
            
                      <span>Popular</span>
                      <div class="slide-content">
                        <h3>The Raven</h3>
            
                      </div>
                    </div>
                    <div class="swiper-slide swiper-slide--two">
                      <span>Popular</span>
                      <div class="slide-content">
                        <h3>Mademoiselle</h3>
                        <p>epic drama</p>
            
                      </div>
            
                    </div>
                    <div class="swiper-slide swiper-slide--three">
                      <span>Popular</span>
            
                    </div>
                    <div class="swiper-slide swiper-slide--four">
                      <span>Popular</span>
            
                    </div>
                    <div class="swiper-slide swiper-slide--five">
                      <span>Popular</span>
            
                    </div>
                    <div class="swiper-slide swiper-slide--six">
                      <span>Popular</span>
                      <div class="slide-content">
                        <h3>Woman in the dark</h3>
                      </div>
            
                    </div>
            
                  </div>
            
                </div>
            
                <div class="swiper-pagination"></div>
              </div>
        </section>

        <!------------------------------- END OF ROW ------------------------->

        <div class="books-section">
            <h2 class="section_title">New Books</h2>

            <div class="book-slide">
                <div class="flickity-book js-flickity" data-flickity-options='{ "wrapAround": true }'>
                <?php
                
                    $select_query = "SELECT * FROM book LIMIT 5";
                    $result = mysqli_query($con, $select_query);
                    
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<div class="book-cell">';
                            echo '<div class="book-img">';
                            echo '<img src="data:image/jpeg;base64,' . $row['Cover'] . '" alt="" class="book-photo">';
                            echo '</div>';
                            echo '<div class="book-content">';
                            echo '<div class="book-title">' . $row['Title'] . '</div>';
                            echo '<div class="book-author">by ' . $row['Author'] . '</div>';
                            echo '<div class="rate">
                            <fieldset class="rating blue">
                             <input type="checkbox" id="star6" name="rating" value="5" />
                             <label class="full1" for="star6"></label>
                             <input type="checkbox" id="star7" name="rating" value="4" />
                             <label class="full1" for="star7"></label>
                             <input type="checkbox" id="star8" name="rating" value="3" />
                             <label class="full1" for="star8"></label>
                             <input type="checkbox" id="star9" name="rating" value="2" />
                             <label class="full1" for="star9"></label>
                             <input type="checkbox" id="star10" name="rating" value="1" />
                             <label class="full1" for="star10"></label>
                            </fieldset>
                            <span class="book-voters">2 reviews</span>
                           </div>';
                            echo '<div class="book-sum">' . $row['Description'] . '</div>';
                            echo '<a href="sbook.php?id=' . $row['ID'] . '"><div class="book-see">See The Book</div></a>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<div>No books found.</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="books-section">
            <h2 class="section_title">Recommendation</h2>

            <div class="book-slide">
                <div class="flickity-book js-flickity" data-flickity-options='{ "wrapAround": true }'>
                <?php
                
                $select_query = "SELECT * FROM book ORDER BY RAND() LIMIT 5";
                $result = mysqli_query($con, $select_query);
                
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="book-cell">';
                        echo '<div class="book-img">';
                        echo '<img src="data:image/jpeg;base64,' . $row['Cover'] . '" alt="" class="book-photo">';
                        echo '</div>';
                        echo '<div class="book-content">';
                        echo '<div class="book-title">' . $row['Title'] . '</div>';
                        echo '<div class="book-author">by ' . $row['Author'] . '</div>';
                        echo '<div class="rate">
                        <fieldset class="rating blue">
                         <input type="checkbox" id="star6" name="rating" value="5" />
                         <label class="full1" for="star6"></label>
                         <input type="checkbox" id="star7" name="rating" value="4" />
                         <label class="full1" for="star7"></label>
                         <input type="checkbox" id="star8" name="rating" value="3" />
                         <label class="full1" for="star8"></label>
                         <input type="checkbox" id="star9" name="rating" value="2" />
                         <label class="full1" for="star9"></label>
                         <input type="checkbox" id="star10" name="rating" value="1" />
                         <label class="full1" for="star10"></label>
                        </fieldset>
                        <span class="book-voters">2 reviews</span>
                       </div>';
                        echo '<div class="book-sum">' . $row['Description'] . '</div>';
                        echo '<a href="sbook.php?id=' . $row['ID'] . '"><div class="book-see">See The Book</div></a>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<div>No books found.</div>';
                }
                ?>
                </div>
            </div>
        </div>

        <!------------------------------- END OF BOOKS-SECTION ------------------------->

        <div class="feature">
            <div class="middle-text">
                <h2>Discover More <span>Good things.</span></h2>
            </div>

            <div class="feature-content">
                <div class="row">
                    <div class="main-row">
                        <div class="row-text">
                            <h6>Explore Board Games</h6>
                            <h3>Board Games <br> for you</h3>
                            <a href="StudentPage-BoardGames.php" class="row-btn">Show me all</a>
                        </div>
                        <div class="row-img">
                            <img src="../Pictures/board.png">
                        </div>
                    </div>
                </div>

                <div class="row row2">
                    <div class="main-row">
                        <div class="row-text">
                            <h6>Explore PS4 Games</h6>
                            <h3>PS4 Games <br> for you</h3>
                            <a href="StudentPage-PS4.php" class="row-btn">Show me all</a>
                        </div>
                        <div class="row-img">
                            <img src="../Pictures/ps4.png">
                        </div>
                    </div>
                </div>

                <div class="row row3">
                    <div class="main-row">
                        <div class="row-text">
                            <h6>Explore PC</h6>
                            <h3>Check PC <br> for you</h3>
                            <a href="StudentPage-PC.php" class="row-btn">Show me all</a>
                        </div>
                        <div class="row-img">
                            <img src="../Pictures/pc.png">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <p>&copy; 2023 Library Management System</p>
        </div>
    </footer>
    
    <script src='https://cdnjs.cloudflare.com/ajax/libs/flickity/1.0.0/flickity.pkgd.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="JAVASCRIPT/StudentPage-Home.js"></script>
</body>
</html>
