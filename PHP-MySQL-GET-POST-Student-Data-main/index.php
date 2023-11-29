<?php
    $insert = false;
    if(isset($_POST['name'])) {
        $server = "localhost";
        $username = "root";
        $password = "1463";
        $database = "trip";

        // Connection established
        $con = mysqli_connect($server, $username, $password, $database, 3306);
        if(!$con) {
            die("connection to this database failed due to " . mysqli_connect_error());
        }
        // echo "Success connecting to the db!";

        // Putting values in db through post
        $name = $_POST['name'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $desc = $_POST['desc'];

        $sql = "INSERT INTO `trip`.`trip` ( `name`, `age`, `gender`, `email`, `phone`, `other`, `dt`) VALUES
            ('$name', '$age', '$gender', '$email', '$phone', '$desc',
                current_timestamp());";
        // echo $sql;

        if($con->query($sql) == true) {
            // echo "Successfully inserted!"
            $insert = true;
            // Redirect to prevent form resubmission
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }
        else {
            echo "ERROR: $sql <br> $con->error";
        }

        $con->close();
    }
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Welcome to Travel Form</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Josefin+Sans&family=Jost:wght@300&family=Montserrat:wght@100;400;900&family=Mulish&family=Roboto&family=Ubuntu:wght@300;400;700&display=swap"
      rel="stylesheet"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Josefin+Sans&family=Jost:wght@300&family=Montserrat:wght@100;400;900&family=Mulish&family=Roboto&family=Sriracha&family=Ubuntu:wght@300;400;700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <img class="bg" src="bg.jpg" alt="VIT Pune" />
    <div class="container">
      <h1>Welcome to VIT, Pune US Trip Form</h1>
      <p>
        Enter your details and submit this form to confirm your participation in
        the trip
      </p>
      <?php
        if($insert == true){
            echo "<p class='submitMsg'>Thank you for filling out the form. We are happy to see you joining us for the US trip!</p>";
        }
      ?>
      <form action="index.php" method="post">
        <input
          type="text"
          name="name"
          id="name"
          placeholder="Enter your name"
        />
        <input type="text" name="age" id="age" placeholder="Enter your age" />
        <input
          type="text"
          name="gender"
          id="gender"
          placeholder="Enter your gender"
        />
        <input
          type="email"
          name="email"
          id="email"
          placeholder="Enter your email"
        />
        <input
          type="phone"
          name="phone"
          id="phone"
          placeholder="Enter your phone"
        />
        <textarea
          name="desc"
          id="desc"
          cols="30"
          rows="10"
          placeholder="Enter any other information here"
        ></textarea>
        <button class="btn">Submit</button>
      </form>
    </div>
    <script src="index.js"></script>
  </body>
</html>
