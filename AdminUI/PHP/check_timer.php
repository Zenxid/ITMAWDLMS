<?php
include 'connect.php';

$user_id = $_POST['user_id'];
$student_name = $_POST['student_name'];

$adminPicturePath = "../Pictures/AI_picture";

$adminPictureBase64 = base64_encode(file_get_contents($adminPicturePath));

insertNotification($con, $user_id, $student_name, $adminPictureBase64);

function insertNotification($con, $user_id, $student_name, $adminPictureBase64) {
    $adminId = 10000;
    $adminName = "Automated Message";
    $title = "Timer Notification";
    $message = "The timer is about to expire. Please take action.";

    $stmt = $con->prepare("INSERT INTO notification (admin_id, admin_name, admin_picture, student_id, title, name, message) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isbssss", $adminId, $adminName, $adminPictureBase64, $user_id, $title, $student_name, $message);

    $stmt->execute();
    $stmt->close();
}
?>
