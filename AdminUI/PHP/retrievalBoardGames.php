<?php

$con=new mysqli('localhost', 'root','roberthans20','lms');

if(!$con) {
    die(mysqli_error($con));
}

if (isset($_POST['click_update_btn'])) {
    $id = $_POST['id'];
    $arrayresult = [];

    $sql = "Select * from `board_games` where id='$id'";
    $result = mysqli_query($con, $sql);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($arrayresult, $row);
        }
       
        header('content-type: application/json');
        echo json_encode($arrayresult);
    }
}

if (isset($_POST['update_data'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $quantity = $_POST['quantity'];


    if (isset($_FILES['imageInput']) && $_FILES['imageInput']['error'] === UPLOAD_ERR_OK) {
        $temp = $_FILES['imageInput']['tmp_name'];
        $cover = base64_encode(file_get_contents($temp));
    } else {
        $existingCoverQuery = "SELECT cover FROM board_games WHERE id='$id'";
        $existingCoverResult = mysqli_query($con, $existingCoverQuery);
        if ($existingCoverResult && mysqli_num_rows($existingCoverResult) > 0) {
            $row = mysqli_fetch_assoc($existingCoverResult);
            $cover = $row['cover'];
        } else {
            $cover = '';
        }
    }

    $update_query = "UPDATE board_games SET cover='$cover', name='$name', description='$description', quantity='$quantity' WHERE id='$id'";
    $update_query_run = mysqli_query($con, $update_query);

    if ($update_query_run) {
       
    } else {
        echo "Error updating record: " . mysqli_error($con);
    }
}


?>