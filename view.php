<?php
require 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $pdo->prepare("SELECT * FROM restaurants WHERE babershop_id = ?");
    $stmt->execute([$id]);
    $restaurant = $stmt->fetch();

    if (!$restaurant) {
        echo "<div class='alert alert-danger text-center'>Restaurant not found!</div>";
        exit;
    }
} else {
    echo "<div class='alert alert-danger text-center'>Invalid request!</div>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Barbershop</title>
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
        .table th {
            background-color: #74ebd5;
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
    <h1>Barbershop Details</h1>
    <table class="table table-bordered">
        <tr>
            <th>Name:</th>
            <td><?php echo htmlspecialchars($restaurant['name']); ?></td>
        </tr>
        <tr>
            <th>Address:</th>
            <td><?php echo htmlspecialchars($restaurant['address']); ?></td>
        </tr>
        <tr>
            <th>Phone:</th>
            <td><?php echo htmlspecialchars($restaurant['phone_number']); ?></td>
        </tr>
        <tr>
            <th>Email:</th>
            <td><?php echo htmlspecialchars($restaurant['email']); ?></td>
        </tr>
    </table>
    <div class="text-center">
        <a href="index.php" class="btn btn-secondary">Back</a>
    </div>
</div>
</body>
</html>
