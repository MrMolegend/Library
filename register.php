<?php
// register.php

// If you want to show errors
$error = "";
$success = "";

// Process form if submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once("connection.php");

    $forename = trim($_POST["forename"]);
    $surname  = trim($_POST["surname"]);
    $email    = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // Basic validation
    if (empty($forename) || empty($surname) || empty($email) || empty($password)) {
        $error = "All fields are required!";
    } else {
        // Check if user with this email already exists
        $checkQuery = $conn->prepare("SELECT user_id FROM tbl_users WHERE email = ?");
        $checkQuery->bindParam(1, $email);
        $checkQuery->execute();

        if ($checkQuery->rowCount() > 0) {
            $error = "Email is already registered!";
        } else {
            // Hash password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insert new user
            $stmt = $conn->prepare("INSERT INTO tbl_users (forename, surname, email, password) VALUES (?, ?, ?, ?)");
            $stmt->execute([$forename, $surname, $email, $hashedPassword]);

            $success = "Registration successful! You can now <a href='login.php'>log in</a>.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - The Library</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Register</h2>
    <?php if ($error): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <?php if ($success): ?>
        <p style="color: green;"><?php echo $success; ?></p>
    <?php endif; ?>

    <form method="POST" action="register.php">
        <label>Forename:</label><br>
        <input type="text" name="forename" required><br><br>

        <label>Surname:</label><br>
        <input type="text" name="surname" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Register</button>
    </form>
</body>
</html>
