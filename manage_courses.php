<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Courses</title>
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

       
        .manage-courses-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 400px;
        }

        .manage-courses-container h2 {
            margin-top: 0;
            text-align: center;
        }

        .manage-courses-container form {
            margin-bottom: 5px;
        }

        .manage-courses-container label {
            display: block;
            margin-bottom: 5px;
        }

        .manage-courses-container input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .manage-courses-container button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        .manage-courses-container button:hover {
            background-color: #45a049;
        }

      
        .success-message {
            color: #F08FFB;
            text-align: left;
            margin-bottom: 20px;
			font-size: 30px;
			
        }

		
		table 
		{
			width: 600px;
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
                <li><a href="manage_courses.php"class="active">Manage Courses</a></li>
                <li><a href="manage_teachers.php">Manage Teachers</a></li>
                <li><a href="view_students.php">View Students</a></li>
                <li><a href="view_course_feedback_results.php">View Course Feedback Results</a></li>
				<li><a href="view_teacher_feedback_results.php">View Teacher Feedback Results</a></li>
				<li><a href="analysis.php">Feedback Summary</a></li>
				<li><a href="index.html" class="logout">Logout</a></li>
            </ul>
        </div>
        <div class="content">
            <?php
            // Code to add or remove courses and display success messages

            // Add course
            if (isset($_POST['add_course'])) {
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
                $course_code = $_POST['course_code'];
                $course_name = $_POST['course_name'];
                $admin_id = $_POST['admin_id'];
                $teacher_id = $_POST['teacher_id'];

                // Insert data into database
                $sql = "INSERT INTO course (Coursecode, Coursename, AdminID, TeacherID) VALUES ('$course_code', '$course_name', '$admin_id', '$teacher_id')";

                if (mysqli_query($conn, $sql)) {
                    echo '<div class="success-message">Course added successfully</div>';
                } else {
                    echo '<div class="error-message" style="color: red;">Error: Teacher ID does not exist</div>';

                }

                mysqli_close($conn);
            }

            // Remove course
if (isset($_POST['remove_course'])) {
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
    
    // Retrieve course ID to remove
    $course_id_to_remove = $_POST['course_code_remove'];

    // SQL query to remove course
    $sql = "DELETE FROM course WHERE coursecode = '$course_id_to_remove'";

    if (mysqli_query($conn, $sql)) {
        echo '<div class="success-message">Course removed successfully</div>';
    } else {
        echo '<div class="error-message">Error occurred while removing course</div>';
    }

    mysqli_close($conn);
}
?>

            <div class="manage-courses-container">
                <h2>Add Course</h2>
                <form action="manage_courses.php" method="post">
                    <label for="course_code">Course Code:</label>
                    <input type="text" id="course_code" name="course_code" required>
                    
                    <label for="course_name">Course Name:</label>
                    <input type="text" id="course_name" name="course_name" required>
                    
                    <label for="admin_id">Admin ID:</label>
                    <input type="text" id="admin_id" name="admin_id" required>
                    
                    <label for="teacher_id">Teacher ID:</label>
                    <input type="text" id="teacher_id" name="teacher_id" required>
                    
                    <button type="submit" name="add_course">Add Course</button>
                </form>
                
                <hr>
                
<h2>Remove Course</h2>
<form action="manage_courses.php" method="post">
    <label for="course_code_remove">Course Code:</label>
    <input type="text" id="course_code_remove" name="course_code_remove" required>
    
    <button type="submit" name="remove_course">Remove Course</button>
</form>

            </div>

            <!-- Display table of courses -->
            <h2>Courses List</h2>
            <table>
                <thead>
                    <tr>
                        <th>Course Code</th>
                        <th>Course Name</th>
                        <th>Teacher ID</th>
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

                    // Fetch courses from the database
                    $sql = "SELECT Coursecode, Coursename, TeacherID FROM course";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        // Output data of each row
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['Coursecode'] . "</td>";
                            echo "<td>" . $row['Coursename'] . "</td>";
                            echo "<td>" . $row['TeacherID'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No courses found</td></tr>";
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
