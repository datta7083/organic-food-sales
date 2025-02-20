<?php
session_start();
include 'config.php'; // Database connection

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user details
$stmt = $conn->prepare("SELECT name, email FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($name, $email);
$stmt->fetch();
$stmt->close();

// Fetch purchased products
$orders = [];
$order_stmt = $conn->prepare("
    SELECT products.name, products.price, orders.order_date 
    FROM orders 
    JOIN products ON orders.product_id = products.id 
    WHERE orders.user_id = ?
");
$order_stmt->bind_param("i", $user_id);
$order_stmt->execute();
$order_result = $order_stmt->get_result();

while ($row = $order_result->fetch_assoc()) {
    $orders[] = $row;
}

$order_stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Organix</title>
    <link rel="stylesheet" href="profile.css">
</head>
<body>
    <div class="profile-container">
        <h2>User Profile</h2>
        <p><strong>Name:</strong> <?php echo htmlspecialchars($name); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
        <a href="edit-profile.php" class="btn">Edit Profile</a>

        <h3>Purchased Products</h3>
        <?php if (count($orders) > 0): ?>
            <ul>
                <?php foreach ($orders as $order): ?>
                    <li>
                        <?php echo htmlspecialchars($order['name']); ?> - 
                        $<?php echo number_format($order['price'], 2); ?> 
                        (Purchased on <?php echo $order['order_date']; ?>)
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No purchases yet.</p>
        <?php endif; ?>
        
        <a href="logout.php" class="btn logout">Logout</a>
    </div>
</body>
</html>
