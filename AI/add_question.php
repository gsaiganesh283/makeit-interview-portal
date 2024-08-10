<?php
// Database connection settings
$servername = "127.0.0.1:3306"; // Your database server
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "interview_platform"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description']);
    $example = $conn->real_escape_string($_POST['example']);

    // SQL query to insert a new question
    $sql = "INSERT INTO questions (title, description, example) VALUES ('$title', '$description', '$example')";

    if ($conn->query($sql) === TRUE) {
        echo "New question added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question Added</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
        <h1>Question Submission</h1>
        <p><?php echo isset($message) ? $message : ''; ?></p>
        <a href="add_question_form.html">Add another question</a>
        <a href="index.php">Back to Dashboard</a>
    </div>
</body>

</html>
