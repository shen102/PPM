<?php
session_start();
include 'config.php';

// Initialize variables for form inputs and error message
$username = $password = '';
$error_message = '';

// Process form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and store user inputs
    $username = htmlspecialchars($_POST['username']);
    $password = $_POST['password'];

    // Query database for user with matching username
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    // Verify password if user found
    if ($user && password_verify($password, $user['password'])) {
        // Store user ID in session and redirect to dashboard
        $_SESSION['user_id'] = $user['id'];
        header("Location: dashboard.php");
        exit(); // Ensure no further output after redirect
    } else {
        // Display error message for invalid login attempt
        $error_message = "Invalid username or password";
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
            font-family: Arial, sans-serif;
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

        .error-message {
            color: red;
            margin-top: 10px;
        }

        .signup-link {
            font-size: 14px;
            margin-top: 10px;
        }

        .signup-link a {
            color: #0066cc;
            text-decoration: none;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Log In</h2>
        <form method="post">
            <?php if (!empty($error_message)): ?>
                <p class="error-message"><?php echo $error_message; ?></p>
            <?php endif; ?>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>
           <center> <input type="submit" value="Login"></center>
        </form>
        <p class="signup-link">Don't have an account? <a href="register.php">Sign Up</a></p>
    </div>
</body>
</html>
