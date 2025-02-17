<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch current details
$stmt = $conn->prepare("SELECT name, email FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($name, $email);
$stmt->fetch();
$stmt->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_name = $_POST['name'];
    $new_email = $_POST['email'];

    $update_stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE email = ? AND id != ?;
        if ($stmt->fetchColumn() > 0) {
            die("Email already in use. Please choose another.");
        }
        UPDATE users SET name = ?, email = ? WHERE id = ?");
    $update_stmt->bind_param("ssi", $new_name, $new_email, $user_id);

    if ($update_stmt->execute()) {
        $_SESSION['success'] = "Profile updated successfully!";
        header("Location: profile.php");
        exit();
    } else {
        $error = "Update failed!";
    }
    $update_stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - Organix</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="profile-container">
        <h2>Edit Profile</h2>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form action="edit-profile.php" method="POST">
            <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
            <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            <button type="submit">Update Profile</button>
        </form>
        <a href="profile.php" class="btn">Back to Profile</a>
    </div>
</body>
</html>
