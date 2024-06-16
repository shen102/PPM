<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $project_id = $_POST['project_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $status = $_POST['status'];

    $sql = "INSERT INTO tasks (project_id, name, description, start_date, end_date, status) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute([$project_id, $name, $description, $start_date, $end_date, $status])) {
        echo "Task created successfully";
    } else {
        echo "Error creating task";
    }
}
?>

<form method="post">
    Project ID: <input type="text" name="project_id" required><br>
    Name: <input type="text" name="name" required><br>
    Description: <textarea name="description" required></textarea><br>
    Start Date: <input type="date" name="start_date" required><br>
    End Date: <input type="date" name="end_date" required><br>
    Status: <input type="text" name="status" required><br>
    <input type="submit" value="Create Task">
</form>
