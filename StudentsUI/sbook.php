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
        case 'admin':
            $sql = "SELECT picture FROM admin WHERE id = $userId";
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

$bookId = isset($_GET['id']) ? $_GET['id'] : null;

if ($bookId) {
    $query = "SELECT * FROM book WHERE ID = $bookId";
    $result = mysqli_query($con, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $bookData = mysqli_fetch_assoc($result);

    } else {
        echo "Book not found";
    }
} else {
    echo "Book ID not provided";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Details</title>
    <link rel="stylesheet" href="CSS/sbook.css?v=<?php echo time() ?>">
    <link rel="stylesheet" href="CSS/notification.css?v=<?php echo time() ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.1/fonts/remixicon.min.css" rel="stylesheet">
</head>
<body>
    <div class="header-container">
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
                <a href="StudentPage-Borrowing.html" class="view-btn">View Books</a>
            </div>

        </header>

    </div>

        <!------------------------------- END OF HEADER ------------------------->
        <div class="single-product">
            <div class="container">
                <div class="wrapper">
                    <div class="breadcrumb">
                        <ul class="flexitem">
                            <li><a href="StudentPage-Home.php">Return To Home</a></li>
                        </ul>
                    </div>

                    <div class="column">
                        <div class="products one">
                            <div class="flexwrap">
                                <div class="row">
                                    <div class="item">
                                        <div class="big-image">
                                            <div class="big-image-wrapper swiper-wrapper">
                                                <div class="image-show swiper-slide">
                                                    <a data-fslightbox href="data:image/jpeg;base64,<?php echo $bookData['Cover']; ?>"><img src="data:image/jpeg;base64,<?php echo $bookData['Cover']; ?>" alt=""></a>
                                                </div>
                                            </div>
                                            <div class="swiper-button-next"></div>
                                            <div class="swiper-button-prev"></div>
                                        </div>

                                        <div thumbSlider="" class="small-image">
                                            <div class="small-image-wrapper flexitem swiper-wrapper">
                                                <li class="thumbnail-show swiper-slide">
                                                    <img src="data:image/jpeg;base64,<?php echo $bookData['Cover']; ?>" alt="">
                                                </li>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="item">
                                        <h1><?php echo $bookData['Title']; ?></h1>
                                        <div class="content">
                                            <div class="rating">
                                                <div class="stars"></div>
                                                <a href="#" class="mini-text">2,251 reviews</a>
                                                <a href="" class="add-review mini-text">Add Your Review</a>
                                            </div>
                                            <div class="stock-sku">
                                                <span class="available">In Stock</span>
                                                <span class="sku min-text"><?php echo $bookData['Quantity'] ?> Available</span>
                                            </div>
                                            <div class="actions">
                                                
                                                <div class="button-cart"><button class="primary-button" data-id="<?php echo $bookData['ID'] ?>" data-title="<?php echo $bookData['Title'] ?>" data-message="Has Been Added To Your Collection" data-image="<?php echo $bookData['Cover'] ?>">Add to book</button></div>
                                                <div class="favorites">
                                                    <ul class="flexitem second-links">
                                                        <li>
                                                            <?php

                                                            function isBoardGameFavorited($userId, $bookId, $con) {
                                                                $query = "SELECT * FROM favorite_book WHERE user_id = $userId AND book_id = $bookId";
                                                                $result = mysqli_query($con, $query);
                                                                return mysqli_num_rows($result) > 0;
                                                            }
                                                            
                                                            $bookId = $bookData['ID'];
                                                            $isFavorited = $userId ? isBoardGameFavorited($userId, $bookId, $con) : false;
                                                            ?>
                                                            <a href="#" id="favoritesButton" data-id="<?php echo $bookId; ?>" data-is-favorited="<?php echo $isFavorited ? 'true' : 'false'; ?>" data-title="<?php echo $bookData['Title'] ?>" data-description="<?php echo $bookData['Description'] ?>" data-image="<?php echo $bookData['Cover']?>">
                                                                <span class="icon-large">
                                                                    <i class="ri-heart-line <?php echo $isFavorited ? 'ri-heart-fill' : ''; ?>" id="heartIcon"></i>
                                                                </span>
                                                                <span>Favorites</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="description collapse">
                                        <ul>
                                            <li class="has-child expand">
                                                <a href="#" class="icon-small">Information</a>
                                                <div class="content">
                                                    <ul>
                                                        <li><span>Author:</span><span><?php echo $bookData['Author']; ?></span></li>
                                                        <li><span>Genre:</span><span><?php echo $bookData['Genre']; ?></span></li>
                                                        <li><span>Year</span><span><?php echo $bookData['Year']; ?></span></li>
                                                        <li><span>ISBN:</span><span><?php echo $bookData['ISBN']; ?></span></li>
                                                    </ul>
                                                </div>
                                                </a>
                                            </li>
                                            <li class="has-child">
                                                <a href="#" class="icon-small">Description</a>
                                                <div class="content">
                                                    <p><?php echo $bookData['Description']; ?></p>
                                                </div>
                                            </li>
                                            <li class="has-child">
                                                <a href="" class="icon-small">Reviews<span class="mini-text">2.2k</span></a>
                                                <div class="content">
                                                    <div class="reviews">
                                                        <h4>Customer Reviews</h4>
                                                        <div class="review-block">
                                                            <div class="review-block-head">
                                                                <div class="flexitem">
                                                                    <span class="rate-sum">4.9</span>
                                                                    <span>2.251 Reviews</span>
                                                                </div>
                                                                <a href="#review-form" class="secondary-button">Write review</a>
                                                            </div>
                                                            <div class="review-block-body">
                                                                <ul>
                                                                    <li class="item">
                                                                        <div class="review-form">
                                                                            <p class="person">Review by Unknown</p>
                                                                            <div class="mini-text">On 7/7/22</div>
                                                                        </div>
                                                                        <div class="review-rating rating">
                                                                            <div class="stars"></div>
                                                                        </div>
                                                                        <div class="review-title">
                                                                            <p>Very good story!</p>
                                                                        </div>
                                                                        <div class="review-text">
                                                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                                                        </div>
                                                                    </li>
                                                                    <li class="item">
                                                                        <div class="review-form">
                                                                            <p class="person">Review by Unknown</p>
                                                                            <div class="mini-text">On 7/7/22</div>
                                                                        </div>
                                                                        <div class="review-rating rating">
                                                                            <div class="stars"></div>
                                                                        </div>
                                                                        <div class="review-title">
                                                                            <p>Very good story!</p>
                                                                        </div>
                                                                        <div class="review-text">
                                                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                                <div class="second-links"><a href="" class="view-all">View all reviews<i class="ri-arrow-right-line"></i></a></div>
                                                            </div>
                                                            <div id="review-form" class="review-form">
                                                                <h4>Write a review</h4>
                                                                <div class="rating">
                                                                    <p>Are you satisfied of the works?</p>
                                                                    <div class="rate-this">
                                                                        <input type="radio" name="rating" id="star5">
                                                                        <label for="star5"><i class="ri-star-fill"></i></label>

                                                                        <input type="radio" name="rating" id="star4">
                                                                        <label for="star4"><i class="ri-star-fill"></i></label>

                                                                        <input type="radio" name="rating" id="star3">
                                                                        <label for="star3"><i class="ri-star-fill"></i></label>

                                                                        <input type="radio" name="rating" id="star2">
                                                                        <label for="star2"><i class="ri-star-fill"></i></label>

                                                                        <input type="radio" name="rating" id="star1">
                                                                        <label for="star1"><i class="ri-star-fill"></i></label>
                                                                    </div>
                                                                </div>
                                                                <form action="">
                                                                    <p>
                                                                        <label>Name</label>
                                                                        <input type="text">
                                                                    </p>
                                                                    <p>
                                                                        <label>Summary</label>
                                                                        <input type="text">
                                                                    </p>
                                                                    <p>
                                                                        <label>Review</label>
                                                                        <textarea cols="30" rows="10"></textarea>
                                                                    </p>
                                                                    <p><a href="#" class="primary-button">Submit Review</a></p>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="circle-menu" class="circle-menu">
            <div id="menu-toggle" class="menu-toggle">
                <a href="StudentPage-Home.php" class="menu-icon"><i class="ph ph-house"></i></a>
            </div>
        </div>
        <div class="notification-container"></div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fslightbox/3.3.1/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="JAVASCRIPT/sbook.js?v=<?php echo time() ?>"></script>
</body>
</html>

<script>

$(document).ready(function() {
    $(".primary-button").click(function() {
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
            displayAddBooks();
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
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

$(document).ready(function() {
    $("#favoritesButton").click(function(event) {
        event.preventDefault();
        
        var bookId = $(this).data("id");
        var cover = $(this).data("image");
        var name = $(this).data("title");
        var description = $(this).data("description");

        var heartIcon = $(this).find(".ri-heart-line");

        var isFavorited = heartIcon.hasClass("ri-heart-fill");

        var action = isFavorited ? "remove" : "add";

        var title = name;
        var message = action === "add" ? "You have favorited " + title + "." : "You have removed " + title + " from favorites.";

        var notification = $('<div class="add-to-notification">\
                                <div class="notification-img">\
                                    <img src="data:image/jpeg;base64,' + cover + '" alt="">\
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

        toggleFavorite(bookId, isFavorited, cover, name, description, function(response) {
            console.log("Toggle favorite response:", response);
            heartIcon.toggleClass("ri-heart-fill", action === "add" && response === "added");
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

</script>