<?php
// connection.php - Database Connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>

<?php
// install.php - Database and Table Setup
include_once("connection.php");

try {
    $sql = "CREATE DATABASE IF NOT EXISTS library";
    $conn->exec($sql);
    $conn->exec("USE library");
    
    $tables = [
        "CREATE TABLE IF NOT EXISTS tbl_books (
            book_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            title TEXT NOT NULL,
            author TEXT NOT NULL,
            genre TEXT NOT NULL,
            blurb TEXT NOT NULL,
            rating TINYINT(1) NOT NULL,
            t_copies TINYINT(2) NOT NULL,
            a_copies TINYINT(2) NOT NULL,
            cover VARCHAR(255) NOT NULL
        )",
        "CREATE TABLE IF NOT EXISTS tbl_users (
            user_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            forename TEXT NOT NULL,
            surname TEXT NOT NULL,
            address TEXT NOT NULL,
            email TEXT NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            phone_num VARCHAR(11) NOT NULL,
            role TINYINT(1) NOT NULL
        )",
        "CREATE TABLE IF NOT EXISTS tbl_loans (
            loan_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            book_id INT NOT NULL,
            user_id INT NOT NULL,
            return_date VARCHAR(10) NOT NULL,
            returned BOOLEAN NOT NULL,
            rating TINYINT(1),
            review TEXT
        )"
    ];

    foreach ($tables as $table) {
        $conn->exec($table);
    }

    echo "Database and tables created successfully.";
} catch (PDOException $e) {
    die("Error creating database: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form action="authenticate.php" method="post">
            <?php if (isset($_GET['error'])) echo '<p class="error">' . $_GET['error'] . '</p>'; ?>
            <label>Email:</label>
            <input type="email" name="email" required><br>
            <label>Password:</label>
            <input type="password" name="password" required><br>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>

<?php
// authenticate.php - User Authentication
session_start();
include_once("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    
    if (empty($email) || empty($password)) {
        header("Location: login.php?error=Fill in all fields");
        exit();
    }

    $stmt = $conn->prepare("SELECT user_id, forename, password, role FROM tbl_users WHERE email = ?");
    $stmt->bindParam(1, $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["loggedin"] = true;
        $_SESSION["user_id"] = $user["user_id"];
        $_SESSION["forename"] = $user["forename"];
        $_SESSION["role"] = $user["role"];
        header("Location: dashboard.php");
    } else {
        header("Location: login.php?error=Invalid credentials");
    }
}
?>

<?php
// logout.php - Logout Functionality
session_start();
session_destroy();
header("Location: login.php");
exit();
?>

<?php
// dashboard.php - Protected Dashboard Page
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Library - Login</title>
    <link rel="stylesheet" href="style.css"> 
    <link rel="icon" href="library-512.png" type="image/x-icon">
</head>

<body>
    <!-- Header and Nav (same as home page) -->
    <header>
        <nav>
            <div class="logo">
                <a href="index.html" class="logo-link"></a>
                <img src="library-512.png" alt="Library Logo">
            </div>
            <ul class="nav-links">
                <li><a href="index.html">Home</a></li>
                <li><a href="catalogue.html">Catalogue</a></li>
                <li><a href="analytics.html">Analytics</a></li>
                <li><a href="reviews.html">Reviews</a></li>
                <li><a href="fines.html">Fines</a></li>
                <!-- Mark Login as active -->
                <li><a href="login.php" class="active">Login</a></li>
            </ul>
        </nav>
    </header>

    <!-- Optional Intro Section to match home page styling -->
    <section id="home" class="intro-section">
        <h1>The Library</h1>
        <img src="pexels-ivo-rainha-527110-1290141.jpg" alt="Library Intro" class="featured-image">
    </section>

    <!-- Main content area for the login form -->
    <section id="current-cars">
        <div class="inventory-container">
            <div class="inventory-text">
                <h1>Login</h1>
                <div class="inventory-line">
                    <h4>Please enter your credentials below</h4>
                </div>
            </div>
            <div class="stock-gallery">
                <div class="login-form-container"><!-- Add your own styling in style.css -->

                    <!-- Display error if exists (same as original login.php) -->
                    <?php if (!empty($errorMessage)): ?>
                        <p class="error"><?php echo htmlspecialchars($errorMessage); ?></p>
                    <?php endif; ?>

                    <!-- The form action points to your authenticate.php as before -->
                    <form action="authenticate.php" method="post">
                        <label>Email:</label>
                        <input type="email" name="email" required><br>

                        <label>Password:</label>
                        <input type="password" name="password" required><br>

                        <button type="submit">Login</button>
                    </form>
                    <!-- (Optional) Link to register or reset password can go here -->
                </div>
            </div>
        </div>
    </section>

    <!-- Footer (same as home page) -->
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
