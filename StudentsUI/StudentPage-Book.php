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
    <title>Book</title>
    <link rel="stylesheet" href="CSS/StudentPage-Book.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="CSS/footer.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <style>
        .slider {
        background: url(../Pictures/banner-bg.jpg) no-repeat;
        }
    </style>
</head>
<body>
    <div class="home">
        <header class="header">
            <div class="header-1">
                <div class="logo-details">
                <img src="../Pictures/STI-Small.png" class="logo">
                <p>STI College Muñoz-EDSA Library</p>
                </div>

                <div class="icons">
                    <i class='bx bx-bell notification'></i>
                    <i class='bx bx-book book-notification'></i>
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
                <div class="book-height">
                    
                </div>
                <a href="#" class="borrow-btn">Borrow</a>
                <a href="StudentPage-Borrowing.php" class="view-btn">View Books</a>
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

    <section class="slider" id="slider">
        <div class="row">
            <div class="content">
                <h3>The Books are Here!</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
                    Id dolorem maxime neque numquam facere? Sapiente nihil incidunt et harum. Error.</p>
                <a href="#" class="btn">Try Now</a>
            </div>

            <div class="swiper books-slider">
                <div class="swiper-wrapper">
                    <a href="#" class="swiper-slide"><img src="../Pictures/book6.png" alt=""></a>
                    <a href="#" class="swiper-slide"><img src="../Pictures/book7.png" alt=""></a>
                    <a href="#" class="swiper-slide"><img src="../Pictures/book8.png" alt=""></a>
                    <a href="#" class="swiper-slide"><img src="../Pictures/book9.png" alt=""></a>
                    <a href="#" class="swiper-slide"><img src="../Pictures/book10.webp" alt=""></a>
                    <a href="#" class="swiper-slide"><img src="../Pictures/book11.jpg" alt=""></a>
                    <a href="#" class="swiper-slide"><img src="../Pictures/book12.jpg" alt=""></a>
                    
                            
                </div>

                <img src="../Pictures/stand.png" class="stand" alt="">
            </div>
        </div>
    </section>
    <div class="books">
        <div class="container">
            <div class="wrapper">
                <div class="sectop flexitem">
                    <h2><span class="circle"></span><span>Books</span></h2>
                    <form id="searchForm" class="search">
                        <span class="icon-large"><i class='bx bx-search-alt-2'></i></span>
                        <input id="searchInput" type="search" name="search" placeholder="Search for Books">
                    </form>
                </div>
                <div class="single-category">
                    <div class="container">
                        <div class="wrapper">
                            <div class="column">
                                <div class="holder">
                                        <div class="row sidebar">
                                            <div class="filter">
                                                <div class="filter-block">
                                                    <h4>Genre</h4>
                                                    <ul>
                                                    <?php
                                            
                                                        $select_query = "SELECT genre, COUNT(*) AS genre_count FROM book GROUP BY genre";
                                                        $result = mysqli_query($con, $select_query);

                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            $genre = $row['genre'];
                                                            $genre_count = $row['genre_count'];

                                                            echo '<li>';
                                                            echo '<input type="checkbox" name="checkbox" id="' . $genre . '">';
                                                            echo '<label for="' . $genre . '">';
                                                            echo '<span class="checked"></span>';
                                                            echo '<span>' . $genre . '</span>';
                                                            echo '</label>';
                                                            echo '<span class="count">' . $genre_count . '</span>';
                                                            echo '</li>';
                                                        }
                                                        ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class = "section">
                                        <?php

                                        function isBoardGameFavorited($userId, $bookId, $con) {
                                            $query = "SELECT * FROM favorite_book WHERE user_id = $userId AND book_id = $bookId";
                                            $result = mysqli_query($con, $query);
                                            return mysqli_num_rows($result) > 0;
                                        }

                                        $userId = isset($_SESSION['id']) ? $_SESSION['id'] : null;

                                        $searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

                                        $select_query = "SELECT * FROM book";
                                        if (!empty($searchQuery)) {
                                            $select_query .= " WHERE Title LIKE '%$searchQuery%' OR Author LIKE '%$searchQuery%'";
                                        }
                                        $result = mysqli_query($con, $select_query);

                                        if (mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {

                                                $bookId = $row['ID'];
                                                $isFavorited = $userId ? isBoardGameFavorited($userId, $bookId, $con) : false;

                                                $genres = explode(',', $row['Genre']);

                                                foreach ($genres as &$genre) {
                                                    $genre = str_replace(' ', '_', trim($genre));
                                                }
                                                unset($genre);

                                                $classAttr = 'book-product';
                                                foreach ($genres as $genre) {
                                                    $classAttr .= ' ' . $genre;
                                                }

                                                echo '<div class="'.$classAttr.'">';
                                                echo '<a href="sbook.php?id='.$row['ID'].'" class="image">';
                                                echo '<img src="data:image/jpeg;base64,'.$row['Cover'].'">';
                                                echo '</a>';
                                                echo '<div class="description">';
                                                echo '<h4>'.$row['Title'].'</h4>';
                                                echo '<p>By: '.$row['Author'].'</p>';
                                                echo '</div>';
                                                echo '<div class="button-data">';
                                                echo '<button class="add" data-id="'.$row['ID'].'" data-title="'.$row['Title'].'" data-message="Has Been Added To Your Collection" data-image="'.$row['Cover'].'">';
                                                echo '<i class="bx bx-book"> Add To Book</i>';
                                                echo '</button>';
                                                echo '<button class="favorite" data-id="'.$row['ID'].'" data-title="'.$row['Title'].'" data-description="'.$row['Description'].'" data-image="'.$row['Cover'].'">';
                                                echo '<i class="bx bx-heart' . ($isFavorited ? ' red-heart' : '') . '"></i>';
                                                echo '</button>';
                                                echo '</div>';
                                                echo '</div>';
                                            }
                                        } else {
                                            echo "0 results";
                                        }

                                        ?>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="notification-container"></div>
            </div>
        </div>
    </div>
    <footer>
        <div class="container">
            <p>&copy; 2023 Library Management System</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/5eaa044e5f.js" crossorigin="anonymous"></script>
    <script src="JAVASCRIPT/StudentPage-Book.js"></script>
