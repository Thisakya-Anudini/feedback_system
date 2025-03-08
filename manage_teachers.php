<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Teachers</title>
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
            margin-left: 450px;
            overflow-y: auto;
        }
        h1 {
            margin-top: 0;
        }

        
        .manage-teachers-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 400px;
        }

        .manage-teachers-container h2 {
            margin-top: 0;
            text-align: center;
        }

        .manage-teachers-container form {
            margin-bottom: 5px;
        }

        .manage-teachers-container label {
            display: block;
            margin-bottom: 5px;
        }

        .manage-teachers-container input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .manage-teachers-container button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        .manage-teachers-container button:hover {
            background-color: #45a049;
        }

      
        .success-message {
            color: #F08FFB; 
            text-align: left;
            margin-bottom: 20px;
            font-size: 30px;
        }
		.error-message {
            color: #BB1111;
            text-align: left;
            margin-bottom: 20px;
            font-size: 40px;
        }

		
		table 
		{
			width: 500px;
			border-collapse: collapse;
			margin-bottom: 20px;
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
                <li><a href="manage_teachers.php" class="active">Manage Teachers</a></li>
                <li><a href="view_students.php">View Students</a></li>
                <li><a href="view_course_feedback_results.php">View Course Feedback Results</a></li>
				<li><a href="view_teacher_feedback_results.php">View Teacher Feedback Results</a></li>
				<li><a href="analysis.php">Feedback Summary</a></li>
				<li><a href="index.html" class="logout">Logout</a></li>
            </ul>
        </div>
        <div class="content">
            <?php
            // Code to add or remove teachers and display success messages

            // Add teacher
            if (isset($_POST['add_teacher'])) {
                // Establish connection to the database
                $servername = "localhost";
                $username = "root";
                $password = ""; 
                $dbname = "feedback_management_system_group16";

                $conn = mysqli_connect($servername, $username, $password, $dbname);

                // Check connection
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                // Retrieve form data
                $teacher_name = $_POST['teacher_name'];
                $teacher_id = $_POST['teacher_id'];
                $admin_id = $_POST['admin_id'];

                // Insert data into database
                $sql = "INSERT INTO teacher (TeacherID, Name, AdminID) VALUES ('$teacher_id', '$teacher_name', '$admin_id')";

                if (mysqli_query($conn, $sql)) {
                    echo '<div class="success-message">Teacher added successfully</div>';
                } else {
					echo '<div class="error-message" style="color: red;">Error: Teacher ID already exists</div>';

                }

                mysqli_close($conn);
            }

            // Remove teacher
            if (isset($_POST['remove_teacher'])) {
                // Establish connection to the database
                $servername = "localhost";
                $username = "root";
                $password = ""; 
                $dbname = "feedback_management_system_group16"; 

                $conn = mysqli_connect($servername, $username, $password, $dbname);

                // Check connection
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                // Retrieve teacher ID to remove
                $teacher_id_to_remove = $_POST['teacher_id'];

                // SQL query to remove teacher
                $sql = "DELETE FROM teacher WHERE TeacherID = '$teacher_id_to_remove'";

                if (mysqli_query($conn, $sql)) {
                    echo '<div class="success-message">Teacher removed successfully</div>';
                } else {
                    echo '<div class="error-message">Error occurred while removing teacher</div>';
                }

                mysqli_close($conn);
            }
            ?>

            <div class="manage-teachers-container">
                <h2>Add Teacher</h2>
                <form action="manage_teachers.php" method="post">
                    <label for="teacher_name">Teacher Name: (eg:JOHN K.T.)</label>
                    <input type="text" id="teacher_name" name="teacher_name" required>
                    
                    <label for="teacher_id">Teacher ID:</label>
                    <input type="text" id="teacher_id" name="teacher_id" required>
                    
                    <label for="admin_id">Admin ID:</label>
                    <input type="text" id="admin_id" name="admin_id" required>
                    
                    <button type="submit" name="add_teacher">Add Teacher</button>
                </form>
                
                <hr>
                
                <h2>Remove Teacher</h2>
                <form action="manage_teachers.php" method="post">
                    <label for="teacher_id_remove">Teacher ID:</label>
                    <input type="text" id="teacher_id_remove" name="teacher_id" required>
                    
                    <button type="submit" name="remove_teacher">Remove Teacher</button>
                </form>
            </div>

            <!-- Display table of teachers -->
            <h2 style="color: #black;">Teachers List</h2>

            <table>
                <thead>
                    <tr>
                        <th>Teacher ID</th>
                        <th>Teacher Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Establish connection to the database
                    $servername = "localhost";
                    $username = "root"; 
                    $password = ""; 
                    $dbname = "feedback_management_system_group16"; 

                    $conn = mysqli_connect($servername, $username, $password, $dbname);

                    // Check connection
                    if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                    }

                    // Fetch teachers from the database
                    $sql = "SELECT TeacherID, Name FROM teacher";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        // Output data of each row
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['TeacherID'] . "</td>";
                            echo "<td>" . $row['Name'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='2'>No teachers found</td></tr>";
                    }

                    // Close connection
                    mysqli_close($conn);
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
