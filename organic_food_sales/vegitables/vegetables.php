<?php
session_start();
include_once('../config.php');  // Ensure correct path

// Check if $conn is defined
if (!isset($conn) || $conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Check if the products table exists
$table_check = $conn->query("SHOW TABLES LIKE 'products'");
if ($table_check->num_rows == 0) {
    die("Error: Table 'products' does not exist in the database.");
}

// Fetch organic vegetables
$sql = "SELECT * FROM products WHERE category = 'organic_vegetable'";
$result = $conn->query($sql);

// If no products are found, set a flag
$no_products = ($result->num_rows === 0);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organic Vegetables - Organix</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style1.css">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="index.php">
    <img src="../images/logo.png" alt="Organix Logo" height="50">
</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link active text-success" href="vegetables.php">Organic Vegetables</a></li>
                <li class="nav-item"><a class="nav-link" href="cart.php">🛒 Cart</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item"><a class="nav-link" href="../profile.php">👤 Profile</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="../login.php">🔒 Login</a></li>
                    
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

    <!-- Page Title -->
    <div class="container text-center mt-4">
        <h2 class="text-success">Fresh Organic Vegetables</h2>
        <p class="text-muted">Explore our wide range of fresh and organic vegetables.</p>
    </div>

    <!-- Product Grid -->
    <div class="container">
        <div class="row">
            <?php if ($no_products): ?>
                <div class="col-12 text-center">
                    <p class="text-danger">No organic vegetables available at the moment.</p>
                </div>
            <?php else: ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                        <img src="../uploads/<?php echo htmlspecialchars($row['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($row['name']); ?>">
                            <div class="card-body text-center">
                                <h5 class="card-title"><?php echo htmlspecialchars($row['name']); ?></h5>
                                <p class="card-text text-success">$<?php echo number_format($row['price'], 2); ?></p>
                                <a href="cart.php?add=<?php echo $row['id']; ?>" class="btn btn-success">Add to Cart</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-success text-white text-center p-3 mt-4">
        <p>&copy; 2025 Organix. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
