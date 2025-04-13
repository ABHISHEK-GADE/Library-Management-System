<?php
session_start();
include('../config/db_connect.php');

// Ensure librarian is logged in
if (!isset($_SESSION['librarian_id'])) {
    header('Location: login.php');
    exit();
}

// Fetch members from database
$sql = "SELECT * FROM members";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Members List</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">

</head>
<body>
<?php include('../includes/header.php'); ?>

    <div class="container">
        <h2>All Members</h2>
        <a href="add_member.php">➕ Add New Member</a>

        <table border="1">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Membership ID</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['phone']; ?></td>
                <td><?php echo $row['membership_id']; ?></td>
                <td>
                    <a href="edit_member.php?id=<?php echo $row['id']; ?>">✏️ Edit</a>
                    <a href="delete_member.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')">❌ Delete</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>
