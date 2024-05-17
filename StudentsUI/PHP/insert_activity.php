<?php
include "connect.php";

if (isset($_POST['game_id'], $_POST['user_id'], $_POST['user_name'], $_POST['timestamp'], $_POST['date'])) {
    $gameId = $_POST['game_id'];
    $userId = $_POST['user_id'];
    $userName = $_POST['user_name'];
    $timestamp = $_POST['timestamp'];
    $date = $_POST['date'];

    $query_check_quantity = "SELECT quantity FROM board_games WHERE id = '$gameId'";
    $result_check_quantity = mysqli_query($con, $query_check_quantity);
    if ($result_check_quantity && mysqli_num_rows($result_check_quantity) > 0) {
        $row = mysqli_fetch_assoc($result_check_quantity);
        $quantity = $row['quantity'];
        if ($quantity <= 0) {
            echo "Error: Quantity is already 0. Cannot insert activity.";
            exit;
        }
    } else {
        echo "Error retrieving game quantity: " . mysqli_error($con);
        exit;
    }

    $query_reduce_quantity = "UPDATE board_games SET quantity = quantity - 1 WHERE id = '$gameId'";
    if (!mysqli_query($con, $query_reduce_quantity)) {
        echo "Error updating game quantity: " . mysqli_error($con);
        exit;
    }

    $query_game = "SELECT cover, name FROM board_games WHERE id = '$gameId'";
    $result_game = mysqli_query($con, $query_game);

    if ($result_game && mysqli_num_rows($result_game) > 0) {
        $row_game = mysqli_fetch_assoc($result_game);
        $picture = $row_game['cover'];
        $name = $row_game['name'];

        $query_insert = "INSERT INTO boardgames_activity (game_id, user_id, user_name, picture, name, timestamp, date) 
                        VALUES ('$gameId', '$userId', '$userName', '$picture', '$name', '$timestamp', '$date')";

        if (mysqli_query($con, $query_insert)) {
            echo "Activity inserted successfully";
        } else {
            echo "Error inserting activity: " . mysqli_error($con);
        }
    } else {
        echo "Error retrieving game information: " . mysqli_error($con);
    }
} else {
    echo "Insufficient data received";
}
?>
