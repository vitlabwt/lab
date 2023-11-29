<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <title>Document</title>
</head>
<body>
    <div class="general-container">
        <section class="menu-section">
            <div class="menu-top-container">
                <h2>Menu</h2>
            </div>
            <div class="menu-container">    
                <div class="calculator-tab">
                    <h3>Calculator</h3>
                    <div class="calculator-container">
                        <p>
                        <?php
                            $servername = "localhost:4306";
                            $username = "root";
                            $password = "";
                            $dbname = "semester_results";

                            // Create connection
                            $conn = new mysqli($servername, $username, $password, $dbname);

                            // Check connection
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                $mseWeight = 0.3;
                                $eseWeight = 0.7;

                                $mse1 = filter_input(INPUT_POST, 'mse1');
                                $ese1 = filter_input(INPUT_POST, 'ese1');
                                $mse2 = filter_input(INPUT_POST, 'mse2');
                                $ese2 = filter_input(INPUT_POST, 'ese2');
                                $mse3 = filter_input(INPUT_POST, 'mse3');
                                $ese3 = filter_input(INPUT_POST, 'ese3');
                                $mse4 = filter_input(INPUT_POST, 'mse4');
                                $ese4 = filter_input(INPUT_POST, 'ese4');

                                // Insert data into the database
                                $sql = "INSERT INTO results (mse1, ese1, mse2, ese2, mse3, ese3, mse4, ese4) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("dddddddd", $mse1, $ese1, $mse2, $ese2, $mse3, $ese3, $mse4, $ese4);

                                if ($stmt->execute()) {
                                    echo "Data inserted successfully.<br>";
                                    
                                    // Calculate the weighted average
                                    $weightedAverage1 = ($mse1 * $mseWeight) + ($ese1 * $eseWeight);
                                    $weightedAverage2 = ($mse2 * $mseWeight) + ($ese2 * $eseWeight);
                                    $weightedAverage3 = ($mse3 * $mseWeight) + ($ese3 * $eseWeight);
                                    $weightedAverage4 = ($mse4 * $mseWeight) + ($ese4 * $eseWeight);

                                    // Calculate the total percentage
                                    $totalPercentage = ($weightedAverage1 + $weightedAverage2 + $weightedAverage3 + $weightedAverage4) / 4;
                                    echo "Total Percentage: $totalPercentage";
                                } else {
                                    echo "Error: " . $stmt->error . "<br>";
                                }

                                // Close the connection
                                $stmt->close();
                            }

                            // Close the connection
                            $conn->close();
                        ?>

                        </p>
                        <form method="post" class="calculator-form">
                            <input type="text" class="input-grade" id="mse1" name="mse1" placeholder="MSE for subject 1">
                            <input type="text" class="input-grade" id="ese1" name="ese1" placeholder="ESE for subject 1">
                            <input type="text" class="input-grade" id="mse2" name="mse2" placeholder="MSE for subject 2">
                            <input type="text" class="input-grade" id="ese2" name="ese2" placeholder="ESE for subject 2">
                            <input type="text" class="input-grade" id="mse3" name="mse3" placeholder="MSE for subject 3">
                            <input type="text" class="input-grade" id="ese3" name="ese3" placeholder="ESE for subject 3">
                            <input type="text" class="input-grade" id="mse4" name="mse4" placeholder="MSE for subject 4">
                            <input type="text" class="input-grade" id="ese4" name="ese4" placeholder="ESE for subject 4">
                            <button type="submit">Calculate</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>
</html>
