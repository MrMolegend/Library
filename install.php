
<?php
// install.php - Set up initial database structure

include_once("connection.php");

<<<<<<< HEAD
try {
    // Create database if it doesn’t exist (optional if created manually)
    $conn->exec("CREATE DATABASE IF NOT EXISTS library");
    // Select the database
    $conn->exec("USE library");
=======
$conn = new PDO("mysql:host=$servername", $username, $password);
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "CREATE DATABASE IF NOT EXISTS library";
$conn->exec($sql);
//next 3 lines optional only needed really if you want to go on an do more SQL here!
$sql = "USE library";
$conn->exec($sql);
echo "DB created successfully";
>>>>>>> 4dec44dd7a4b3d3d3f41a4f1845c05ef27907ccd

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

<<<<<<< HEAD
    foreach ($tables as $table) {
        $conn->exec($table);
    }

    echo "Database and tables created successfully.";
} catch (PDOException $e) {
    die("Error creating database: " . $e->getMessage());
}
=======
$statement=$conn->prepare("
DROP TABLE IF EXISTS tbl_books;
CREATE TABLE tbl_books
(book_id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
title TEXT NOT NULL,
author TEXT NOT NULL,
genre TEXT NOT NULL,
blurb TEXT NOT NULL,
rating TINYINT(1) NOT NULL,
t_copies TINYINT(2) ,
a_copies TINYINT(2) ,
cover VARCHAR(255) NOT NULL);
");

$statement->execute();
$statement->closeCursor();


$statement=$conn->prepare("
DROP TABLE IF EXISTS tbl_users;
CREATE TABLE tbl_users
(user_id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
forename TEXT NOT NULL,
surname TEXT NOT NULL,
address TEXT NOT NULL,
email TEXT NOT NULL,
password VARCHAR(200) NOT NULL,
phone_num VARCHAR(11) NOT NULL,
role TINYINT(1) NOT NULL);
");

$statement->execute();
$statement->closeCursor();

$statement=$conn->prepare("
DROP TABLE IF EXISTS tbl_loans;
CREATE TABLE tbl_loans
(loan_id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
book_id INT(5) NOT NULL,
user_id INT(5) NOT NULL,
return_date VARCHAR(10) NOT NULL,
returned BOOLEAN NOT NULL);
");

$statement->execute();
$statement->closeCursor();


##$statement=$conn->prepare("
##DROP TABLE IF EXISTS tbl_reviews;
##CREATE TABLE tbl_reviews
#(review_id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
#book_id INT(5) NOT NULL,
#user_id INT(5) NOT NULL,
#email TEXT NOT NULL,
#review TEXT NOT NULL,
#rating TINYINT(1) NOT NULL);
#");

#$statement->execute();
#$statement->closeCursor();

?>
>>>>>>> 4dec44dd7a4b3d3d3f41a4f1845c05ef27907ccd
