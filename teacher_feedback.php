<?php	
		// Database connection
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
		
session_start();
$std_id = $_SESSION['std_id'];
// Check if the session variable is set
$std_id = isset($_SESSION['std_id']) ? $_SESSION['std_id'] : null;

// Check if $_SESSION['std_id'] is set and not null before using it
if ($std_id !== null) {
    // Your existing code here that uses $std_id
} else {
    // Handle the case when $_SESSION['std_id'] is not set or null
    echo "Session variable std_id is not set.";
}

// Rest of your code...
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Feedback</title>
 <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
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
            width: 260px;
            background-color: #2c3e50;
            color: #fff;
            padding: 20px;
            position: fixed;
            height: 100%;
        }
        .sidebar h2 {
            margin-top: 20px;
            margin-bottom: 30px;
            font-size: 30px;
            color: #fff;
            display: flex;
            margin-left: 20px;
        }
        .sidebar ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        .sidebar li {
            margin-top: 70px;
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


        .content {
            flex: 1;
            padding: 50px;
            margin-left: 350px;
            overflow-y: auto;
        }
        h1 {
            margin-top: 0;
			color:#922B21;
        }
        .scale-buttons {
            text-align: right;
        }
        .scale-buttons button {
            background-color: #f0f0f0;
            color: #000;
            padding: 1px; 
            margin: 0px;
            width: 30px;
            height: 30px; 
            border: 1px solid #AEAEAE;
            cursor: pointer;
            transition: background-color 0.3s ease;
            vertical-align: top; 
        }
        .scale-buttons button.selected {
            background-color: blue;
            color: white;
        }
        .form-container {
            max-height: none;
            overflow-y: auto;
        }
        
        #comments {
            margin-top: 1px;
        }
        #comments-box {
            margin-top: 10px; 
        }
        form label {
            display: block;
            text-align: left; 
        }
		#date 
		{
		width: 250px; 
		}
		#course_unit {
		width: 250px;
		}
		#teacher_name 
		{
		width: 350px;
				}
		.feedback-success {
				color: blue;
				margin-bottom: 60px; 
			}

    </style>

	</head>
		<body>
			<div class="container">
				<div class="sidebar">
					<h2>Dashboard</h2>
					<ul>
						<li><a href="course_feedback.php">Provide Course Feedback</a></li>
						<li><a href="teacher_feedback.php"class="active">Provide Teacher Feedback</a></li>
						<li><a href="reset_password.php">Reset Password</a></li>
						<!-- Logout button with the "logout" class -->
						<li><a href="index.html" class="logout">Logout</a></li>
					</ul>
				</div>
				<div class="content">
 
			<div class="form-container">
				 <h1>Teacher Evaluation Feedback</h1>
				<form id="courseEvaluationForm" class="feedback-form" action="teacher_feedback.php" method="post">
						<p>This questionnaire intends to collect feedback from the students about the Lecturer. Your valuable feedback will be vital for us to strengthen the teaching-learning environment to achieve excellence in teaching and learning.</p>

						<label for="teacher_name">Teacher's Name:</label>
						<select id="teacher_name" name="teacher_name" required>
							<?php
								// Database connection
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
									// Fetching teacher names from the database
									$sql_teachers = "SELECT name FROM teacher"; 
									$result_teachers = $conn->query($sql_teachers);

									if (!$result_teachers) {
										// Handle query error
										echo "Error: " . $conn->error;
									} else {
										
										// Check if there are any teachers available
										if ($result_teachers->num_rows > 0) {
											// Loop through each teacher and display their names as options in the dropdown
											while ($row = $result_teachers->fetch_assoc()) {
													echo '<option value="' . $row['name'] . '">' . $row['name'] . '</option>';
}
										} else {
											echo '<option value="" disabled>No teachers available</option>';
										}
									}
						    ?>
						</select>

						<label for="course_unit">Course Unit:</label>
						
							
						
						<?php
						


						// Fetching course data
						$sql_courses = "SELECT name FROM course";
						$sql_courses = "SELECT coursecode, coursename FROM course";
						$result_courses = $conn->query($sql_courses);

						if (!$result_courses) {
							// Handle query error
							echo "Error: " . $conn->error;
						} else {
							// Check if there are any courses available
							if ($result_courses->num_rows > 0) {
								echo '<select id="course_unit" name="course_unit" required>';
								while ($row = $result_courses->fetch_assoc()) {
									echo '<option value="' . $row['coursecode'] . '">' . $row['coursecode'] . ' - ' . $row['coursename'] . '</option>';
								}
								echo '</select>';
							} else {
								echo "No courses available.";
							}
						}
						
						?>
						<br><br>

							<label for="date">Date:</label>
							<input type="date" id="date" name="date" required><br><br>
							
							<p>Please respond to the following statements by marking on the scale next to each statement . The scale 1 to 5 refers to the following.</p>
			<br><br>	
			<div class="scale-values">
				<span>-2: Strongly Disagree </span><br>
				<span>-1: Disagree</span><br>
				<span>0:   Not Sure</span><br>
				<span>+1: Agree</span><br>
				<span>+2: Strongly Agree</span><br>
				
			</div><br><br>


						<h3>A. Time Management</h3>
						<div class="scale-buttons">
							<label>i. Lectures/Labs/Fieldworks started and finished on time.</label>
							<button type="button" onclick="selectButton(this)" name="time_management_q1" value="-2">-2</button>
							<button type="button" onclick="selectButton(this)" name="time_management_q1" value="-1">-1</button>
							<button type="button" onclick="selectButton(this)" name="time_management_q1" value="0">0</button>
							<button type="button" onclick="selectButton(this)" name="time_management_q1" value="+1">+1</button>
							<button type="button" onclick="selectButton(this)" name="time_management_q1" value="+2">+2</button><br>

							<label>ii. The lecturer managed class time effectively.</label>
							<button type="button" onclick="selectButton(this)" name="time_management_q2" value="-2">-2</button>
							<button type="button" onclick="selectButton(this)" name="time_management_q2" value="-1">-1</button>
							<button type="button" onclick="selectButton(this)" name="time_management_q2" value="0">0</button>
							<button type="button" onclick="selectButton(this)" name="time_management_q2" value="+1">+1</button>
							<button type="button" onclick="selectButton(this)" name="time_management_q2" value="+2">+2</button><br>

							<label>iii. The lecturer was readily available for consultation with students.</label>
							<button type="button" onclick="selectButton(this)" name="time_management_q3" value="-2">-2</button>
							<button type="button" onclick="selectButton(this)" name="time_management_q3" value="-1">-1</button>
							<button type="button" onclick="selectButton(this)" name="time_management_q3" value="0">0</button>
							<button type="button" onclick="selectButton(this)" name="time_management_q3" value="+1">+1</button>
							<button type="button" onclick="selectButton(this)" name="time_management_q3" value="+2">+2</button><br>
						</div>

						<h3>B. Delivery Method</h3>
						<div class="scale-buttons">
							<label>i. The lecturer used effective teaching aids (like multimedia and whiteboards).</label>
							<button type="button" onclick="selectButton(this)" name="delivery_method_q1" value="-2">-2</button>
							<button type="button" onclick="selectButton(this)" name="delivery_method_q1" value="-1">-1</button>
							<button type="button" onclick="selectButton(this)" name="delivery_method_q1" value="0">0</button>
							<button type="button" onclick="selectButton(this)" name="delivery_method_q1" value="+1">+1</button>
							<button type="button" onclick="selectButton(this)" name="delivery_method_q1" value="+2">+2</button><br>

							<label>ii. Lectures were easy to understand.</label>
							<button type="button" onclick="selectButton(this)" name="delivery_method_q2" value="-2">-2</button>
							<button type="button" onclick="selectButton(this)" name="delivery_method_q2" value="-1">-1</button>
							<button type="button" onclick="selectButton(this)" name="delivery_method_q2" value="0">0</button>
							<button type="button" onclick="selectButton(this)" name="delivery_method_q2" value="+1">+1</button>
							<button type="button" onclick="selectButton(this)" name="delivery_method_q2" value="+2">+2</button><br>
							
							<label>iii. The lecturer encouraged students to participate in discussions.</label>
							<button type="button" onclick="selectButton(this)" name="delivery_method_q3" value="-2">-2</button>
							<button type="button" onclick="selectButton(this)" name="delivery_method_q3" value="-1">-1</button>
							<button type="button" onclick="selectButton(this)" name="delivery_method_q3" value="0">0</button>
							<button type="button" onclick="selectButton(this)" name="delivery_method_q3" value="+1">+1</button>
							<button type="button" onclick="selectButton(this)" name="delivery_method_q3" value="+2">+2</button><br>
						</div>

						<h3>C. Subject Command</h3>
						<div class="scale-buttons">
							<label>i. The lecturer focused on syllabi.</label>
							<button type="button" onclick="selectButton(this)" name="subject_command_q1" value="-2">-2</button>
							<button type="button" onclick="selectButton(this)" name="subject_command_q1" value="-1">-1</button>
							<button type="button" onclick="selectButton(this)" name="subject_command_q1" value="0">0</button>
							<button type="button" onclick="selectButton(this)" name="subject_command_q1" value="+1">+1</button>
							<button type="button" onclick="selectButton(this)" name="subject_command_q1" value="+2">+2</button><br>
							
							<label>ii. The lecturer was self-confident in subject and teaching.</label>
							<button type="button" onclick="selectButton(this)" name="subject_command_q2" value="-2">-2</button>
							<button type="button" onclick="selectButton(this)" name="subject_command_q2" value="-1">-1</button>
							<button type="button" onclick="selectButton(this)" name="subject_command_q2" value="0">0</button>
							<button type="button" onclick="selectButton(this)" name="subject_command_q2" value="+1">+1</button>
							<button type="button" onclick="selectButton(this)" name="subject_command_q2" value="+2">+2</button><br>
							
							<label>iii. The lecturer linked real-world applications and created interest in the subject.</label>
							<button type="button" onclick="selectButton(this)" name="subject_command_q3" value="-2">-2</button>
							<button type="button" onclick="selectButton(this)" name="subject_command_q3" value="-1">-1</button>
							<button type="button" onclick="selectButton(this)" name="subject_command_q3" value="0">0</button>
							<button type="button" onclick="selectButton(this)" name="subject_command_q3" value="+1">+1</button>
							<button type="button" onclick="selectButton(this)" name="subject_command_q3" value="+2">+2</button><br>
							
							<label>iv. The lecturer updated with the latest developments in the field.</label>
							<button type="button" onclick="selectButton(this)" name="subject_command_q4" value="-2">-2</button>
							<button type="button" onclick="selectButton(this)" name="subject_command_q4" value="-1">-1</button>
							<button type="button" onclick="selectButton(this)" name="subject_command_q4" value="0">0</button>
							<button type="button" onclick="selectButton(this)" name="subject_command_q4" value="+1">+1</button>
							<button type="button" onclick="selectButton(this)" name="subject_command_q4" value="+2">+2</button><br>
						</div>

						<h3>D. About Myself</h3>
						<div class="scale-buttons">
							<label>i. I asked questions from the lecturer in class.</label>
							<button type="button" onclick="selectButton(this)" name="about_myself_q1" value="-2">-2</button>
							<button type="button" onclick="selectButton(this)" name="about_myself_q1" value="-1">-1</button>
							<button type="button" onclick="selectButton(this)" name="about_myself_q1" value="0">0</button>
							<button type="button" onclick="selectButton(this)" name="about_myself_q1" value="+1">+1</button>
							<button type="button" onclick="selectButton(this)" name="about_myself_q1" value="+2">+2</button><br>

							<label>ii. I consulted with the lecturer after lecture hours.</label>
							<button type="button" onclick="selectButton(this)" name="about_myself_q2" value="-2">-2</button>
							<button type="button" onclick="selectButton(this)" name="about_myself_q2" value="-1">-1</button>
							<button type="button" onclick="selectButton(this)" name="about_myself_q2" value="0">0</button>
							<button type="button" onclick="selectButton(this)" name="about_myself_q2" value="+1">+1</button>
							<button type="button" onclick="selectButton(this)" name="about_myself_q2" value="+2">+2</button><br>

						</div>

							<label for="comments">Any other comments?</label>
							<textarea id="comments" name="comments" rows="4" cols="50"></textarea><br>
							
							<input type="hidden" id="time_management_q1" name="time_management_q1" value="">
							<input type="hidden" id="time_management_q2" name="time_management_q2" value="">
							<input type="hidden" id="time_management_q3" name="time_management_q3" value="">
							<input type="hidden" id="delivery_method_q1" name="delivery_method_q1" value="">
							<input type="hidden" id="delivery_method_q2" name="delivery_method_q2" value="">
							<input type="hidden" id="delivery_method_q3" name="delivery_method_q3" value="">
							<input type="hidden" id="subject_command_q1" name="subject_command_q1" value="">
							<input type="hidden" id="subject_command_q2" name="subject_command_q2" value="">
							<input type="hidden" id="subject_command_q3" name="subject_command_q3" value="">
							<input type="hidden" id="subject_command_q4" name="subject_command_q4" value="">
							<input type="hidden" id="about_myself_q1" name="about_myself_q1" value="">
							<input type="hidden" id="about_myself_q2" name="about_myself_q2" value="">

							
							
							
							<input type="submit" value="Submit Feedback" style="margin-top: 40px; background-color: #63E84E; cursor: pointer; padding: 10px; transition: background-color 0.3s ease;">


				</form>
			</div>
		   <script>
			
					function selectButton(button) {
						// Deselect all buttons in the same group
						var buttons = document.getElementsByName(button.name);
						buttons.forEach(function(btn) {
							btn.classList.remove('selected');
						});

						// Select the clicked button
						button.classList.add('selected');

						// Update the value of the corresponding hidden input field
						document.getElementById(button.name).value = button.value;
					}
				

				
			</script>
			
				<?php

				if ($_SERVER['REQUEST_METHOD'] === 'POST') 
				{
					// Sanitize input data
					$teacher_name = filter_var($_POST['teacher_name'], FILTER_SANITIZE_STRING);
					$course_unit = filter_var($_POST['course_unit'], FILTER_SANITIZE_STRING);
					$date = date('Y-m-d H:i:s');
					

					// Check database connection
					if (!$conn) {
						error_log("Database connection error: " . $conn->error);
						die("Database connection failed. Please try again later.");
					}


					// Prepare SQL statement for inserting into feedback table
					$stmt_feedback = $conn->prepare("
						INSERT INTO feedback (AdminID) VALUES (?)
					");
					$admin_id = 1; // Replace with the actual AdminID
					$stmt_feedback->bind_param("i", $admin_id);
					$stmt_feedback->execute();
					$feedback_id = $stmt_feedback->insert_id;
					$stmt_feedback->close();
					
					// Prepare SQL statement for inserting into teacherfeedback table
					$stmt_teacherfeedback = $conn->prepare("
						INSERT INTO teacherfeedback (Feedback_ID) VALUES (?)
					");
					$stmt_teacherfeedback->bind_param("i", $feedback_id);
					$stmt_teacherfeedback->execute();
					$teacherfeedback_id = $stmt_teacherfeedback->insert_id;
					$stmt_teacherfeedback->close();

		
					// Prepare the SQL statement for inserting into t_questions table
					$stmt_t_questions = $conn->prepare("
					INSERT INTO t_questions (
						teacher_name, 
						course_unit, 
						date, 
						time_management_q1, 
						time_management_q2, 
						time_management_q3, 
						delivery_method_q1, 
						delivery_method_q2,
						delivery_method_q3, 
						subject_command_q1, 
						subject_command_q2,
						subject_command_q3,
						subject_command_q4,
						about_myself_q1,
						about_myself_q2,
						comments,
						TF_ID,
						st_id
					) 
					VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
					");

					// Check if the SQL statement was prepared successfully
					if (!$stmt_t_questions) {
						// Handle the case where preparation fails
						echo "Error preparing SQL statement: " . $conn->error;
					} else {
						// Bind parameters to the SQL statement with correct data types
						$stmt_t_questions->bind_param("sssiiiiiiiiiiiisis", 
							$teacher_name, // String
							$course_unit, // String
							$date, // String for submission date
							$_POST['time_management_q1'], // Integer
							$_POST['time_management_q2'], // Integer
							$_POST['time_management_q3'], // Integer
							$_POST['delivery_method_q1'], // Integer
							$_POST['delivery_method_q2'], // Integer
							$_POST['delivery_method_q3'], // Integer
							$_POST['subject_command_q1'], // Integer
							$_POST['subject_command_q2'], // Integer
							$_POST['subject_command_q3'], // Integer
							$_POST['subject_command_q4'], // Integer
							$_POST['about_myself_q1'], // Integer
							$_POST['about_myself_q2'], // Integer
							$_POST['comments'], // String
							$teacherfeedback_id, // Integer
							$std_id // Student's Std_ID retrieved from session
						);

						// Execute the prepared statement and handle errors
						if ($stmt_t_questions->execute()) {
							echo '<span class="feedback-success" style="margin-top: 20px; margin-bottom: 20px;">Feedback submitted successfully.</span>';
						} else {
							// Handle the case where execution fails
							echo "Error executing SQL statement: " . $stmt_t_questions->error;
						}
					}
					// Close the prepared statement
					$stmt_t_questions->close();
				}
				?>
				





		</body>
</html>














