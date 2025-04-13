<?php
// Start session only if it's not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include('../config/db_connect.php');

// Ensure librarian is logged in
if (!isset($_SESSION['librarian_id'])) {
    header('Location: ../pages/login.php');
    exit();
}

$librarian_name = $_SESSION['librarian_name'];

// Determine if the page should show a back button
$show_back_button = basename($_SERVER['PHP_SELF']) !== 'dashboard.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">
    <style>
        /* Header Styling */
        .header {
            background: #333;
            color: white;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 18px;
        }

        .header .left {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .header .right {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .header a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            padding: 8px 12px;
            border-radius: 5px;
        }

        .logout-btn {
            background: #d9534f;
        }

        .logout-btn:hover {
            background: #c9302c;
        }

        /* Back Button */
        .back-btn {
            background: #ff9800;
        }

        .back-btn:hover {
            background: #e68900;
        }
    </style>
</head>
<body>

    <div class="header">
        <div class="left">
            <span>Welcome, <?php echo $librarian_name; ?></span>
            <?php if ($show_back_button): ?>
                <a href="javascript:history.back()" class="back-btn">⬅ Back</a>
            <?php endif; ?>
        </div>
        <div class="right">
            <a href="../pages/logout.php" class="logout-btn">Logout</a>
        </div>
    </div>
</body>
</html>