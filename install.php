<?php

$servername = 'localhost';
$username = 'root';
$password= '';
//note no Database mentioned here!!

$conn = new PDO("mysql:host=$servername", $username, $password);
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "CREATE DATABASE IF NOT EXISTS library";
$conn->exec($sql);
//next 3 lines optional only needed really if you want to go on an do more SQL here!
$sql = "USE library";
$conn->exec($sql);
echo "DB created successfully";


$statement=$conn->prepare("
DROP TABLE IF EXISTS tbl_books;
CREATE TABLE tbl_books
(book_id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
title TEXT NOT NULL,
author TEXT NOT NULL,
genre TEXT NOT NULL,
blurb TEXT NOT NULL,
rating TINYINT(1) NOT NULL,
t_copies TINYINT(2) NOT NULL,
a_copies TINYINT(2) NOT NULL,
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
returned BOOLEAN NOT NULL,
rating TINYINT(1),
review TEXT);
");

$statement->execute();
$statement->closeCursor();


$statement=$conn->prepare("
DROP TABLE IF EXISTS tbl_reviews;
CREATE TABLE tbl_reviews
(review_id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
book_id INT(5) NOT NULL,
user_id INT(5) NOT NULL,
username TEXT NOT NULL,
review TEXT NOT NULL,
rating TINYINT(1) NOT NULL);
");

$statement->execute();
$statement->closeCursor();

?>