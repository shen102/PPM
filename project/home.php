<?php
session_start();
include 'config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch project count
$sql = "SELECT COUNT(*) AS project_count FROM projects WHERE user_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);
$project_count = $stmt->fetchColumn();

// Fetch portfolio count
$sql = "SELECT COUNT(*) AS portfolio_count FROM portfolios WHERE user_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);
$portfolio_count = $stmt->fetchColumn();

// Fetch task count
$sql = "SELECT COUNT(*) AS task_count FROM tasks 
        JOIN projects ON tasks.project_id = projects.id 
        WHERE projects.user_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);
$task_count = $stmt->fetchColumn();

// Fetch recent projects
$sql = "SELECT * FROM projects WHERE user_id = ? ORDER BY start_date DESC LIMIT 5";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);
$recent_projects = $stmt->fetchAll();

// Fetch recent tasks
// Fetch task count
$sql = "SELECT COUNT(*) AS task_count FROM tasks 
        JOIN projects ON tasks.project_id = projects.id 
        WHERE projects.user_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);
$task_count = $stmt->fetchColumn();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>

<body>
    <style>
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


        .button-container {
            display: flex;
            justify-content: center;
            margin-top: 300px;
        }

        .button-container form {
            margin: 0 10px;
        }

        .button {
            padding: 50px 50px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .button:hover {
            background-color: #0056b3;
        }
    </style>

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

    <div class="button-container">
    <form method="post" action="All_residents_dashboard.php">
        <button type="submit" name="button1" class="button">Projects (<?php echo $project_count; ?>)</button>
    </form>
    <form method="post" action="blotter_report.php">
        <button type="submit" name="button2" class="button">Tasks (<?php echo $task_count; ?>)</button>
    </form>
    <form method="post" action="req_id_dashboard.php">
        <button type="submit" name="button3" class="button">Portfolios (<?php echo $portfolio_count; ?>)</button>
    </form>
</div>


    </div>
</body>

</html>