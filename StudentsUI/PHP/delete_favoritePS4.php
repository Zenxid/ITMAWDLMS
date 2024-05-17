<?php
include 'connect.php';

if (!isset($_SESSION['id'])) {
    die("User not logged in!");
}

if (!isset($_POST['id'])) {
    die("ID not provided!");
}

$deleteId = mysqli_real_escape_string($con, $_POST['id']);

$query = "DELETE FROM favorite_ps4 WHERE id = '$deleteId'";

if (mysqli_query($con, $query)) {
    echo "Row deleted successfully!";
} else {
    echo "Error deleting row: " . mysqli_error($con);
}

?>