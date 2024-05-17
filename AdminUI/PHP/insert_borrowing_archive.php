<?php
include 'connect.php';

error_log("Received POST parameters: " . print_r($_POST, true));

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id'])) {
        $id = mysqli_real_escape_string($con, $_POST['id']);

        $query_select = "SELECT * FROM borrow WHERE id = '$id'";
        $result_select = mysqli_query($con, $query_select);

        if ($result_select) {
            $row = mysqli_fetch_assoc($result_select);

            $query_insert = "INSERT INTO borrow_archive (school_id, user_id, name, role, dept_section, book_name, quantity, due_date, date, remark) 
                             VALUES ('" . $row['school_id'] . "', '" . $row['user_id'] . "', '" . $row['name'] . "', 
                             '" . $row['role'] . "', '" . $row['dept_section'] . "', '" . $row['book_name'] . "', 
                             '" . $row['quantity'] . "', '" . $row['due_date'] . "', '" . $row['date'] . "', 
                              '" . $_POST['remark'] . "')";
            $result_insert = mysqli_query($con, $query_insert);

            if ($result_insert) {
                $query_delete = "DELETE FROM borrow WHERE id = '$id'";
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
