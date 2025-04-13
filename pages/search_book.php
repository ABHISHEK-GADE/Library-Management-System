<?php
session_start();
include('../config/db_connect.php');

// Ensure librarian is logged in
if (!isset($_SESSION['librarian_id'])) {
    header('Location: login.php');
    exit();
}

// Get search keyword
$search = isset($_GET['q']) ? $_GET['q'] : '';

// Fetch matching books
$sql = "SELECT * FROM books WHERE 
        title LIKE '%$search%' OR 
        author LIKE '%$search%' OR 
        category LIKE '%$search%' OR 
        isbn LIKE '%$search%'";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Books</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">
</head>
<body>
<?php include('../includes/header.php'); ?>

    <div class="container">
        <h2>Search Books</h2>

        <form action="search_book.php" method="GET">
            <input type="text" name="q" placeholder="Search by title, author, category, or ISBN" value="<?php echo $search; ?>" required>
            <button type="submit">Search</button>
        </form>

        <table border="1">
            <tr>
                <th>Cover</th>
                <th>Title</th>
                <th>Author</th>
                <th>ISBN</th>
                <th>Category</th>
                <th>Copies</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><img src="../assets/images/<?php echo $row['cover_image']; ?>" width="50"></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['author']; ?></td>
                <td><?php echo $row['isbn']; ?></td>
                <td><?php echo $row['category']; ?></td>
                <td><?php echo $row['copies']; ?></td>
                <td>
                    <a href="edit_book.php?id=<?php echo $row['id']; ?>">✏️ Edit</a>
                    <a href="delete_book.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')">❌ Delete</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>
