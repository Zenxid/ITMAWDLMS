<?php
include 'connect.php';

if (isset($_POST['row_id'])) {
    $rowId = mysqli_real_escape_string($con, $_POST['row_id']);

    $deleteQuery = "DELETE FROM add_book WHERE id = '$rowId'";

    if (mysqli_query($con, $deleteQuery)) {
        echo json_encode(array('success' => true, 'message' => 'Row deleted successfully.'));
    } else {
        echo json_encode(array('success' => false, 'message' => 'Error deleting row: ' . mysqli_error($con)));
    }
} else {
    echo json_encode(array('success' => false, 'message' => 'Row ID not provided.'));
}
?>