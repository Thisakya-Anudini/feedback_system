<?php
// Database connection details
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

// Handle delete all feedback action
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_all_feedback"])) {
    // SQL queries to delete data from the specified tables in order
    $queries = [
        "DELETE FROM t_questions",
        "DELETE FROM c_questions",
        "DELETE FROM coursefeedback",
        "DELETE FROM teacherfeedback",
        "DELETE FROM feedback"
    ];

    $success = true;
    foreach ($queries as $query) {
        if ($conn->query($query) === false) {
            $success = false;
            echo "Error: " . $conn->error;
            break;
        }
    }

    if ($success) {
        echo "<script>alert('All feedback data has been successfully deleted.');</script>";
    } else {
        echo "<script>alert('An error occurred while deleting feedback data.');</script>";
    }
}

// Close connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Analysis</title>
    <style>
       body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('admin.jpg'); /* Replace 'your-image.jpg' with the path to your image */
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        .container {
            display: flex;
            max-width: 100%;
            margin: 0px auto;
            background-image: url('admin.jpg'); /* Replace 'your-image.jpg' with the path to your image */
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
            transition: background-color 0.3s ease, color 0.3s ease; /* Added transition for color change */
        }
        .sidebar a:hover {
            background-color: #D4FAFA; /* Darker shade on hover */
            color: black; /* Change text color to black on hover */
        }
        .sidebar a.active {
            background-color: #3498db; /* Lighter shade when active */
            color: #fff; /* Text color remains white when active */
        }
        .content {
            flex: 1;
            padding: 20px;
            margin-left: 450px;
            overflow-y: auto;
        }
        .form-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 15px;
            margin-bottom: 50px;
		    margin-top: 30px;
			width: 400px;
        }
        .form-container h2 {
            margin-top: 5px;
            margin-bottom: 20px;
            color: #333;
        }
        .form-container label {
            display: block;
            margin-bottom: 0px;
            font-weight: bold;
        }
        .form-container select {
            width: 100%;
            padding: 2px;
            margin-bottom: 20px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }
        .form-container button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #F9B845;
            color: #black;
            border: none;
            border-radius: 4px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .form-container button:hover {
            background-color: #B6AD9C;
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
                <li><a href="view_students.php">View Students</a></li>
                <li><a href="view_course_feedback_results.php">View Course Feedback Results</a></li>
                <li><a href="view_teacher_feedback_results.php">View Teacher Feedback Results</a></li>
				<li><a href="analysis.php"class="active">Feedback Summary</a></li>
                <li><a href="index.html" class="logout">Logout</a></li>
            </ul>
        </div>
        <div class="content">
            <div class="form-container">
                <h2>Summarize Course Feedback</h2>
                <form action="course_analysis.php" method="get">
                    <label for="course_id">Select Course:</label>
                    <select id="course_id" name="course_id">
                        <?php
                        // Database connection
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "feedback_management_system_group16";
                        $conn = new mysqli($servername, $username, $password, $dbname);

                        // Check connection 
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        // SQL query to select course ID and name from course table
                        $sql = "SELECT Coursecode, Coursename FROM course";
                        $result = $conn->query($sql);

                        if ($result === false) {
                            echo "Error: " . $conn->error;
                        } elseif ($result->num_rows > 0) {
                       
                            while ($row = $result->fetch_assoc()) {
                             
                                echo "<option value='" . $row["Coursecode"] . "'>" . $row["Coursecode"] . " - " . $row["Coursename"] . "</option>";
                            }
                        } else {
                            echo "<option value=''>No courses available</option>";
                        }

                        // Close connection
                        $conn->close();
                        ?>
                    </select>
                    <button type="submit">Generate Summary</button>
                </form>
            </div>

            <div class="form-container">
                <h2>Summarize Teacher Feedback</h2>
                <form action="teacher_analysis.php" method="get">
                    <label for="teacher_id">Select Teacher:</label>
                    <select id="teacher_id" name="teacher_id">
                        <?php
                        // Database connection 
                        $conn = new mysqli($servername, $username, $password, $dbname);

                        // Check connection 
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        // SQL query to select teacher ID and name from teacher table
                        $sql = "SELECT TeacherID, Name FROM teacher";
                        $result = $conn->query($sql);

                        if ($result === false) {
                            echo "Error: " . $conn->error;
                        } elseif ($result->num_rows > 0) {
                
                            while ($row = $result->fetch_assoc()) {
                 
                                echo "<option value='" . $row["TeacherID"] . "'>" . $row["TeacherID"] . " - " . $row["Name"] . "</option>";
                            }
                        } else {
                            echo "<option value=''>No teachers available</option>";
                        }

                        // Close connection
                        $conn->close();
                        ?>
                    </select>
                    <label for="course_unit">Select Course:</label>
                    <select id="course_unit" name="course_unit">
                        <?php
                        // Database connection 
                        $conn = new mysqli($servername, $username, $password, $dbname);

                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        // SQL query to select course ID and name from course table
                        $sql = "SELECT Coursecode, Coursename FROM course";
                        $result = $conn->query($sql);

                        if ($result === false) {
                            echo "Error: " . $conn->error;
                        } elseif ($result->num_rows > 0) {
                         
                            while ($row = $result->fetch_assoc()) {
                      
                                echo "<option value='" . $row["Coursecode"] . "'>" . $row["Coursecode"] . " - " . $row["Coursename"] . "</option>";
                            }
                        } else {
                            echo "<option value=''>No courses available</option>";
                        }

                        // Close connection
                        $conn->close();
                        ?>
                    </select>
                    <button type="submit">Generate Summary</button>
                </form>
            </div>

            <div class="form-container">
                <h2>Delete All Feedback</h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return confirm('Are you sure you want to delete all feedback data?');">
                    <input type="hidden" name="delete_all_feedback" value="1">
                    <button type="submit">Delete All</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
