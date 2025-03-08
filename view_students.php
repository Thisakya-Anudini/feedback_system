<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Students</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('admin.jpg'); 
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        .container {
            display: flex;
            max-width: 100%;
            margin: 0px auto;
            background-image: url('admin.jpg'); 
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .sidebar {
            width: 300px;
            background-color: #2c3e50;
            color: #fff;
            padding: 20px;
            position: fixed;
            height: 100%;
        }
        .sidebar h2 {
            margin-top: 5px;
            margin-bottom: 20px;
            margin: 20px;
            font-size: 30px;
            color: #fff;
        }
        .sidebar ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        .sidebar li {
            margin-top: 50px;
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
        .sidebar a.active {
            background-color: #3498db;
            color: #fff;
        }
        .content {
            flex: 1;
            padding: 20px;
            margin-left: 400px;
            overflow-y: auto;
        }
        h1 {
            margin-top: 0;
        }

        .view-students-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 600px;
        }

        .view-students-container h2 {
            text-align: center;
        }

		
		table 
		{
			width: 600px;
			border-collapse: collapse;
			margin-top: 50px;
		}

		
		th, td 
		{
			padding: 15px;
			text-align: left;
			border-bottom: 2px solid #273746;
			border-right: 2px solid #273746; 
			border-left: 2px solid #273746;
		}

		
		th {
			background-color: #FFE26D ;
			border-right: 2px solid #273746; 
			border-left: 2px solid #273746;
			border-top: 2px solid #273746;
		}

		tr {
			background-color: #fff; 
		}
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <h2>Dashboard</h2>
            <ul>
                <li><a href="manage_courses.php">Manage Courses</a></li>
                <li><a href="manage_teachers.php">Manage Teachers</a></li>
                <li><a href="view_students.php" class="active">View Students</a></li>
                <li><a href="view_course_feedback_results.php">View Course Feedback Results</a></li>
				<li><a href="view_teacher_feedback_results.php">View Teacher Feedback Results</a></li>
				<li><a href="analysis.php">Feedback Summary</a></li>
				<li><a href="index.html" class="logout">Logout</a></li>
            </ul>
        </div>
        <div class="content">
            <div class="view-students-container">
                <h2> Registered Students</h2>
                <table>
                    <tr>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Department</th>
                    </tr>

                    <?php
                    // Establish database connection
                    $servername = 'localhost';
                    $username = 'root';
                    $password = '';
                    $dbname = 'feedback_management_system_group16';

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die('Connection failed: ' . $conn->connect_error);
                    }

                    // SQL query to join tables and fetch required data
                    $sql = "SELECT s.Std_ID, r.Name, r.Department
                            FROM student s
                            JOIN registration r ON s.Std_ID = r.Std_ID";

                    $result = $conn->query($sql);

                    if ($result && $result->num_rows > 0) {
                        // Output each row
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['Std_ID'] . "</td>";
                            echo "<td>" . $row['Name'] . "</td>";
                            echo "<td>" . $row['Department'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No students found</td></tr>"; 
                    }

                    $conn->close();
                    ?>

                </table>
            </div>
        </div>
    </div>
</body>
</html>
