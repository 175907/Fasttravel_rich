<?php
@include 'database.php';


$sql = "SELECT Location, Date, Capacity FROM tours";
$result = $conn->query($sql);

if (!$result) {
    die("Error in SQL query: " . $conn->error);
}

$tours = array();

while ($row = $result->fetch_assoc()) {
    $tours[] = $row;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["add_to_cart"])) {
        $selected_tour = $_POST["selected_tour"];
        $num_travelers = $_POST["num_travelers"];

        foreach ($tours as $tour) {
            if ($tour["Location"] == $selected_tour) {
                if ($num_travelers <= $tour["Capacity"]) {
                    $_SESSION["shopping_cart"][] = array(
                        "location" => $tour["Location"],
                        "date" => $tour["Date"],
                        "num_travelers" => $num_travelers
                    );
                    echo "Tour added to the shopping cart successfully.";
                } else {
                    echo "Error: Number of travelers exceeds tour capacity.";
                }
                break;
            }
        }
    } elseif (isset($_POST["view_cart"])) {
        
        header("Location: view_cart.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Tours</title>
</head>
<body>
    <h2>Select Tours</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="selected_tour">Select Tour:</label>
        <select name="selected_tour" required>
            <?php
            foreach ($tours as $tour) {
                echo "<option value='{$tour["Location"]}'>{$tour["Location"]} - {$tour["Date"]}</option>";
            }
            ?>
        </select><br>

        <label for="num_travelers">Number of Travelers:</label>
        <input type="number" name="num_travelers" required><br>

        <input type="submit" name="add_to_cart" value="Add to Cart">
    </form>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="submit" name="view_cart" value="View Cart">
    </form>
</body>
</html>
