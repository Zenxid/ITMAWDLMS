<?php
include 'connect.php';

if(isset($_GET['game_id']) && filter_var($_GET['game_id'], FILTER_VALIDATE_INT)) {
    $game_id = mysqli_real_escape_string($con, $_GET['game_id']);
    
    $update_query = "UPDATE board_games SET quantity = GREATEST(quantity - 1, 0) WHERE id = $game_id";
    
    if(mysqli_query($con, $update_query)) {
        echo "Quantity updated successfully!";
    } else {
        echo "Error updating quantity: " . mysqli_error($con);
    }
} else {
    echo "Invalid game ID!";
}

?>