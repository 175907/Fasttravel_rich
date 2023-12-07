<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
  </head>
  <body>
    <h1>Hello Admin</h1>
    <?php

@include 'database.php';

session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:login.php');
}

?>
<?php

@include 'database.php';

$sql = "SELECT location, date, capacity FROM tours";
$result = $conn->query($sql);

if (!$result) {
    die("Error in SQL query: " . $conn->error);
}

if ($result->num_rows > 0) {
    echo "<table border='1'>
        <tr>
            <th>Location</th>
            <th>Date</th>
            <th>Capacity</th>
        </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["location"] . "</td>
                <td>" . $row["date"] . "</td>
                <td>" . $row["capacity"] . "</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "No tours found";
}
?>


<?php

@include 'database.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $tour_id = $_GET["id"];


    $sql = "SELECT id, location, date, capacity FROM tours WHERE id = $tour_id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $location = $row["location"];
        $date = $row["date"];
        $capacity = $row["capacity"];
    } else {
        echo "Tour not found";
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tour_id = $_POST["tour_id"];
    $new_date = $_POST["new_date"];
    $new_capacity = $_POST["new_capacity"];

    $update_sql = "UPDATE tours SET date='$new_date', capacity=$new_capacity WHERE id=$tour_id";

    if ($conn->query($update_sql) === TRUE) {
        echo "Tour information updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>


    <a href="post-a-tour.php"><button>Post a Tour</button></a>
    <a href="modify-a-tour.php"><button>Modify a Tour</button></a>
  </body>
</html>
