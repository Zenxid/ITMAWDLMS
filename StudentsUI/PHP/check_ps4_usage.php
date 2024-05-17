<?php
include 'connect.php';

$response = array();

$check_query = "SELECT COUNT(*) AS count FROM ps4_activity";
$result = mysqli_query($con, $check_query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $isActive = ($row['count'] > 0) ? true : false;
    $response['isActive'] = $isActive;
} else {
    $response['error'] = "Error querying database";
}

echo json_encode($response);
?>
