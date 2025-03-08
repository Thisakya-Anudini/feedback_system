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

$std_id = isset($_SESSION['std_id']) ? $_SESSION['std_id'] : null;

if ($std_id !== null) {
} else {
    echo "Session variable std_id is not set.";
}


?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Feedback</title>
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
		.feedback-success {
		color: blue;
		margin-bottom: 60px		
		}
    </style>

</head>
<body>
	<div class="container">
        <div class="sidebar">
            <h2>Dashboard</h2>
            <ul>
                <li><a href="course_feedback.php"class="active">Provide Course Feedback</a></li>
                <li><a href="teacher_feedback.php">Provide Teacher Feedback</a></li>
                <li><a href="reset_password.php">Reset Password</a></li>
                <li><a href="index.html" class="logout">Logout</a></li>
            </ul>
        </div>
        <div class="content">




	<div class="form-container">
		 <h1>Course Evaluation Feedback</h1>
		<form id="courseEvaluationForm" class="feedback-form" action="course_feedback.php" method="post">
		<p>This questionnaire intends to collect feedback from the students about the course unit. Your valuable feedback will be vital for us to strengthen the teaching-learning environment to achieve excellence in teaching and learning.</p>

		<label for="course_unit">Course Unit:</label>
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

		// Fetching course data
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


			<h3>A. General</h3>
			<div class="scale-buttons">
				<label>i. This course helped me to enhance my knowledge.</label>
				<button type="button" onclick="selectButton(this)" name="general_q1" value="-2">-2</button>
				<button type="button" onclick="selectButton(this)" name="general_q1" value="-1">-1</button>
				<button type="button" onclick="selectButton(this)" name="general_q1" value="0">0</button>
				<button type="button" onclick="selectButton(this)" name="general_q1" value="+1">+1</button>
				<button type="button" onclick="selectButton(this)" name="general_q1" value="+2">+2</button><br>

				<label>ii. The workload of the course was manageable.</label>
				<button type="button" onclick="selectButton(this)" name="general_q2" value="-2">-2</button>
				<button type="button" onclick="selectButton(this)" name="general_q2" value="-1">-1</button>
				<button type="button" onclick="selectButton(this)" name="general_q2" value="0">0</button>
				<button type="button" onclick="selectButton(this)" name="general_q2" value="+1">+1</button>
				<button type="button" onclick="selectButton(this)" name="general_q2" value="+2">+2</button><br>

				<label>iii. The course was interesting.</label>
				<button type="button" onclick="selectButton(this)" name="general_q3" value="-2">-2</button>
				<button type="button" onclick="selectButton(this)" name="general_q3" value="-1">-1</button>
				<button type="button" onclick="selectButton(this)" name="general_q3" value="0">0</button>
				<button type="button" onclick="selectButton(this)" name="general_q3" value="+1">+1</button>
				<button type="button" onclick="selectButton(this)" name="general_q3" value="+2">+2</button><br>
			</div>

			<h3>B. Materials</h3>
			<div class="scale-buttons">
				<label>i. Adequate materials (handouts) were provided.</label>
				<button type="button" onclick="selectButton(this)" name="materials_q1" value="-2">-2</button>
				<button type="button" onclick="selectButton(this)" name="materials_q1" value="-1">-1</button>
				<button type="button" onclick="selectButton(this)" name="materials_q1" value="0">0</button>
				<button type="button" onclick="selectButton(this)" name="materials_q1" value="+1">+1</button>
				<button type="button" onclick="selectButton(this)" name="materials_q1" value="+2">+2</button><br>

				<label>ii. Handouts were easy to understand.</label>
				<button type="button" onclick="selectButton(this)" name="materials_q2" value="-2">-2</button>
				<button type="button" onclick="selectButton(this)" name="materials_q2" value="-1">-1</button>
				<button type="button" onclick="selectButton(this)" name="materials_q2" value="0">0</button>
				<button type="button" onclick="selectButton(this)" name="materials_q2" value="+1">+1</button>
				<button type="button" onclick="selectButton(this)" name="materials_q2" value="+2">+2</button><br>

				<label>iii. Enough reference books were used.</label>
				<button type="button" onclick="selectButton(this)" name="materials_q3" value="-2">-2</button>
				<button type="button" onclick="selectButton(this)" name="materials_q3" value="-1">-1</button>
				<button type="button" onclick="selectButton(this)" name="materials_q3" value="0">0</button>
				<button type="button" onclick="selectButton(this)" name="materials_q3" value="+1">+1</button>
				<button type="button" onclick="selectButton(this)" name="materials_q3" value="+2">+2</button><br>
			</div>

			<h3>C. Tutorials/Examples</h3>
			<div class="scale-buttons">
				<label>i. Given problems (examples/tutorials/exercises) were enough.</label>
				<button type="button" onclick="selectButton(this)" name="tutorials_examples_q1" value="-2">-2</button>
				<button type="button" onclick="selectButton(this)" name="tutorials_examples_q1" value="-1">-1</button>
				<button type="button" onclick="selectButton(this)" name="tutorials_examples_q1" value="0">0</button>
				<button type="button" onclick="selectButton(this)" name="tutorials_examples_q1" value="+1">+1</button>
				<button type="button" onclick="selectButton(this)" name="tutorials_examples_q1" value="+2">+2</button><br>
								
				<label>ii. Given problems (examples/ tutorials/ exercises) were challenging.</label>
				<button type="button" onclick="selectButton(this)" name="tutorials_examples_q2" value="-2">-2</button>
				<button type="button" onclick="selectButton(this)" name="tutorials_examples_q2" value="-1">-1</button>
				<button type="button" onclick="selectButton(this)" name="tutorials_examples_q2" value="0">0</button>
				<button type="button" onclick="selectButton(this)" name="tutorials_examples_q2" value="+1">+1</button>
				<button type="button" onclick="selectButton(this)" name="tutorials_examples_q2" value="+2">+2</button><br>
			</div>

			<h3>D. Lab/Fieldwork</h3>
			<div class="scale-buttons">
				<label>i. I could relate what I learnt from lectures to lab/field classes.</label>
				<button type="button" onclick="selectButton(this)" name="lab_fieldwork_q1" value="-2">-2</button>
				<button type="button" onclick="selectButton(this)" name="lab_fieldwork_q1" value="-1">-1</button>
				<button type="button" onclick="selectButton(this)" name="lab_fieldwork_q1" value="0">0</button>
				<button type="button" onclick="selectButton(this)" name="lab_fieldwork_q1" value="+1">+1</button>
				<button type="button" onclick="selectButton(this)" name="lab_fieldwork_q1" value="+2">+2</button><br>

				<label>ii. Labs & Fieldwork helped to improve my skills and practical knowledge.</label>
				<button type="button" onclick="selectButton(this)" name="lab_fieldwork_q2" value="-2">-2</button>
				<button type="button" onclick="selectButton(this)" name="lab_fieldwork_q2" value="-1">-1</button>
				<button type="button" onclick="selectButton(this)" name="lab_fieldwork_q2" value="0">0</button>
				<button type="button" onclick="selectButton(this)" name="lab_fieldwork_q2" value="+1">+1</button>
				<button type="button" onclick="selectButton(this)" name="lab_fieldwork_q2" value="+2">+2</button><br>
				
				<label>iii. I can conduct experiments/fieldwork myself through a set of instructions in future.</label>
				<button type="button" onclick="selectButton(this)" name="lab_fieldwork_q3" value="-2">-2</button>
				<button type="button" onclick="selectButton(this)" name="lab_fieldwork_q3" value="-1">-1</button>
				<button type="button" onclick="selectButton(this)" name="lab_fieldwork_q3" value="0">0</button>
				<button type="button" onclick="selectButton(this)" name="lab_fieldwork_q3" value="+1">+1</button>
				<button type="button" onclick="selectButton(this)" name="lab_fieldwork_q3" value="+2">+2</button><br>
			</div>

			<h3>E. About Myself</h3>
			<div class="scale-buttons">
				<label>i. I prepared thoroughly for each class.</label>
				<button type="button" onclick="selectButton(this)" name="about_myself_q1" value="-2">-2</button>
				<button type="button" onclick="selectButton(this)" name="about_myself_q1" value="-1">-1</button>
				<button type="button" onclick="selectButton(this)" name="about_myself_q1" value="0">0</button>
				<button type="button" onclick="selectButton(this)" name="about_myself_q1" value="+1">+1</button>
				<button type="button" onclick="selectButton(this)" name="about_myself_q1" value="+2">+2</button><br>

				<label>ii. I attended lectures, lab/fieldwork regularly.</label>
				<button type="button" onclick="selectButton(this)" name="about_myself_q2" value="-2">-2</button>
				<button type="button" onclick="selectButton(this)" name="about_myself_q2" value="-1">-1</button>
				<button type="button" onclick="selectButton(this)" name="about_myself_q2" value="0">0</button>
				<button type="button" onclick="selectButton(this)" name="about_myself_q2" value="+1">+1</button>
				<button type="button" onclick="selectButton(this)" name="about_myself_q2" value="+2">+2</button><br>

				<label>iii. I did all assigned work (homework/assignments/lab & field report) on time.</label>
				<button type="button" onclick="selectButton(this)" name="about_myself_q3" value="-2">-2</button>
				<button type="button" onclick="selectButton(this)" name="about_myself_q3" value="-1">-1</button>
				<button type="button" onclick="selectButton(this)" name="about_myself_q3" value="0">0</button>
				<button type="button" onclick="selectButton(this)" name="about_myself_q3" value="+1">+1</button>
				<button type="button" onclick="selectButton(this)" name="about_myself_q3" value="+2">+2</button><br>
				
				<label>iv. I referred recommended textbooks regularly.</label>
				<button type="button" onclick="selectButton(this)" name="about_myself_q4" value="-2">-2</button>
				<button type="button" onclick="selectButton(this)" name="about_myself_q4" value="-1">-1</button>
				<button type="button" onclick="selectButton(this)" name="about_myself_q4" value="0">0</button>
				<button type="button" onclick="selectButton(this)" name="about_myself_q4" value="+1">+1</button>
				<button type="button" onclick="selectButton(this)" name="about_myself_q4" value="+2">+2</button><br>
			</div>

			<label for="comments">Any other comments?</label>
			<textarea id="comments" name="comments" rows="4" cols="50"></textarea><br>
			
			<input type="hidden" id="general_q1" name="general_q1" value="">
			<input type="hidden" id="general_q2" name="general_q2" value="">
			<input type="hidden" id="general_q3" name="general_q3" value="">
			<input type="hidden" id="materials_q1" name="materials_q1" value="">
			<input type="hidden" id="materials_q2" name="materials_q2" value="">
			<input type="hidden" id="materials_q3" name="materials_q3" value="">
			<input type="hidden" id="tutorials_examples_q1" name="tutorials_examples_q1" value="">
			<input type="hidden" id="tutorials_examples_q2" name="tutorials_examples_q2" value="">
			<input type="hidden" id="lab_fieldwork_q1" name="lab_fieldwork_q1" value="">
			<input type="hidden" id="lab_fieldwork_q2" name="lab_fieldwork_q2" value="">
			<input type="hidden" id="lab_fieldwork_q3" name="lab_fieldwork_q3" value="">
			<input type="hidden" id="about_myself_q1" name="about_myself_q1" value="">
			<input type="hidden" id="about_myself_q2" name="about_myself_q2" value="">
			<input type="hidden" id="about_myself_q3" name="about_myself_q3" value="">
			<input type="hidden" id="about_myself_q4" name="about_myself_q4" value="">
			
			
			
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
			document.getElementById(button.name).value = button.value;
			
        }
    </script>
	
		<?php


			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				// Sanitize input data
				$course_unit = filter_var($_POST['course_unit'], FILTER_SANITIZE_STRING);
				
				// Get the current date and time
				$date = date('Y-m-d H:i:s');

				// Check database connection
				if (!$conn) {
					error_log("Database connection error: " . $conn->error);
					die("Database connection failed. Please contact support.");
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

				// Prepare SQL statement for inserting into coursefeedback table
				$stmt_coursefeedback = $conn->prepare("
					INSERT INTO coursefeedback (Feedback_ID) VALUES (?)
				");
				$stmt_coursefeedback->bind_param("i", $feedback_id);
				$stmt_coursefeedback->execute();
				$coursefeedback_id = $stmt_coursefeedback->insert_id;
				$stmt_coursefeedback->close();

				// Prepare SQL statement for inserting into c_questions table
				$stmt_c_questions = $conn->prepare("
					INSERT INTO c_questions (
						course_unit, 
						date, 
						general_q1, 
						general_q2, 
						general_q3,
						materials_q1, 
						materials_q2,
						materials_q3, 
						tutorials_examples_q1,
						tutorials_examples_q2,
						lab_fieldwork_q1, 
						lab_fieldwork_q2,
						lab_fieldwork_q3, 
						about_myself_q1,
						about_myself_q2,
						about_myself_q3,
						about_myself_q4,
						comments,
						CF_ID,
						st_id
					) 
					VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
				");

				// Bind parameters with correct data types
			$stmt_c_questions->bind_param("ssiiiiiiiiiiiiiiisis", 
					$course_unit, // String
					$date, // Date and time
					$_POST['general_q1'], // Integer
					$_POST['general_q2'], // Integer
					$_POST['general_q3'], // Integer
					$_POST['materials_q1'], // Integer
					$_POST['materials_q2'], // Integer
					$_POST['materials_q3'], // Integer
					$_POST['tutorials_examples_q1'], // Integer
					$_POST['tutorials_examples_q2'], // Integer
					$_POST['lab_fieldwork_q1'], // Integer
					$_POST['lab_fieldwork_q2'], // Integer
					$_POST['lab_fieldwork_q3'], // Integer
					$_POST['about_myself_q1'], // Integer
					$_POST['about_myself_q2'], // Integer
					$_POST['about_myself_q3'], // Integer
					$_POST['about_myself_q4'], // Integer
					$_POST['comments'], // String
					$coursefeedback_id, // Integer (foreign key referencing coursefeedback table)
					$std_id // Student's Std_ID retrieved from session
				);

				// Execute the SQL query and handle errors
				if ($stmt_c_questions->execute()) {
					echo '<span class="feedback-success" style="margin-top: 20px; margin-bottom: 20px;">Feedback submitted successfully.</span>


			';
				} else {
					error_log("Error executing query: " . $stmt_c_questions->error);
					echo "An error occurred while submitting feedback. Please try again.";
				}

				// Close the statement to free resources
				$stmt_c_questions->close();
			}

			// Close the database connection
			$conn->close();
			?>





</body>
</html>
