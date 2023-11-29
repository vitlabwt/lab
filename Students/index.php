<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "college";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Add student record
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
    $first_name = test_input($_POST['first_name']);
    $last_name = test_input($_POST['last_name']);
    $email = test_input($_POST['email']);
    $phone = test_input($_POST['phone']);

    // Perform form validation
    if (empty($first_name) || empty($last_name) || empty($email) || empty($phone)) {
        echo "All fields are required";
    } else {
        // Insert student record
        $sql = "INSERT INTO students (first_name, last_name, email, phone)
                VALUES ('$first_name', '$last_name', '$email', '$phone')";

        if ($conn->query($sql) === TRUE) {
            echo "Student record added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Delete student record
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $id_to_delete = test_input($_POST['id_to_delete']);

    // Perform form validation
    if (empty($id_to_delete) || !is_numeric($id_to_delete)) {
        echo "Invalid ID";
    } else {
        // Delete student record
        $sql = "DELETE FROM students WHERE id=$id_to_delete";

        if ($conn->query($sql) === TRUE) {
            echo "Student record deleted successfully";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    }
}

// Function to sanitize and validate form input
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Display student records
$sql = "SELECT * FROM students";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student System</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h2 {
            color: #333;
        }

        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:hover {
            background-color: #f5f5f5;
        }
    </style>

    <script>
        // JavaScript for client-side form validation
        function validateForm() {
            var firstName = document.forms["studentForm"]["first_name"].value;
            var lastName = document.forms["studentForm"]["last_name"].value;
            var email = document.forms["studentForm"]["email"].value;
            var phone = document.forms["studentForm"]["phone"].value;

            if (firstName == "" || lastName == "" || email == "" || phone == "") {
                alert("All fields are required");
                return false;
            }
        }
    </script>
</head>
<body>

<h2>Add Student</h2>
<form name="studentForm" method="post" action="" onsubmit="return validateForm()">
    <label for="first_name">First Name:</label>
    <input type="text" name="first_name" required>
    <label for="last_name">Last Name:</label>
    <input type="text" name="last_name" required>
    <label for="email">Email:</label>
    <input type="email" name="email" required>
    <label for="phone">Phone:</label>
    <input type="text" name="phone" required>
    <button type="submit" name="add">Add Student</button>
</form>

<h2>Delete Student</h2>
<form method="post" action="" onsubmit="return confirm('Are you sure you want to delete this student?')">
    <label for="id_to_delete">Student ID to Delete:</label>
    <input type="number" name="id_to_delete" required>
    <button type="submit" name="delete">Delete Student</button>
</form>

<h2>Student List</h2>
<table>
    <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Phone</th>
    </tr>

    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["first_name"] . "</td>";
            echo "<td>" . $row["last_name"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["phone"] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No records found</td></tr>";
    }
    ?>
</table>

</body>
</html>

<?php
// Close connection
$conn->close();
?>