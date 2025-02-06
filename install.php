<?php
// install.php - Set up initial database structure

include_once("connection.php");

try {
    // Create database if it doesn’t exist (optional if created manually)
    $conn->exec("CREATE DATABASE IF NOT EXISTS library");
    // Select the database
    $conn->exec("USE library");

    // SQL statements to create tables
    $tables = [
        "CREATE TABLE IF NOT EXISTS tbl_users (
            user_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            forename VARCHAR(100) NOT NULL,
            surname VARCHAR(100) NOT NULL,
            email VARCHAR(150) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            role TINYINT(1) NOT NULL DEFAULT 0
        )",
        "CREATE TABLE IF NOT EXISTS tbl_books (
            book_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(255) NOT NULL,
            author VARCHAR(255) NOT NULL,
            genre VARCHAR(100) NOT NULL,
            blurb TEXT NOT NULL,
            rating TINYINT(1) NOT NULL,
            t_copies TINYINT(2) NOT NULL,
            a_copies TINYINT(2) NOT NULL,
            cover VARCHAR(255) NOT NULL
        )",
        "CREATE TABLE IF NOT EXISTS tbl_loans (
            loan_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            book_id INT NOT NULL,
            user_id INT NOT NULL,
            loan_date DATE NOT NULL,
            return_date DATE NOT NULL,
            returned BOOLEAN NOT NULL DEFAULT 0,
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
