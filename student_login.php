<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>
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
        .login-container {
            background-color: #C9D8F1; 
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 40px;
            width: 500px;
        }
        h1 {
            text-align: center;
            margin-bottom: 50px;
            color: #333;
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
            color: #2E31F5; 
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
		        .login-link {
            margin-top: 20px;
            color: #007bff;
        }
        .login-link a {
            text-decoration: none;
            color: #2E31F5;
        }
        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Student Login</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="std_id">Username (Student ID):</label>
            <input type="text" id="std_id" name="std_id" required>
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
            $std_id = $_POST['std_id'];
            $password = $_POST['password'];

            // Check if the student is registered
            $check_query = "SELECT * FROM registration WHERE Std_ID='$std_id'";
            $result = $conn->query($check_query);
            if ($result->num_rows > 0) {
                // Student is registered, check password
                $row = $result->fetch_assoc();
                if ($row['Password'] == $password) {
                    // Password is correct, check if login already exists
                    $check_login_query = "SELECT * FROM Login WHERE Std_ID=?";
                    $stmt_check = $conn->prepare($check_login_query);
                    $stmt_check->bind_param("s", $std_id);
                    $stmt_check->execute();
                    $stmt_check_result = $stmt_check->get_result();

                    if ($stmt_check_result->num_rows === 0) {
                        // Login does not exist, log the login
                        $login_query = "INSERT INTO Login (User, Std_ID, Password) VALUES (?, ?, ?)";
                        $stmt = $conn->prepare($login_query);

                        if ($stmt === false) {
                            die("Error in prepare statement: " . $conn->error);
                        }

                        // Assuming 'User' is a unique identifier, 'Std_ID' and 'Password' are provided by the login form
                        $user = $row['User']; // Retrieve the user identifier from the registration table
                        $stmt->bind_param("sss", $user, $std_id, $password);
                        $stmt->execute();
                        $stmt->close();
                    }

                    $stmt_check->close();

                    // Redirect to feedback page or perform other actions
                    $_SESSION['std_id'] = $std_id;
                    header("Location: student_dashboard.php"); 
                    exit();
                } else {
                   
                    $message = "Password incorrect. Please try again.";
                }
            } else {
               
                $message = "Student does not exist. Please register first.";
            }

            $conn->close();
        }
        ?>
        <?php
        if (isset($message)) {
            echo '<p class="message">' . $message . '</p>';
        }
        ?>
        <p>Not Registered? <a href="student_register.php">Register here</a></p>
        <div class="login-link">
            <a href="index.html">&larr; Back to Main Menu</a>
        </div>
    </div>
</body>


</html>
