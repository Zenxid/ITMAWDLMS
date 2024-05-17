<?php
include 'connect.php';

$query = "SELECT pc_id, due_time FROM pc_activity WHERE TIMESTAMPDIFF(SECOND, NOW(), due_time) > 0 LIMIT 1";
$result = mysqli_query($con, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $pc_id = $row['pc_id'];
    $due_time = $row['due_time'];
    echo json_encode(['pc_id' => $pc_id, 'due_time' => $due_time]);
} else {
    echo json_encode(['error' => 'No PC is currently in use']);
}
?>