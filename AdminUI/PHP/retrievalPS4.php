<?php

$con=new mysqli('localhost', 'root','roberthans20','lms');

if(!$con) {
    die(mysqli_error($con));
}

if (isset($_POST['click_update_btn'])) {
    $id = $_POST['id'];
    $arrayresult = [];

    $sql = "Select * from `ps4` where id='$id'";
    $result = mysqli_query($con, $sql);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($arrayresult, $row);
        }
       
        header('content-type: application/json');
        echo json_encode($arrayresult);
    }
}


?>