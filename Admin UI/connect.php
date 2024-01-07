<?php

$con=new mysqli('localhost', 'root','roberthans20','lms');

if(!$con) {
    die(mysqli_error($con));
}

if (isset($_POST['click_update_btn'])) {
    $id = $_POST['user_id'];
    $arrayresult = [];

    $sql = "Select * from `book` where id='$id'";
    $result = mysqli_query($con, $sql);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($arrayresult, $row);
        }
       
        header('content-type: application/json');
        echo json_encode($arrayresult);
    }
}

if(isset($_POST['update_data']))
{   
    $id = $_POST['id'];
    $cover = $_POST['image'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];
    $year = $_POST['year'];
    $quantity = $_POST['quantity'];
    $isbn = $_POST['isbn'];

    $update_query = "UPDATE book SET Cover='$cover', Title='$title', Author='$author', Genre='$genre', 
    Year='$year', Quantity='$quantity', ISBN='$isbn' WHERE ID='$id'";
    $update_query_run = mysqli_query($con, $update_query);

    if ($update_query_run) {
        header('Location: Book-Database.php');
    } else {
        echo "Error: " . mysqli_error($con);
    }

}

?>