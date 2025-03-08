<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview Teacher Feedback</title>
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
            background-color: #BDD3D3;
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

        h2 {
            color: #B20C0C
        }

        table {
            width: 90%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
			background-color:#C7FFC9 ;
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #121212;
            border-top: 1px solid #121212;
            border-right: 1px solid #121212;
            border-left: 1px solid #121212;
        }

        th {
            background-color: #50C654   
 
 
 ;
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
		.back-button {
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .back-button button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .back-button button:hover {
            background-color: #2980b9;
        }
		       .info {
            color: #black;
			font-size: 20px
        }
        .box h2 {
            color: #B20C0C;
            margin-top: 0;
			font-size: 35px;
        }
    </style>
	
	<script>
        function goBack() {
            window.history.back();
        }
    </script>
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
	        <div class="back-button">
            <button onclick="goBack()">Back</button>
			</div>
	
	
        <div class="feedback-results-container">
			<?php
			// Check if student_id, teacher_name, and course_unit are set in the URL
			if (isset($_GET['student_id']) && isset($_GET['teacher_name']) && isset($_GET['course_unit'])) {
				$student_id = $_GET['student_id'];
				$teacher_name = $_GET['teacher_name'];
				$course_unit = $_GET['course_unit'];

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
		
						// Output topic,  course unit
			echo "<div class='box'>";
            echo "<h2>Teacher Feedback Results</h2>";
            echo "<div class='info'>";

            echo "<p><strong>Teacher Name:</strong> $teacher_name</p>";
            echo "<p><strong>Course Unit:</strong> $course_unit</p>";
            echo "</div>"; // Close info div
            echo "</div>"; // Close box	
				
				
				                mysqli_close($conn);
            }
				?>
		
				
			<br><br	
            <div class="scale-values">
                <span>-2: Strongly Disagree </span><br>
                <span>-1: Disagree</span><br>
                <span>0: Not Sure</span><br>
                <span>+1: Agree</span><br>
                <span>+2: Strongly Agree</span><br>
            </div><br><br>
<?php
// Check if student_id, teacher_name, and course_unit are set in the URL
if (isset($_GET['student_id']) && isset($_GET['teacher_name']) && isset($_GET['course_unit'])) {
    $student_id = $_GET['student_id'];
    $teacher_name = $_GET['teacher_name'];
    $course_unit = $_GET['course_unit'];

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

    // Prepare and execute SQL query to get feedback from t_questions table
    $sql = "SELECT * FROM t_questions WHERE st_id = '$student_id' AND teacher_name = '$teacher_name' AND course_unit = '$course_unit'";
    $result = $conn->query($sql);

    // Check if query executed successfully
    if ($result === false) {
        echo "Error executing SQL query: " . $conn->error;
    } elseif ($result->num_rows > 0) {
        // Output table header
        echo "<table>";
        echo "<tr><th>Question Type</th><th>Questions</th><th>Response</th></tr>";

        // Define an array to map question numbers to their corresponding text
        $questions = array(
            "time_management_q1" => "Lectures/Labs/Fieldworks started and finished on time.",
            "time_management_q2" => "The lecturer managed class time effectively.",
            "time_management_q3" => "The lecturer was readily available for consultation with students.",
            "delivery_method_q1" => "The lecturer used effective teaching aids (like multimedia and whiteboards).",
            "delivery_method_q2" => "Lectures were easy to understand.",
            "delivery_method_q3" => "The lecturer encouraged students to participate in discussions.",
            "subject_command_q1" => "The lecturer focused on syllabi.",
            "subject_command_q2" => "The lecturer was self-confident in subject and teaching.",
            "subject_command_q3" => "The lecturer linked real-world applications and created interest in the subject.",
            "subject_command_q4" => "The lecturer updated with the latest developments in the field.",
            "about_myself_q1" => "I asked questions from the lecturer in class.",
            "about_myself_q2" => "I consulted with the lecturer after lecture hours.",
            "comments" => "Any other comments?"
        );

        // Fetch the responses for the student, teacher, and course unit
        $feedback = $result->fetch_assoc();

        // Output data of each row
        foreach ($questions as $column => $question) {
            echo "<tr>";
           
            $question_type = ucfirst(str_replace("_", " ", explode("_", $column)[0]));
           
            echo "<td>$question_type</td>";
        
            echo "<td>$question</td>";
          
            echo "<td>" . $feedback[$column] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No feedback results found for the selected student, teacher, and course unit.";
    }
                // Close connection
                $conn->close();
            } else {
                echo "Error: Student ID or teacher name not provided.";
            }
            ?>
        </div>
    </div>
</div>
</body>
</html>
