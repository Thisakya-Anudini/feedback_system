<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            display: flex;
            max-width:100%;
            margin: 0px auto;
            background-image: url('stu.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .sidebar {
            width: 260px;
            background-color: #2c3e50;
            color: #fff;
            padding: 20px;
            position: fixed;
            height: 100%;
        }
        .sidebar h2 {
            margin-top: 20px;
            margin-bottom: 30px;
            font-size: 30px;
            color: #fff;
            display: flex;
            margin-left: 20px;
        }
        .sidebar ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        .sidebar li {
            margin-top: 70px;
            margin-bottom: 50px;
        }
        .sidebar a {
            color: #fff;
            text-decoration: none;
            font-size: 18px;
            padding: 10px 20px;
            border-radius: 4px;
            display: block;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .sidebar a:hover {
            background-color: #D4FAFA;
            color: black;
        }

        .content {
            flex: 1;
            padding: 50px;
            margin-left: 350px;
            overflow-y: auto;
            max-width: 800px;
        }
        h1 {
            margin-top: 0px;
            color:#FBFF77  
        }

        .reset-form {
            max-width: 400px;
            margin: 70px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 50px;
            border: 1px solid #ccc;
        }
        label {
            display: block;
            margin-bottom: 20px;
        }
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 30px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background-color: #007bff;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #0056b3;
        }
        .error-message {
            color:#D00050;
			font-size: 30px;
            margin-top:0px;
        }
		.success-message {
		color: #214FE8;
		font-size: 30px;
		margin-top: 0px; 
	}
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <h2>Dashboard</h2>
            <ul>
                <li><a href="course_feedback.php">Provide Course Feedback</a></li>
                <li><a href="teacher_feedback.php">Provide Teacher Feedback</a></li>
                <li><a href="reset_password.php"class="active">Reset Password</a></li>
                <!-- Logout button with the "logout" class -->
                <li><a href="index.html" class="logout">Logout</a></li>
            </ul>
        </div>
        <div class="content">
            <!-- Content area -->
			<?php
			// Connect to the database
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "feedback_management_system_group16";

			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);

			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}

			// Start or resume session
			if (session_status() == PHP_SESSION_NONE) {
				session_start();
			}

			// Get student's name based on their username (Std_ID)
			$std_id = $_SESSION['std_id']; 
			$sql = "SELECT Name, Password FROM registration WHERE Std_ID = '$std_id'";
			$result = $conn->query($sql);

			// Check if a record is found
			if ($result->num_rows > 0) {
				
				$row = $result->fetch_assoc();
				$student_name = $row["Name"];
				$current_password = $row["Password"];
			} else {
				$student_name = "Student"; 
			}

			// Close connection
			$conn->close();
			?>

			
			<h1>Welcome, <?php echo $student_name; ?></h1>

			<div class="reset-form">
				<h2 style="margin-top: 0px;">Reset The Password</h2>

				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
					<label for="current_password">Current Password:</label>
					<input type="password" id="current_password" name="current_password" required>
					<label for="new_password">New Password:</label>
					<input type="password" id="new_password" name="new_password" required>
					<label for="confirm_password">Confirm New Password:</label>
					<input type="password" id="confirm_password" name="confirm_password" required>
					<button type="submit">Reset Password</button>
				</form>
			</div>

			<?php
			// Check if a session is already active before starting a new one
			if (session_status() == PHP_SESSION_NONE) {
				session_start();
			}

			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				// Connect to the database
				$conn = new mysqli($servername, $username, $password, $dbname);

				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				}

				// Check if session variable is set
				if(isset($_SESSION['std_id'])) {
					$std_id = $_SESSION['std_id'];
					$sql = "SELECT Password FROM registration WHERE Std_ID = '$std_id'";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						$row = $result->fetch_assoc();
						$current_password = $row["Password"];
						$entered_current_password = $_POST["current_password"];
						$new_password = $_POST["new_password"];
						$confirm_password = $_POST["confirm_password"];

						if ($entered_current_password === $current_password) {
							if ($new_password === $confirm_password) 
							{
								$update_sql = "UPDATE registration SET Password = '$new_password' WHERE Std_ID = '$std_id'";

								if ($conn->query($update_sql) === TRUE) 
								{
									echo "<p class='success-message'>Password updated successfully.</p>";
								} 
								else 
								{
									echo "<p class='error-message'>Error updating password.</p>";
								}
							} 
							else 
							{
								echo "<p class='error-message'>Passwords do not match.</p>";
							}
						} 
						else 
						{
							echo "<p class='error-message'>Incorrect current password.</p>";
						}
					} else {
						echo "<p class='error-message'>User not found.</p>";
					}
				} else {
					echo "<p class='error-message'>Session variable not set.</p>";
				}

				$conn->close();
			}
			?>

   
		   
        </div>
    </div>
</body>
</html>
