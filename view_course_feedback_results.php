<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Course Feedback Results</title>
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
            background-attachment: fixed;
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

        .feedback-results-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 800px;
        }

        .feedback-results-container h2 {
            margin-top: 0;
            text-align: center;
        }

         table {
            width: 90%;
            border-collapse: collapse;
            margin-top: 50px;
        }

        th, td {
            padding: 10px;
            text-align: left;
		    background-color:#FBEEE0 ;		
            border-bottom: 1px solid #121212;
            border-top: 1px solid #121212;
            border-right: 1px solid #121212;
            border-left: 1px solid #121212;
        }

        th {
            background-color: #C89B6B;
            border-right: 1px solid #121212;
        }

        td:last-child {
            border-right: 1px solid #121212;
        }

        td input {
            width: 90%;
            box-sizing: border-box;
            padding: 5px;
        }

        .feedback-link {
            text-decoration: underline;
            color: #528EF7;
            cursor: pointer;
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
                <li><a href="view_course_feedback_results.php"class="active">View Course Feedback Results</a></li>
                <li><a href="view_teacher_feedback_results.php">View Teacher Feedback Results</a></li>
				<li><a href="analysis.php">Feedback Summary</a></li>
                <li><a href="index.html" class="logout">Logout</a></li>
            </ul>
        </div>
        <div class="content">
            <div class="feedback-results-container">
                <h2>Course Feedback Results</h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <label for="course_unit">Course Unit:</label>
                    <select id="course_unit" name="course_unit">
					
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

						// Initialize selected option variable
						$selected = '';

						if (isset($_POST["course_unit"])) {

							$selected_course = $_POST["course_unit"];
						}
						
                     // SQL query to select available courses with course code and course name
						$sql = "SELECT coursecode, coursename FROM course";
						$result = $conn->query($sql);

						// Check if query executed successfully
						if ($result === false) {
							echo "Error: " . $conn->error;
						} elseif ($result->num_rows > 0) {
							// Output data of each row
							while ($row = $result->fetch_assoc()) {
								// Check if the current course matches the selected course
								if (isset($selected_course) && $row["coursecode"] == $selected_course) {

									$selected = 'selected';
								} else {

									$selected = '';
								}

								// Display both course code and course name as option values
								echo "<option value='" . $row["coursecode"] . "' $selected>" . $row["coursecode"] . " - " . $row["coursename"] . "</option>";
							}
						} else {
							echo "<option value=''>No courses available</option>";
						}

						// Close connection
						$conn->close();
					?>
                    </select>
                    <button type="submit">View Feedback Results</button>
                </form>

                <!-- Feedback results table -->
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

                // Check if course_unit is set in the $_POST array
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["course_unit"])) {
                    // Get selected course ID
                    $selected_course_id = $_POST["course_unit"];

                    // Validate if a course is selected
                    if (!empty($selected_course_id)) {
                        // SQL to select feedback results for the selected course
                        $sql = "SELECT cq.st_id AS Std_ID, cq.date
                                FROM c_questions cq
                                WHERE cq.course_unit = '$selected_course_id'";

                        $result = $conn->query($sql);

                        if ($result === false) {
                            echo "Error: " . $conn->error;
                        } elseif ($result->num_rows > 0) {
                            echo "<div class='feedback-results'>";
                            echo "<table>";
                            echo "<tr><th>Student ID</th><th>Feedback Forms</th><th>Submitted Date and Time</th></tr>";
                            // Output data of each row
                            while($row = $result->fetch_assoc()) {
                                $student_id = $row["Std_ID"];
                                $date = date("Y-m-d H:i:s", strtotime($row["date"]));

                                // Assuming each row represents a feedback form submission, count the number of feedback forms
                                $feedback_forms = 1;

                                // Generate link for feedback form preview
                                $feedback_link = "preview_course_feedback.php?student_id=$student_id&course_unit=$selected_course_id";

                                // Output feedback results with link
                                echo "<tr>";
                                echo "<td>$student_id</td>";
                                echo "<td><span class='feedback-link'><a href='$feedback_link'>Preview Form</a></span></td>";
                                echo "<td>$date</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                            echo "</div>";
                        } else {
                            echo "No feedback results found for the selected course.";
                        }
                    } else {
                        echo "Please select a course.";
                    }
                }

                // Close connection
                $conn->close();
                ?>
            </div>
        </div>
    </div>
</body>
</html>

