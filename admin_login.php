<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('adlog.jpg'); 
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .container {
            max-width: 500px;
            margin: 200px auto;
            padding: 50px;
            background-color: #CE9FAD;               
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1, h2 {
            margin-top: 0;
        }

        label {
            display: block;
            margin-bottom: 20px;
        }

        input[type="text"],
        input[type="password"] {
            width: calc(100% - 10px);
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            background-color: #08AB39;
            color: #black;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #E69569 ;
        }

        .error {
            color: red;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Admin Login</h1>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="admin_id">Admin ID:</label>
            <input type="text" id="admin_id" name="admin_id" required><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>
            <button type="submit">Login</button>
        </form>

        <?php
        // Database connection
        include_once "db_connections.php";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $admin_id = $_POST["admin_id"];
            $password = $_POST["password"];

            // Check if admin credentials are correct
            $stmt = $conn->prepare("SELECT * FROM adminlogin WHERE AdminID = ? AND Password = ?");
            $stmt->bind_param("is", $admin_id, $password);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                echo "<p>Login successful. Redirecting to admin dashboard...</p>";
                // Redirect to admin dashboard
                header("Location: admin_dashboard.php");
                exit();
            } else {
                echo "<p class='error'>Invalid admin ID or password. Please try again.</p>";
            }
            $stmt->close();
        }
        ?>
		<br><br>
		 <div class="login-link">
            <a href="index.html">&larr; Back to Main Menu</a>
        </div>
    </div>
</body>
</html>

