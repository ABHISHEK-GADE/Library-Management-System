<?php
session_start();

// If the librarian is already logged in, redirect to the dashboard
if (isset($_SESSION['librarian_id'])) {
    header('Location: pages/index.php');
    exit();
} else {
    // Redirect to login page
    header('Location: pages/login.php');
    exit();
}
?>
