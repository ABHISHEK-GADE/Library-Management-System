<?php
session_start();
include('../config/db_connect.php');

// Ensure librarian is logged in
if (!isset($_SESSION['librarian_id'])) {
    header('Location: login.php');
    exit();
}

// Get member ID
if (!isset($_GET['id'])) {
    header('Location: members.php');
    exit();
}

$member_id = $_GET['id'];

// Fetch member details
$sql = "SELECT * FROM members WHERE id = $member_id";
$result = $conn->query($sql);
if ($result->num_rows == 0) {
    header('Location: members.php');
    exit();
}
$member = $result->fetch_assoc();

// Handle form submission
if (isset($_POST['update_member'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $membership_id = $_POST['membership_id'];

    // Update database
    $sql = "UPDATE members SET name='$name', email='$email', phone='$phone', address='$address', membership_id='$membership_id' 
            WHERE id=$member_id";

    if ($conn->query($sql) === TRUE) {
        header('Location: members.php');
    } else {
        $error_message = "Error updating member: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Member</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">

</head>
<body>
<?php include('../includes/header.php'); ?>

    <div class="container">
        <h2>Edit Member</h2>

        <?php if (isset($error_message)) { echo "<p style='color: red;'>$error_message</p>"; } ?>

        <form action="edit_member.php?id=<?php echo $member_id; ?>" method="POST">
            <label>Name:</label>
            <input type="text" name="name" value="<?php echo $member['name']; ?>" required>

            <label>Email:</label>
            <input type="email" name="email" value="<?php echo $member['email']; ?>" required>

            <label>Phone:</label>
            <input type="text" name="phone" value="<?php echo $member['phone']; ?>" required>

            <label>Address:</label>
            <textarea name="address" required><?php echo $member['address']; ?></textarea>

            <label>Membership ID:</label>
            <input type="text" name="membership_id" value="<?php echo $member['membership_id']; ?>" required>

            <button type="submit" name="update_member">Update Member</button>
        </form>

        <br>
        <a href="members.php">Back to Members List</a>
    </div>
</body>
</html>
