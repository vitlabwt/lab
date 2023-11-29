<?php
$servername = "localhost:4306";
$username = "root";
$password = "";
$dbname = "attendance_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
    
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
        // Get the selected date
        $classDate = $_POST["date"];

        // Check if attendance data was submitted
        if (isset($_POST["attendance"])) {
            // Loop through the submitted attendance data
            foreach ($_POST["attendance"] as $serialNumber) {
                // Insert attendance records into the database
            $validateSql = "SELECT * FROM student WHERE serial = '$serialNumber'";
            $validateResult = $conn->query($validateSql);
            
            if ($validateResult->num_rows > 0) {
                $sql = "INSERT INTO attendance (student_serial, class_date, is_present) VALUES ('$serialNumber', '$classDate', 1)";
            
                if ($conn->query($sql) !== TRUE) {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
                
            }
        } 
        echo "<script> alert('Attendance records have been saved')</script>";
        }
         else {
            echo "<script>alert('No attendance data submitted')</script>";
        }
    }




?>



<!DOCTYPE html>
<head>
    <title>Student Attendance</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>Student Attendance System</h2>
    <form method="post" action="">
        <label>Date:</label>
        <input type="date" name="date" required><br><br>

        <table>
            <tr>
                <th>Student ID</th>
                <th>Student Name</th>
                <th>Present</th>
            </tr>
            <?php
            $sql = "SELECT * FROM student";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $studentId = $row["id"];
                    $serialNumber = $row["serial"];
                    $studentName = $row["name"];
           ?>
            
                   <tr>
                            <td><?php echo "$studentId"; ?></td>
                            <td><?php echo "$studentName"; ?></td>
                            <td><input type='checkbox' name='attendance[]' value='<?php echo $serialNumber; ?>'></td>
                    </tr>
               <?php }
             } ?>

            
        </table>
        <br><br>
        <center><input type="submit" name="submit" value="Submit"></center>
    </form>
    <br>
    <center><h3>Click Here to See the Attendance Report <a href="report.php">View Report</a> </h3></center><br>

    <?php 
            $conn->close();
            
            ?>
</body>

</html>