<?php
$server = "localhost";
$username = "root";
$password = "1463";
$database = "trip";

// Connection established
$con = mysqli_connect($server, $username, $password, $database, 3306);
if (!$con) {
    die("connection to this database failed due to " . mysqli_connect_error());
}

// Fetch data from the database
$sql = "SELECT * FROM `trip`.`trip`";
$result = $con->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Participant List</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
<div class="container">
    <h2>Participant List</h2>
    <?php
    if ($result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Other</th>
                    <th>Registration Date</th>
                </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['name']}</td>
                    <td>{$row['age']}</td>
                    <td>{$row['gender']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['phone']}</td>
                    <td>{$row['other']}</td>
                    <td>{$row['dt']}</td>
                </tr>";
        }

        echo "</table>";
    } else {
        echo "No participants found";
    }
    ?>
</div>
</body>
</html>

<?php
$con->close();
?>
