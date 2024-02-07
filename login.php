<?php
include "connect.php";

if (isset($_POST['school_id']) &&  isset($_POST['name']) && isset($_POST['password'])) {
    function validate($data) {
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
    }else if(empty($uname)) {
        header("Location: LoginForm.php?error=User Name is required");
        exit();
    }else if(empty($pass)) {
        header("Location: LoginForm.php?error=Password is required");
        exit();
    }else{
        $sql = "SELECT * FROM profile WHERE school_id ='$schlID' AND name ='$uname' AND password = '$pass'";
        
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if($row['school_id'] === $schlID && $row['name'] === $uname && $row['password'] = $pass) {
                $_SESSION['school_id'] = $row['school_id'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['password'] = $row['password'];
                $_SESSION['id'] = $row['id'];
                header("Location: StudentsUI/StudentPage-Home.php");
            } else {
                header("Location: LoginForm.php?error=Incorrect ID, Username or Password");
                exit();
            }
        } else {
            header("Location: LoginForm.php?error=Incorrect ID, Username or Password");
            exit();
        }

    }
}
?>