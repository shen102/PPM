<?php
session_start();
include 'config.php';

// Fetch tasks from the database
$stmt = $pdo->query("SELECT * FROM tasks");
$tasks = $stmt->fetchAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Your existing code for task creation

    // Insert task into tasks table
    $sql = "INSERT INTO tasks (project_id, name, description, start_date, end_date, status) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$project_id, $name, $description, $start_date, $end_date, $status])) {
        echo "Task created successfully";
    } else {
        echo "Error creating task: " . $stmt->errorInfo()[2];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Portfolio</title>
    <style>
        /* Your existing CSS styles */
    </style>
</head>
<body>
    <!-- Your navigation and form container -->
    <!-- Display tasks from the database -->
    <div>
        <h2>Tasks</h2>
        <ul>
            <?php foreach ($tasks as $task): ?>
                <li><?php echo htmlspecialchars($task['name']); ?> - <?php echo htmlspecialchars($task['status']); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>