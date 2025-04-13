<?php
session_start();
include('../config/db_connect.php');

// Ensure librarian is logged in
if (!isset($_SESSION['librarian_id'])) {
    header('Location: login.php');
    exit();
}

// Handle form submission
if (isset($_POST['add_member'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $membership_id = $_POST['membership_id'];

    // Insert into database
    $sql = "INSERT INTO members (name, email, phone, address, membership_id) 
            VALUES ('$name', '$email', '$phone', '$address', '$membership_id')";

    if ($conn->query($sql) === TRUE) {
        $success_message = "Member added successfully!";
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
    <title>Add New Member</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">

</head>
<body>
<?php include('../includes/header.php'); ?>

    <div class="container">
        <h2>Add New Member</h2>

        <?php
        if (isset($success_message)) {
            echo "<p style='color: green;'>$success_message</p>";
        } elseif (isset($error_message)) {
            echo "<p style='color: red;'>$error_message</p>";
        }
        ?>

        <form action="add_member.php" method="POST">
            <label>Name:</label>
            <input type="text" name="name" required>

            <label>Email:</label>
            <input type="email" name="email" required>

            <label>Phone:</label>
            <input type="text" name="phone" required>

            <label>Address:</label>
            <textarea name="address" required></textarea>

            <label>Membership ID:</label>
            <input type="text" name="membership_id" required>

            <button type="submit" name="add_member">Add Member</button>
        </form>

        <br>
        <a href="members.php">Back to Members List</a>
    </div>
</body>
</html>