</body>
</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

$(document).ready(function() {
    $('#searchInput').on('input', function() {
        var searchQuery = $(this).val().trim().toLowerCase();
        filterBooks(searchQuery);
    });

    function filterBooks(searchQuery) {
        $('.book-product').each(function() {
            var title = $(this).find('h4').text().trim().toLowerCase();
            var author = $(this).find('p').text().trim().toLowerCase();
            var matches = title.includes(searchQuery) || author.includes(searchQuery);
            $(this).toggle(matches);
        });
    }
});

$(document).ready(function() {
    $(".add").click(function() {
        var id = $(this).data("id");    
        var title = $(this).data("title");
        var message = $(this).data("message");
        var image = $(this).data("image");
        
        $(this).toggleClass("active");
        
        if ($(this).hasClass("active")) {
            
            addBook(id, title, image);
            var notification = $('<div class="add-to-notification">\
                                    <div class="notification-img">\
                                        <img src="data:image/jpeg;base64,' + image + '" alt="">\
                                    </div>\
                                    <div class="notification-description">\
                                        <h4>' + title + '</h4>\
                                        <p>' + message + '</p>\
                                    </div>\
                                    <div class="progress-bar">\
                                        <div class="progress"></div>\
                                    </div>\
                                </div>');

            $(".notification-container").prepend(notification);

            notification.slideDown();

            setTimeout(function() {
                notification.slideUp(function() {
                    $(this).remove();
                });
            }, 5000);

        } else {
            removeBook(id);
        }
    });
});

