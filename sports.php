<?php
// Create the uploads directory if it doesn't exist
$uploads_dir = __DIR__ . '/uploads';
if (!is_dir($uploads_dir)) {
    mkdir($uploads_dir, 0755, true);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Sport</title>
    <style>
        body{
            font-family: 'Roboto', sans-serif;
        }
        
        header {
            
            background-color: #283593; /* Dark Blue */
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        nav {

            background-color: #303f9f; /* Dark Blue */
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            margin: 0 10px;
            background-color: #303f9f; /* Dark Blue */
            padding: 8px 12px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        nav a:hover {
            background-color: #283593; /* Slightly Darker Blue on hover */
        }
        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<header>
        <h1>Sports Event Management System</h1>
    </header>

    <nav>
        <a href="admin.php">Home</a>
        <a href="events.php">Events</a>
        <a href="createevent.php">create Events</a>
        <a href="sports.php">Add sports</a>
        <a href="venue.php">Add venue</a>
        <a href="messages.php">Messages</a>
        <a href="participants.php">Participants</a>
        <a href="login.php?logout=true">Logout</a>
    </nav>
    <div class="container">
        <h2>Add Sport</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
            <label for="sport_name">Sport Name:</label>
            <input type="text" id="sport_name" name="sport_name" required>
            
            <label for="category">Category:</label>
            <select id="category" name="category" required>
                <option value="sport">Sport</option>
                <option value="esport">Esport</option>
            </select>
            
            <label for="image">Sport Image:</label>
            <input type="file" id="image" name="image" accept="image/*" required>
            
            <button type="submit" name="submit">Add Sport</button>
        </form>
    </div>

    <?php
    // Database connection
    include 'config.php';

    // Add sport to database
    if (isset($_POST['submit'])) {
        $sport_name = $_POST['sport_name'];
        $category = $_POST['category'];

        // Upload image
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Insert sport details into database
            $sql = "INSERT INTO sports (sport_name, image_path, category) VALUES ('$sport_name', '$target_file', '$category')";

            if ($conn->query($sql) === TRUE) {
                echo "<p>Sport added successfully!</p>";
            } else {
                echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
            }
        } else {
            echo "<p>Sorry, there was an error uploading your file.</p>";
        }
    }

    $conn->close();
    ?>
</body>
</html>


import React, { useState, useEffect } from "react";
import axios from "axios";
import "./Timeline.css";
import "./DocumentStatus.css";

const FinalApproval = () => {
  const applicationId = 1; // hardcoded for now
  const api = `http://localhost:8080/api/customers/${applicationId}`;

  const [applicantInfo, setApplicantInfo] = useState({});
  const [showPopup, setShowPopup] = useState(false);

  // Load applicant details
  const loadApplicantDetails = async () => {
    try {
      const res = await axios.get(api);
      console.log(res.data);
      setApplicantInfo(res.data);
    } catch (error) {
      console.log(error);
    }
  };

  useEffect(() => {
    loadApplicantDetails();
  }, []);

  // Accept button handler
  const handleAccept = () => {
    setShowPopup(true);
  };

  // Confirm popup handler
  const handleConfirm = () => {
    alert("Final approval confirmed and card process initiated.");
    setShowPopup(false);
  };

  // Cancel popup handler
  const handleCancel = () => {
    setShowPopup(false);
  };

  return (
    <div className="row m-0 py-2">
      {/* Progress Card Section */}
      <div id="progress-card" className="col-9 p-4 position-relative">
        {/* Header 1: Basic Details */}
        <div className="mb-3">
          <div id="progress-card-header">
            <h5>Basic Details</h5>
          </div>
          <div className="d-flex justify-content-start py-2">
            <div className="info-holder me-5">
              <span className="info-label">Date of Birth: </span>
              <span className="info-value">{applicantInfo.date_of_birth}</span>
            </div>
            <div className="info-holder">
              <span className="info-label">Email: </span>
              <span className="info-value">{applicantInfo.email}</span>
            </div>
          </div>
          <div className="d-flex justify-content-start py-2">
            <div className="info-holder me-5">
              <span className="info-label">Contact Number: </span>
              <span className="info-value">{applicantInfo.phone}</span>
            </div>
            <div className="info-holder">
              <span className="info-label">Card Type: </span>
              <span className="info-value">{applicantInfo.card_type}</span>
            </div>
          </div>
        </div>

        {/* Header 2: Address */}
        <div className="mb-3">
          <div id="progress-card-header">
            <h5>Address</h5>
          </div>
          <div className="d-flex justify-content-start py-2">
            <div className="info-holder me-5">
              <span className="info-label">House No./Area/Locality: </span>
              <span className="info-value">{applicantInfo.address_line}</span>
            </div>
          </div>
          <div className="d-flex justify-content-start py-2">
            <div className="info-holder me-5">
              <span className="info-label">City: </span>
              <span className="info-value">{applicantInfo.city}</span>
            </div>
            <div className="info-holder">
              <span className="info-label">Pincode: </span>
              <span className="info-value">{applicantInfo.pincode}</span>
            </div>
          </div>
          <div className="d-flex justify-content-start py-2">
            <div className="info-holder me-5">
              <span className="info-label">State: </span>
              <span className="info-value">{applicantInfo.state}</span>
            </div>
            <div className="info-holder">
              <span className="info-label">Country: </span>
              <span className="info-value">{applicantInfo.country}</span>
            </div>
          </div>
        </div>

        {/* Accept / Reject Buttons */}
        <div className="button-group mt-3">
          <button className="accept-btn me-2" onClick={handleAccept}>
            Accept
          </button>
          <button className="reject-btn">Reject</button>
        </div>
      </div>

      {/* Popup Overlay */}
      {showPopup && (
        <div className="popup-overlay">
          <div className="popup-box">
            <h5>
              <strong>Confirm Final Approval</strong>
            </h5>
            <p>
              By clicking <strong>Confirm</strong>, you are confirming the
              Credit Card is <strong>Ready to Issue.</strong>
            </p>
            <div className="popup-buttons">
              <button className="confirm-btn" onClick={handleConfirm}>
                Confirm
              </button>
              <button className="cancel-btn" onClick={handleCancel}>
                Cancel
              </button>
            </div>
          </div>
        </div>
      )}
    </div>
  );
};

export default FinalApproval;





card issued



import React, { useState, useEffect } from "react";
import axios from "axios";
import "./Timeline.css";
import "./DocumentStatus.css";

const CardIssuedDetails = () => {
  const cardId = 1; // You can dynamically set this if needed
  const api = `http://localhost:8080/api/creditcards/${cardId}`;

  const [cardInfo, setCardInfo] = useState({});
  const [showPopup, setShowPopup] = useState(false);

  // Load credit card details
  const loadCardDetails = async () => {
    try {
      const res = await axios.get(api);
      console.log(res.data);
      setCardInfo(res.data);
    } catch (error) {
      console.log(error);
    }
  };

  useEffect(() => {
    loadCardDetails();
  }, []);

  // Accept button handler
  const handleAccept = () => {
    setShowPopup(true);
  };

  // Confirm popup handler
  const handleConfirm = () => {
    alert("Card issuance confirmed and status updated.");
    setShowPopup(false);
  };

  // Cancel popup handler
  const handleCancel = () => {
    setShowPopup(false);
  };

  return (
    <div className="row m-0 py-2">
      {/* Progress Card Section */}
      <div id="progress-card" className="col-9 p-4 position-relative">
        {/* Header 1: Card Details */}
        <div className="mb-3">
          <div id="progress-card-header">
            <h5>Card Details</h5>
          </div>
          <div className="d-flex justify-content-start py-2">
            <div className="info-holder me-5">
              <span className="info-label">Card Number: </span>
              <span className="info-value">{cardInfo.card_number}</span>
            </div>
            <div className="info-holder">
              <span className="info-label">Card Type: </span>
              <span className="info-value">{cardInfo.card_type}</span>
            </div>
          </div>
          <div className="d-flex justify-content-start py-2">
            <div className="info-holder me-5">
              <span className="info-label">Status: </span>
              <span className="info-value">{cardInfo.status}</span>
            </div>
            <div className="info-holder">
              <span className="info-label">Issued At: </span>
              <span className="info-value">{cardInfo.issued_at}</span>
            </div>
          </div>
          <div className="d-flex justify-content-start py-2">
            <div className="info-holder me-5">
              <span className="info-label">Expiry Date: </span>
              <span className="info-value">{cardInfo.expiry_date}</span>
            </div>
            <div className="info-holder">
              <span className="info-label">Application ID: </span>
              <span className="info-value">{cardInfo.application_id}</span>
            </div>
          </div>
        </div>

        {/* Header 2: User Info */}
        <div className="mb-3">
          <div id="progress-card-header">
            <h5>User Details</h5>
          </div>
          <div className="d-flex justify-content-start py-2">
            <div className="info-holder me-5">
              <span className="info-label">User ID: </span>
              <span className="info-value">{cardInfo.user_id}</span>
            </div>
          </div>
        </div>

        {/* Accept / Reject Buttons */}
        <div className="button-group mt-3">
          <button className="accept-btn me-2" onClick={handleAccept}>
            Accept
          </button>
          <button className="reject-btn">Reject</button>
        </div>
      </div>

      {/* Popup Overlay */}
      {showPopup && (
        <div className="popup-overlay">
          <div className="popup-box">
            <h5>
              <strong>Confirm Card Issuance</strong>
            </h5>
            <p>
              By clicking <strong>Confirm</strong>, you are confirming that the
              credit card has been issued successfully.
            </p>
            <div className="popup-buttons">
              <button className="confirm-btn" onClick={handleConfirm}>
                Confirm
              </button>
              <button className="cancel-btn" onClick={handleCancel}>
                Cancel
              </button>
            </div>
          </div>
        </div>
      )}
    </div>
  );
};

export default CardIssuedDetails;

