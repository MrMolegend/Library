<?php
// users.php - Manage users (Admin Only)
session_start();
include_once("connection.php");

// Ensure only admins can access this page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["role"] != 2) {
    header("Location: login.php");
    exit();
}

// Handle User Deletion
if (isset($_GET['delete'])) {
    $userId = intval($_GET['delete']);
    $stmt = $conn->prepare("DELETE FROM tbl_users WHERE user_id = ?");
    $stmt->execute([$userId]);
    header("Location: users.php");
    exit();
}

// Handle Role Updates
if (isset($_POST['update_role'])) {
    $userId = intval($_POST['user_id']);
    $newRole = intval($_POST['role']);
    $stmt = $conn->prepare("UPDATE tbl_users SET role = ? WHERE user_id = ?");
    $stmt->execute([$newRole, $userId]);
    header("Location: users.php");
    exit();
}

// Fetch all users
$stmt = $conn->prepare("SELECT * FROM tbl_users ORDER BY role DESC, forename ASC");
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Users - The Library</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Manage Users</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo $user['user_id']; ?></td>
                <td><?php echo htmlspecialchars($user['forename'] . " " . $user['surname']); ?></td>
                <td><?php echo htmlspecialchars($user['email']); ?></td>
                <td>
                    <form method="post" action="users.php">
                        <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                        <select name="role" onchange="this.form.submit()">
                            <option value="0" <?php echo $user['role'] == 0 ? "selected" : ""; ?>>User</option>
                            <option value="1" <?php echo $user['role'] == 1 ? "selected" : ""; ?>>Librarian</option>
                            <option value="2" <?php echo $user['role'] == 2 ? "selected" : ""; ?>>Admin</option>
                        </select>
                        <input type="hidden" name="update_role" value="1">
                    </form>
                </td>
                <td>
                    <?php if ($user['role'] != 2): ?> 
                        <a href="users.php?delete=<?php echo $user['user_id']; ?>" onclick="return confirm('Are you sure?');">Delete</a>
                    <?php else: ?>
                        Admin
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <p><a href="dashboard.php">Back to Dashboard</a></p>
</body>
</html>
