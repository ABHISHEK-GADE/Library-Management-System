<?php
session_start();
include('../config/db_connect.php');

// Ensure librarian is logged in
if (!isset($_SESSION['librarian_id'])) {
    header('Location: login.php');
    exit();
}

// Check if book ID is provided
if (isset($_GET['id'])) {
    $book_id = $_GET['id'];

    // Delete book
    $sql = "DELETE FROM books WHERE id = $book_id";
    if ($conn->query($sql) === TRUE) {
        header('Location: books.php');
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>
