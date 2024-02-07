

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="StudentPage-Home.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
</head>
<body>
   <div class="container">
        <header class="header">
            <div class="header-1">
                <div class="logo-details">
                <img src="../Pictures/STI-Small.png" class="logo">
                <p>STI College Muñoz-EDSA Library</p>
                </div>

                <div class="icons">
                    <i class='bx bx-bell notification'></i>
                    <i class='bx bx-book book-notification'></i>
                    <a href="StudentProfile.php"><img src="https://upload.wikimedia.org/wikipedia/en/1/14/Balltze_%28Cheems%29.jpg" class="profile"></a>
                </div>
            </div>

            <div class="header-2">
                <div class="navbar">
                    <a href="StudentPage-Home.html">Home</a>
                    <a href="StudentPage-Book.html">Book</a>
                    <a href="#">Board Games</a>
                    <a href="#">PS4</a>
                    <a href="#">PC</a>
                </div>
            </div>

            <div class="notifications_dd">
                <ul class="notifications_ul">
                    <li class="success">
                        <div class="notify_icon">
                            <span class="icon"></span>
                        </div>
                        <div class="notify_data">
                            <div class="title">
                                Markiplier will hunt you.
                            </div>
                            <div class="sub_title">
                                You have 10 mins left.
                            </div>
                        </div>
                    </li>
                    <li class="failed">
                        <div class="notify_icon">
                            <span class="icon"></span>
                        </div>
                        <div class="notify_data">
                            <div class="title">
                                Lorem ipsum dolor sit.
                            </div>
                            <div class="sub_title">
                                Lorem ipsum dolor sit amet,
                                consecutor.
                            </div>
                        </div>
                        <div class="notify_status">
                            <a href="#"><p>Check</p></a>
                        </div>
                    </li>
                    <li class="show_all">
                        <a href="#" class="link">Show All Notifications</a>
                    </li>
                </ul>
            </div>

            <div class="borrow-book">
                <div class="book-box">
                    <i class='bx bxs-trash trash' ></i>
                    <img src="../Pictures/Book2.png" alt="image">
                    <div class="book-content">
                        <h3>Book</h3>
                        <span class="quantity">Quantity: 1</span>
                    </div>
                </div>
                <div class="book-box">
                    <i class='bx bxs-trash trash' ></i>
                    <img src="../Pictures/Book3.png" alt="image">
                    <div class="book-content">
                        <h3>Book</h3>
                        <span class="quantity">Quantity: 1</span>
                    </div>
                </div>
                <div class="book-box">
                    <i class='bx bxs-trash trash' ></i>
                    <img src="../Pictures/Book4.png" alt="image">
                    <div class="book-content">
                        <h3>Book</h3>
                        <span class="quantity">Quantity: 1</span>
                    </div>
                </div>
                <div class="book-box">
                    <i class='bx bxs-trash trash' ></i>
                    <img src="../Pictures/Book5.png" alt="image">
                    <div class="book-content">
                        <h3>Book</h3>
                        <span class="quantity">Quantity: 1</span>
                    </div>
                </div>
                <div class="book-box">
                    <i class='bx bxs-trash trash' ></i>
                    <img src="../Pictures/Book6.png" alt="image">
                    <div class="book-content">
                        <h3>Book</h3>
                        <span class="quantity">Quantity: 1</span>
                    </div>
                </div>
                <a href="#" class="borrow-btn">Borrow</a>
                <a href="StudentPage-Borrowing.html" class="view-btn">View Books</a>
            </div>

        </header>

        <!------------------------------- END OF HEADER ------------------------->

        <div class="bottom-navbar">
            <a href="StudentPage-Home.html"><i class='bx bxs-home'>Home</i></a>
                <a href="StudentPage-Book.html"><i class='bx bxs-book-alt'>Book</i></a>
                <a href="#"><i class='bx bxs-cube-alt' >Board Games</i></a>
                <a href="#"><i class='bx bxs-joystick'>PS4</i></a>
                <a href="#"><i class='bx bx-desktop'>PC</i></a>
        </div>

        <!------------------------------- END OF BOTTOM NAVBAR ------------------------->

        <section class="home" id="home">

            <div class="row">
                <div class="content">
                    <h3>Books Available</h3>
                    <p>Pick your book in the selection of available. Romance, Comedy, Thriller, Thesis, Psychology and much more!</p>
                    <a href="" class="btn">BORROW NOW</a>
                </div>

                <div class="books-list">

                    <div>
                        <a href="#"><img src="../Pictures/Book1.png" alt=""></a>
                        <a href="#"><img src="../Pictures/Book2.png" alt=""></a>
                        <a href="#"><img src="../Pictures/Book3.png" alt=""></a>
                        <a href="#"><img src="../Pictures/Book4.png" alt=""></a>
                        <a href="#"><img src="../Pictures/Book5.png" alt=""></a>
                        <a href="#"><img src="../Pictures/Book6.png" alt=""></a>
                        <a href="#"><img src="../Pictures/Book6.png" alt=""></a>
                        <a href="#"><img src="../Pictures/Book6.png" alt=""></a>
                    </div>
                </div>
            </div>
        </section>

        <!------------------------------- END OF ROW ------------------------->

        <div class="books-section">
            <h2 class="section_title">New Books</h2>

            <div class="book-sections-container">
                <div class="book-swiper swiper">
                    <div class="swiper-wrapper">
                        <a href="sbook.html" class="book-card swiper-slide">
                            <img src="../Pictures/Book1.png" alt="image" class="book-img">

                            <div>
                                <h2 class="book-title">New Book</h2>
                                <span class="book-author">Author: Author </span>

                                <div class="book-stars">
                                    <i class='bx bxs-star' ></i>
                                    <i class='bx bxs-star' ></i>
                                    <i class='bx bxs-star' ></i>
                                    <i class='bx bxs-star' ></i>
                                    <i class='bx bxs-star-half' ></i>
                                </div>
                            </div>
                        </a>
                        <a href="sbook.html" class="book-card swiper-slide">
                            <img src="../Pictures/Book1.png" alt="image" class="book-img">

                            <div>
                                <h2 class="book-title">New Book</h2>
                                <span class="book-author">Author: Author </span>

                                <div class="book-stars">
                                    <i class='bx bxs-star' ></i>
                                    <i class='bx bxs-star' ></i>
                                    <i class='bx bxs-star' ></i>
                                    <i class='bx bxs-star' ></i>
                                    <i class='bx bxs-star-half' ></i>
                                </div>
                            </div>
                        </a>
                        <a href="sbook.html" class="book-card swiper-slide">
                            <img src="../Pictures/Book1.png" alt="image" class="book-img">

                            <div>
                                <h2 class="book-title">New Book</h2>
                                <span class="book-author">Author: Author </span>

                                <div class="book-stars">
                                    <i class='bx bxs-star' ></i>
                                    <i class='bx bxs-star' ></i>
                                    <i class='bx bxs-star' ></i>
                                    <i class='bx bxs-star' ></i>
                                    <i class='bx bxs-star-half' ></i>
                                </div>
                            </div>
                        </a>
                        <a href="sbook.html" class="book-card swiper-slide">
                            <img src="../Pictures/Book1.png" alt="image" class="book-img">

                            <div>
                                <h2 class="book-title">New Book</h2>
                                <span class="book-author">Author: Author </span>

                                <div class="book-stars">
                                    <i class='bx bxs-star' ></i>
                                    <i class='bx bxs-star' ></i>
                                    <i class='bx bxs-star' ></i>
                                    <i class='bx bxs-star' ></i>
                                    <i class='bx bxs-star-half' ></i>
                                </div>
                            </div>
                        </a>
                        <a href="sbook.html" class="book-card swiper-slide">
                            <img src="../Pictures/Book1.png" alt="image" class="book-img">

                            <div>
                                <h2 class="book-title">New Book</h2>
                                <span class="book-author">Author: Author </span>

                                <div class="book-stars">
                                    <i class='bx bxs-star' ></i>
                                    <i class='bx bxs-star' ></i>
                                    <i class='bx bxs-star' ></i>
                                    <i class='bx bxs-star' ></i>
                                    <i class='bx bxs-star-half' ></i>
                                </div>
                            </div>
                        </a>
                        <a href="sbook.html" class="book-card swiper-slide">
                            <img src="../Pictures/Book1.png" alt="image" class="book-img">

                            <div>
                                <h2 class="book-title">New Book</h2>
                                <span class="book-author">Author: Author </span>

                                <div class="book-stars">
                                    <i class='bx bxs-star' ></i>
                                    <i class='bx bxs-star' ></i>
                                    <i class='bx bxs-star' ></i>
                                    <i class='bx bxs-star' ></i>
                                    <i class='bx bxs-star-half' ></i>
                                </div>
                            </div>
                        </a>
                        <a href="sbook.html" class="book-card swiper-slide">
                            <img src="../Pictures/Book1.png" alt="image" class="book-img">

                            <div>
                                <h2 class="book-title">New Book</h2>
                                <span class="book-author">Author: Author </span>

                                <div class="book-stars">
                                    <i class='bx bxs-star' ></i>
                                    <i class='bx bxs-star' ></i>
                                    <i class='bx bxs-star' ></i>
                                    <i class='bx bxs-star' ></i>
                                    <i class='bx bxs-star-half' ></i>
                                </div>
                            </div>
                        </a>
                        <a href="sbook.html" class="book-card swiper-slide">
                            <img src="../Pictures/Book1.png" alt="image" class="book-img">

                            <div>
                                <h2 class="book-title">New Book</h2>
                                <span class="book-author">Author: Author </span>

                                <div class="book-stars">
                                    <i class='bx bxs-star' ></i>
                                    <i class='bx bxs-star' ></i>
                                    <i class='bx bxs-star' ></i>
                                    <i class='bx bxs-star' ></i>
                                    <i class='bx bxs-star-half' ></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="books-section">
            <h2 class="section_title">Recommendation</h2>

            <div class="book-sections-container">
                <div class="book-swiper swiper">
                    <div class="swiper-wrapper">
                        <a href="#" class="book-card swiper-slide">
                            <img src="../Pictures/Book1.png" alt="image" class="book-img">

                            <div>
                                <h2 class="book-title">Recommendation Book</h2>
                                <span class="book-author">Author: Author </span>

                                <div class="book-stars">
                                    <i class='bx bxs-star' ></i>
                                    <i class='bx bxs-star' ></i>
                                    <i class='bx bxs-star' ></i>
                                    <i class='bx bxs-star' ></i>
                                    <i class='bx bxs-star-half' ></i>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="book-card swiper-slide">
                            <img src="../Pictures/Book1.png" alt="image" class="book-img">

                            <div>
                                <h2 class="book-title">Recommendation Book</h2>
                                <span class="book-author">Author: Author </span>

                                <div class="book-stars">
                                    <i class='bx bxs-star' ></i>
                                    <i class='bx bxs-star' ></i>
                                    <i class='bx bxs-star' ></i>
                                    <i class='bx bxs-star' ></i>
                                    <i class='bx bxs-star-half' ></i>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="book-card swiper-slide">
                            <img src="../Pictures/Book1.png" alt="image" class="book-img">

                            <div>
                                <h2 class="book-title">Recommendation Book</h2>
                                <span class="book-author">Author: Author </span>

                                <div class="book-stars">
                                    <i class='bx bxs-star' ></i>
                                    <i class='bx bxs-star' ></i>
                                    <i class='bx bxs-star' ></i>
                                    <i class='bx bxs-star' ></i>
                                    <i class='bx bxs-star-half' ></i>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="book-card swiper-slide">
                            <img src="../Pictures/Book1.png" alt="image" class="book-img">

                            <div>
                                <h2 class="book-title">Recommendation Book</h2>
                                <span class="book-author">Author: Author </span>

                                <div class="book-stars">
                                    <i class='bx bxs-star' ></i>
                                    <i class='bx bxs-star' ></i>
                                    <i class='bx bxs-star' ></i>
                                    <i class='bx bxs-star' ></i>
                                    <i class='bx bxs-star-half' ></i>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="book-card swiper-slide">
                            <img src="../Pictures/Book1.png" alt="image" class="book-img">

                            <div>
                                <h2 class="book-title">Recommendation Book</h2>
                                <span class="book-author">Author: Author </span>

                                <div class="book-stars">
                                    <i class='bx bxs-star' ></i>
                                    <i class='bx bxs-star' ></i>
                                    <i class='bx bxs-star' ></i>
                                    <i class='bx bxs-star' ></i>
                                    <i class='bx bxs-star-half' ></i>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="book-card swiper-slide">
                            <img src="../Pictures/Book1.png" alt="image" class="book-img">

                            <div>
                                <h2 class="book-title">Recommendation Book</h2>
                                <span class="book-author">Author: Author </span>

                                <div class="book-stars">
                                    <i class='bx bxs-star' ></i>
                                    <i class='bx bxs-star' ></i>
                                    <i class='bx bxs-star' ></i>
                                    <i class='bx bxs-star' ></i>
                                    <i class='bx bxs-star-half' ></i>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="book-card swiper-slide">
                            <img src="../Pictures/Book1.png" alt="image" class="book-img">

                            <div>
                                <h2 class="book-title">Recommendation Book</h2>
                                <span class="book-author">Author: Author </span>

                                <div class="book-stars">
                                    <i class='bx bxs-star' ></i>
                                    <i class='bx bxs-star' ></i>
                                    <i class='bx bxs-star' ></i>
                                    <i class='bx bxs-star' ></i>
                                    <i class='bx bxs-star-half' ></i>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="book-card swiper-slide">
                            <img src="../Pictures/Book1.png" alt="image" class="book-img">

                            <div>
                                <h2 class="book-title">Recommendation Book</h2>
                                <span class="book-author">Author: Author </span>

                                <div class="book-stars">
                                    <i class='bx bxs-star' ></i>
                                    <i class='bx bxs-star' ></i>
                                    <i class='bx bxs-star' ></i>
                                    <i class='bx bxs-star' ></i>
                                    <i class='bx bxs-star-half' ></i>
                                </div>
                            </div>
                        </a>
                    </div>
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
                            <a href="#" class="row-btn">Show me all</a>
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
                            <a href="#" class="row-btn">Show me all</a>
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
                            <a href="#" class="row-btn">Show me all</a>
                        </div>
                        <div class="row-img">
                            <img src="../Pictures/pc.png">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="StudentPage-Home.js"></script>
</body>
</html>

<?php

?>