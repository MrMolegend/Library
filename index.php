<?php include_once("navbar.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Library - Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <section class="intro-section">
        <h1>Welcome to The Library</h1>
        <p>Your one-stop destination for discovering, borrowing, and reviewing books.</p>
        <img src="pexels-ivo-rainha-527110-1290141.jpg" alt="Library Image" class="featured-image">
    </section>

    <section class="library-info">
        <h2>Explore Our Library</h2>
        <p>Browse our extensive collection of books, leave reviews, and manage your borrowed books effortlessly.</p>
        
        <div class="buttons">
            <a href="catalogue.php" class="btn">View Catalogue</a>
            <a href="reviews.php" class="btn">Read Reviews</a>
            <?php if (!isset($_SESSION["loggedin"])): ?>
                <a href="register.php" class="btn">Register</a>
            <?php endif; ?>
        </div>
    </section>

    <section class="featured-books">
        <h2>Popular Books</h2>
        <div class="book-grid">
            <figure class="gallery-item">
                <a href="the-winter-soldier.html">
                    <img src="winter.jpg" alt="The Winter Soldier">
                </a>
                <figcaption>The Winter Soldier</figcaption>
            </figure>
            <figure class="gallery-item">
                <a href="beneath-a-scarlet-sky.html">
                    <img src="scar.jpg" alt="Beneath a Scarlet Sky">
                </a>
                <figcaption>Beneath a Scarlet Sky</figcaption>
            </figure>
            <figure class="gallery-item">
                <a href="the-man-in-the-white-suit.html">
                    <img src="man.jpg" alt="The Man in the White Suit">
                </a>
                <figcaption>The Man in the White Suit</figcaption>
            </figure>
        </div>
    </section>

    <footer>
        <div class="footer-container">
            <div class="footer-item center-item">
                <h1>The Library</h1>
            </div>
        </div>
        <p>&copy; 2024 The Library. All rights reserved.</p>
    </footer>
</body>
</html>
