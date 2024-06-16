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
            <li style="float: right;"><a href="logout.php">Logout</a></li>
        </ul>
        
        
    </div>
</body>
</html>
