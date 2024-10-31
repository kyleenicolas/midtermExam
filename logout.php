<?php
session_start();
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #74ebd5 0%, #acb6e5 100%);
            font-family: Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        .logout-container {
            text-align: center;
            background-color: #f6f6f6;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        h2 {
            color: #3d7873;
            font-weight: 600;
            margin-bottom: 20px;
        }
        .btn-login {
            background-color: #2eaea6;
            color: #ffffff;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            margin-top: 20px;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.3s ease;
        }
        .btn-login:hover {
            background-color: #52ece9;
        }
    </style>
</head>
<body>
    <div class="logout-container">
        <h2>You have been logged out</h2>
        <p>Thank you for visiting. You can log in again by clicking the button below.</p>
        <a href="login.php" class="btn-login">Back to Login</a>
    </div>
</body>
</html>
