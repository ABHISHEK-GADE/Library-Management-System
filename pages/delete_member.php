<?php
session_start();
include('../config/db_connect.php');

// Ensure librarian is logged in
if (!isset($_SESSION['librarian_id'])) {
    header('Location: login.php');
    exit();
}

// Check if member ID is provided
if (isset($_GET['id'])) {
    $member_id = $_GET['id'];

    // Delete member from database
    $sql = "DELETE FROM members WHERE id = $member_id";

    if ($conn->query($sql) === TRUE) {
        header('Location: members.php'); // Redirect to member list
    } else {
        echo "Error deleting member: " . $conn->error;
    }
}
?>
