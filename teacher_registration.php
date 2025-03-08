<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('t.jpg'); 
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #8FC0B2;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 400px;
            text-align: left;
        }
        h1 {
            margin-bottom: 50px;
            color: #black;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #black;
            font-weight: bold;
        }
        input, select {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 0 auto 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            display: block;
        }
        button {
            background-color: #007bff;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: calc(100% - 20px);
            font-size: 16px;
            transition: background-color 0.3s ease;
            display: block;
            margin: 0 auto;
        }
        button:hover {
            background-color: #0056b3;
        }
        .message {
            color: #ff4d4d;
            margin-bottom: 20px;
        }
        .login-link {
            margin-top: 20px;
            color: #2931D5 ;
        }
        .login-link a {
            text-decoration: none;
            color: #2931D5 ;
        }
        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Teacher Registration</h1>
    <form action="teacher_registration.php" method="post">
        <label for="teacher_id">Teacher ID:</label>
        <input type="text" id="teacher_id" name="teacher_id" required>
        <br>
        <label for="teacher_name">Teacher Name:(eg:JOHN K.T.)</label>
        <input type="text" id="teacher_name" name="teacher_name" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required>
        <br>
        <button type="submit">Register</button>
    </form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // Establish database connection
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'feedback_management_system_group16';

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    // Retrieve form data
    if(isset($_POST['teacher_id']) && isset($_POST['teacher_name']) && isset($_POST['password']) && isset($_POST['confirm_password'])){
        $teacher_id = $_POST['teacher_id'];
        $teacher_name = $_POST['teacher_name'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        // Check if password and confirm password match
        if ($password !== $confirm_password) {
            echo "<p class='message'>Passwords do not match.</p>";
            $conn->close();
            exit;
        }

        // Check if the teacher exists in the teacher table
        $teacher_check_query = "SELECT * FROM teacher WHERE TeacherID = ? AND Name = ?";
        $stmt = $conn->prepare($teacher_check_query);
        $stmt->bind_param('ss', $teacher_id, $teacher_name);
        $stmt->execute();
        $teacher_result = $stmt->get_result();

        if ($teacher_result->num_rows == 0) {
            echo "<p class='message'>Teacher ID or Name not found in the Feedback System.</p>";
            $stmt->close();
            $conn->close();
            exit;
        }

        // Check if the teacher is already registered
        $check_query = "SELECT * FROM teacher_reg WHERE TeacherID = ?";
        $stmt = $conn->prepare($check_query);
        $stmt->bind_param('s', $teacher_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<p class='message'>Teacher already registered. Proceed to login.</p>";
        } else {


            // Insert into the teacher_reg table
            $registration_query = "INSERT INTO teacher_reg (teacher_name, TeacherID, password) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($registration_query);

            $stmt->bind_param('sss', $teacher_name, $teacher_id, $password);
            $stmt->execute();

            if ($stmt->error) {
                echo "Error inserting into teacher_reg: " . $stmt->error;
            } else {
                echo "<p class='message'>Registration successful. Proceed to login.</p>";
            }
        }

        $stmt->close();
    }else{
        echo "<p class='message'>Please fill out all the fields.</p>";
    }
    $conn->close();
}
?>






        <div class="login-link">
            <a href="teacher_login.php">&larr; Back to Login</a>
        </div>
				 <div class="login-link">
            <a href="index.html">&larr; Back to Main Menu</a>
        </div>
    </div>
</body>
</html>