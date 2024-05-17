<?php
include 'connect.php';

if(isset($_POST['game_id'], $_POST['picture'], $_POST['name'], $_POST['user_pic'], $_POST['user_name'], $_POST['user_id'], $_POST['timestamp'], $_POST['date'])) {
    $game_id = mysqli_real_escape_string($con, $_POST['game_id']);
    $picture = mysqli_real_escape_string($con, $_POST['picture']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $user_pic = mysqli_real_escape_string($con, $_POST['user_pic']);
    $user_name = mysqli_real_escape_string($con, $_POST['user_name']);
    $user_id = mysqli_real_escape_string($con, $_POST['user_id']);
    $timestamp = mysqli_real_escape_string($con, $_POST['timestamp']);
    $date = mysqli_real_escape_string($con, $_POST['date']);

    $due_time = date('H:i:s', strtotime('+1 hour', strtotime($timestamp)));

    $insert_query = "INSERT INTO ps4_activity (game_id, picture, name, user_pic, user_name, user_id, timestamp, date, due_time) VALUES ('$game_id', '$picture', '$name', '$user_pic', '$user_name', '$user_id', '$timestamp', '$date', '$due_time')";
    if(mysqli_query($con, $insert_query)) {
        echo $due_time;
    } else {
        echo "Error: " . mysqli_error($con);
    }
}

?>
