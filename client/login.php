<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css"> <!-- Linking to the external CSS file -->
</head>

<body>
    <div class="container">
        <form action="authenticate.php" method="POST">
            <h1>Login</h1>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Login</button>

            <!-- Link to registration page -->
            <p>
                Don't have an account? <a href="register.php" target="_blank">Register here</a>.
            </p>
        </form>
    </div>
</body>

</html>
