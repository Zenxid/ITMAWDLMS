<?php
include 'connect.php';


$html = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id'])) {
        $id = mysqli_real_escape_string($con, $_POST['id']);

        $query = "SELECT * FROM pc_activity WHERE id = '$id'";
        $result = mysqli_query($con, $query);

        if ($result) {
            $row = mysqli_fetch_assoc($result);

            $row_id = 'row_' . $row['id'];

            $html .= '<div class="success-container">';
            $html .= '<p class="title">Success Remark</p>';
            $html .= '<div class="content">';
            $html .= '<div class="container-grid">';
            $html .= '<p>Reason:</p>';
            $html .= '<input type="text" class="searchInput successInput" id="searchInput" placeholder="For what?">';
            $html .= '<div class="button-details">';
            $html .= '<button class="check" id="successCheck" data-activity-id="' . $row['id'] . '" data-row-id="' . $row_id . '"><i class="bx bx-check-circle"></i></button>';
            $html .= '<button class="x"><i class="bx bx-x-circle"></i></button>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '<div class="container-grid">';
            $html .= '<h4>User Details:</h4>';
            $html .= '<div class="user-details">';
            $html .= '<img src="data:image/jpeg;base64,' . $row['picture'] . '" alt="">';
            $html .= '<p>' . $row['name'] . '</p>';
            $html .= '</div>';
            $html .= '<div class="user-details">';
            $html .= '<h4>Username: </h4>';
            $html .= '<p>' . $row['user_name'] . '</p>';
            $html .= '</div>';
            $html .= '<div class="user-details">';
            $html .= '<h4>Date: </h4>';
            $html .= '<p>' . $row['date'] . '</p>';
            $html .= '</div>';
            $html .= '<div class="user-details">';
            $html .= '<h4>Due Time: </h4>';
            $html .= '<p>' . date('h:i A', strtotime($row['due_time'])) . '</p>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '<div class="failure-container">';
            $html .= '<p class="title">Failure Remark</p>';
            $html .= '<div class="content">';
            $html .= '<div class="container-grid">';
            $html .= '<p>Reason:</p>';
            $html .= '<input type="text" class="searchInput" id="finesInput" placeholder="For what?">';
            $html .= '<p style="margin-top:15px">Fines: </p>';
            $html .= '<input type="number" class="searchInput" id="fines" placeholder="Enter Fines (₱)">';
            $html .= '<div class="button-details">';
            $html .= '<button class="check" id="failedCheck" data-activity-id="' . $row['id'] . '" data-row-id="' . $row_id . '"><i class="bx bx-check-circle"></i></button>';
            $html .= '<button class="x"><i class="bx bx-x-circle"></i></button>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '<div class="container-grid">';
            $html .= '<h4>User Details:</h4>';
            $html .= '<div class="user-details">';
            $html .= '<img src="data:image/jpeg;base64,' . $row['picture'] . '" alt="">';
            $html .= '<p>' . $row['name'] . '</p>';
            $html .= '</div>';
            $html .= '<div class="user-details">';
            $html .= '<h4>Username: </h4>';
            $html .= '<p>' . $row['user_name'] . '</p>';
            $html .= '</div>';
            $html .= '<div class="user-details">';
            $html .= '<h4>Date: </h4>';
            $html .= '<p>' . $row['date'] . '</p>';
            $html .= '</div>';
            $html .= '<div class="user-details">';
            $html .= '<h4>Due Time: </h4>';
            $html .= '<p>' . date('h:i A', strtotime($row['due_time'])) . '</p>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';

            echo $html;
        } else {
            echo "Error: " . mysqli_error($con);
        }
    } else {
        echo "Error: ID parameter not set";
    }
} else {
    echo "Error: Invalid request method";
}
?>
