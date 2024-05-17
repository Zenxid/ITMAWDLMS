<?php
include 'connect.php';

$html = '';

$query = "SELECT * FROM `fines`";
$result = mysqli_query($con, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($con));
}

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo '<td><img src="data:image/jpeg;base64,' . $row['picture'] . '" alt="" /> </td>';
    echo "<td><p>". $row['user_name'] ."</p></td>";
    echo "<td><p>". $row['name'] ."</p></td>";
    echo "<td><p>".$row['price']."</p></td>";
    echo "<td><p>".$row['remark']."</p></td>";
    echo "<td><button class='insert-button data-buttons' data-id='" . $row['id'] . "'><i class='ph ph-arrow-bend-up-left'></i></button></td>";
    echo "</tr>";
}

mysqli_free_result($result);

echo $html;
?>
