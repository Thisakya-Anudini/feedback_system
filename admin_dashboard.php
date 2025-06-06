<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('admin.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;;
        }
        .container {
            display: flex;
            max-width: 100%;
            margin: 0px auto;
            background-color: #F5B7B1;
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
			margin-top:50px;
            margin-bottom: 30px;
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
            color: black 
        }
        .content {
            flex: 1;
            padding: 50px;
            margin-left: 350px;
            overflow-y: auto;
        }
        h1 {
            margin-top: 0;
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
				<li><a href="analysis.php">Feedback Summary</a></li>
				<li><a href="index.html" class="logout">Logout</a></li>
            </ul>
        </div>
        <div class="content">
            <h1>Welcome, Admin</h1>
            <p>This is your admin dashboard. Use the menu on the left to navigate.</p>
        </div>
    </div>
</body>
</html>
