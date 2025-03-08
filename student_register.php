<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('stu.jpg'); 
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
            background-color: #C9D8F1;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 320px;
            text-align: left;
        }
        h1 {
            margin-bottom: 50px;
            color: #333;
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
        <h1>Student Registration</h1>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <label for="name">Name:(eg:JOHN K.T.)</label>
            <input type="text" id="name" name="name" required>
            <label for="std_id">Username (Student ID):</label>
            <input type="text" id="std_id" name="std_id" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
			<label for="confirm_password">Confirm Password:</label>
			<input type="password" id="confirm_password" name="confirm_password" required>
            <label for="department">Department:</label>
            <select id="department" name="department" required>
                <option value="Electrical & Electronic">Electrical & Electronic Engineering</option>
                <option value="Computer">Computer Engineering</option>
                <option value="Civil">Civil Engineering</option>
                <option value="Mechanical">Mechanical Engineering</option>
                <option value="Other">Other</option>
            </select>
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
            $name = $_POST['name'];
            $std_id = $_POST['std_id'];
            $password = $_POST['password'];
			$confirm_password = $_POST['confirm_password'];
            $department = $_POST['department'];
			
			// Check if password and confirm password match
			if ($password !== $confirm_password) {
				echo "<p class='message'>Passwords do not match.</p>";
				return;
			}

            // Check if student is already registered
            $check_query = "SELECT * FROM student WHERE Std_ID = ?";
            $stmt = $conn->prepare($check_query);
            $stmt->bind_param('s', $std_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo "<p class='message'>Student already registered. Proceed to login.</p>";
            } else {
                // Insert into the student table
                $student_query = "INSERT INTO student (AdminID, Std_ID) VALUES (1, ?)";
                $stmt = $conn->prepare($student_query);
                $stmt->bind_param('s', $std_id);
                $stmt->execute();

                if ($stmt->error) {
                    echo "Error inserting into student: " . $stmt->error;
                    return;
                }

                // Insert into the registration table
                $registration_query = "INSERT INTO registration (Name, Password, Department, Std_ID) VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($registration_query);
                $stmt->bind_param('ssss', $name, $password, $department, $std_id);
                $stmt->execute();

                if ($stmt->error) {
                    echo "Error inserting into registration: " . $stmt->error;
                } else {
                    echo "<p class='message'>Registration successful. Proceed to login.</p>";
                }
            }

            $conn->close();
        }
        ?>

        <div class="login-link">
            <a href="student_login.php">&larr; Back to Login</a>
        </div>
						 <div class="login-link">
            <a href="index.html">&larr; Back to Main Menu</a>
        </div>
    </div>
</body>
</html>
