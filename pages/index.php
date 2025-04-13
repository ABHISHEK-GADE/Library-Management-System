<?php
session_start();
include('../config/db_connect.php');

// Ensure librarian is logged in
if (!isset($_SESSION['librarian_id'])) {
    header('Location: login.php');
    exit();
}

$librarian_name = $_SESSION['librarian_name'];

// Fetch statistics
$total_books = $conn->query("SELECT COUNT(*) AS total FROM books")->fetch_assoc()['total'];
$total_issued_books = $conn->query("SELECT COUNT(*) AS total FROM issued_books WHERE status='issued'")->fetch_assoc()['total'];
$total_pending_returns = $conn->query("SELECT COUNT(*) AS total FROM issued_books WHERE return_date < CURDATE() AND status='issued'")->fetch_assoc()['total'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">
    <style>
        /* Centering Overview Section */
        .overview {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 30px 0;
        }

        .overview-box {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 200px;
            font-size: 16px;
            font-weight: bold;
        }

        .overview-box h3 {
            font-size: 18px;
            margin-bottom: 10px;
            color: #333;
        }

        .overview-box p {
            font-size: 22px;
            font-weight: bold;
            margin: 5px 0;
        }

        .books-count {
            color: #5cb85c;
        }

        .issued-books-count {
            color: #0275d8;
        }

        .pending-returns-count {
            color: #ff9800;
        }

        /* Dashboard Navigation */
        .dashboard-options {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
        }

        .dashboard-options a {
            background: #5cb85c;
            color: white;
            padding: 12px 18px;
            border-radius: 5px;
            font-size: 16px;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
        }

        .dashboard-options a:hover {
            background: #4cae4c;
        }

        /* Logout Button */
        .logout-btn {
            background: #d9534f !important;
        }

        .logout-btn:hover {
            background: #c9302c !important;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .overview {
                flex-direction: column;
                align-items: center;
            }

            .dashboard-options {
                flex-direction: column;
                align-items: center;
            }

            .dashboard-options a {
                width: 80%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h2>Welcome, <?php echo $librarian_name; ?>!</h2>

        <!-- Overview Section -->
        <div class="overview">
            <div class="overview-box books-count">
                <h3>Total Books</h3>
                <p><?php echo $total_books; ?></p>
            </div>
            <div class="overview-box issued-books-count">
                <h3>Issued Books</h3>
                <p><?php echo $total_issued_books; ?></p>
            </div>
            <div class="overview-box pending-returns-count">
                <h3>Pending Returns</h3>
                <p><?php echo $total_pending_returns; ?></p>
            </div>
        </div>

        <!-- Navigation -->
        <div class="dashboard-options">
            <a href="add_book.php">📚 Add New Book</a>
            <a href="books.php">📖 Manage Books</a>
            <a href="members.php">👥 Manage Members</a>
            <a href="issued_books.php">📦 Issued Books</a>
            <a href="logout.php" class="logout-btn">🚪 Logout</a>
        </div>
    </div>
</body>
</html>
