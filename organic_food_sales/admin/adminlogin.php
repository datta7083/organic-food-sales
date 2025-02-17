<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../config.php'; // Ensure this file does not output anything before session_start()

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Prepare the SQL statement
    $stmt = $conn->prepare("SELECT password FROM admin WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['admin'] = $username;

            // Debugging output
            echo "<script>console.log('Redirecting to dashboard.php');</script>";

            header("Location: dashboard.php");
            exit(); // Ensure script stops execution
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "Invalid username.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        <form id="loginForm" action="adminlogin.php" method="POST">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Login</button>
        </form>
        <?php if (isset($error)): ?>
            <p id="errorMessage"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
    </div>
</body>
<style>
    body {
    font-family: Arial, sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
    background-color: #f4f4f4;
}

.login-container {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 300px;
    text-align: center;
}

h2 {
    margin-bottom: 20px;
}

label {
    display: block;
    text-align: left;
    margin-bottom: 5px;
}

input[type="text"],
input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

button {
    width: 100%;
    padding: 10px;
    background-color: #28a745;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: #218838;
}

#errorMessage {
    color: red;
    margin-top: 10px;
}

</style>
<script>
    document.getElementById('loginForm').addEventListener('submit', function(event) {
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
    var errorMessage = '';

    if (username.trim() === '') {
        errorMessage = 'Username is required.';
    } else if (password.trim() === '') {
        errorMessage = 'Password is required.';
    }

    if (errorMessage) {
        event.preventDefault();
        document.getElementById('errorMessage').textContent = errorMessage;
    }
});

</script>
</html>
