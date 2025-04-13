<?php
session_start();
include('../config/db_connect.php');

// Ensure librarian is logged in
if (!isset($_SESSION['librarian_id'])) {
    header('Location: login.php');
    exit();
}

// Check if issue ID is provided
if (!isset($_GET['id'])) {
    header('Location: issued_books.php');
    exit();
}

$issue_id = $_GET['id'];

// Fetch book issue details
$sql = "SELECT * FROM issued_books WHERE id = $issue_id";
$result = $conn->query($sql);
$issue = $result->fetch_assoc();

$return_date = $issue['return_date'];
$current_date = date('Y-m-d');

// Calculate fine (₹5 per day)
$days_late = max((strtotime($current_date) - strtotime($return_date)) / (60 * 60 * 24), 0);
$fine = $days_late * 5;

// Update record
$sql = "UPDATE issued_books SET status='returned', fine='$fine' WHERE id=$issue_id";
$conn->query($sql);

// Redirect back
header('Location: issued_books.php');
?>
