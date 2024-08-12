<?php
// Database connection
$servername = "127.0.0.1:3307";
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
            align-items: center;
            height: 100vh;
            background-color: #182037;
            margin: 0;
        }
        .container {
            background-color: #ffff;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-left: 250px;
            width: 350px;
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
    <h2>Question Form</h2>
    <form>
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title" placeholder="Enter the title">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" placeholder="Enter the description"></textarea>
        </div>
        <div class="form-group">
            <label for="example">Example</label>
            <textarea id="example" placeholder="Enter an example"></textarea>
        </div>
        <button type="submit" class="submit-btn">Submit Question</button>
    </form>
</div>

<div class="container" style="margin-top: 20px;">
    <h2>Test Case Form</h2>
    <form>
        <div class="form-group">
            <label for="input1">Input 1</label>
            <input type="text" id="input1" placeholder="Enter Input 1">
        </div>
        <div class="form-group">
            <label for="input2">Input 2</label>
            <input type="text" id="input2" placeholder="Enter Input 2">
        </div>
        <div class="form-group">
            <label for="output">Expected Output</label>
            <input type="text" id="output" placeholder="Enter Expected Output">
        </div>
        <button type="submit" class="submit-btn">Submit Test Case</button>
    </form>
</div>

</body>
</html>
