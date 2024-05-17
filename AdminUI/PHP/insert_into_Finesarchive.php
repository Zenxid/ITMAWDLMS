<?php
include 'connect.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    
    $insert_query = "INSERT INTO `fines_archive` SELECT * FROM `fines` WHERE `id` = $id";
    $result = mysqli_query($con, $insert_query);

    if ($result) {
        $delete_query = "DELETE FROM `fines` WHERE `id` = $id";
        $delete_result = mysqli_query($con, $delete_query);
        
        if ($delete_result) {
            echo "Record inserted into archive and deleted from fines successfully";
        } else {
            echo "Failed to delete record from fines";
        }
    } else {
        echo "Failed to insert record into archive";
    }
} else {
    echo "Invalid request";
}
?>