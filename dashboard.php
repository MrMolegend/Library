<?php
// dashboard.php
session_start();

// If user not logged in, redirect to login
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - The Library</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION["forename"]); ?>!</h1>
    <p>Your role: 
        <?php
        // Example: 0=User, 1=Librarian, 2=Admin
        switch ($_SESSION["role"]) {
            case 0: echo "User"; break;
            case 1: echo "Librarian"; break;
            case 2: echo "Admin"; break;
            default: echo "Unknown"; break;
        }
        ?>
    </p>

    <!-- Example protected content -->
    <p>This is a protected dashboard page. You can show analytics, books to manage, etc.</p>

    <p><a href="logout.php">Logout</a></p>
</body>
</html>
