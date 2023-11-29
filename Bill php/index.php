<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Electricity Bill Calculator</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

  <div class="container mt-5">
    <h2 class="text-center mb-4">Electricity Bill Calculator</h2>

    <form action="" method="post">
      <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" class="form-control" id="username" name="username" required>
      </div>

      <div class="form-group">
        <label for="consumerId">Consumer ID:</label>
        <input type="text" class="form-control" id="consumerId" name="consumerId" required>
      </div>

      <div class="form-group">
        <label for="address">Address:</label>
        <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
      </div>

      <div class="form-group">
        <label for="mobile">Mobile Number:</label>
        <input type="tel" class="form-control" id="mobile" name="mobile" pattern="[0-9]{10}" required>
        <small class="form-text text-muted">Enter a 10-digit mobile number.</small>
      </div>

      <div class="form-group">
        <label for="units">Enter Units Consumed:</label>
        <input type="number" class="form-control" id="units" name="units" required>
      </div>

      <button type="submit" class="btn btn-primary">Calculate Bill</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Get the input values
      $username = $_POST["username"];
      $consumerId = $_POST["consumerId"];
      $address = $_POST["address"];
      $mobile = $_POST["mobile"];
      $units = $_POST["units"];

      // Calculate electricity bill based on the given conditions
      $bill = 0;
      if ($units <= 50) {
        $bill = $units * 3.5;
      } elseif ($units <= 150) {
        $bill = 50 * 3.5 + ($units - 50) * 4.00;
      } elseif ($units <= 250) {
        $bill = 50 * 3.5 + 100 * 4.00 + ($units - 150) * 5.20;
      } else {
        $bill = 50 * 3.5 + 100 * 4.00 + 100 * 5.20 + ($units - 250) * 6.50;
      }
      ?>
      <div class="mt-4">
        <h4>Electricity Bill Details:</h4>
        <p>Username: <?php echo $username; ?></p>
        <p>Consumer ID: <?php echo $consumerId; ?></p>
        <p>Address: <?php echo $address; ?></p>
        <p>Mobile Number: <?php echo $mobile; ?></p>
        <p>Consumed Units: <?php echo $units; ?></p>
        <p>Total Bill: Rs. <?php echo number_format($bill, 2); ?></p>
      </div>
    <?php } ?>

  </div>

  <!-- Bootstrap JS and jQuery (optional) -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
