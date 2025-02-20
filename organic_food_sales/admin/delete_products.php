<?php
session_start();
include_once('../config.php');

if (!isset($_SESSION['admin'])) {
    header("Location: adminlogin.php");
    exit();
}

if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']); // Convert ID to integer for security

    // Delete product from database
    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param("i", $product_id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Product deleted successfully!";
    } else {
        $_SESSION['message'] = "Error deleting product!";
    }

    $stmt->close();
    $conn->close();
}

header("Location: manage_products.php");
exit();
?>
