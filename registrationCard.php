<?php
include 'PHP/connect.php';

if (isset($_SESSION['name'], $_SESSION['role'])) {
    $name = $_SESSION['name'];
    $role = $_SESSION['role'];

    $user_role = "";
    switch ($role) {
        case 'student':
            $user_role = "Student";
            $sql_student = "SELECT section, picture FROM student WHERE name = '$name'";
            $result_student = mysqli_query($con, $sql_student);
            if ($result_student && mysqli_num_rows($result_student) === 1) {
                $row = mysqli_fetch_assoc($result_student);
                $dept_section = $row['section'];
                $profile_image_base64 = base64_encode($row['picture']);
            }
            break;
        case 'teacher':
            $user_role = "Teacher";
            $sql_teacher = "SELECT faculty_name, picture FROM teacher WHERE name = '$name'";
            $result_teacher = mysqli_query($con, $sql_teacher);
            if ($result_teacher && mysqli_num_rows($result_teacher) === 1) {
                $row = mysqli_fetch_assoc($result_teacher);
                $dept_section = $row['faculty_name'];
                $profile_image_base64 = base64_encode($row['picture']); 
            }
            break;
        default:
            $user_role = "Unknown";
            $dept_section = "Unknown";
            $profile_image = "Pictures/no-user-images.png";
            break;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Confirmation</title>
    <link rel="stylesheet" href="registrationCard.css?v=<?php echo time(); ?>">
</head>
<body>
    <div class="card">
        <div class="imgBx">
            <img src="data:image/jpeg;base64,<?php echo $profile_image_base64; ?>" alt="Profile Image" />
        </div>
        <div class="content">
            <div class="details">
                <h2><?php echo $name; ?><br><span><?php echo $dept_section; ?></span></h2>
                <div class="actionBtn">
                    <button id="confirmBtn">Confirm</button>
                    <button id="cancelBtn">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <?php
} else {
    header("Location: LoginForm.php");
    exit();
}
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
</body>
</html>

<script>
$(document).ready(function() {
    $("#confirmBtn").click(function() {
        $.ajax({
            url: 'PHP/insert_registration.php',
            type: 'POST',
            data: {},
            success: function(response) {
                window.location.href = "StudentsUI/StudentPage-Home.php";
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });
    $("#cancelBtn").click(function() {
        window.location.href = "PHP/logout.php";
    });
});
</script>
