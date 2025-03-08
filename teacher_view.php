<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Views Feedback</title>
    <style>
       body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('tdash.jpg'); 
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        .container {
            display: flex;
            max-width: 100%;
            margin: 0px auto;

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


                <li><a href="view_teacher_analysis.php"class="active">Teacher Feedback Summary</a></li>

                <li><a href="index.html" class="logout">Logout</a></li>
            </ul>
        </div>
 <div class="content">
            <div class="form-container">
                <h2>Summarize Teacher Feedback</h2>
<?php
                // Start the session to access session variables
                session_start();

                // Check if the teacher is logged in
                if (isset($_SESSION['teacher_id'])) {
                    // Get the logged-in teacher's ID
                    $logged_teacher_id = $_SESSION['teacher_id'];

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

                    // SQL query to fetch the name of the logged-in teacher
                    $teacher_query = "SELECT Name FROM teacher WHERE TeacherID = '$logged_teacher_id'";
                    $teacher_result = $conn->query($teacher_query);

                    if ($teacher_result->num_rows > 0) {
                        $teacher_row = $teacher_result->fetch_assoc();
                        $teacher_name = $teacher_row["Name"];
                    } else {
                        $teacher_name = "Teacher"; // Default name if no record found
                    }

                    // SQL query to fetch the courses of the logged-in teacher
                    $course_query = "SELECT Coursecode, Coursename FROM course WHERE TeacherID = '$logged_teacher_id'";
                    $course_result = $conn->query($course_query);
                    ?>
                    <select id="teacher_id" name="teacher_id" disabled>
                        <option value="<?php echo $logged_teacher_id; ?>"><?php echo $logged_teacher_id . " - " . $teacher_name; ?></option>
                    </select>

                    <select id="course_unit" name="course_unit">
                        <?php
                        if ($course_result->num_rows > 0) {
                            // Output data of each row
                            while ($row = $course_result->fetch_assoc()) {
                                // Display course code and name as options
                                echo "<option value='" . $row["Coursecode"] . "'>" . $row["Coursecode"] . " - " . $row["Coursename"] . "</option>";
                            }
                        } else {
                            echo "<option value=''>No courses available</option>";
                        }
                        ?>
                    </select>
                    <?php
                    // Close connection
                    $conn->close();
                }
                ?>

                <form action="view_teacher_analysis.php" method="get">
          
                    <input type="hidden" name="teacher_id" value="<?php echo $logged_teacher_id; ?>">
                    <input type="hidden" name="course_unit" id="selected_course_unit">
                    <button type="submit" onclick="setCourseUnit()">Generate Summary</button>
                </form>

                <script>
                    function setCourseUnit() {
                        var selectedCourseUnit = document.getElementById("course_unit").value;
                        document.getElementById("selected_course_unit").value = selectedCourseUnit;
                    }
                </script>
            </div>
        </div>
    </div>
</body>
</html>