<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $status = $_POST['status'];
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO projects (user_id, name, description, start_date, end_date, status) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute([$user_id, $name, $description, $start_date, $end_date, $status])) {
        echo "Project created successfully";
    } else {
        echo "Error creating project";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Project</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
    background-color: pink;
}

/* Style for the navigation */
.nav {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: white;
}

/* Style for the navigation items */
.nav li {
    float: left;
}

/* Style for the navigation links */
.nav a {
    display: block;
    color: rgb(15, 1, 1);
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    font-size: 20px;
}

/* Change color on hover */
.nav a:hover {
    background-color: #ff5d8f;
}

/* Style for the dropdown content */
.nav ul {
    display: none;
    position: absolute;
    background-color:white;
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
    z-index: 1;
    min-width: 160px;
}

/* Show dropdown content on hover */
.nav li:hover ul {
    display: block;
}

/* Style for the dropdown items */
.nav li ul li {
    float: none;
}

.nav li ul li a {
    padding: 12px 16px;
    color: rgb(15, 1, 1);
    text-decoration: none;
    display: block;
    text-align: left;
}

.nav li ul li a:hover {
    background-color: #ff5d8f;
}

/* Style for the logout link */
.nav li:last-child {
    float: right;
}

        .form-container {
            margin-top: 100px;
            margin-left: 500px;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 320px;
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
           <center> <input type="submit" value="Create Project"></center>
        </form>
    </div>
</body>
</html>
