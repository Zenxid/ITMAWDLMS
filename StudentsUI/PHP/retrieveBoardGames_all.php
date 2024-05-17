<?php
include "connect.php";

if (isset($_SESSION['id'])) {
    $userId = $_SESSION['id'];

    $query = "SELECT id, game_id FROM boardgames_activity WHERE user_id = '$userId'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $gameId = $row['game_id'];
            $updateQuery = "UPDATE board_games SET quantity = quantity + 1 WHERE id = '$gameId'";
            mysqli_query($con, $updateQuery);
        }

        $deleteQuery = "DELETE FROM boardgames_activity WHERE user_id = '$userId'";
        if (mysqli_query($con, $deleteQuery)) {
            echo "success";
        } else {
            echo "error";
        }
    } else {
        echo "No data found!";
    }
} else {
    echo "User not logged in!";
}
?>