<?php
include "connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
        $userId = $_SESSION['id'];
        $userRole = $_SESSION['role'];

        if (isset($_POST["id"]) && isset($_POST["title"]) && isset($_POST["image"])) {
            $id = $_POST["id"];
            $title = $_POST["title"];
            $image = $_POST["image"];
            
            $currentDate = date("Y-m-d");

            if ($userRole === 'student') {
                $idColumn = 'student_id';
            } elseif ($userRole === 'teacher') {
                $idColumn = 'faculty_id';
            }

            $insert_query = "INSERT INTO add_book (cover, title, author, quantity, date, book_id, $idColumn) SELECT Cover, Title, Author, Quantity, ?, ID, ? FROM book WHERE ID = ?";
            $stmt = $con->prepare($insert_query);
            $stmt->bind_param("sii", $currentDate, $userId, $id);
            if ($stmt->execute()) {
                echo json_encode(["success" => true, "message" => "Book added successfully!"]);
            } else {
                echo json_encode(["success" => false, "message" => "Error adding book: " . $stmt->error]);
            }
        } else {
            echo json_encode(["success" => false, "message" => "Missing required fields!"]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "User not logged in or role not set!"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method!"]);
}
?>
