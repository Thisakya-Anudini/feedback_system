<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Teacher Feedback Results</title>
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
		    background-color:#FBEEE0   ;		
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
                <li><a href="view_course_feedback_results.php">View Course Feedback Results</a></li>
                <li><a href="view_teacher_feedback_results.php" class="active">View Teacher Feedback Results</a></li>
                <li><a href="analysis.php">Feedback Summary</a></li>
                <li><a href="index.html" class="logout">Logout</a></li>
            </ul>
        </div>
        <div class="content">
            <div class="feedback-results-container">
                <h2>Teacher Feedback Results</h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <label for="teacher_id">Select Teacher:</label>
                    <select id="teacher_id" name="teacher_id" onchange="this.form.submit()">
                        <option value="">Select a Teacher</option>
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

                        // SQL query to select teacher ID and name from teacher table
                        $sql = "SELECT TeacherID, Name FROM teacher";
                        $result = $conn->query($sql);

                        if ($result === false) {
                            echo "Error: " . $conn->error;
                        } elseif ($result->num_rows > 0) {
                            // Output data of each row
                            while ($row = $result->fetch_assoc()) {
                                $selected = (isset($_POST["teacher_id"]) && $_POST["teacher_id"] == $row["TeacherID"]) ? "selected" : "";
                                // Display teacher ID and name as options
                                echo "<option value='" . $row["TeacherID"] . "' $selected>" . $row["TeacherID"] . " - " . $row["Name"] . "</option>";
                            }
                        } else {
                            echo "<option value=''>No teachers available</option>";
                        }

                        // Close connection
                        $conn->close();
                        ?>
                    </select>
                </form>

                <?php if (isset($_POST["teacher_id"]) && !empty($_POST["teacher_id"])): ?>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <input type="hidden" name="teacher_id" value="<?php echo $_POST["teacher_id"]; ?>">
                        <label for="course_unit">Select Course:</label>
                        <select id="course_unit" name="course_unit">
                            <option value="">Select a Course</option>
                            <?php
                            // Database connection
                            $conn = new mysqli($servername, $username, $password, $dbname);

                            // Check connection
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            // SQL query to select courses associated with the selected teacher
                            $sql = "SELECT Coursecode, Coursename FROM course WHERE TeacherID = ?";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("i", $_POST["teacher_id"]);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            if ($result === false) {
                                echo "Error: " . $conn->error;
                            } elseif ($result->num_rows > 0) {
                                // Output data of each row
                                while ($row = $result->fetch_assoc()) {
                                    $selected = (isset($_POST["course_unit"]) && $_POST["course_unit"] == $row["Coursecode"]) ? "selected" : "";
                                    // Display course code and name as options
                                    echo "<option value='" . $row["Coursecode"] . "' $selected>" . $row["Coursename"] . "</option>";
                                }
                            } else {
                                echo "<option value=''>No courses available for this teacher</option>";
                            }

                            // Close connection
                            $conn->close();
                            ?>
                        </select>
                        <button type="submit">View Feedback Results</button>
                    </form>
                <?php endif; ?>

                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["teacher_id"]) && isset($_POST["course_unit"])) {
                    // Get selected teacher ID
                    $selected_teacher_id = $_POST["teacher_id"];
                    $selected_course_unit = $_POST["course_unit"];

                    // Database connection
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // SQL query to get teacher name based on the selected teacher ID
                    $teacher_sql = "SELECT Name FROM teacher WHERE TeacherID = ?";
                    $stmt = $conn->prepare($teacher_sql);
                    $stmt->bind_param("i", $selected_teacher_id);
                    $stmt->execute();
                    $teacher_result = $stmt->get_result();

                    if ($teacher_result->num_rows > 0) {
                        $teacher_row = $teacher_result->fetch_assoc();
                        $selected_teacher_name = $teacher_row["Name"];
                    } else {
                        echo "Teacher not found.";
                        $conn->close();
                        exit;
                    }

                    // SQL query to select feedback results for the selected teacher and course
                    $sql = "SELECT tq.st_id AS Std_ID, tq.date
                            FROM t_questions tq
                            INNER JOIN course c ON tq.course_unit = c.Coursecode
                            INNER JOIN teacher t ON tq.teacher_name = t.Name
                            WHERE t.TeacherID = ?
                            AND c.Coursecode = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("is", $selected_teacher_id, $selected_course_unit);
                    $stmt->execute();
                    $result = $stmt->get_result();

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

                            // Generate link for feedback form preview
                            $feedback_link = "preview_teacher_feedback.php?student_id=$student_id&teacher_name=" . urlencode($selected_teacher_name) . "&course_unit=" . urlencode($selected_course_unit);

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
                        echo "<span style='color: #F68423;'>No feedback available.</span>";
                    }

                    // Close connection
                    $conn->close();
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
