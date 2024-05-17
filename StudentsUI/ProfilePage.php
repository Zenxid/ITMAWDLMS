<?php
$name = "Markiplier";
$grade = "Grade 12 - ITMAWD401";
$email = "markiplier@example.com";
$books = 152;
$games = 2;
$pcTime = "8 hours";
$description = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus harum eligendi necessitatibus
optio magnam? Error, impedit. Odio repellat obcaecati ex, beatae blanditiis neque vitae hic 
autem temporibus, exercitationem facere voluptatem.";

$photoPaths = array(
    "../Pictures/Book1.png",
    "../Pictures/Book2.png",
    "../Pictures/Book6.png",
    "../Pictures/book7.png",
    "../Pictures/book8.png",
    "../Pictures/book9.png"
);

$coverPaths = array (
    "../Pictures/God_of_War_4_cover.jpg",
    "../Pictures/JustDance_cover_.jpg",
    "../Pictures/Spider-Man_Miles_Morales_cover.jpeg",
    "../Pictures/Spider-Man_PS4_cover.jpg",
    "../Pictures/Tekken7_cover.jpg"
);

$boardPaths = array (
    "../Pictures/UNOThumbnail.png",
    "../Pictures/ScrabbleThumbnail.png",
    "../Pictures/GuessWhoThumbnail.png"
);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/ProfilePage.css?v=<?php echo time() ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>Profile</title>
</head>
<body>
    <div class="header_wrapper">
        <header style=" background: url(../Pictures/blueBackground.jpg) no-repeat 50% 20% / cover;"></header>
        <div class="cols_container">
            <div class="left_col">
                <div class="img_container">
                    <img src="../Pictures/profile.jpg" alt="">
                    <span></span>
                </div>
                <h2><?php echo $name; ?></h2>
                <p><?php echo $grade; ?></p>
                <p><?php echo $email; ?></p>

                <ul class="about">
                    <li><span><?php echo $books; ?></span> Books</li>
                    <li><span><?php echo $games; ?></span> Board Games & PS4</li>
                    <li><span><?php echo $pcTime; ?></span> PC Time</li>
                </ul>

                <div class="content">
                    <p><?php echo $description; ?></p>
                </div>
            </div>
            <div class="right_col">
                <nav>
                    <ul>
                        <li><button id="bookButton" onclick="openBook()">Edit Profile</button></li>
                        <li><button id="ps4Button" onclick="openPS4()">Favorite PS4</button></li>
                        <span id="linespan"></span>
                    </ul>
                </nav>

                <div id="content1" class="photos">

                </div>

                <div id="content2" class="photos">

                </div>

            </div>
        </div>
    </div>

<script src="JAVASCRIPT/ProfilePage.js"></script>
</body>
</html>