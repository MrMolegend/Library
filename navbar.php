<?php session_start(); ?>
<header>
    <nav>
        <div class="logo">
            <a href="index.php" class="logo-link"></a>
            <img src="library-512.png" alt="Library Logo">
        </div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="catalogue.php">Catalogue</a></li>
            <li><a href="reviews.php">Reviews</a></li>
            <li><a href="fines.php">Fines</a></li>
            
            <?php if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true): ?>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="logout.php">Logout</a></li>
            <?php else: ?>
                <li><a href="login.php">Login</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
