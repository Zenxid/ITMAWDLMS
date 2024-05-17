<?php
include "connect.php";

if (isset($_POST['bookId'], $_POST['isFavorited'])) {
    $userId = isset($_SESSION['id']) ? $_SESSION['id'] : null;
    if (!$userId) {
        echo "User ID not found in session.";
        exit;
    }

    $bookId = $_POST['bookId'];
    $isFavorited = $_POST['isFavorited'];

    if ($isFavorited === 'true') {
        $query = "DELETE FROM favorite_book WHERE user_id = $userId AND book_id = $bookId";
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

        $query = "INSERT INTO favorite_book (user_id, book_id, cover, name, description) VALUES ($userId, $bookId, '$cover', '$name', '$description')";
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