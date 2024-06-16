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

<form method="post">
    Name: <input type="text" name="name" required><br>
    Description: <textarea name="description" required></textarea><br>
    Start Date: <input type="date" name="start_date" required><br>
    End Date: <input type="date" name="end_date" required><br>
    Status: <input type="text" name="status" required><br>
    <input type="submit" value="Create Project">
</form>
