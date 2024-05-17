<?php
include "PHP\connect.php";


$showModal = false;
$_SESSION['login_success'] = true;

if (isset($_POST['school_id']) && isset($_POST['name']) && isset($_POST['password'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $schlID = validate($_POST['school_id']);
    $uname = validate($_POST['name']);
    $pass = validate($_POST['password']);

    if (empty($schlID)) {
        header("Location: LoginForm.php?error=School ID is required");
        exit();
    } elseif (empty($uname)) {
        header("Location: LoginForm.php?error=User Name is required");
        exit();
    } elseif (empty($pass)) {
        header("Location: LoginForm.php?error=Password is required");
        exit();
    } else {
        $sql_student = "SELECT * FROM student WHERE school_id = '$schlID' AND name = '$uname' AND password = '$pass'";
        $result_student = mysqli_query($con, $sql_student);

        if ($result_student && mysqli_num_rows($result_student) === 1) {
            $row = mysqli_fetch_assoc($result_student);
            $_SESSION['school_id'] = $row['school_id'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['password'] = $row['password'];
            $_SESSION['id'] = $row['id'];
            $_SESSION['role'] = $row['role'];
            header("Location: registrationCard.php");
            $showModal = true;
            exit();
        }

        $sql_teacher = "SELECT * FROM teacher WHERE school_id = '$schlID' AND name = '$uname' AND password = '$pass'";
        $result_teacher = mysqli_query($con, $sql_teacher);

        if ($result_teacher && mysqli_num_rows($result_teacher) === 1) {
            $row = mysqli_fetch_assoc($result_teacher);
            $_SESSION['school_id'] = $row['school_id'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['password'] = $row['password'];
            $_SESSION['id'] = $row['id'];
            $_SESSION['role'] = $row['role'];
            header("Location: registrationCard.php");
            $showModal = true;
            exit();
        }

        $sql_admin = "SELECT * FROM admin WHERE school_id = '$schlID' AND name = '$uname' AND password = '$pass'";
        $result_admin = mysqli_query($con, $sql_admin);

        if ($result_admin && mysqli_num_rows($result_admin) === 1) {
            $row = mysqli_fetch_assoc($result_admin);
            $_SESSION['school_id'] = $row['school_id'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['password'] = $row['password'];
            $_SESSION['id'] = $row['id'];
            $_SESSION['role'] = $row['role'];
            header("Location: AdminUI/Dashboard.php");
            $showModal = true;
            exit();
        }


        header("Location: LoginForm.php?error=Incorrect ID, Username, or Password");
        exit();
    }
} else {
    header("Location: LoginForm.php");
    exit();
}
?>
