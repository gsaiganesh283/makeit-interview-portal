<?php
// Database connection
$servername = "127.0.0.1:3306";
$username = "root";
$password = "";
$dbname = "interview_platform";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the question details
    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description']);
    $example = $conn->real_escape_string($_POST['example']);
    $category = $conn->real_escape_string($_POST['category']);

    // Insert question into database
    $sql = "INSERT INTO questions (title, description, example, category) VALUES ('$title', '$description', '$example', '$category')";
    if ($conn->query($sql) === TRUE) {
        $question_id = $conn->insert_id; // Get the ID of the newly inserted question

        // Insert test cases
        $test_inputs = $_POST['input'];
        $test_outputs = $_POST['output'];

        for ($i = 0; $i < count($test_inputs); $i++) {
            $test_input = $conn->real_escape_string($test_inputs[$i]);
            $test_output = $conn->real_escape_string($test_outputs[$i]);

            $sql = "INSERT INTO testcases (id, input, output) VALUES ('$question_id', '$test_input', '$test_output')";
            $conn->query($sql);
        }

        echo "Question and test cases added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a New Question</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
        <h1>Add a New Question</h1>
        <form action="add_question.php" method="POST">
            <label for="title">Question Title:</label>
            <input type="text" id="title" name="title" required>

            <label for="description">Question Description:</label>
            <textarea id="description" name="description" required></textarea>

            <label for="example">Example:</label>
            <textarea id="example" name="example"></textarea>

            <div id="test-cases-container">
            <h3>Test Cases</h3>
            <div class="test-case">
                <label for="test_input_1">Test Case 1 Input</label>
                <textarea id="test_input_1" name="test_input[]" placeholder="Enter test case input" required></textarea>

                <label for="test_output_1">Test Case 1 Expected Output</label>
                <textarea id="test_output_1" name="test_output[]" placeholder="Enter expected output" required></textarea>
            </div>
        </div>

        <button type="button" id="add-test-case">Add Another Test Case</button>

        <button type="submit">Add Question</button>

            <button type="submit">Add Question</button>
        </form>
    </div>
</body>

</html>
