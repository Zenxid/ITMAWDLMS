<?php
include "connect.php";

if (isset($_POST['game_id'], $_POST['activity_id'])) {
    $gameId = $_POST['game_id'];
    $activityId = $_POST['activity_id'];

    $updateQuery = "UPDATE board_games SET quantity = quantity + 1 WHERE id = '$gameId'";
    $deleteQuery = "DELETE FROM boardgames_activity WHERE id = '$activityId'";

    if (mysqli_query($con, $updateQuery) && mysqli_query($con, $deleteQuery)) {
        echo "success";
    } else {
        echo "error";
    }
} else {
    echo "invalid_request";
}
?>