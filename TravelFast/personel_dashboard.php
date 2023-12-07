<?php

@include 'database.php';


$user_id = 1; 
$sql_user = "SELECT * FROM users WHERE id = $user_id";
$result_user = $conn->query($sql_user);

if ($result_user->num_rows == 1) {
    $user = $result_user->fetch_assoc();
} else {
    echo "User not found";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    echo "User information updated successfully.";
}
?>