function addBook(id, title, image) {
    $.ajax({
        url: "PHP/insert_books.php",
        method: "POST",
        data: {id: id, title: title, image: image},
        success: function(response) {
            console.log(response);
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}

function removeBook(id) {
    $.ajax({
        url: "PHP/remove_book.php",
        method: "POST",
        data: {id: id},
        success: function(response) {
            console.log(response);
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}

$(document).ready(function() {
    $(".favorite").click(function(event) {
        var heartIcon = $(this).find(".bx-heart");
        var bookId = $(this).data("id");
        var isFavorited = heartIcon.hasClass("red-heart");
        var cover = $(this).data("image");
        var name = $(this).data("title");
        var description = $(this).data("description");

        var action = isFavorited ? "remove" : "add";

        var title = name;
        var message = action === "add" ? "You have favorited " + title + "." : "You have removed " + title + " from favorites.";
        var image = cover;

        var notification = $('<div class="add-to-notification">\
                                <div class="notification-img">\
                                    <img src="data:image/jpeg;base64,' + image + '" alt="">\
                                </div>\
                                <div class="notification-description">\
                                    <h4>' + title + '</h4>\
                                    <p>' + message + '</p>\
                                </div>\
                                <div class="progress-bar">\
                                    <div class="progress"></div>\
                                </div>\
                            </div>');

        $(".notification-container").prepend(notification);

        notification.slideDown();

        setTimeout(function() {
            notification.slideUp(function() {
                $(this).remove();
            });
        }, 5000);

        toggleFavorite(bookId, action === "remove", cover, name, description, function(response) {
            console.log("Toggle favorite response:", response);
            heartIcon.toggleClass("red-heart", action === "add" && response === "added");
        });
    });
});



function toggleFavorite(bookId, isFavorited, cover, name, description, callback) {
    $.ajax({
        url: "PHP/book_toggle_favorite.php",
        method: "POST",
        data: { 
            bookId: bookId, 
            isFavorited: isFavorited,
            cover: cover,
            name: name,
            description: description
        },
        success: function(response) {
            callback(response);
        },
        error: function(xhr, status, error) {
            console.error("Error:", error);
        }
    });
}


$(document).ready(function() {
    function displayAddBooks() {
        $.ajax({
            url: "PHP/fetch_add_books.php",
            method: "GET",
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    var books = response.books;
                    var bookContainer = $(".borrow-book .book-height");
                    bookContainer.empty();

                    books.forEach(function(book) {
                        var bookBox = $('<div class="book-box">\
                                            <i class="bx bxs-trash trash" data-id="' + book.id + '"></i>\
                                            <div class="image">\
                                            <img src="data:image/jpeg;base64,' + book.cover + '" alt="image">\
                                            </div>\
                                            <div class="book-content">\
                                                <h3>' + book.title + '</h3>\
                                            </div>\
                                        </div>');
                        bookContainer.append(bookBox);
                    });
                } else {
                    console.error(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
    
    $(".borrow-book .book-height").on("click", ".trash", function() {
        var bookId = $(this).data("id");
        deleteBook(bookId);
    });

    function deleteBook(bookId) {
        $.ajax({
            url: "PHP/remove_book.php",
            method: "POST",
            data: {id: bookId},
            success: function(response) {
                console.log(response);

                displayAddBooks();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    displayAddBooks();
});

document.addEventListener("DOMContentLoaded", function() {
    const checkboxes = document.querySelectorAll('.filter input[type="checkbox"]');

    const books = document.querySelectorAll('.book-product');


    function handleCheckboxChange() {
        const selectedGenres = Array.from(checkboxes)
            .filter(checkbox => checkbox.checked)
            .map(checkbox => checkbox.id);

        books.forEach(book => {
            const isVisible = selectedGenres.length === 0 || selectedGenres.some(genre => book.classList.contains(genre));
            book.classList.toggle('hidden', !isVisible);
        });
    }

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', handleCheckboxChange);
    });
});

</script>