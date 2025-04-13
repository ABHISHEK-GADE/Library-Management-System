<?php
session_start();
include('../config/db_connect.php');

// Ensure librarian is logged in
if (!isset($_SESSION['librarian_id'])) {
    header('Location: login.php');
    exit();
}

// Handle form submission
if (isset($_POST['issue_book'])) {
    $book_id = $_POST['book_id'];
    $member_id = $_POST['member_id'];
    $issue_date = date('Y-m-d');
    $return_date = $_POST['return_date'];

    // Insert into database
    $sql = "INSERT INTO issued_books (book_id, member_id, issue_date, return_date) 
            VALUES ('$book_id', '$member_id', '$issue_date', '$return_date')";

    if ($conn->query($sql) === TRUE) {
        $success_message = "Book issued successfully!";
    } else {
        $error_message = "Error: " . $conn->error;
    }
}

// Fetch available books
$books = $conn->query("SELECT * FROM books WHERE copies > 0");

// Fetch registered members
$members = $conn->query("SELECT * FROM members");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Issue Book</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">

</head>
<body>
<?php include('../includes/header.php'); ?>

    <div class="container">
        <h2>Issue a Book</h2>

        <?php
        if (isset($success_message)) {
            echo "<p style='color: green;'>$success_message</p>";
        } elseif (isset($error_message)) {
            echo "<p style='color: red;'>$error_message</p>";
        }
        ?>

        <form action="issue_book.php" method="POST">
            <label>Select Book:</label>
            <select name="book_id" required>
                <option value="">-- Select Book --</option>
                <?php while ($book = $books->fetch_assoc()) { ?>
                    <option value="<?php echo $book['id']; ?>">
                        <?php echo $book['title']; ?> (Available: <?php echo $book['copies']; ?>)
                    </option>
                <?php } ?>
            </select>

            <label>Select Member:</label>
            <select name="member_id" required>
                <option value="">-- Select Member --</option>
                <?php while ($member = $members->fetch_assoc()) { ?>
                    <option value="<?php echo $member['id']; ?>">
                        <?php echo $member['name']; ?> (ID: <?php echo $member['membership_id']; ?>)
                    </option>
                <?php } ?>
            </select>

            <label>Return Date:</label>
            <input type="date" name="return_date" required>

            <button type="submit" name="issue_book">Issue Book</button>
        </form>

        <br>
        <a href="issued_books.php">View Issued Books</a>
    </div>
</body>
</html>
