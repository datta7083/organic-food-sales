<?php
session_start();
include_once('../config.php'); // Ensure correct path

// Check if admin is logged in
if (!isset($_SESSION['admin'])) {
    header("Location: adminlogin.php");
    exit();
}

// Handle product addition
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $category = trim($_POST['category']);
    $price = trim($_POST['price']);
    $image = $_FILES['image']['name'];
    $target_dir = "../images/";
    $target_file = $target_dir . basename($image);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        $stmt = $conn->prepare("INSERT INTO products (name, category, price, image) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssds", $name, $category, $price, $image);
        if ($stmt->execute()) {
            $success = "Product added successfully!";
        } else {
            $error = "Error adding product.";
        }
        $stmt->close();
    } else {
        $error = "Failed to upload image.";
    }
}

// Fetch all products
$products = $conn->query("SELECT * FROM products");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <h2>Admin Panel</h2>
            <nav>
                <a href="dashboard.php">Dashboard</a>
                <a href="manage_products.php" class="active">Manage Products</a>
                <a href="manage_orders.php">Manage Orders</a>
                <a href="logout.php">Logout</a>
            </nav>
        </aside>
        <main class="main-content">
            <h1>Manage Products</h1>

            <?php if (isset($success)) echo "<p class='success'>$success</p>"; ?>
            <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
            
            <form action="" method="POST" enctype="multipart/form-data">
                <label>Product Name:</label>
                <input type="text" name="name" required>
                
                <label>Category:</label>
                <select name="category" required>
                    <option value="organic_vegetable">Organic Vegetable</option>
                    <option value="fruits">Fruits</option>
                </select>
                
                <label>Price:</label>
                <input type="number" name="price" step="0.01" required>
                
                <label>Image:</label>
                <input type="file" name="image" accept="image/*" required>
                
                <button type="submit">Add Product</button>
            </form>
            
            <h2>Product List</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $products->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['category']); ?></td>
                            <td>$<?php echo number_format($row['price'], 2); ?></td>
                            <td><img src="../images/<?php echo $row['image']; ?>" width="50"></td>
                            <td>
                                <a href="edit_product.php?id=<?php echo $row['id']; ?>">Edit</a> |
                                <a href="delete_products.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?');">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </main>
    </div>
</body>
<style>
    .dashboard-container {
        display: flex;
    }
    .sidebar {
        width: 250px;
        background: #28a745;
        padding: 20px;
        height: 100vh;
        color: white;
    }
    .sidebar a {
        display: block;
        color: white;
        text-decoration: none;
        margin: 10px 0;
    }
    .sidebar a.active {
        font-weight: bold;
    }
    .main-content {
        flex-grow: 1;
        padding: 20px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        padding: 10px;
        border: 1px solid #ddd;
    }
    th {
        background: #28a745;
        color: white;
    }
    img {
        max-width: 50px;
    }
    .success {
        color: green;
    }
    .error {
        color: red;
    }
</style>
</html>
