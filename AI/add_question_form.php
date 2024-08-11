<?php
// Database configuration
$servername = "127.0.0.1:3307";
$username = "root";  // Replace with your database username
$password = "";  // Replace with your database password
$dbname = "interview_platform";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description']);
    $example = $conn->real_escape_string($_POST['example']);

    // Insert data into the database
    $sql = "INSERT INTO questions (title, description, example) VALUES ('$title', '$description', '$example')";

    if ($conn->query($sql) === TRUE) {
        echo "New question added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the connection
$conn->close();
?>
