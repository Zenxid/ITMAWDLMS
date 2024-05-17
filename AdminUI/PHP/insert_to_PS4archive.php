<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id']) && isset($_POST['remark'])) {
        $id = mysqli_real_escape_string($con, $_POST['id']);
        $remark = mysqli_real_escape_string($con, $_POST['remark']);

        $query_select = "SELECT * FROM ps4_activity WHERE id = '$id'";
        $result_select = mysqli_query($con, $query_select);

        if ($result_select) {
            $row = mysqli_fetch_assoc($result_select);

            $query_insert = "INSERT INTO ps4_activity_archive (user_id, user_name, picture, name, timestamp, date, due_time, remark) 
                             VALUES ('" . $row['user_id'] . "', '" . $row['user_name'] . "', '" . $row['picture'] . "', 
                             '" . $row['name'] . "', '" . $row['timestamp'] . "', '" . $row['date'] . "', 
                             '" . $row['due_time'] . "', '" . $remark . "')";
            $result_insert = mysqli_query($con, $query_insert);

            if ($result_insert) {
                $query_delete = "DELETE FROM ps4_activity WHERE id = '$id'";
                $result_delete = mysqli_query($con, $query_delete);

                if ($result_delete) {
                    echo "Success: Row archived and deleted successfully.";
                } else {
                    echo "Error: Failed to delete row from original table - " . mysqli_error($con);
                }
            } else {
                echo "Error: Failed to insert row into archive table - " . mysqli_error($con);
            }
        } else {
            echo "Error: Failed to fetch row from original table - " . mysqli_error($con);
        }
    } else {
        echo "Error: ID parameter not set";
    }
} else {
    echo "Error: Invalid request method";
}
?>
