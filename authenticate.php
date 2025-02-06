<?php
// authenticate.php
session_start();
include_once("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // Basic validation
    if (empty($email) || empty($password)) {
        header("Location: login.php?error=" . urlencode("Fill in all fields"));
        exit();
    }

    // Check user
    $stmt = $conn->prepare("SELECT user_id, forename, password, role FROM tbl_users WHERE email = ?");
    $stmt->bindParam(1, $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user["password"])) {
        // Valid login
        $_SESSION["loggedin"] = true;
        $_SESSION["user_id"]  = $user["user_id"];
        $_SESSION["forename"] = $user["forename"];
        $_SESSION["role"]     = $user["role"];

        // Redirect to dashboard or wherever
        header("Location: dashboard.php");
        exit();
    } else {
        // Invalid login
        header("Location: login.php?error=" . urlencode("Invalid credentials"));
        exit();
    }
}
