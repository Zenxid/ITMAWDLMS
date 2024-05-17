<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["id"])) {
        $book_id = $_POST["id"];

        $select_query = "SELECT book_id FROM add_book WHERE id = ?";
        $stmt = $con->prepare($select_query);
        $stmt->bind_param("i", $book_id);
        $stmt->execute();
        $stmt->bind_result($book_id);
        $stmt->fetch();
        $stmt->close();

        $delete_query = "DELETE FROM add_book WHERE book_id = ?";
        $stmt = $con->prepare($delete_query);
        $stmt->bind_param("i", $book_id);
        if ($stmt->execute()) {
            echo "Book removed successfully!";
        } else {
            echo "Error removing book: " . $stmt->error;
        }
    } else {
        echo "Missing required fields!";
    }
} else {
    echo "Invalid request!";
}
?>