<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header("Location: dashboard.php");
    } else {
        echo "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Log In</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: pink;
        }

        .login-container {
            background-color: #ffffff;
            width: 320px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .login-container form {
            text-align: left;
        }

        .login-container label {
            display: block;
            margin: 10px 0 5px;
        }

        .login-container input[type="text"],
        .login-container input[type="password"] {
            display: block;
            width: calc(100% - 22px); /* 100% width minus padding and border */
            margin: 5px 0 15px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .login-container input[type="submit"] {
            width: 150px;
            padding: 10px 20px;
            background-color: #ff0090;
            color: #ffffff;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-size: 20px;
        }

        .login-container input[type="submit"]:hover {
            background-color: #fb5aaa;
        }
        .login-container h2 {
            font-size: 30px;
        }
    </style>
</head>
<body>
<div class="login-container">
    <form method="post">
        <center><h2>Log In</h2></center>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
       <center> <input type="submit" value="Login"></center>
    </form>
</div>
</body>
</html>
