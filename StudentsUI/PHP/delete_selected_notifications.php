<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $notificationIDs = $_POST['notificationIDs'];

    $escaped_notificationIDs = array_map(function($id) use ($con) {
        return mysqli_real_escape_string($con, $id);
    }, $notificationIDs);

    $notificationIDs_string = implode(',', $escaped_notificationIDs);

    $sql = "DELETE FROM notification WHERE id IN ($notificationIDs_string)";

    if(mysqli_query($con, $sql)) {
        echo "success";
    } else {
        echo "Error deleting selected notifications: " . mysqli_error($con);
    }
} else {
    echo "Invalid request method.";
}
?>
