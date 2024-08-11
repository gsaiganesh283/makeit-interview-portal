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
    <h2>Question Form</h2>
    <form>
        <div class="form-group">
            <label for="title">Question</label>
            <input type="text" id="title" placeholder="Enter the question">
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
