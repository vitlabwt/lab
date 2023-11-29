<?php
session_start();

// Initialize student array in the session if not already set
if (!isset($_SESSION['students'])) {
    $_SESSION['students'] = [];
}

// Function to add a new student
function addStudent($name) {
    $_SESSION['students'][] = $name;
}

// Function to delete a student
function deleteStudent($index) {
    array_splice($_SESSION['students'], $index, 1);
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    // Handle form actions
    if ($_POST['action'] === 'add' && isset($_POST['name'])) {
        addStudent($_POST['name']);
    } elseif ($_POST['action'] === 'delete' && isset($_POST['index'])) {
        deleteStudent($_POST['index']);
    }
}

// Display student list
$students = $_SESSION['students'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Student Management System</h2>
        <form id="addForm" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            <input type="hidden" name="action" value="add">
            <button type="submit">Add Student</button>
        </form>

        <ul id="studentList">
            <?php
            foreach ($students as $index => $student) {
                echo "<li>{$student} <form method='post' style='display:inline;'><input type='hidden' name='index' value='{$index}'><input type='hidden' name='action' value='delete'><button type='submit'>Delete</button></form></li>";
            }
            ?>
        </ul>
    </div>

   
</body>
</html>
