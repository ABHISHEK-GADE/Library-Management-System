<?php
session_start();
include('../config/db_connect.php');

// Ensure librarian is logged in
if (!isset($_SESSION['librarian_id'])) {
    header('Location: login.php');
    exit();
}

// Fetch issued books
$sql = "SELECT issued_books.*, books.title AS book_title, members.name AS member_name 
        FROM issued_books
        JOIN books ON issued_books.book_id = books.id
        JOIN members ON issued_books.member_id = members.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Issued Books</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">

</head>
<body>
<?php include('../includes/header.php'); ?>

    <div class="container">
        <h2>Issued Books</h2>
        <a href="issue_book.php">Issue New Book</a>
        
        <table border="1">
            <tr>
                <th>Book</th>
                <th>Member</th>
                <th>Issue Date</th>
                <th>Return Date</th>
                <th>Status</th>
                <th>Fine</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['book_title']; ?></td>
                <td><?php echo $row['member_name']; ?></td>
                <td><?php echo $row['issue_date']; ?></td>
                <td><?php echo $row['return_date']; ?></td>
                <td><?php echo ucfirst($row['status']); ?></td>
                <td><?php echo $row['fine']; ?></td>
                <td>
                    <?php if ($row['status'] == 'issued') { ?>
                        <a href="return_book.php?id=<?php echo $row['id']; ?>">🔄 Return</a>
                    <?php } else { ?>
                        ✔ Returned
                    <?php } ?>
                </td>
            </tr>
            <?php } ?>
        </table>

        <br>

    </div>
</body>
</html>
