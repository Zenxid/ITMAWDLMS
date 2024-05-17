<?php
include 'connect.php';

if(isset($_GET['name'])) {
    $name = $_GET['name'];

    $studentquery = "SELECT `school_id` FROM `student` WHERE `name` = '$name'";
    $teacherquery = "SELECT `school_id` FROM `teacher` WHERE `name` = '$name'";
              
    $studentResult = mysqli_query($con, $studentquery);
    $teacherResult = mysqli_query($con, $teacherquery);

    $data = array();
    while ($row = mysqli_fetch_assoc($studentResult)) {
        $data[] = $row['school_id'];
    }

    while ($row = mysqli_fetch_assoc($teacherResult)) {
        $data[] = $row['school_id'];
    }

    echo json_encode($data);
} else {
    echo json_encode(array());
}
?>
