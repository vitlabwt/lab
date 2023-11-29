<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transformed Text</title>
</head>
<body>
    <h2>Transformed Text</h2>

    <?php
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get input from the text box
        $inputText = $_POST['inputText'];

        // Transform the input: make it lowercase and capitalize the first character of each word
        $transformedText = ucwords(strtolower($inputText));

        // Display the transformed text
        echo "<p>Original Text: $inputText</p>";
        echo "<p>Transformed Text: $transformedText</p>";
    } else {
        // If the form is not submitted, display a message
        echo "<p>No input submitted</p>";
    }
    ?>
</body>
</html>
