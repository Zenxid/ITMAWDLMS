<?php
include 'connect.php';

$html = '';

$query = "SELECT * FROM `borrow`";
$result = mysqli_query($con, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($con));
}

while ($row = mysqli_fetch_assoc($result)) {
    $html .= "<tr id='row_" . $row['id'] . "'>";
    $html .= "<td><p>" .$row['school_id']. "</p></td>";
    $html .= "<td><p>". $row['name'] ."</p></td>";
    $html .= "<td><p>". $row['role'] ."</p></td>";
    $html .= "<td><p>".$row['dept_section']."</p></td>";
    $html .= "<td><p>".$row['book_name']."</p></td>";
    $html .= "<td><p>".$row['quantity']."</p></td>";
    $html .= "<td><p>".$row['due_date']."</p></td>";
    $html .= "<td><button class='insert-button data-buttons' data-id='" . $row['id'] . "'><i class='ph ph-arrow-bend-up-left'></i></button></td>";
    $html .= "</tr>";
}

mysqli_free_result($result);

echo $html;
?>
