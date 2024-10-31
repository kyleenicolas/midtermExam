<?php
require 'db.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: /login/login.php');
    exit;
}

$babershop_id = '';
$name = '';
$address = '';
$phone = '';
$email = '';
$added_by = $_SESSION['user_id'];

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM restaurants WHERE babershop_id = ?");
    $stmt->execute([$id]);
    $restaurant = $stmt->fetch();

    $babershop_id = $restaurant['babershop_id'];
    $name = $restaurant['name'];
    $address = $restaurant['address'];
    $phone = $restaurant['phone_number'];
    $email = $restaurant['email'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    if ($babershop_id) {
        // Update existing restaurant
        $stmt = $pdo->prepare("UPDATE restaurants SET name = ?, address = ?, phone_number = ?, email = ? WHERE babershop_id = ?");
        $stmt->execute([$name, $address, $phone, $email, $babershop_id]);
    } else {
        // Add new restaurant
        $stmt = $pdo->prepare("INSERT INTO restaurants (name, address, phone_number, email, added_by) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$name, $address, $phone, $email, $added_by]);
    }

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $babershop_id ? 'Edit' : 'Add'; ?> Barbershop</title>
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
        .btn-primary {
            background-color: #54d6d4;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
        }
        .btn-primary:hover {
            background-color: #95cee9;
        }
        .btn-secondary {
            background-color: #d9534f;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
        }
        .btn-secondary:hover {
            background-color: #c9302c;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><?php echo $babershop_id ? 'Edit' : 'Add'; ?> Barbershop</h1>

        <form method="POST" action="">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="<?php echo htmlspecialchars($address); ?>" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($phone); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
