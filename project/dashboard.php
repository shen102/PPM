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
    <div class="container">
        
        <ul class="nav">
            <li><a href="#overview">Overview</a>
                <ul>
                    <li><a href="#projects">Projects: <?php echo $project_count ?? 0; ?></a></li>
                    <li><a href="#portfolios">Portfolios: <?php echo $portfolio_count ?? 0; ?></a></li>
                    <li><a href="#tasks">Tasks: <?php echo $task_count ?? 0; ?></a></li>
                </ul>
            </li>
            <li><a href="#recent-projects">Recent Projects</a>
                <ul>
                    <?php if (!empty($recent_projects)): ?>
                        <?php foreach ($recent_projects as $project): ?>
                            <li><a href="#"><?php echo htmlspecialchars($project['name']); ?></a></li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li>No recent projects found.</li>
                    <?php endif; ?>
                </ul>
            </li>
            <li><a href="#recent-tasks">Recent Tasks</a>
                <ul>
                    <?php if (!empty($recent_tasks)): ?>
                        <?php foreach ($recent_tasks as $task): ?>
                            <li><a href="#"><?php echo htmlspecialchars($task['name']); ?></a></li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li>No recent tasks found.</li>
                    <?php endif; ?>
                </ul>
            </li>
            <li><a href="#create">Create</a>
                <ul>
                    <li><a href="create_project.php">Create Project</a></li>
                    <li><a href="create_portfolio.php">Create Portfolio</a></li>
                    <li><a href="create_task.php">Create Task</a></li>
                </ul>
            </li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
        
    </div>
</body>
</html>
