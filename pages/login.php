<?php
session_start();
include('../config/db_connect.php');

// Check if the form is submitted
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query the database to find the librarian by email
    $sql = "SELECT * FROM librarians WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Verify the password using password_verify
        if (password_verify($password, $row['password'])) {
            // Store librarian session
            $_SESSION['librarian_id'] = $row['id'];
            $_SESSION['librarian_name'] = $row['name'];
            
            // Redirect to dashboard
            header('Location: index.php');
            exit();
        } else {
            $error_message = "Incorrect password!";
        }
    } else {
        $error_message = "No librarian found with that email!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Librarian Login</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">

</head>
<body>
    <div class="login-container">
        <h2>Librarian Login</h2>
        
        <?php
        if (isset($error_message)) {
            echo "<p style='color:red;'>$error_message</p>";
        }
        ?>

        <form action="login.php" method="POST">
            <label for="email">Email</label>
            <input type="email" name="email" required>

            <label for="password">Password</label>
            <input type="password" name="password" required>

            <button type="submit" name="login">Login</button>
        </form>
    </div>
</body>
</html>
