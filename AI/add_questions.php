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
    <title>Question and Test Case Submission</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: row;
            align-items: center;
            height: 100vh;
            background-color: #182037;
            margin: 0;
        }
        .container {
            background-color: #fff;
            border-radius: 8px;           
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 350px;
            margin-left: 250px;
            padding: 30px;
        }
        .container h2 {
            margin-top: 0;
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-group textarea {
            resize: vertical;
            height: 80px;
        }
        .submit-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        .submit-btn:hover {
            background-color: #45a049;
        }
    </style>
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

            <button type="submit">Add Question</button>
        </form>
    </div>
</body>

</html>
