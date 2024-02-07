<?php

$con=new mysqli('localhost', 'root','roberthans20','lms');

if(!$con) {
    die(mysqli_error($con));
}

if (isset($_POST['click_update_btn'])) {
    $id = $_POST['user_id'];
    $arrayresult = [];

    $sql = "Select * from `book` where id='$id'";
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
    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];
    $year = $_POST['year'];
    $quantity = $_POST['quantity'];
    $isbn = $_POST['isbn'];


    if (isset($_FILES['imageInput']) && $_FILES['imageInput']['error'] === UPLOAD_ERR_OK) {
        $temp = $_FILES['imageInput']['tmp_name'];
        $cover = base64_encode(file_get_contents($temp));
    } else {
        $existingCoverQuery = "SELECT Cover FROM book WHERE ID='$id'";
        $existingCoverResult = mysqli_query($con, $existingCoverQuery);
        if ($existingCoverResult && mysqli_num_rows($existingCoverResult) > 0) {
            $row = mysqli_fetch_assoc($existingCoverResult);
            $cover = $row['Cover'];
        } else {
            $cover = '';
        }
    }

    $update_query = "UPDATE book SET Cover='$cover', Title='$title', Author='$author', Genre='$genre', 
    Year='$year', Quantity='$quantity', ISBN='$isbn' WHERE ID='$id'";
    $update_query_run = mysqli_query($con, $update_query);

    if ($update_query_run) {
       
    } else {
        echo "Error updating record: " . mysqli_error($con);
    }
}

?>