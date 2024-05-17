<?php
include 'connect.php';

$html = '';

$query = "SELECT `id`, `picture`, `name`, `user_name`, `timestamp`, `date`, `due_time` FROM `ps4_activity`";
$result = mysqli_query($con, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($con));
}

while ($row = mysqli_fetch_assoc($result)) {
    $html .= "<tr id='row_" . $row['id'] . "'>";
    $html .= "<td><img src='" . $row['picture'] . "'></td>";
    $html .= "<td>" . $row['name'] . "</td>";
    $html .= "<td>" . $row['user_name'] . "</td>";
    $html .= "<td>" . date('h:i A', strtotime($row['timestamp'])) . "</td>";
    $html .= "<td>" . $row['date'] . "</td>";
    $html .= "<td>" . date('h:i A', strtotime($row['due_time'])) . "</td>";
    $html .= "<td><button class='remark-btn' data-id='" . $row['id'] . "'><i class='bx bx-comment-edit'></i></button></td>";
    $html .= "</tr>";
}

mysqli_free_result($result);

echo $html;
?>
