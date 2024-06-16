<?php
session_start();
include 'config.php';

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM projects WHERE user_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);
$projects = $stmt->fetchAll();

foreach ($projects as $project) {
    echo "Project: " . $project['name'] . "<br>";
    echo "Description: " . $project['description'] . "<br>";
    echo "Status: " . $project['status'] . "<br>";
    echo "<hr>";
}
?>
