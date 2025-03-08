<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview Course Feedback</title>
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
            background-color:#BDD3D3;
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
	
        table {
            width: 90%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
		    background-color:#C7FFC9 ;		
            border-bottom: 1px solid #121212;
            border-top: 1px solid #121212;
            border-right: 1px solid #121212;
            border-left: 1px solid #121212;
        }

        th {
            background-color: #50C654;
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
                <li><a href="view_course_feedback_results.php"class="active">View Course Feedback Results</a></li>
                <li><a href="view_teacher_feedback_results.php">View Teacher Feedback Results</a></li>
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
                // Check if student_id and course_unit are set in the URL
                if (isset($_GET['student_id']) && isset($_GET['course_unit'])) {
                    $student_id = $_GET['student_id'];
                    $course_unit = $_GET['course_unit'];

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
            echo "<h2>Course Feedback Results</h2>";
            echo "<div class='info'>";
			            echo "<p><strong>Course Unit:</strong> $course_unit</p>";
            echo "</div>"; // Close info div
            echo "</div>";	
				
				
				                mysqli_close($conn);
            }
				?>
				
							
				
			<br><br>	
			<div class="scale-values">
				<span>-2: Strongly Disagree </span><br>
				<span>-1: Disagree</span><br>
				<span>0:   Not Sure</span><br>
				<span>+1: Agree</span><br>
				<span>+2: Strongly Agree</span><br>
				
			</div><br><br>
               <?php
                // Check if student_id and course_unit are set in the URL
                if (isset($_GET['student_id']) && isset($_GET['course_unit'])) {
                    $student_id = $_GET['student_id'];
                    $course_unit = $_GET['course_unit'];

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

                    // Prepare and execute SQL query
                    $sql = "SELECT * FROM c_questions WHERE st_id = '$student_id' AND course_unit = '$course_unit'";
                    $result = $conn->query($sql);

					// Check if query executed successfully
					if ($result === false) {
						echo "Error: " . $conn->error;
					} elseif ($result->num_rows > 0) {
						// Output table header
						echo "<table>";
						echo "<tr><th>Question Type</th><th>Questions</th><th>Response</th></tr>";

						// Define an array to map question numbers to their corresponding text
						$questions = array(
							"general_q1" => "This course helped me to enhance my knowledge",
							"general_q2" => "The workload of the course was manageable",
							"general_q3" => "The course was interesting",
							"materials_q1" => "Adequate Materials (handouts) were provided",
							"materials_q2" => "Handouts were easy to understand",
							"materials_q3" => "Enough reference books were used",
							"tutorials_examples_q1" => "Given problems (examples/tutorials/exercises) were enough",
							"tutorials_examples_q2" => "Given problems (examples/tutorials/exercises) were challenging",
							"lab_fieldwork_q1" => "I could relate what I learnt from lectures to lab/field classes",
							"lab_fieldwork_q2" => "Labs & Fieldwork helped to improve my skills and practical knowledge",
							"lab_fieldwork_q3" => "I can conduct experiments/fieldwork myself through a set of instructions in future",
							"about_myself_q1" => "I prepared thoroughly for each class",
							"about_myself_q2" => "I attended lectures, lab/fieldwork regularly",
							"about_myself_q3" => "I did all assigned work (homework/assignments/lab & field report) on time",
							"about_myself_q4" => "I referred recommended textbooks regularly",
							"comments" => "Any other comments?"
						);

						// Output data of each row
						foreach ($questions as $column => $question) {
							echo "<tr>";
							
							$question_type = ucfirst(str_replace("_", " ", explode("_", $column)[0]));
							
							echo "<td>$question_type</td>";
							
							echo "<td>$question</td>";
							
							$sql = "SELECT $column FROM c_questions WHERE st_id = '$student_id' AND course_unit = '$course_unit'";
							$response_result = $conn->query($sql);
							if ($response_result->num_rows > 0) {
								$response_row = $response_result->fetch_assoc();
								
								echo "<td>" . $response_row[$column] . "</td>";
							}
							echo "</tr>";
						}
						echo "</table>";
					} else {
						echo "<span style='color: red;'>No feedback results found for the selected student and course.";
					}



                    // Close connection
                    $conn->close();
                } 
				else {
                    echo "<span style='color: red;'>Error: Student ID or course unit not provided.";
                }
                ?>

            </div>
        </div>
    </div>
	

</body>
</html>