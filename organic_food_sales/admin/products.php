<?php
session_start();
include __DIR__ . '/config.php'; // Ensure correct path

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$result = $conn->query("SELECT * FROM products");

if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h2>Product Management</h2>
    <table>
        <tr><th>Name</th><th>Price</th><th>Stock</th><th>Actions</th></tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row["name"]; ?></td>
            <td><?php echo $row["price"]; ?></td>
            <td><?php echo $row["stock"]; ?></td>
            <td><a href="edit_product.php?id=<?php echo $row["id"]; ?>">Edit</a></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
