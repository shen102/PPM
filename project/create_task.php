<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize form data
    $project_id = filter_var($_POST['project_id'], FILTER_SANITIZE_NUMBER_INT);
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
    $start_date = $_POST['start_date']; // You may consider validating the date format
    $end_date = $_POST['end_date']; // You may consider validating the date format
    $status = filter_var($_POST['status'], FILTER_SANITIZE_STRING);

    try {
        // Disable foreign key checks
        $pdo->exec('SET foreign_key_checks = 0');

        // Insert task into tasks table
        $sql = "INSERT INTO tasks (project_id, name, description, start_date, end_date, status) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);

        if ($stmt->execute([$project_id, $name, $description, $start_date, $end_date, $status])) {
            echo "Task created successfully";
        } else {
            echo "Error creating task: " . $stmt->errorInfo()[2];
        }

        // Re-enable foreign key checks
        $pdo->exec('SET foreign_key_checks = 1');
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Portfolio</title>
    <style>
        body {
            background-color: pink;
        }


        body {
            background-color: pink;
        }

        /* Style for the navigation */
        .sidenav {
            height: 100%;
            width: 300px;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #013220;
            overflow-x: hidden;
            padding-top: 20px;
            border-right: 20px solid #013220;
            justify-content: center;
        }

        ul {
            list-style-type: none;
        }

        .sidenav a {
            padding: 6px 8px 6px 16px;
            text-decoration: none;
            font-size: 20px;
            color: #026943;
            display: block;
        }

        .sidenav a:hover {
            color: #f1f1f1;
            transition-duration: 0.4s;
        }

        .tools {
            padding-top: 20px;
        }

        .main {
            background-color: #fff8de;
            width: 85%;
            height: 1000%;
            margin-left: 300px;
            font-size: 28px;
            padding: 20px 50px;
        }

        .main button {
            background-color: #013220;
            color: #f1f1f1;
        }


        .form-container {
            margin-top: 100px;
            margin-left: 500px;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        .form-container input[type="text"],
        .form-container input[type="date"],
        .form-container textarea {
            width: calc(100% - 22px);
            margin: 10px 0;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-container input[type="submit"] {
            width: 150px;
            padding: 10px 20px;
            background-color: #ff0090;
            color: white;
            border: none;
            border-radius: 20px;
            cursor: pointer;
        }

        .form-container input[type="submit"]:hover {
            background-color: #fb5aaa;
        }
    </style>
</head>

<body>

    <header>
        <ul class="sidenav">
            <!-- Profile Section -->
            <center>
                <li class="logo-profile">
                    <img src="profile.png" alt="Profile Picture" class="logo-profile-photo">
                    <div class="text-profile">
                    </div>
                </li>
            </center>
            <div class="tools">
                <!-- Left Nav Bar -->
                <li class="sidebar-active"><a href="home.php" style="text-decoration: none;">Home </a></li>
                <li class="sidebar"><a href="create_project.php" style="text-decoration: none;">Create Project </a></li>
                <li class="sidebar"><a href="create_portfolio.php" style="text-decoration: none;">Create Portfolio </a></li>
                <li class="sidebar"> <a href="create_task.php" style="text-decoration: none;">Create Task</a></li>
                <li class="sidebar">
                    <a href="logout.php" style="text-decoration: none;">Logout</a>
                </li>
            </div>
        </ul>
    </header>
    <div class="form-container">
        <center>
            <h2>Create Task</h2>
        </center>
        <form method="post">
            <label for="project_id">Project ID:</label>
            <input type="text" id="project_id" name="project_id" required><br>

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br>

            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="4" required></textarea><br>

            <label for="start_date">Start Date:</label>
            <input type="date" id="start_date" name="start_date" required><br>

            <label for="end_date">End Date:</label>
            <input type="date" id="end_date" name="end_date" required><br>

            <label for="status">Status:</label>
            <input type="text" id="status" name="status" required><br>

            <center><input type="submit" value="Create Task"></center>
        </form>
    </div>
</body>

</html>