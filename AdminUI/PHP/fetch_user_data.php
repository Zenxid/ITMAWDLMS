<?php
include 'connect.php';

$data = array();

$studentQuery = "SELECT `name`, `picture` FROM `student`";
$studentResult = mysqli_query($con, $studentQuery);
if ($studentResult) {
    while ($row = mysqli_fetch_assoc($studentResult)) {
        $pictureBase64 = base64_encode($row['picture']);
        $data[] = array('value' => htmlspecialchars($row['name']), 'data' => $pictureBase64);
    }
}

$teacherQuery = "SELECT `name`, `picture` FROM `teacher`";
$teacherResult = mysqli_query($con, $teacherQuery);
if ($teacherResult) {
    while ($row = mysqli_fetch_assoc($teacherResult)) {
        $pictureBase64 = base64_encode($row['picture']);
        $data[] = array('value' => htmlspecialchars($row['name']), 'data' => $pictureBase64);
    }
}

echo "var userArray = " . json_encode($data) . ";";
?>
