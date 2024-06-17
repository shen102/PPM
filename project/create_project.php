<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Project</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
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

    <div class="form-container">
        <form method="post">
           <center> <h2>Create Project</h2></center>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br>
            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea><br>
            <label for="start_date">Start Date:</label>
            <input type="date" id="start_date" name="start_date" required><br>
            <label for="end_date">End Date:</label>
            <input type="date" id="end_date" name="end_date" required><br>
            <label for="status">Status:</label>
            <input type="text" id="status" name="status" required><br>
            <center><input type="submit" value="Create Project"></center>
        </form>
    </div>
</body>
</html>
