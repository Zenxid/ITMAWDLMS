<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
        $userId = $_SESSION['id'];
        $userRole = $_SESSION['role'];

        if (!empty($_FILES['profilePicture']['tmp_name']) && $_FILES['profilePicture']['error'] === UPLOAD_ERR_OK) {

            $pictureData = file_get_contents($_FILES['profilePicture']['tmp_name']);

            switch ($userRole) {
                case 'student':
                    $sql = "UPDATE student SET picture = ? WHERE id = ?";
                    break;
                case 'teacher':
                    $sql = "UPDATE teacher SET picture = ? WHERE id = ?";
                    break;
                default:
                    break;
            }

            $stmt = mysqli_prepare($con, $sql);
            mysqli_stmt_bind_param($stmt, "si", $pictureData, $userId);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }

        if (!empty($_POST['passwordInput']) && !empty($_POST['ConfirmpasswordInput'])) {
            $password = $_POST['passwordInput'];
            
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            switch ($userRole) {
                case 'student':
                    $sql = "UPDATE student SET password = ? WHERE id = ?";
                    break;
                case 'teacher':
                    $sql = "UPDATE teacher SET password = ? WHERE id = ?";
                    break;
                default:
                    break;
            }

            $stmt = mysqli_prepare($con, $sql);
            mysqli_stmt_bind_param($stmt, "si", $hashedPassword, $userId);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }

        echo "Profile updated successfully";
    } else {
        http_response_code(403);
        echo "User is not logged in";
    }
}
?>
