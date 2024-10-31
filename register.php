<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $email = $_POST['email'];

    // Check if username already exists
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    if ($stmt->fetch()) {
        $error = "Username is already taken.";
    } else {
        // Insert the new user into the database
        $stmt = $pdo->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
        if ($stmt->execute([$username, $password, $email])) {
            header("Location: login.php?register=success");
            exit();
        } else {
            $error = "Error in registration.";
        }
    }
}
?>

<!-- HTML Registration Form -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
       body {
            background: linear-gradient(135deg, #74ebd5 0%, #acb6e5 100%);
            font-family: 'Roboto', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        .register-container {
            background-color: white;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        .register-container h2 {
            font-size: 2em;
            color: #4a4a4a;
            margin-bottom: 20px;
        }
        .register-container .form-group {
            margin-bottom: 15px;
        }
        .register-container input[type="text"],
        .register-container input[type="password"] {
            font-size: 1em;
            padding: 10px;
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 5px;
            transition: border-color 0.2s;
        }
        .register-container input[type="text"]:focus,
        .register-container input[type="password"]:focus {
            border-color: #74ebd5;
            outline: none;
        }
        .btn-register {
            background-color: #74ebd5;
            color: white;
            font-weight: bold;
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            transition: background-color 0.2s;
        }
        .btn-register:hover {
            background-color: #5dc9c0;
        }
        .register-container a {
            display: block;
            margin-top: 15px;
            color: #5dc9c0;
            text-decoration: none;
            font-size: 0.9em;
        }
        .register-container a:hover {
            text-decoration: underline;
        }
        .error-message {
            color: #e74c3c;
            font-size: 0.9em;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <?php if (isset($error)): ?>
            <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        
        <form method="POST" action="register.php">
            <div class="form-group">
                <label class="form-label">Username:</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label class="form-label">Password:</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label class="form-label">Email:</label>
                <input type="email" name="email" class="form-control">
            </div>
            <button type="submit" class="btn btn-register">Register</button>
        </form>

        <a href="login.php" class="login-link">Already have an account? Login here</a>
    </div>
</body>
</html>
