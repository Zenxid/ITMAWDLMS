<?php
include "connect.php";

if (isset($_POST['boardGameId'], $_POST['isFavorited'])) {
    $userId = isset($_SESSION['id']) ? $_SESSION['id'] : null;
    if (!$userId) {
        echo "User ID not found in session.";
        exit;
    }

    $boardGameId = $_POST['boardGameId'];
    $isFavorited = $_POST['isFavorited'];

    if ($isFavorited === 'true') {
        $query = "DELETE FROM favorite_board WHERE user_id = $userId AND board_id = $boardGameId";
        $result = mysqli_query($con, $query);
        if ($result) {
            echo "removed";
        } else {
            echo "Error removing from favorites: " . mysqli_error($con);
        }
    } else {
        $cover = $_POST['cover'];
        $name = $_POST['name'];
        $description = $_POST['description'];

        $query = "INSERT INTO favorite_board (user_id, board_id, cover, name, description) VALUES ($userId, $boardGameId, '$cover', '$name', '$description')";
        $result = mysqli_query($con, $query);
        if ($result) {
            echo "added";
        } else {
            echo "Error adding to favorites: " . mysqli_error($con);
        }
    }
} else {
    echo "Incomplete data received.";
}
?>