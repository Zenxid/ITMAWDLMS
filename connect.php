<?php

$sname = "localhost";
$uname = "root";
$password = "roberthans20";

$db_name = "lms";

$conn = mysqli_connect($sname, $uname, $password, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>