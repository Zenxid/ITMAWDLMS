<?php
require 'connect.php';

$_SESSION["id"] = 1;
$sessionId = $_SESSION["id"];
$user = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM profile WHERE id = $sessionId"));

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="StudentProfile.css">
</head>
<body>
    <div class="main">
        <form class="" action="" enctype="multipart/form-data" method="post">
            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
            <div class="upload">
            <?php
                // Convert BLOB data to base64 for displaying in an image tag
                $imageData = base64_encode($user['image']);
                echo '<img src="data:image/jpeg;base64,' . $imageData . '" id="image">';
                ?>

                <div class="rightRound" id="upload">
                    <input type="file" name="fileImg" id = "fileImg" accept=".jpg, .jpeg, .png">
                    <i class="fa-solid fa-camera"></i>
                </div>

                <div class="leftRound" id = "cancel" style="display:none;">
                    <i class="fa-solid fa-circle-xmark"></i>
                </div>
                <div class="rightRound" id = "confirm" style="display:none;">
                    <input type="submit" name="" value="">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
            </div>
        </form>
    </div>

    <script src="https://kit.fontawesome.com/5eaa044e5f.js" crossorigin="anonymous"></script>
    <script src="StudentProfile.js"></script>

    <?php 
    if(isset($_FILES["fileImg"]["name"])) {
        $id = $_POST["id"];

        $src = $_FILES["fileImg"]["tmp_name"];
        $imageName = uniqid() . $_FILES["fileImg"]["name"];

        $target = "Pictures/" . $imageName;

        move_uploaded_file($src, $target);

        $query = "UPDATE profile SET image = '$imageName' WHERE id = $id";
        mysqli_query($con, $query);

        header("Location: StudentProfile.php");
    }
    ?>
</body>
</html>