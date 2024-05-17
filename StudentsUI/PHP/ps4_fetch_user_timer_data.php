<?php
include 'connect.php';

$user_id = $_SESSION['id'];
$query = "SELECT due_time FROM ps4_activity WHERE user_id = '$user_id'";
$result = mysqli_query($con, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $due_time = $row['due_time'];
    echo json_encode(['due_time' => $due_time]);
} else {
    echo json_encode(['error' => 'No data found for the user']);
}
?>