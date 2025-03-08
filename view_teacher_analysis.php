<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher views Feedback Summary</title>
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
			    .scale {
            max-width: 800px;
            margin-bottom: 20px;
			
        }
        .content {
            flex: 1;
            padding: 20px;
            margin-left: 400px;
            overflow-y: auto;
        }
        .form-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 15px;
            margin-bottom: 50px;
            margin-top: 30px;
            width: 100px;
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
            color: black;
            border: none;
            border-radius: 4px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .form-container button:hover {
            background-color: #B6AD9C;
        }
        table {
            width: 78%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            background-color: #C7FFC9;
            border: 1px solid #121212;
        }
        th {
            background-color: #50C654;
        }
        .back-button {
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .back-button button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #F0EC67;
            color: #000000;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .back-button button:hover {
            background-color: #ED9408;
        }
		.comments-container {
			width: 75%;
            margin-top: 30px;
            background-color: #86867D;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 15px;
        }
        .comments-container h3 {
			font-size: 20px;
            margin-top: 0;
            color: #000000;
        }
		 .comments-container ul {
            list-style-type: disc;
            padding-left: 20px;
        }
		.comment_containetli {
            margin-top: 50px;
            margin-bottom: 50px;
        }
        .comment {
           
            margin-bottom: 30px; 
            padding: 10px;
            border-bottom: 1px solid #ddd;
            background-color: #f9f9f9;
            border-radius: 5px;
        }

        .info {
            color: #black;
			font-size: 20px;
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

                <li><a href="teacher_view.php"class="active"> Teacher Feedback Summary</a></li>

                <li><a href="index.html" class="logout">Logout</a></li>
            </ul>
        </div>
        <div class="content">
            <div class="back-button">
                <button onclick="goBack()">Back</button>
            </div>
            <div class="summary-container">
			 <?php
			// Check if teacher ID and course unit are set in the URL
			if (isset($_GET['teacher_id']) && isset($_GET['course_unit'])) {
				$teacher_id = $_GET['teacher_id'];
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

				// Fetch teacher's name based on teacher_id from teacher table
				$sql_teacher_name = "SELECT Name FROM teacher WHERE TeacherID = ?";
				$stmt_teacher_name = $conn->prepare($sql_teacher_name);
				$stmt_teacher_name->bind_param("i", $teacher_id);
				$stmt_teacher_name->execute();
				$result_teacher_name = $stmt_teacher_name->get_result();

				if ($result_teacher_name->num_rows > 0) {
					$teacher_row = $result_teacher_name->fetch_assoc();
					$teacher_name = $teacher_row['Name'];
				} else {
					echo "Error: Teacher not found.";
					exit;
				}
			// Output topic, teacher's name, teacher ID, and course unit
			echo "<div class='box'>";
						echo "<h2>Teacher Feedback Summary</h2>";
						echo "<div class='info'>";
						echo "<p><strong>Teacher ID:</strong> $teacher_id</p>";
						echo "<p><strong>Teacher Name:</strong> $teacher_name</p>";
						echo "<p><strong>Course Unit:</strong> $course_unit</p>";
						echo "</div>"; 
						echo "</div>";
?>
						<br><br>
			 <img src="scale.png" alt="scale" class="scale">							
<br><br>

<?php

						
				// Prepare and execute SQL query to fetch average responses for the selected teacher and course
				$sql = "SELECT AVG(time_management_q1) AS avg_time_management_q1, AVG(time_management_q2) AS avg_time_management_q2, AVG(time_management_q3) AS avg_time_management_q3, 
						AVG(delivery_method_q1) AS avg_delivery_method_q1, AVG(delivery_method_q2) AS avg_delivery_method_q2, AVG(delivery_method_q3) AS avg_delivery_method_q3,
						AVG(subject_command_q1) AS avg_subject_command_q1, AVG(subject_command_q2) AS avg_subject_command_q2, AVG(subject_command_q3) AS avg_subject_command_q3,
						AVG(subject_command_q4) AS avg_subject_command_q4,
						AVG(about_myself_q1) AS avg_about_myself_q1, AVG(about_myself_q2) AS avg_about_myself_q2
						FROM t_questions
						WHERE teacher_name = ? AND course_unit = ?";
				$stmt = $conn->prepare($sql);

				if ($stmt === false) {
					die("Error in preparing SQL statement: " . $conn->error);
				}

				$bind_result = $stmt->bind_param("ss", $teacher_name, $course_unit);

				if ($bind_result === false) {
					die("Error in binding parameters: " . $stmt->error);
				}

				$execute_result = $stmt->execute();

				if ($execute_result === false) {
					die("Error in executing SQL statement: " . $stmt->error);
				}

				$result = $stmt->get_result();

				if ($result === false) {
					echo "Error in fetching result: " . $stmt->error;
				} else {
					// Fetch the result as an associative array
					$row = $result->fetch_assoc();

					// Output table header
					echo "<table>";
					echo "<tr><th>Question Type</th><th>Question</th><th>Average Response</th></tr>";

					// Define an array to map question types to their corresponding text
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
						"about_myself_q2" => "I consulted with the lecturer after lecture hours."
					);

					// Output data of each row
					foreach ($questions as $key => $text) {
						echo "<tr>";
						echo "<td>" . ucfirst(explode("_", $key)[1]) . "</td>";
						echo "<td>" . $text . "</td>";
						if (isset($row["avg_" . $key])) {
							echo "<td>" . round($row["avg_" . $key], 2) . "</td>";
						} else {
							echo "<td>No data available</td>";
						}
						echo "</tr>";
					}
					echo "</table>";
				}

				// Prepare and execute SQL query to fetch comments for the selected teacher and course
				$sql_comments = "SELECT comments FROM t_questions WHERE teacher_name = ? AND course_unit = ? AND comments IS NOT NULL";
				$stmt_comments = $conn->prepare($sql_comments);
				if ($stmt_comments === false) {
					die("Error in preparing SQL query for comments: " . $conn->error);
				}

				$bind_comments = $stmt_comments->bind_param("ss", $teacher_name, $course_unit);
				if ($bind_comments === false) {
					die("Error in binding parameters for comments: " . $stmt_comments->error);
				}

				$execute_comments = $stmt_comments->execute();
				if ($execute_comments === false) {
					die("Error in executing SQL statement for comments: " . $stmt_comments->error);
				}

				$result_comments = $stmt_comments->get_result();

				if ($result_comments === false) {
					echo "Error in fetching result for comments: " . $stmt_comments->error;
				} else {
					echo "<div class='comments-container'>";
					echo "<h3>Comments</h3>";
					if ($result_comments->num_rows > 0) {
						// Output comments in a list
						echo "<ul>";
						while ($comment_row = $result_comments->fetch_assoc()) {
							echo "<li class='comment'>" . htmlspecialchars($comment_row['comments']) . "</li>";
						}
						echo "</ul>";
					} else {
						echo "<p>No comments available.</p>";
					}
					echo "</div>";
				}

				// Close statement
				$stmt->close();

				// Close connection
				$conn->close();
			} else {
				echo "Error: Teacher ID or course unit not provided.";
			}
			?>




            </div>
        </div>
    </div>
</body>
</html>
