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



react


import React from "react";
import "bootstrap/dist/css/bootstrap.min.css";
import "./FinalApproval.css"; // optional minimal custom styles

function FinalApproval() {
  return (
    <div className="final-approval-container d-flex justify-content-center align-items-center">
      <div className="card shadow-sm p-3" style={{ width: "75%", maxWidth: "700px" }}>
        <h5 className="text-center mb-3 fw-bold">Final Approval Details</h5>
        <hr />

        <div className="row mb-2">
          <div className="col-6"><strong>Name:</strong></div>
          <div className="col-6 text-end">John Doe</div>
        </div>
        <div className="row mb-2">
          <div className="col-6"><strong>Credit Score:</strong></div>
          <div className="col-6 text-end">785</div>
        </div>
        <div className="row mb-2">
          <div className="col-6"><strong>Income:</strong></div>
          <div className="col-6 text-end">₹85,000 / month</div>
        </div>
        <div className="row mb-2">
          <div className="col-6"><strong>Card Type:</strong></div>
          <div className="col-6 text-end">Platinum Rewards</div>
        </div>
        <div className="row mb-2">
          <div className="col-6"><strong>Proposed Limit:</strong></div>
          <div className="col-6 text-end">₹2,00,000</div>
        </div>
        <div className="row mb-2">
          <div className="col-6"><strong>Verification:</strong></div>
          <div className="col-6 text-end text-success">Completed</div>
        </div>

        <hr />
        <div className="d-flex justify-content-center gap-3 mt-3">
          <button className="btn btn-success px-4">Accept</button>
          <button className="btn btn-danger px-4">Reject</button>
        </div>
      </div>
    </div>
  );
}

export default FinalApproval;


fa.css

.final-approval-container {
  height: 75vh; /* keeps it within view between header & footer */
}

.card {
  border-radius: 12px;
  background-color: #fff;
}

hr {
  margin: 0.5rem 0;
}

.btn {
  border-radius: 20px;
  font-weight: 500;
}
