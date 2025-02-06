<?php
// connection.php

$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "library";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected Successfully"; // Uncomment for debugging
} catch (PDOException $e) {
    // In production, use a generic error message and log the actual error:
    // error_log($e->getMessage());
    // die("Database connection failed.");
    
    // For development/testing:
    // echo "Connection failed: " . $e->getMessage();
}
