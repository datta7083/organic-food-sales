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
    <footer class="footer bg-dark text-white mt-5">
    <div class="container">
        <div class="row pt-4">
            <div class="col-md-3">
                <h5>Get to Know Us</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-white">About Us</a></li>
                    <li><a href="#" class="text-white">Careers</a></li>
                    <li><a href="#" class="text-white">Press Releases</a></li>
                    <li><a href="#" class="text-white">Our Science</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h5>Connect with Us</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-white">Facebook</a></li>
                    <li><a href="#" class="text-white">Twitter</a></li>
                    <li><a href="#" class="text-white">Instagram</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h5>Make Money with Us</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-white">Sell on Our Platform</a></li>
                    <li><a href="#" class="text-white">Advertise Your Products</a></li>
                    <li><a href="#" class="text-white">Become an Affiliate</a></li>
                    <li><a href="#" class="text-white">Fulfillment Services</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h5>Let Us Help You</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-white">Your Account</a></li>
                    <li><a href="#" class="text-white">Returns</a></li>
                    <li><a href="#" class="text-white">Customer Support</a></li>
                    <li><a href="#" class="text-white">Download Our App</a></li>
                </ul>
            </div>
        </div>

        <hr class="border-white">

        <div class="text-center py-3">
            <a href="#" class="text-white">Back to top</a>
        </div>

        <div class="text-center">
            <img src="logo.png" alt="Logo" height="40">
        </div>

        <div class="text-center mt-3">
            <button class="btn btn-outline-light btn-sm">🌍 English</button>
            <button class="btn btn-outline-light btn-sm">🇮🇳 India</button>
        </div>

        <div class="text-center mt-3 pb-3">
            <p class="mb-0">&copy; 2025 Organic. All rights reserved.</p>
        </div>
    </div>
</footer>

</body>
</html>