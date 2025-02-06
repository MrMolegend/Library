<?php
// addbook.php - Add new books (Librarian/Admin Only)
session_start();
include_once("connection.php");

// Ensure only librarians and admins can access
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["role"] < 1) {
    header("Location: login.php");
    exit();
}

<<<<<<< HEAD
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
=======
$stmt = $conn->prepare("SELECT t_copies, a_copies FROM tbl_books WHERE title = :title AND author = :author");
$stmt->bindParam(':title', $_POST["title"]);
$stmt->bindParam(':author', $_POST["author"]);
$stmt->execute();
$book = $stmt->fetch(PDO::FETCH_ASSOC);

if ($book) {
    $new_t_copies = $book['t_copies'] + 1;
    $new_a_copies = $book['a_copies'] + 1;

    $update_stmt = $conn->prepare("UPDATE tbl_books SET t_copies = :t_copies, a_copies = :a_copies WHERE title = :title AND author = :author");
    $update_stmt->bindParam(':t_copies', $new_t_copies);
    $update_stmt->bindParam(':a_copies', $new_a_copies);
    $update_stmt->bindParam(':title', $_POST["title"]);
    $update_stmt->bindParam(':author', $_POST["author"]);
    $update_stmt->execute();
} else {
    $stmt = $conn->prepare("INSERT INTO tbl_books (book_id, title, author, genre, blurb, rating, t_copies, a_copies, cover)
    VALUES (null, :title, :author, :genre, :blurb, :rating, 1, 1, :cover)");

    $stmt->bindParam(':title', $_POST["title"]);
    $stmt->bindParam(':author', $_POST["author"]);
    $stmt->bindParam(':genre', $_POST["genre"]);
    $stmt->bindParam(':blurb', $_POST["blurb"]);
    $stmt->bindParam(':rating', $_POST["rating"]);
    $stmt->bindParam(':cover', $_FILES["cover"]["name"]);
    $stmt->execute();
}

$target_dir = "images/";
    print_r($_FILES);
    $target_file = $target_dir . basename($_FILES["cover"]["name"]);
    $target_dir = "images/";
    $original_file = $_FILES["cover"]["tmp_name"];
    $original_filename = basename($_FILES["cover"]["name"]);
    $target_file = $target_dir . $original_filename;
    $new_file_name = $target_dir . $_POST["title"] . "." . strtolower(pathinfo($original_filename, PATHINFO_EXTENSION));
    echo $target_file;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    if (move_uploaded_file($original_file, $target_file)) {
        if (rename($target_file, $new_file_name)) {
            echo "The file " . htmlspecialchars($_POST["title"]) . " has been uploaded and renamed.";
        } else {
            echo "The file was uploaded, but renaming failed.";
        }
>>>>>>> 4dec44dd7a4b3d3d3f41a4f1845c05ef27907ccd
    } else {
        $stmt = $conn->prepare("INSERT INTO tbl_books (title, author, genre, blurb, rating, t_copies, a_copies, cover) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$title, $author, $genre, $blurb, $rating, $t_copies, $a_copies, $cover]);
        $success = "Book added successfully!";
    }
<<<<<<< HEAD
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
=======
$conn=null;
?>
>>>>>>> 4dec44dd7a4b3d3d3f41a4f1845c05ef27907ccd
