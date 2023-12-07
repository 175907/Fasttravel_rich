<?php

@include 'database.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Location = $_POST["Location"];
    $Date = $_POST["Date"];
    $Capacity = $_POST["Capacity"];


    $sql = "INSERT INTO tours (Location, Date, Capacity) VALUES ('$Location', '$Date', $Capacity)";

    if ($conn->query($sql) === TRUE) {
        echo "Tour information added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
  </head>
  <body>
  <form action="" method="post">
    <label for="Location">Location</label>
    <input type="text" name="Location" required />
    <br />
    <br />
    <label for="Date">Date</label>
    <input type="date" name="Date" required/>
    <br />
    <br />
    <label for="Location">Capacity</label>
    <input type="number" name="Capacity" required/>
    <input type="submit" name="submit" class="submit" value="Post Tour"></input>
  </form>
  </body>
</html>
