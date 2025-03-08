<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Login</title>
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
        .login-container {
            background-color: #8FC0B2; 
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 40px;
            width: 500px;
        }
        h1 {
            text-align: center;
            margin-bottom: 50px;
            color: #black;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #black;
			font-weight: bold;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        button {
            background-color: #007bff; 
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }
        button:hover {
            background-color: #0056b3;
        }
        .message {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }
        a {
            color: #2931D5 ; 
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline; 
        }
		        .login-link {
            margin-top: 20px;
            color: #2931D5 ;
        }
        .login-link a {
            text-decoration: none;
            color:#2931D5 ;
        }
        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Teacher Login</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="t">Username (Teacher ID):</label>
            <input type="text" id="t" name="t" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Login</button>
        </form>
      <?php
        session_start(); // Start the session

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Establish connection to the database
            $servername = "localhost";
            $username = "root"; 
            $password = ""; 
            $dbname = "feedback_management_system_group16"; 

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Retrieve form data
            $t = $_POST['t'];
            $password = $_POST['password'];

            // Check if the teacher is registered
            $check_query = "SELECT * FROM teacher_reg WHERE TeacherID='$t'";
            $result = $conn->query($check_query);
            if ($result->num_rows > 0) {
                // Teacher is registered, check password
                $row = $result->fetch_assoc();
                if ($row['password'] == $password) {
                    // Password is correct, redirect to dashboard or perform other actions
                    $_SESSION['teacher_id'] = $t; // Store TeacherID in session for future use
                    header("Location: teacher_dashboard.php"); // Redirect to dashboard
                    exit();
                } else {
                    // Incorrect password
                    $message = "Password incorrect. Please try again.";
                }
            } else {
                // Teacher does not exist in the teacher_reg table
                $message = "Teacher does not exist. Please register first.";
            }

            $conn->close();
        }
        ?>
        <?php
        if (isset($message)) {
            echo '<p class="message">' . $message . '</p>';
        }
        ?>
        <p>Not Registered? <a href="teacher_registration.php">Register here</a></p>
		        
				<div class="login-link">
            <a href="index.html">&larr; Back to Main Menu</a>
        </div>
    </div>
</body>
</html>
