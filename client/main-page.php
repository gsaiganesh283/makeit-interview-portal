<?php
// Database connection settings
$servername = "127.0.0.1:3307"; // Your database server
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "interview_platform"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to get a question
$sql = "SELECT title, description, example FROM questions WHERE id = 1"; // Change id as needed
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch the question
    $row = $result->fetch_assoc();
    $title = $row['title'];
    $description = $row['description'];
    $example = $row['example'];
} else {
    $title = "No question found";
    $description = "";
    $example = "";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Interview Platform</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/codemirror.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/theme/dracula.min.css">
    <style>
        #code-editor {
            height: 400px; /* Adjust height as needed */
            width: 100%;
            box-sizing: border-box;
        }
    </style>
</head>

<body>
    <div class="container">
        <main>
            <div class="screen" id="screen-1">
                <div class="code-section">
                    <div class="question-section">
                        <h2><?php echo htmlspecialchars($title); ?></h2>
                        <p><?php echo nl2br(htmlspecialchars($description)); ?></p>
                        <p><strong>Example:</strong> <?php echo nl2br(htmlspecialchars($example)); ?></p>
                    </div>

                    <select id="language-selector">
                        <option value="c">C</option>
                        <option value="cpp">C++</option>
                        <option value="python">Python</option>
                        <option value="java">Java</option>
                        <option value="javascript">JavaScript</option>
                    </select>

                    <textarea id="code-editor" placeholder="Write your code here..."></textarea>
                    <div class="code-controls">
                        <button class="run-button" id="run-button">Run</button>
                        <button class="reset-button" id="reset-button">Reset</button>
                        <button class="submit-button">Submit</button>
                    </div>

                    <div class="boxes-container">
                        <div class="box" id="box-1">Test Case 1:
                            <p>Input: 2 4</p>
                            <p>Output: 2</p>
                        </div>
                        <div class="box" id="box-2">Test Case 2:
                            <p>Input: 3 9</p>
                            <p>Output: 3</p>
                        </div>
                    </div>
                    
                    <div class="output-section">
                        <h3>Output:</h3>
                        <pre id="output"></pre>
                    </div>
                </div>

                <div class="chat-section">
                    <div class="interviewer">
                        <img src="interviewer.jpg" alt="Interviewer">
                    </div>
                    <canvas class="voice-wave" id="voice-wave"></canvas>
                    <div class="transcript-section">
                        <div class="chat-window" id="chat-window"></div>
                    </div>
                    <div class="chat-input">
                        <button id="listen-button">Listen</button>
                        <button id="send-button">Send</button>
                    </div>
                    <button class="analysis-button">Analysis</button>
                </div>
            </div>

            <div class="screen" id="screen-2" style="display: none;">
                <div class="review-section">
                    <h2>Mock Interview Review</h2>
                    <div class="score-section">
                        <div class="score-circle">65%</div>
                        <div class="details">
                            <p><strong>Attempts:</strong> 3</p>
                            <p><strong>Mastery:</strong> Partial Mastery</p>
                        </div>
                    </div>
                    <div class="detailed-feedback">
                        <h3>Detailed Feedback</h3>
                        <p>Overall performance was good, but there's room for improvement in optimization and code readability.</p>
                    </div>
                    <div class="recommendations">
                        <h3>Recommendations</h3>
                        <ul>
                            <li>Optimize your code to improve efficiency.</li>
                            <li>Enhance code readability with better variable names and comments.</li>
                        </ul>
                    </div>
                    <div class="skill-chart">
                        <h3>Skills Chart</h3>
                        <canvas id="skills-chart"></canvas>
                    </div>
                </div>
                <button class="finish-button">Finish</button>
            </div>
        </main>

        <footer>
            <p>&copy; 2024 MakeIT. All rights reserved.</p>
        </footer>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/codemirror.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/mode/python/python.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/mode/clike/clike.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/mode/javascript/javascript.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/mode/java/java.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
    var editor = CodeMirror.fromTextArea(document.getElementById("code-editor"), {
        lineNumbers: true,
        mode: "python", // Default mode
        theme: "dracula",
        indentUnit: 4
    });

    var templates = {
        c: '#include <stdio.h>\n\nint main() {\n    // Your code here\n    return 0;\n}',
        cpp: '#include <iostream>\n\nint main() {\n    // Your code here\n    return 0;\n}',
        python: 'def main():\n    # Your code here\n    pass\n\nif __name__ == "__main__":\n    main()',
        java: 'public class Main {\n    public static void main(String[] args) {\n        // Your code here\n    }\n}',
        javascript: 'function main() {\n    // Your code here\n}\n\nmain();'
    };

    document.getElementById("language-selector").addEventListener("change", function() {
        var language = this.value;
        var mode = '';

        switch(language) {
            case 'c':
                mode = 'text/x-csrc';
                break;
            case 'cpp':
                mode = 'text/x-c++src';
                break;
            case 'python':
                mode = 'python';
                break;
            case 'java':
                mode = 'text/x-java';
                break;
            case 'javascript':
                mode = 'javascript';
                break;
        }

        editor.setOption("mode", mode);
        editor.setValue(templates[language]);
    });

    // Handle reset button click
    document.getElementById("reset-button").addEventListener("click", function() {
        var language = document.getElementById("language-selector").value;
        editor.setValue(templates[language]); // Reset the editor content to the template
    });

    // Handle run button click
    document.getElementById("run-button").addEventListener("click", function() {
    var code = editor.getValue();
    var language = document.getElementById("language-selector").value;

    fetch('/run', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            code: code,
            language: language
        }),
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);  // Log the entire response for debugging
        const outputElement = document.getElementById("output");
        if (data.error) {
            outputElement.textContent = `Error: ${data.error}`;
        } else {
            outputElement.textContent = `Output:\n${data.output}`;
        }
    })
    .catch((error) => {
        console.error('Error:', error);
    });
});

});


    </script>

    <script>
        var timeoutDuration = 1800 * 1000; // 30 minutes in milliseconds
        var warningDuration = 60 * 1000; // 1 minute before timeout

        setTimeout(function() {
            alert('Your session is about to expire. Please save your work.');
        }, timeoutDuration - warningDuration);
    </script>

</body>

</html>
