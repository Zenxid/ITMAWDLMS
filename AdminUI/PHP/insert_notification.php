<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $currentUser = $_POST['currentUser'];
    $currentUserId = $_POST['currentUserId'];
    $currentUserPicture = $_POST['currentUserPicture'];
    $schoolID = $_POST['schoolID'];
    $user = $_POST['user'];
    $title = $_POST['title'];
    $message = $_POST['message'];

    $currentUser = mysqli_real_escape_string($con, $currentUser);
    $currentUserId = mysqli_real_escape_string($con, $currentUserId);
    $currentUserPicture = mysqli_real_escape_string($con, $currentUserPicture);
    $schoolID = mysqli_real_escape_string($con, $schoolID);
    $user = mysqli_real_escape_string($con, $user);
    $message = mysqli_real_escape_string($con, $message);

    $sql = "INSERT INTO notification (admin_id, admin_name, admin_picture, student_id, title, name, message) 
            VALUES ('$currentUserId', '$currentUser', '$currentUserPicture', '$schoolID', '$title', '$user', '$message')";

    if(mysqli_query($con, $sql)) {
        echo "Notification inserted successfully.";
    } else {
        echo "Error inserting notification: " . mysqli_error($con);
    }
} else {
    echo "Invalid request method.";
}
?>
