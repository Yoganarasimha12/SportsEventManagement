<?php
session_start();
include 'config.php';

// Check if there was a previous invalid admin login attempt
$showInvalidAdminMessage = isset($_SESSION['error_message']) && $_SESSION['error_message'] === 'Invalid admin login';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = clean_input($_POST["username"]);
    $password = clean_input($_POST["password"]);

    // Perform validation (add more validation as needed)
    if (empty($username) || empty($password)) {
        echo '<div class="error-message">Username and password are required.</div>';
    } else {
        // Check if the username exists in the database
        $check_query = "SELECT * FROM register WHERE username='$username'";
        $check_result = $conn->query($check_query);

        if ($check_result->num_rows > 0) {
            $row = $check_result->fetch_assoc();
        
            // Verify password
            if (password_verify($password, $row["pwd"])) {
                if (isset($_POST['admin_login'])) {
                    if ($row['is_admin'] == 1) {
                        // Redirect to the admin page
                        $_SESSION['success_message'] = "Admin login successful!";
                        header("Location: admin.php");
                        exit();
                    } else {
                        $_SESSION['error_message'] = "Invalid admin login.";
                    }
                } else {
                    // Set the user ID in the session
                    $_SESSION['user_id'] = $row["reg_id"];
        
                    $_SESSION['success_message'] = "Login successful!";
                    // Redirect to a regular user page or perform additional actions here
                    header("Location: user.php");
                    exit();
                }
            } else {
                $_SESSION['error_message'] = "Incorrect password.";
            }
        } else {
            $_SESSION['error_message'] = "Username not found.";
        }
    }
}

function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sports Event Management</title>
    <link rel="stylesheet" type="text/css" href="loginstyle.css">
</head>
<body>
    <div class="background-container">
        <div class="background-image"></div>
    </div>

    <div class="login-form">
    <form method="post" id="loginForm" onsubmit="return handleLogin()">
        <h1>LOGIN</h1>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <label for="admin_login">Admin Login:</label>
        <input type="checkbox" id="admin_login" name="admin_login">

        <?php
        // Display error message for incorrect password inside the form
        if (isset($_SESSION['error_message'])) {
            echo '<div class="error-message">' . $_SESSION['error_message'] . '</div>';
            unset($_SESSION['error_message']);
        }
        ?>

        <button type="submit">Login</button>
        <a href="register.php">Don't have an account? Sign Up</a>
        <br>
        <br>
        <a href="index1.php">Return to Home</a>
    </form>

    <?php
    // Display success message outside the form
    if (isset($_SESSION['success_message'])) {
        echo '<div class="success-message">' . $_SESSION['success_message'] . '</div>';
        unset($_SESSION['success_message']);
    }
    ?>
</div>

</body>
</html>
