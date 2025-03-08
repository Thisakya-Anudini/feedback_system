<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('stu.png'); 
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        .container {
            display: flex;
            max-width: 100%;
            margin: 0px auto;
            background-color:#F4D03F;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .sidebar {
            width: 280px;
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
        }
        h1 {
            margin-top: 0;
			color:#922B21;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <h2>Dashboard</h2>
            <ul>
                <li><a href="course_feedback.php">Give Course Feedback</a></li>
				<li><a href="teacher_feedback.php">Give Teacher Feedback</a></li>
				<li><a href="reset_password.php">Reset Password</a></li>
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

            // Get student's name based on their username (Std_ID)
            session_start();
            $std_id = $_SESSION['std_id']; // Assuming the student's username is stored in the session
            $sql = "SELECT Name FROM registration WHERE Std_ID = '$std_id'";
            $result = $conn->query($sql);

            // Check if a record is found
            if ($result->num_rows > 0) {
                // Output data of the first row
                $row = $result->fetch_assoc();
                $student_name = $row["Name"];
            } else {
                $student_name = "Student"; // Default name if no record found
            }

            $conn->close();
            ?>

            <!-- Use the fetched student's name in the HTML -->
            <h1>Welcome,    <?php echo $student_name; ?></h1>
            <p>This is your student dashboard. Use the menu on the left to navigate.</p>
        </div>
    </div>
</body>
</html>
