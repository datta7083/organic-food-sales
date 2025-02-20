<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include database connection
include(__DIR__ . '/../config.php');

// Check if admin is logged in
if (!isset($_SESSION['admin'])) {
    header("Location: adminlogin.php");
    exit();
}

// Fetch products for display
$products = $conn->query("SELECT * FROM products");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <h2>Organic Food Admin</h2>
            <nav>
                <a href="dashboard.php" class="active">Dashboard</a>
                <a href="manage_products.php">Manage Products</a>
                <a href="manage_orders.php">Manage Orders</a>
                <a href="customers.php">Customers</a>
                <a href="reports.php">Reports</a>
                <a href="logout.php">Logout</a>
            </nav>
        </aside>

        <main class="main-content">
            <h1>Welcome, Admin!</h1>
            <div class="product-list">
                <h2>Available Products</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Product ID</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($product = $products->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $product['id']; ?></td>
                                <td><?php echo $product['name']; ?></td>
                                <td><?php echo $product['category']; ?></td>
                                <td>$<?php echo $product['price']; ?></td>
                                <td>
                                    <a href="edit_product.php?id=<?php echo $product['id']; ?>" class="btn edit">Edit</a>
                                    <a href="delete_products.php?id=<?php echo $product['id']; ?>" class="btn delete">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>

<style>
    body {
        font-family: 'Poppins', sans-serif;
        margin: 0;
        background-color: #f4f4f4;
        display: flex;
    }

    .dashboard-container {
        display: flex;
        width: 100%;
    }

    .sidebar {
        width: 250px;
        background-color: #28a745;
        color: #fff;
        padding: 20px;
        height: 100vh;
    }

    .sidebar h2 {
        margin-bottom: 30px;
        font-weight: 600;
    }

    .sidebar nav a {
        display: block;
        color: #fff;
        text-decoration: none;
        margin: 15px 0;
        font-weight: 500;
    }

    .sidebar nav a:hover, .sidebar nav a.active {
        background-color: #218838;
        padding: 10px;
        border-radius: 4px;
    }

    .main-content {
        flex-grow: 1;
        padding: 40px;
    }

    .main-content h1 {
        margin-top: 0;
        font-weight: 600;
    }

    .product-list {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #28a745;
        color: white;
    }

    .btn {
        padding: 8px 12px;
        border-radius: 4px;
        text-decoration: none;
        color: #fff;
    }

    .edit {
        background-color: #007bff;
    }

    .delete {
        background-color: #dc3545;
    }

    .edit:hover {
        background-color: #0056b3;
    }

    .delete:hover {
        background-color: #c82333;
    }
</style>

</html>
