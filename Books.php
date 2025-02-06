<<<<<<< HEAD
<?php
// books.php - View and manage books
session_start();
include_once("connection.php");

// Ensure only logged-in users can access
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.php");
    exit();
}

// Handle book deletion (Admins/Librarians only)
if (isset($_GET['delete']) && ($_SESSION["role"] >= 1)) {
    $bookId = intval($_GET['delete']);
    $stmt = $conn->prepare("DELETE FROM tbl_books WHERE book_id = ?");
    $stmt->execute([$bookId]);
    header("Location: books.php");
    exit();
}

// Fetch all books
$stmt = $conn->prepare("SELECT * FROM tbl_books ORDER BY title ASC");
$stmt->execute();
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

=======
>>>>>>> 4dec44dd7a4b3d3d3f41a4f1845c05ef27907ccd
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Books - The Library</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Library Catalogue</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Author</th>
            <th>Genre</th>
            <th>Rating</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($books as $book): ?>
            <tr>
                <td><?php echo $book['book_id']; ?></td>
                <td><?php echo htmlspecialchars($book['title']); ?></td>
                <td><?php echo htmlspecialchars($book['author']); ?></td>
                <td><?php echo htmlspecialchars($book['genre']); ?></td>
                <td><?php echo $book['rating']; ?>/5</td>
                <td>
                    <?php if ($_SESSION["role"] >= 1): ?> 
                        <a href="books.php?delete=<?php echo $book['book_id']; ?>" onclick="return confirm('Are you sure?');">Delete</a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <p><a href="dashboard.php">Back to Dashboard</a></p>
</body>
</html>