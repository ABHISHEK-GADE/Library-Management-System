<?php
session_start();
include('../config/db_connect.php');

// Ensure librarian is logged in
if (!isset($_SESSION['librarian_id'])) {
    header('Location: login.php');
    exit();
}

// Check if book ID is provided
if (!isset($_GET['id'])) {
    header('Location: books.php');
    exit();
}

$book_id = $_GET['id'];

// Fetch book details
$sql = "SELECT * FROM books WHERE id = $book_id";
$result = $conn->query($sql);
if ($result->num_rows == 0) {
    header('Location: books.php');
    exit();
}
$book = $result->fetch_assoc();

// Handle form submission
if (isset($_POST['update_book'])) {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $isbn = $_POST['isbn'];
    $publisher = $_POST['publisher'];
    $year = $_POST['year'];
    $category = $_POST['category'];
    $copies = $_POST['copies'];

    // Handle file upload (if a new cover is uploaded)
    $cover_image = $book['cover_image'];
    if ($_FILES['cover_image']['name']) {
        $target_dir = "../assets/images/";
        $cover_image = basename($_FILES["cover_image"]["name"]);
        $target_file = $target_dir . $cover_image;
        move_uploaded_file($_FILES["cover_image"]["tmp_name"], $target_file);
    }

    // Update book details
    $sql = "UPDATE books SET 
                title='$title', author='$author', isbn='$isbn', publisher='$publisher', 
                year='$year', category='$category', copies='$copies', cover_image='$cover_image'
            WHERE id=$book_id";

    if ($conn->query($sql) === TRUE) {
        header('Location: books.php');
    } else {
        $error_message = "Error updating book: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">

</head>
<body>
<?php include('../includes/header.php'); ?>

    <div class="container">
        <h2>Edit Book</h2>

        <?php if (isset($error_message)) { echo "<p style='color: red;'>$error_message</p>"; } ?>

        <form action="edit_book.php?id=<?php echo $book_id; ?>" method="POST" enctype="multipart/form-data">
            <label>Title:</label>
            <input type="text" name="title" value="<?php echo $book['title']; ?>" required>

            <label>Author:</label>
            <input type="text" name="author" value="<?php echo $book['author']; ?>" required>

            <label>ISBN:</label>
            <input type="text" name="isbn" value="<?php echo $book['isbn']; ?>" required>

            <label>Publisher:</label>
            <input type="text" name="publisher" value="<?php echo $book['publisher']; ?>">

            <label>Year:</label>
            <input type="number" name="year" value="<?php echo $book['year']; ?>" required>

            <label>Category:</label>
            <input type="text" name="category" value="<?php echo $book['category']; ?>" required>

            <label>Number of Copies:</label>
            <input type="number" name="copies" value="<?php echo $book['copies']; ?>" required>

            <label>Current Cover:</label><br>
            <img src="../assets/images/<?php echo $book['cover_image']; ?>" width="100"><br><br>

            <label>Upload New Cover (optional):</label>
            <input type="file" name="cover_image">

            <button type="submit" name="update_book">Update Book</button>
        </form>

        <br>
        <a href="books.php">Back to Book List</a>
    </div>
</body>
</html>
