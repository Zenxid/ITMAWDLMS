<?php
include 'connect.php';

$teacherQuery = "SELECT DISTINCT `school_id` FROM `teacher`";
$teacherResult = mysqli_query($con, $teacherQuery);

$studentQuery = "SELECT DISTINCT `school_id` FROM `student`";
$studentResult = mysqli_query($con, $studentQuery);

$data = array();

while ($row = mysqli_fetch_assoc($teacherResult)) {
    $data[] = $row['school_id'];
}

while ($row = mysqli_fetch_assoc($studentResult)) {
    if (!in_array($row['school_id'], $data)) {
        $data[] = $row['school_id'];
    }
}

$jsArray = 'var schoolIDArray = ' . json_encode($data) . ';';

echo $jsArray;
?>
