<?php
include "connect.php";

if (isset($_POST['ps4GameId'], $_POST['isFavorited'])) {
    $userId = isset($_SESSION['id']) ? $_SESSION['id'] : null;
    if (!$userId) {
        echo "User ID not found in session.";
        exit;
    }

    $ps4GameId = $_POST['ps4GameId'];
    $isFavorited = $_POST['isFavorited'];

    if ($isFavorited === 'true') {
        $query = "DELETE FROM favorite_ps4 WHERE user_id = $userId AND ps4_id = $ps4GameId";
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

        $query = "INSERT INTO favorite_ps4 (user_id, ps4_id, cover, name, description) VALUES ($userId, $ps4GameId, '$cover', '$name', '$description')";
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