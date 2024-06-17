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
$sql = "SELECT tasks.* FROM tasks 
        JOIN projects ON tasks.project_id = projects.id 
        WHERE projects.user_id = ? ORDER BY tasks.start_date DESC LIMIT 5";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);
$recent_tasks = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
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

        <div class="button-container">
            <form method="post" action="All_residents_dashboard.php">
                <button type="submit" name="button1"  class="button">Project</button>
            </form>
            <form method="post"action="blotter_report.php">
                <button type="submit" name="button2" class="button">Tasks</button>
            </form>
            <form method="post" action="req_id_dashboard.php">
                <button type="submit" name="button3" class="button">Portfolio</button>
            </form>
        </div>

        
    </div>
</body>
</html>
