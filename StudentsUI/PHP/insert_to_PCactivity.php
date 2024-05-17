<?php

date_default_timezone_set('Asia/Manila');
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["pc_id"]) && isset($_POST["picture"]) && isset($_POST["name"]) && isset($_POST["user_pic"]) && isset($_POST["user_name"]) && isset($_POST["user_id"])) {
        $pc_id = $_POST["pc_id"];
        $picture = $_POST["picture"];
        $name = $_POST["name"];
        $user_pic = $_POST["user_pic"];
        $user_name = $_POST["user_name"];
        $user_id = $_POST["user_id"];
        $timestamp = date("H:i:s");
        $date = date("Y-m-d");
        $due_time = date("H:i:s", strtotime('+1 hour'));

        $sql = "INSERT INTO pc_activity (pc_id, picture, name, user_pic, user_name, user_id, timestamp, date, due_time) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("issssisss", $pc_id, $picture, $name, $user_pic, $user_name, $user_id, $timestamp, $date, $due_time);

        if ($stmt->execute()) {
            echo "Record inserted successfully";
        } else {
            echo "Error inserting record: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Missing parameters";
    }
} else {
    echo "Invalid request method";
}
?>