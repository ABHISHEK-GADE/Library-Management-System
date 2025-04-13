<?php
// Include the database connection
include('config/db_connect.php');

// Sample librarian details
$librarian_name = "Varad";
$librarian_email = "varad@librarian.in";
$librarian_password = "varad123"; // The actual password

// Hash the password
$hashed_password = password_hash($librarian_password, PASSWORD_BCRYPT);

// Insert the librarian into the database
$sql = "INSERT INTO librarians (name, email, password) VALUES ('$librarian_name', '$librarian_email', '$hashed_password')";

if ($conn->query($sql) === TRUE) {
    echo "New librarian added successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
