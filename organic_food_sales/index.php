<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organix - Organic Food Store</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>
<body>
    <header>
        <div class="top-bar">
            <p>admin@gmail.com | + (91) 9579883606| Contact us</p>
        </div>
        <nav class="navbar">
    <div class="logo">
        <a href="index.php"><img src="images/logo.png" alt="Organix Logo"></a>
    </div>
    <ul class="nav-links">
        <li><a href="index.php">Home</a></li>
        <li><a href="vegitables/vegetables.php">Organic Vegetable</a></li>
        <li><a href="products.php">Import organic food</a></li>
        <li><a href="products.php">Organic Fruits</a></li>
        
    </ul>
    <div class="nav-icons">
    <a href="cart.php">🛒 Cart</a>
    <?php if (isset($_SESSION['user_id'])): ?>
        <a href="profile.php">👤 Profile</a>
        <a href="logout.php">🚪 Logout</a>
    <?php else: ?>
        <a href="login.php">🔒 Login</a>
    <?php endif; ?>
</div>

</nav>

    </header>
    <main>
        <section class="hero">
            <h1>The Most Healthy Organic Foods</h1>
            <p>Fresh, organic, and delivered to your doorstep.</p>
            <a href="shop.php" class="btn">Shop Now</a>
        </section>
    </main>
    <footer>
        <p>&copy; 2025 Organix. All rights reserved.</p> supported by all people <br>and sell the product this side</footer></footer>
    </footer>
</body>
</html>