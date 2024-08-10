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

            <button type="submit">Add Question</button>
        </form>

        <!-- Link to the Dashboard -->
        <p>
            <a href="dashboard.php">Back to Dashboard</a>
        </p>
    </div>
</body>

</html>
