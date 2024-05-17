<?php
include 'connect.php';

if (!isset($_SESSION['id'])) {
    echo json_encode(["success" => false, "message" => "User not logged in"]);
    exit;
}

$user_id = $_SESSION['id'];
$school_id = $_SESSION['school_id'];
$name = $_SESSION['name'];
$role = $_SESSION['role'];

$currentDate = date("Y-m-d");
$dueDate = $currentDate;

function skipWeekend($date) {
    $dayOfWeek = date('w', strtotime($date));

    $daysToAdd = ($dayOfWeek == 6) ? 2 : 1;

    return date('Y-m-d', strtotime("+$daysToAdd day", strtotime($date)));
}

for ($i = 0; $i < 7; $i++) {
    $dueDate = skipWeekend($dueDate);
}

if ($role === 'student') {
    $idColumn = 'student_id';
    $roleColumn = 'section';
} elseif ($role === 'teacher') {
    $idColumn = 'faculty_id';
    $roleColumn = 'faculty_name';
} else {
    echo json_encode(["success" => false, "message" => "Invalid user role"]);
    exit;
}

if (!isset($_POST['selected_quantity'])) {
    echo json_encode(["success" => false, "message" => "Selected quantity not provided"]);
    exit;
}

$user_selected_quantity = $_POST['selected_quantity'];

$select_query = "SELECT title, quantity, cover FROM add_book WHERE $idColumn = ?";
$stmt = $con->prepare($select_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $row = $result->fetch_assoc()) {
    $book_name = $row['title'];
    $book_quantity = $row['quantity'];
    $book_cover = $row['cover'];

    $select_dept_section_query = "SELECT $roleColumn FROM $role WHERE id = ?";
    $stmt_dept_section = $con->prepare($select_dept_section_query);
    $stmt_dept_section->bind_param("i", $user_id);
    $stmt_dept_section->execute();
    $result_dept_section = $stmt_dept_section->get_result();

    if ($result_dept_section && $row_dept_section = $result_dept_section->fetch_assoc()) {
        $dept_section = $row_dept_section[$roleColumn];

        $insert_query = "INSERT INTO borrow (school_id, user_id, name, role, dept_section, book_cover, book_name, quantity, due_date, date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($insert_query);
        $stmt->bind_param("iissssssss", $school_id, $user_id, $name, $role, $dept_section, $book_cover, $book_name, $user_selected_quantity, $dueDate, $currentDate);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $delete_query = "DELETE FROM add_book WHERE $idColumn = ? AND title = ?";
            $stmt = $con->prepare($delete_query);
            $stmt->bind_param("is", $user_id, $book_name);
            $stmt->execute();

            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to insert borrowing record"]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Failed to retrieve department/section"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Book not found or user does not have access to borrow"]);
}
?>
