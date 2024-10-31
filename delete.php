<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare the statement to delete the restaurant
    $stmt = $pdo->prepare("DELETE FROM restaurants WHERE babershop_id = ?");
    $stmt->execute([$id]);

    // Redirect after deletion
    header('Location: index.php');
    exit;
}

// If the id is not set, redirect back to the index page
header('Location: index.php');
exit;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Deletion</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #74ebd5 0%, #acb6e5 100%);
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 50px;
            background-color: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
            font-weight: 600;
            text-align: center;
            margin-bottom: 30px;
        }
        .btn-danger {
            background-color: #dc3545;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
        .btn-secondary {
            background-color: #54d6d4;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
        }
        .btn-secondary:hover {
            background-color: #95cee9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Confirm Deletion</h1>
        <p class="text-center">Are you sure you want to delete this barbershop? This action cannot be undone.</p>
        <div class="text-center">
            <a href="delete.php?id=<?php echo htmlspecialchars($id); ?>" class="btn btn-danger">Delete</a>
            <a href="index.php" class="btn btn-secondary">Cancel</a>
        </div>
    </div>
</body>
</html>
