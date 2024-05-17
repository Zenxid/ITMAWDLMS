<?php
include 'connect.php';

$data = array();

if(isset($_GET['school_id'])) {
    $school_id = $_GET['school_id'];

    $studentQuery = "SELECT `name`, `picture` FROM `student` WHERE `school_id` = '$school_id'";
    $studentResult = mysqli_query($con, $studentQuery);
    if ($studentResult) {
        while ($row = mysqli_fetch_assoc($studentResult)) {
            $pictureBase64 = base64_encode($row['picture']);
            $data[] = array('value' => htmlspecialchars($row['name']), 'data' => $pictureBase64);
        }
    }

    $teacherQuery = "SELECT `name`, `picture` FROM `teacher` WHERE `school_id` = '$school_id'";
    $teacherResult = mysqli_query($con, $teacherQuery);
    if ($teacherResult) {
        while ($row = mysqli_fetch_assoc($teacherResult)) {
            $pictureBase64 = base64_encode($row['picture']);
            $data[] = array('value' => htmlspecialchars($row['name']), 'data' => $pictureBase64);
        }
    }

    echo json_encode($data);
} else {
    echo json_encode(array());
}
?>