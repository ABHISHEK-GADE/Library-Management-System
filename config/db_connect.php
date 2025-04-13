<?php
$servername = "localhost"; // Use localhost if using XAMPP/WAMP
$username = "root";       // Default MySQL username
$password = "";           // Default MySQL password (leave blank for XAMPP)
$dbname = "library_db";   // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
