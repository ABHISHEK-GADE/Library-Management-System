<?php
session_start();
include('../config/db_connect.php');

// Ensure librarian is logged in
if (!isset($_SESSION['librarian_id'])) {
    header('Location: login.php');
    exit();
}

// Handle form submission
if (isset($_POST['add_book'])) {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $isbn = $_POST['isbn'];
    $publisher = $_POST['publisher'];
    $year = $_POST['year'];
    $category = $_POST['category'];
    $copies = $_POST['copies'];

    // Handle file upload (book cover)
    $cover_image = '';
    if ($_FILES['cover_image']['name']) {
        $target_dir = "../assets/images/";
        $cover_image = basename($_FILES["cover_image"]["name"]);
        $target_file = $target_dir . $cover_image;
        move_uploaded_file($_FILES["cover_image"]["tmp_name"], $target_file);
    }

    // Insert into database
    $sql = "INSERT INTO books (title, author, isbn, publisher, year, category, copies, cover_image) 
            VALUES ('$title', '$author', '$isbn', '$publisher', '$year', '$category', '$copies', '$cover_image')";

    if ($conn->query($sql) === TRUE) {
        $success_message = "Book added successfully!";
    } else {
        $error_message = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Book</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">

</head>
<body>
<?php include('../includes/header.php'); ?>

    <div class="container">
        <h2>Add New Book</h2>

        <?php
        if (isset($success_message)) {
            echo "<p style='color: green;'>$success_message</p>";
        } elseif (isset($error_message)) {
            echo "<p style='color: red;'>$error_message</p>";
        }
        ?>

        <form action="add_book.php" method="POST" enctype="multipart/form-data">
            <label>Title:</label>
            <input type="text" name="title" required>

            <label>Author:</label>
            <input type="text" name="author" required>

            <label>ISBN:</label>
            <input type="text" name="isbn" required>

            <label>Publisher:</label>
            <input type="text" name="publisher">

            <label>Year:</label>
            <input type="number" name="year" required>

            <label>Category:</label>
            <input type="text" name="category" required>

            <label>Number of Copies:</label>
            <input type="number" name="copies" required>

            <label>Book Cover Image:</label>
            <input type="file" name="cover_image">

            <button type="submit" name="add_book">Add Book</button>
        </form>

        <br>
        <a href="books.php">Back to Book List</a>
    </div>
</body>
</html>
