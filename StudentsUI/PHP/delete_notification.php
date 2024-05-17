<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $notificationID = $_POST['notificationID'];

    $notificationID = mysqli_real_escape_string($con, $notificationID);

    $sql = "DELETE FROM notification WHERE id = '$notificationID'";

    if(mysqli_query($con, $sql)) {
        echo "success";
    } else {
        echo "Error deleting notification: " . mysqli_error($con);
    }
} else {
    echo "Invalid request method.";
}
?>