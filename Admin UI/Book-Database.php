<?php
include 'connect.php';



if(isset($_GET['deleteid'])){
    $id=$_GET['deleteid'];

    $sql="delete from `book` where id=$id";
    $result=mysqli_query($con,$sql);
    if($result){
        header('location:Book-Database.php');
    } else {
        die(mysqli_error($con));
    }
}





if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];
    $year = $_POST['year'];
    $quantity = $_POST['quantity'];
    $isbn = $_POST['isbn'];

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $temp = $_FILES['image']['tmp_name'];
        $cover = base64_encode(file_get_contents($temp));
    } else {
        $cover = '';  // Set a default value if no file is uploaded
    }

    // Database connection and query
    $sql = "INSERT INTO `book` (cover, title, author, genre, year, quantity, isbn) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $sql);

    // Check if the prepare statement succeeded
    if ($stmt) {
        // Bind parameters
        mysqli_stmt_bind_param($stmt, "ssssisi", $cover, $title, $author, $genre, $year, $quantity, $isbn);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            header('location:Book-Database.php');
            exit();
        } else {
            echo "Error executing statement: " . mysqli_stmt_error($stmt);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing statement: " . mysqli_error($con);
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Database</title>
    <link rel="stylesheet" href="Book-Database.css">
    <link rel="stylesheet" href="sidebar.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <div class="logo_details">
                <img src="/LMS/Pictures/STI-Small.png">
                <div class="logo_name">Admin Office</div>
                <i class="bx bx-menu" id="btn"></i>
            </div>
            <ul class="nav-list">
                <li>
                    <div class="icon-link">
                    <a href="Dashboard.html">
                        <i class="bx bx-grid-alt"></i>
                        <span class="link_name">Dashboard</span>
                    </a>
                    <span class="tooltip">Dashboard</span>
                    </div>
                </li>
    
                <li>
                    <div class="icon-link">
                        <a href="Book.html" class="menu-link book-link">
                            <i class='bx bxs-book'></i>
                            <span class="link_name">Book Management</span>
                        </a>
                        <i class='bx bx-chevron-down drop-down'></i>
                    </div>
                    <ul class="sub-menu">
                        <li><p class="link_name">Book Management</p></li>
                        <li><a href="#">Books Database</a></li>
                        <li><a href="#">Archive</a></li>
                    </ul>
                </li>
    
                <li>
                    <div class="icon-link">
                        <a href="#" class="menu-link book-link">
                            <i class='bx bx-joystick'></i>
                            <span class="link_name">Activities Management</span>
                        </a>
                        <i class='bx bx-chevron-down drop-down'></i>
                    </div>
                    <ul class="sub-menu">
                        <li><p class="link_name">Activities Management</p></li>
                        <li><a href="#">PC</a></li>
                        <li><a href="#">PS4</a></li>
                        <li><a href="#">Board Games</a></li>
                    </ul>
                </li>
    
                <li>
                    <div class="icon-link">
                        <a href="#" class="menu-link book-link">
                            <i class='bx bx-user'></i>
                            <span class="link_name">User Management</span>
                        </a>
                        <i class='bx bx-chevron-down drop-down'></i>
                    </div>
                    <ul class="sub-menu">
                        <li><p class="link_name">User Management</p></li>
                        <li><a href="#">Moderator</a></li>
                        <li><a href="#">Teacher</a></li>
                        <li><a href="#">Student</a></li>
                    </ul>
                </li>
    
                <li>
                    <div class="icon-link">
                        <a href="#">
                            <i class='bx bx-message-rounded-dots'></i>
                            <span class="link_name">Message</span>
                        </a>
                        <span class="tooltip">Message</span>
                    </div>
                </li>   
                <li>
                <div class="profile-details">
                    <div class="profile-content">
                        <img src="https://upload.wikimedia.org/wikipedia/en/1/14/Balltze_%28Cheems%29.jpg" alt="profile">
                    </div>
                    <div class="name-job">
                        <div class="profile_name">Cheems The Admin</div>
                        <div class="profile_status">Admin</div>
                    </div>
                    <i class='bx bx-log-out'></i>
                </div>
                </li>
            </ul>
        </div>
        <!------- END OF SIDEBAR ------>
        <div class="main">
            <div class="top-bar">
                <div class="top-title">Book Database</div>
                <span class="material-symbols-outlined">notifications</span>
            </div>
            <!------- END OF TOP-BAR ------>
            <div class="table">
                <div class="table_header">
                    <p>Book Information Table:</p>
                    <div>
                        <form action="" method="GET">
                            <input type="text" name="search" value="<?php if(isset($_GET['search'])){echo $_GET['search'];} ?>" placeholder="Search" />
                            <button type="submit" class="search" style="padding:10px 20px; background-color:#0298cf; color:#fff;">Search</button>
                        </form>
                    </div>
                    <button class="add_new" style="padding: 10px 20px; color: #fff; background-color: #0298cf; outline: none; border: none; border-radius: 6px; cursor: pointer;">+ Add New</button>
                </div>
                <div class="table_section">
                    <table id="bookTable">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Cover</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Genre</th>
                                <th>Year</th>
                                <th>Quantity</th>
                                <th>ISBN</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <?php

                            $whereClause = "";

                            if (isset($_GET['search'])) {
                                $searchTerm = mysqli_real_escape_string($con, $_GET['search']);
                                $whereClause = "WHERE Title LIKE '%$searchTerm%' OR Author LIKE '%$searchTerm%' OR Genre LIKE '%$searchTerm%'";
                            }

                            $sql="Select * from `book` $whereClause";
                            $result=mysqli_query($con,$sql);

                            if($result){
                                while($row=mysqli_fetch_assoc($result)) {
                                    $id=$row['ID'];
                                    $cover=$row['Cover'];
                                    $title=$row['Title'];
                                    $author=$row['Author'];
                                    $genre=$row['Genre'];
                                    $year=$row['Year'];
                                    $quantity=$row['Quantity'];
                                    $isbn=$row['ISBN'];
                                    $decodedCover = base64_decode($row['Cover']);
                                    echo '<tr>
                                    <td class="user_id">'.$id.'</td>
                                    <td><img src="data:image;base64,' . base64_encode($decodedCover) . '" alt="Book Cover" style="width:80px; height:80px;"></td>
                                    <td>'.$title.'</td>
                                    <td>'.$author.'</td>
                                    <td>'.$genre.'</td>
                                    <td>'.$year.'</td>
                                    <td>'.$quantity.'</td>
                                    <td>'.$isbn.'</td>
                                    <td class="button-container">
                                            <button type="submit" name="update" class="update-btn" style="background-color: #0298cf;"><i class="fa-solid fa-pen-to-square" style="color: white;"></i></button>
                                        <form method="post" action="Book-Database.php?deleteid='.$id.'">
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
                <h2>Fill the Form</h2>
                <form action="Book-Database.php" method="post" enctype="multipart/form-data">
                    <div class="form">
                        <div class="img-card">
                            <label for="imgInput" class="upload">
                                <input type="file" name="image" id="imgInput" onchange="display_image(this.files[0])">
                                <i class='bx bxs-plus-circle'></i>
                            </label>
                            <img id="previewImage" src="../Pictures/Cover.png" alt="" width="200" height="200">
                        </div>
                        <div class="form-card">
                            <div class="form-element">
                                <label for="title">Title:</label>
                                <input type="text" placeholder="Enter Title" name="title" autocomplete="off">
                            </div>
                            <div class="form-element">
                                <label for="author">Author:</label>
                                <input type="text" placeholder="Enter Author" name="author" autocomplete="off">
                            </div>
                            <div class="form-element">
                                <label for="genre">Genre:</label>
                                <input type="text" placeholder="Enter Genre" name="genre" autocomplete="off">
                            </div>
                            <div class="form-element">
                                <label for="year">Year:</label>
                                <input type="number" placeholder="Enter Year" name="year" autocomplete="off">
                            </div>
                            <div class="form-element">
                                <label for="quantity">Quantity:</label>
                                <input type="number" placeholder="Enter Quantity" name="quantity" autocomplete="off">
                            </div>
                            <div class="form-element">
                                <label for="isbn">ISBN:</label>
                                <input type="number" placeholder="Enter ISBN" name="isbn" autocomplete="off">
                            </div>
                            <div class="form-element">
                                <button type="submit" class="btn-primary" name="submit">Add</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
             <!-------- END OF POP-UP --------->

            <div class="update-popup" id="editdata">
                <div class="close-btn">&times;</div>
                <h2>Fill the Form</h2>
                <form action="Book-Database.php" method="post" enctype="multipart/form-data">
                    <div class="form">
                        <div class="img-card">
                            <label for="imgInputModal" class="upload">
                                <input type="file" name="imageInput" id="imgInputModal" onchange="display_image2(this.files[0])">
                                <i class='bx bxs-plus-circle'></i>
                            </label>
                            <img id="previewImageModal" src="../Pictures/Cover.png" alt="" width="200" height="200">
                        </div>
                        <div class="form-card">
                            <div class="form-element">
                                <input type="hidden" id="user_id" name="id" autocomplete="off">
                            </div>
                            <div class="form-element">
                                <label for="title">Title:</label>
                                <input type="text" id="title" placeholder="Enter Title" name="title" autocomplete="off">
                            </div>
                            <div class="form-element">
                                <label for="author">Author:</label>
                                <input type="text" id="author" placeholder="Enter Author" name="author" autocomplete="off">
                            </div>
                            <div class="form-element">
                                <label for="genre">Genre:</label>
                                <input type="text" id="genre" placeholder="Enter Genre" name="genre" autocomplete="off">
                            </div>
                            <div class="form-element">
                                <label for="year">Year:</label>
                                <input type="number" id="year" placeholder="Enter Year" name="year" autocomplete="off">
                            </div>
                            <div class="form-element">
                                <label for="quantity">Quantity:</label>
                                <input type="number" id="quantity" placeholder="Enter Quantity" name="quantity" autocomplete="off">
                            </div>
                            <div class="form-element">
                                <label for="isbn">ISBN:</label>
                                <input type="number" id="isbn" placeholder="Enter ISBN" name="isbn" autocomplete="off">
                            </div>
                            <div class="form-element">
                                <button type="submit" class="updatebtn-form" name="update_data">Update</button>
                            </div>
                        </div> 
                    </div>
                </form>
            </div>
        </div>
    </div>


    

    <script src="https://kit.fontawesome.com/5eaa044e5f.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="Book-Database.js"></script>
</body>
</html>


<script>
        document.querySelector(".add_new").addEventListener("click", function(){
            document.querySelector(".popup").classList.add("active");
        });

        document.querySelector(".popup .close-btn").addEventListener("click", function(){
            document.querySelector(".popup").classList.remove("active");
        });

        document.querySelectorAll(".update-btn").forEach(btn => {
            btn.addEventListener("click", function() {
                document.querySelector(".update-popup").classList.add("active");
            });
        });

        document.querySelector(".update-popup .close-btn").addEventListener("click", function(){
            document.querySelector(".update-popup").classList.remove("active");
        });

    function display_image(file) 
    {
        var img = document.getElementById("previewImage");
        img.src = URL.createObjectURL(file);

    }

    function display_image2(file) 
    {
        var img = document.getElementById("previewImageModal");
        img.src = URL.createObjectURL(file);

    }

</script>


<script>

$(document).ready(function () {

    $('.update-btn').click(function (e){
        e.preventDefault();

        var user_id = $(this).closest('tr').find('.user_id').text();
        console.log(user_id);

        $.ajax({
            method: "POST",
            url: "connect.php",
            data: {
                'click_update_btn':true,
                'user_id':user_id,
            },
            success:function(response) {

                $.each(response, function(Key, value){

                    
                    $('#previewImageModal').attr('src', 'data:image/png;base64,' + value.Cover);
                    $('#user_id').val(value['ID']);
                    $('#title').val(value['Title']);
                    $('#author').val(value['Author']);
                    $('#genre').val(value['Genre']);
                    $('#year').val(value['Year']);
                    $('#quantity').val(value['Quantity']);
                    $('#isbn').val(value['ISBN']);


                })

            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText); 
            }
        })

    });

});





</script>