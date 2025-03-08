<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Feedback Analysis</title>
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
		        .scale {
            max-width: 800px;
            margin-bottom: 20px;
			
        }

		table {
            width: 78%;
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
            width: 80%;
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
                <li><a href="view_teacher_feedback_results.php">View Teacher Feedback Results</a></li>
                <li><a href="analysis.php" class="active">Feedback Summary</a></li>
                <li><a href="index.html" class="logout">Logout</a></li>
            </ul>
        </div>
        <div class="content">
            <div class="back-button">
                <button onclick="goBack()">Back</button>
            </div>
			

            <div class="summary-container">
                <?php
                // Check if course unit is set in the URL
                if (isset($_GET['course_id'])) {
                    $course_unit = $_GET['course_id'];

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
            echo "<h2>Course Feedback Summary</h2>";
            echo "<div class='info'>";
			            echo "<p><strong>Course Unit:</strong> $course_unit</p>";
            echo "</div>"; // Close info div
            echo "</div>"; 
			?>
						<br><br>
			 <img src="scale.png" alt="scale" class="scale">							
<br><br>
			
			<?php
			
                    // Prepare and execute SQL query to fetch average responses for the selected course
                    $sql = "SELECT AVG(general_q1) AS avg_general_q1, AVG(general_q2) AS avg_general_q2, AVG(general_q3) AS avg_general_q3, 
                            AVG(materials_q1) AS avg_materials_q1, AVG(materials_q2) AS avg_materials_q2, AVG(materials_q3) AS avg_materials_q3,
                            AVG(tutorials_examples_q1) AS avg_tutorials_examples_q1, AVG(tutorials_examples_q2) AS avg_tutorials_examples_q2,
                            AVG(lab_fieldwork_q1) AS avg_lab_fieldwork_q1, AVG(lab_fieldwork_q2) AS avg_lab_fieldwork_q2, AVG(lab_fieldwork_q3) AS avg_lab_fieldwork_q3,
                            AVG(about_myself_q1) AS avg_about_myself_q1, AVG(about_myself_q2) AS avg_about_myself_q2, AVG(about_myself_q3) AS avg_about_myself_q3,
                            AVG(about_myself_q4) AS avg_about_myself_q4
                            FROM c_questions WHERE course_unit = '$course_unit'";
                    $result = $conn->query($sql);

                    // Check if query executed successfully
                    if ($result === false) {
                        echo "Error: " . $conn->error;
                    } else {
                        // Fetch the result as an associative array
                        $row = $result->fetch_assoc();

                        // Output table header
                        echo "<table>";
                        echo "<tr><th>Question Type</th><th>Question</th><th>Average Response</th></tr>";

                        // Define an array to map question types to their corresponding text
                        $question_texts = array(
                            "avg_general_q1" => "This course helped me to enhance my knowledge",
                            "avg_general_q2" => "The workload of the course was manageable",
                            "avg_general_q3" => "The course was interesting",
                            "avg_materials_q1" => "Adequate Materials (handouts) were provided",
                            "avg_materials_q2" => "Handouts were easy to understand",
                            "avg_materials_q3" => "Enough reference books were used",
                            "avg_tutorials_examples_q1" => "Given problems (examples/tutorials/exercises) were enough",
                            "avg_tutorials_examples_q2" => "Given problems (examples/tutorials/exercises) were challenging",
                            "avg_lab_fieldwork_q1" => "I could relate what I learnt from lectures to lab/field classes",
                            "avg_lab_fieldwork_q2" => "Labs & Fieldwork helped to improve my skills and practical knowledge",
                            "avg_lab_fieldwork_q3" => "I can conduct experiments/fieldwork myself through a set of instructions in future",
                            "avg_about_myself_q1" => "I prepared thoroughly for each class",
                            "avg_about_myself_q2" => "I attended lectures, lab/fieldwork regularly",
                            "avg_about_myself_q3" => "I did all assigned work (homework/assignments/lab & field report) on time",
                            "avg_about_myself_q4" => "I referred recommended textbooks regularly"
                        );

                        // Output data of each row
                        foreach ($question_texts as $key => $text) {
                            echo "<tr>";
                            echo "<td>" . ucfirst(explode("_", $key)[1]) . "</td>";
                            echo "<td>" . $text . "</td>";
                            if (isset($row[$key])) {
                                echo "<td>" . round($row[$key], 2) . "</td>";
                            } else {
                                echo "<td>No data available</td>";
                            }
                            echo "</tr>";
                        }
                        echo "</table>";
                    }

                    // Prepare and execute SQL query to fetch comments for the selected course
                    $sql_comments = "SELECT comments FROM c_questions WHERE course_unit = '$course_unit' AND comments IS NOT NULL";
                    $result_comments = $conn->query($sql_comments);

                    // Check if query executed successfully
                    if ($result_comments === false) {
                        echo "Error: " . $conn->error;
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

                    // Close connection
                    $conn->close();
                } else {
                    echo "Error: Course unit not provided.";
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
