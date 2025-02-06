<?php
// add_users.php - Add new users (Admin Only)
session_start();
include_once("connection.php");

// Ensure only admins can access this page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["role"] != 2) {
    header("Location: login.php");
    exit();
}

$error = "";
$success = "";

// Process form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $forename = trim($_POST["forename"]);
    $surname  = trim($_POST["surname"]);
    $email    = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $role     = intval($_POST["role"]);

    if (empty($forename) || empty($surname) || empty($email) || empty($password)) {
        $error = "All fields are required!";
    } else {
        // Check if email is already registered
        $stmt = $conn->prepare("SELECT user_id FROM tbl_users WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->rowCount() > 0) {
            $error = "Email is already registered!";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO tbl_users (forename, surname, email, password, role) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$forename, $surname, $email, $hashedPassword, $role]);
            $success = "User added successfully!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Users - The Library</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Add New User</h1>
    <?php if ($error): ?><p style="color: red;"><?php echo $error; ?></p><?php endif; ?>
    <?php if ($success): ?><p style="color: green;"><?php echo $success; ?></p><?php endif; ?>

    <form method="POST">
        <label>Forename:</label><br>
        <input type="text" name="forename" required><br><br>

        <label>Surname:</label><br>
        <input type="text" name="surname" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <label>Role:</label><br>
        <select name="role">
            <option value="0">User</option>
            <option value="1">Librarian</option>
            <option value="2">Admin</option>
        </select><br><br>

        <button type="submit">Add User</button>
    </form>

    <p><a href="users.php">Back to User Management</a></p>
</body>
</html>
