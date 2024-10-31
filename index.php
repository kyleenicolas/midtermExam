<?php
session_start();
require 'db.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch all barbershops from the database
$stmt = $pdo->query("
    SELECT barbershops.*, users.username 
    FROM barbershops 
    JOIN users ON barbershops.added_by = users.user_id
");
$barbershops = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barbershop Directory</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #90ecff;
            font-family: 'Roboto', sans-serif;
            color: #343a40;
        }
        .container {
            margin-top: 60px;
        }
        .header {
            text-align: center;
            margin-bottom: 40px;
        }
        h1 {
            font-size: 2.5em;
            color: #20345b;
            font-weight: bold;
        }
        .btn-add {
            display: block;
            width: 200px;
            margin: 20px auto;
            background-color: #3a5a98;
            color: white;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            text-align: center;
        }
        .btn-add:hover {
            background-color: #31497c;
        }
        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            gap: 20px;
        }
        .card {
            background-color: #ffffff;
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 280px;
            padding: 20px;
            transition: transform 0.2s ease;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card h5 {
            color: #3a5a98;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .card p {
            color: #495057;
            font-size: 0.9em;
            line-height: 1.6;
        }
        .card-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
        }
        .btn-action {
            font-weight: bold;
            font-size: 0.85em;
            padding: 6px 12px;
            border-radius: 5px;
            text-decoration: none;
        }
        .btn-view {
            background-color: #63c2de;
            color: #ffffff;
        }
        .btn-view:hover {
            background-color: #4da2be;
        }
        .btn-edit {
            background-color: #ffb64c;
            color: #ffffff;
        }
        .btn-edit:hover {
            background-color: #d49038;
        }
        .btn-delete {
            background-color: #f86c6b;
            color: #ffffff;
        }
        .btn-delete:hover {
            background-color: #c85654;
        }
        .btn-logout {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #f86c6b;
            color: #ffffff;
            padding: 10px 20px;
            font-weight: bold;
            border-radius: 5px;
            text-decoration: none;
        }
        .btn-logout:hover {
            background-color: #c85654;
        }
    </style>
</head>
<body>

    <!-- Logout Button -->
    <a href="logout.php" class="btn btn-logout">Logout</a>

    <div class="container">
        <div class="header">
            <h1>Barbershop Directory</h1>
            <a href="edit.php" class="btn btn-add">Add New Barbershop</a>
        </div>

        <div class="card-container">
            <?php foreach ($barbershops as $barbershop): ?>
                <div class="card">
                    <h5><?php echo htmlspecialchars($barbershop['name']); ?></h5>
                    <p><strong>Address:</strong> <?php echo htmlspecialchars($barbershop['address']); ?></p>
                    <p><strong>Phone:</strong> <?php echo htmlspecialchars($barbershop['phone_number']); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($barbershop['email']); ?></p>
                    <p><strong>Added by:</strong> <?php echo htmlspecialchars($barbershop['username']); ?></p>
                    <p><strong>Last updated:</strong> <?php echo htmlspecialchars($barbershop['last_updated']); ?></p>
                    <div class="card-actions">
                        <a href="view.php?id=<?php echo $barbershop['barbershop_id']; ?>" class="btn-action btn-view">View</a>
                        <a href="edit.php?id=<?php echo $barbershop['barbershop_id']; ?>" class="btn-action btn-edit">Edit</a>
                        <a href="delete.php?id=<?php echo $barbershop['barbershop_id']; ?>" class="btn-action btn-delete" onclick="return confirm('Are you sure you want to delete this barbershop?');">Delete</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</body>
</html>
