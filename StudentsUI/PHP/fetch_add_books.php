<?php
include 'connect.php';

if ($_SESSION['role'] === 'student') {
    $idColumn = 'student_id';
} elseif ($_SESSION['role'] === 'teacher') {
    $idColumn = 'faculty_id';
}

$user_id = $_SESSION['id'];

$select_query = "SELECT * FROM add_book WHERE $idColumn = ?";
$stmt = $con->prepare($select_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result) {
    $books = array();
    while ($row = $result->fetch_assoc()) {
        $books[] = $row;
    }
    echo json_encode(["success" => true, "books" => $books]);
} else {
    echo json_encode(["success" => false, "message" => "Error fetching add_book data"]);
}
?>