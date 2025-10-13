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


import React, { useState } from "react";
import "bootstrap/dist/css/bootstrap.min.css";
import "./FinalApproval.css";

const FinalApproval = () => {
  const [showPopup, setShowPopup] = useState(false);
  const [popupType, setPopupType] = useState(""); // "accept" or "reject"

  const handlePopup = (type) => {
    setPopupType(type);
    setShowPopup(true);
  };

  const handleClose = () => setShowPopup(false);

  return (
    <div className="container my-5">
      <div className="card shadow-lg border-0 p-4">
        <h4 className="text-primary mb-4 text-center">Final Approval Details</h4>

        {/* Applicant Info */}
        <div className="mb-3">
          <h6 className="text-secondary">Applicant Information</h6>
          <div className="row">
            <div className="col-md-6"><strong>Name:</strong> John Doe</div>
            <div className="col-md-6"><strong>Date of Birth:</strong> 12 Mar 1995</div>
            <div className="col-md-6"><strong>Email:</strong> john.doe@email.com</div>
            <div className="col-md-6"><strong>Mobile:</strong> +91 9876543210</div>
            <div className="col-md-12"><strong>Address:</strong> Bengaluru, Karnataka</div>
          </div>
        </div>

        <hr />

        {/* Employment Info */}
        <div className="mb-3">
          <h6 className="text-secondary">Employment & Income Details</h6>
          <div className="row">
            <div className="col-md-6"><strong>Occupation:</strong> Salaried</div>
            <div className="col-md-6"><strong>Employer:</strong> Infosys Ltd.</div>
            <div className="col-md-6"><strong>Monthly Income:</strong> ₹80,000</div>
            <div className="col-md-6"><strong>Employment Tenure:</strong> 3 Years 4 Months</div>
            <div className="col-md-6"><strong>Income Proof Verified:</strong> Yes ✅</div>
          </div>
        </div>

        <hr />

        {/* Credit Info */}
        <div className="mb-3">
          <h6 className="text-secondary">Credit Information</h6>
          <div className="row">
            <div className="col-md-6"><strong>Credit Score:</strong> 785</div>
            <div className="col-md-6"><strong>Outstanding Loans:</strong> ₹15,000</div>
            <div className="col-md-6"><strong>Credit Utilization:</strong> 32%</div>
            <div className="col-md-6"><strong>Risk Level:</strong> Low</div>
          </div>
        </div>

        <hr />

        {/* Document Verification */}
        <div className="mb-3">
          <h6 className="text-secondary">Document Verification Summary</h6>
          <div className="row">
            <div className="col-md-6"><strong>PAN Card:</strong> ✅ Verified</div>
            <div className="col-md-6"><strong>Aadhaar:</strong> ✅ Verified</div>
            <div className="col-md-6"><strong>Address Proof:</strong> ✅ Verified</div>
            <div className="col-md-6"><strong>Bank Statement:</strong> ✅ Verified</div>
            <div className="col-md-12"><strong>Remarks:</strong> All documents valid and match application.</div>
          </div>
        </div>

        <hr />

        {/* Card & Limit Info */}
        <div className="mb-3">
          <h6 className="text-secondary">Card & Credit Limit Details</h6>
          <div className="row">
            <div className="col-md-6"><strong>Card Type:</strong> Platinum Rewards</div>
            <div className="col-md-6"><strong>Proposed Limit:</strong> ₹2,00,000</div>
            <div className="col-md-6"><strong>Interest Rate:</strong> 3.25% p.m.</div>
            <div className="col-md-6"><strong>Annual Fees:</strong> ₹499</div>
          </div>
        </div>

        <hr />

        {/* Officer Remarks */}
        <div className="mb-4">
          <h6 className="text-secondary">Credit Officer Remarks</h6>
          <p>Customer has stable income and excellent repayment history.</p>
        </div>

        {/* Action Buttons */}
        <div className="d-flex justify-content-center gap-3">
          <button
            className="btn btn-success px-4"
            onClick={() => handlePopup("accept")}
          >
            Accept
          </button>
          <button
            className="btn btn-danger px-4"
            onClick={() => handlePopup("reject")}
          >
            Reject
          </button>
        </div>
      </div>

      {/* Popup Modal */}
      {showPopup && (
        <div className="popup-overlay">
          <div className="popup-box bg-white p-4 rounded shadow">
            {popupType === "accept" ? (
              <>
                <h5 className="text-success mb-3">Confirm Final Approval</h5>
                <p><strong>Applicant:</strong> John Doe</p>
                <p><strong>Credit Limit:</strong> ₹2,00,000</p>
                <p>Do you want to approve and issue the credit card?</p>
              </>
            ) : (
              <>
                <h5 className="text-danger mb-3">Reject Application</h5>
                <p>Please confirm rejection of <strong>John Doe’s</strong> credit card request.</p>
              </>
            )}
            <div className="d-flex justify-content-end gap-3 mt-3">
              <button className="btn btn-secondary" onClick={handleClose}>
                Cancel
              </button>
              <button className={`btn ${popupType === "accept" ? "btn-success" : "btn-danger"}`}>
                {popupType === "accept" ? "Confirm" : "Reject"}
              </button>
            </div>
          </div>
        </div>
      )}
    </div>
  );
};

export default FinalApproval;
