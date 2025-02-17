<?php
session_start();
include '/config.php';
if (!isset($_SESSION['admin'])) {
    header("Location: adminlogin.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="assets/style.css">
    <script src="assets/script.js" defer></script>
</head>
<body>
    <h2>Welcome, <?php echo $_SESSION['admin']; ?></h2>
    <nav>
        <a href="products.php">Manage Products</a>
        <a href="orders.php">Manage Orders</a>
        <a href="customers.php">Customers</a>
        <a href="reports.php">Reports</a>
        <a href="logout.php">Logout</a>
    </nav>
</body>
</html>
