<?php
$servername = "localhost:4306";
$username = "root";
$password = "";
$dbname = "attendance_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>

<html>
<head>
    <title>Attendance Report</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <form method="post" action="report.php">
        <label for="start_date">Start Date:</label>
        <input type="date" id="start_date" name="start_date" required>

        <label for="end_date">End Date:</label>
        <input type="date" id="end_date" name="end_date" required>

        <input type="submit" name="generate_report" value="Generate Report">
    </form>

    <h2>Attendance Report</h2>
    <?php 
    if (isset($_POST['generate_report'])) {
        $startDate = new DateTime($_POST['start_date']);
        $endDate = new DateTime($_POST['end_date']);
    
        // Format dates as strings
        $startDateStr = $startDate->format('Y-m-d');
        $endDateStr = $endDate->format('Y-m-d');
        echo "<h2>Start Date: " . $startDateStr . "</h2>";
        echo "<h2>End Date: " . $endDateStr . "</h2>";
    }
    else{
        echo "<script> alert('Please select start & end date to generate report')</script>";
    }
    ?>
   
    <table border="1">
        <tr>
            <th>Student ID</th>
            <th>Present Class</th>
            <th>Total Class</th>
            <th>Attendance Percentage</th>
        </tr>
        <?php
        if (isset($_POST['generate_report'])) {

            
            $sql = "SELECT student.id AS student_id, 
            COUNT(DISTINCT attendance.class_date) AS total_present_days
            FROM student
            LEFT JOIN attendance ON student.serial = attendance.student_serial
            WHERE attendance.class_date BETWEEN '$startDateStr' AND '$endDateStr'
            GROUP BY student.serial";

           $totalDaysResult = $conn->query("SELECT COUNT(DISTINCT class_date) as total_days FROM attendance");
           $totalDaysRow = $totalDaysResult->fetch_assoc();
           $totalDays = $totalDaysRow['total_days'];

        
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $row["attendance_percentage"] = ($row["total_present_days"] / $totalDays) * 100;
                    echo "<tr>";
                    echo "<td>" . $row["student_id"] . "</td>";
                    echo "<td>" . $row["total_present_days"] . "</td>";
                    echo "<td>" . $totalDays . "</td>";
                    echo "<td>" . $row["attendance_percentage"] . "%" . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "No attendance data available for the selected date.";
            }
        }
        
        ?>
    </table>
</body>
</html>
