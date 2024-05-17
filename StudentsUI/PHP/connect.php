<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$con = new mysqli('localhost', 'root','roberthans20','lms');

if(!$con) {
    die(mysqli_error($con));
}

?>