<?php
// addbook.php - Add new books (Librarian/Admin Only)
session_start();
include_once("connection.php");

// Ensure only librarians and admins can access
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["role"] < 1) {
    header("Location: login.php");
    exit();
}

$error = "";
$success = "";

// Process form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title    = trim($_POST["title"]);
    $author   = trim($_POST["author"]);
    $genre    = trim($_POST["genre"]);
    $blurb    = trim($_POST["blurb"]);
    $rating   = intval($_POST["rating"]);
    $t_copies = intval($_POST["t_copies"]);
    $a_copies = intval($_POST["a_copies"]);
    $cover    = trim($_POST["cover"]); // Assume image URL or file upload logic

    if (empty($title) || empty($author) || empty($genre) || empty($blurb)) {
        $error = "All fields are required!";
    } else {
        $stmt = $conn->prepare("INSERT INTO tbl_books (title, author, genre, blurb, rating, t_copies, a_copies, cover) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$title, $author, $genre, $blurb, $rating, $t_copies, $a_copies, $cover]);
        $success = "Book added successfully!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Books - The Library</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Add New Book</h1>
    <?php if ($error): ?><p style="color: red;"><?php echo $error; ?></p><?php endif; ?>
    <?php if ($success): ?><p style="color: green;"><?php echo $success; ?></p><?php endif; ?>

    <form method="POST">
        <label>Title:</label><br>
        <input type="text" name="title" required><br><br>

        <label>Author:</label><br>
        <input type="text" name="author" required><br><br>

        <label>Genre:</label><br>
        <input type="text" name="genre" required><br><br>

        <label>Blurb:</label><br>
        <textarea name="blurb" required></textarea><br><br>

        <button type="submit">Add Book</button>
    </form>

    <p><a href="books.php">Back to Books</a></p>
</body>
</html>
