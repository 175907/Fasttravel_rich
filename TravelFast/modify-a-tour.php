<?php

@include 'database.php';


$sql_locations = "SELECT DISTINCT Location FROM tours";
$result_locations = $conn->query($sql_locations);

if (!$result_locations) {
    die("Error in SQL query: " . $conn->error);
}

$locations = array();

while ($row_location = $result_locations->fetch_assoc()) {
    $locations[] = $row_location["Location"];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $location = $_POST["location"];

    
    $sql = "SELECT Location, Date, Capacity FROM tours WHERE Location = '$location'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $date = $row["Date"];
        $capacity = $row["Capacity"];
    } else {
        echo "Tour not found";
        exit();
    }

    $new_date = $_POST["new_date"];
    $new_capacity = $_POST["new_capacity"];

    $update_sql = "UPDATE tours SET Date='$new_date', Capacity=$new_capacity WHERE Location='$location'";

    if ($conn->query($update_sql) === TRUE) {
        echo "Tour information for location '$location' updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Tour</title>
</head>
<body>
    <h2>Modify Tour</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        
        <label for="location">Select Location:</label>
        <select name="location" required>
            <?php
            foreach ($locations as $loc) {
                echo "<option value='$loc'>$loc</option>";
            }
            ?>
        </select><br>

        <label for="new_date">New Date:</label>
        <input type="date" name="new_date" value="<?php echo $date; ?>" required><br>

        <label for="new_capacity">New Capacity:</label>
        <input type="number" name="new_capacity" value="<?php echo $capacity; ?>" required><br>

        <input type="submit" value="Update">
    </form>
</body>
</html>
