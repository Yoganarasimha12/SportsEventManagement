<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Event</title>
    <style>
        /* Add your CSS styles here */
        body {
            font-family: Arial, sans-serif;
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
        form {
            max-width: 500px;
            margin: 0 auto;
            border: 2px solid #ccc; /* Add border */
            border-radius: 10px; /* Add border radius */
            padding: 20px; /* Add padding */
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        select, input[type="text"], input[type="date"], input[type="time"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }
        img {
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
        }
        h2 {
            text-align: center; /* Center align the heading */
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

<h2>Create New Event</h2> <!-- Moved the heading just above the form -->

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="event_name">Event Name:</label>
    <input type="text" id="event_name" name="event_name" required>

    <label for="sport">Sport/Esport:</label>
    <select id="sport" name="sport">
        <option value="">Select Sport/Esport</option>
        <!-- Fetch sports from sports table in the database -->
        <?php
        include 'config.php'; // Include your database connection file

        $sql = "SELECT * FROM sports";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row['sport_id'] . '">' . $row['sport_name'] . '</option>';
        }
        ?>
    </select>

    <label for="venue">Venue:</label>
    <select id="venue" name="venue">
        <option value="">Select Venue</option>
        <!-- Fetch venues from venues table in the database -->
        <?php
        $sql = "SELECT * FROM venues";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row['venue_id'] . '">' . $row['venue_name'] . '</option>';
        }
        ?>
    </select>

    <label for="date">Date:</label>
    <input type="date" id="date" name="date" required>

    <label for="time">Time:</label>
    <input type="time" id="time" name="time" required>

    <!-- Automatically set category based on the first choice (sport or esport) -->
    <input type="hidden" name="category" id="category">

    <input type="submit" name="submit" value="Create Event">
</form>

<!-- JavaScript to set category based on the first choice -->
<script>
    document.getElementById("sport").addEventListener("change", function() {
        document.getElementById("category").value = this.value ? "Sports" : "Esports";
    });
</script>

<?php
// Database connection
include 'config.php';

// Add event to database
if (isset($_POST['submit'])) {
    $event_name = $_POST['event_name'];
    $sport_id = $_POST['sport'];
    $venue_id = $_POST['venue'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $category = $_POST['category'];

    // Insert event details into database
    $sql = "INSERT INTO events (event_name, sport_id, venue_id, event_date, event_time) VALUES ('$event_name', '$sport_id', '$venue_id', '$date', '$time')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<p>Event created successfully!</p>";
    } else {
        echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
    }
}
?>
</body>
</html>


finalapproval new


import React, { useState, useEffect } from "react";
import axios from "axios";
import Timeline from "./Timeline"; // using your existing component
import "./FinalApproval.css";

const FinalApproval = () => {
  const applicationId = 1; // temporary
  const api = `http://localhost:8080/api/customers/${applicationId}`;
  const [applicantInfo, setApplicantInfo] = useState({});
  const [showPopup, setShowPopup] = useState(false);

  // Load applicant details
  const loadApplicantDetails = async () => {
    try {
      const res = await axios.get(api);
      setApplicantInfo(res.data);
    } catch (error) {
      console.error(error);
    }
  };

  useEffect(() => {
    loadApplicantDetails();
  }, []);

  // Popup handlers
  const handleAccept = () => setShowPopup(true);
  const handleConfirm = () => {
    setShowPopup(false);
    // You can add your approval API call here
  };
  const handleCancel = () => setShowPopup(false);

  return (
    <div className="final-approval-container container-fluid py-4">
      <div className="row m-0">
        {/* Timeline Placeholder */}
        <div className="col-3 px-3 d-flex flex-column align-items-start">
          <Timeline />
        </div>

        {/* Details Section */}
        <div className="col-9 p-4 position-relative">
          <div className="approval-card shadow rounded-4 p-4 bg-white">
            {/* Header 1 */}
            <div className="mb-4">
              <div
                id="progress-card-header"
                className="d-flex align-items-center justify-content-between"
              >
                <h4 className="fw-semibold text-primary">Basic Details</h4>
                <span className="status-badge">Pending Final Review</span>
              </div>

              <div className="details-grid mt-3">
                <div className="info-item">
                  <span className="info-label">Full Name</span>
                  <span className="info-value">
                    {applicantInfo.first_name} {applicantInfo.last_name}
                  </span>
                </div>
                <div className="info-item">
                  <span className="info-label">Date of Birth</span>
                  <span className="info-value">
                    {applicantInfo.date_of_birth}
                  </span>
                </div>
                <div className="info-item">
                  <span className="info-label">Email</span>
                  <span className="info-value">{applicantInfo.email}</span>
                </div>
                <div className="info-item">
                  <span className="info-label">Contact Number</span>
                  <span className="info-value">{applicantInfo.phone}</span>
                </div>
              </div>
            </div>

            {/* Header 2 */}
            <div className="mb-4">
              <div id="progress-card-header">
                <h4 className="fw-semibold text-primary">Card Details</h4>
              </div>

              <div className="details-grid mt-3">
                <div className="info-item">
                  <span className="info-label">Card Type</span>
                  <span className="info-value text-uppercase fw-semibold">
                    Gold
                  </span>
                </div>
                <div className="info-item">
                  <span className="info-label">Approved Limit</span>
                  <span className="info-value">₹1,00,000</span>
                </div>
                <div className="info-item">
                  <span className="info-label">Interest Rate</span>
                  <span className="info-value">20% p.a.</span>
                </div>
                <div className="info-item">
                  <span className="info-label">Initial Acceptance</span>
                  <span className="info-value text-success">Accepted</span>
                </div>
              </div>
            </div>

            {/* Buttons */}
            <div className="text-end mt-4">
              <button className="btn btn-accept me-3" onClick={handleAccept}>
                Approve
              </button>
              <button className="btn btn-reject">Reject</button>
            </div>
          </div>
        </div>
      </div>

      {/* Popup */}
      {showPopup && (
        <div className="popup-overlay">
          <div className="popup-box">
            <h5>
              <strong>Confirm Final Approval</strong>
            </h5>
            <p className="mt-2">
              By clicking <strong>Confirm</strong>, you are approving this credit
              card for issuance.
            </p>
            <div className="popup-buttons mt-4">
              <button className="btn btn-confirm me-3" onClick={handleConfirm}>
                Confirm
              </button>
              <button className="btn btn-cancel" onClick={handleCancel}>
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



.css

.final-approval-container {
  background: linear-gradient(145deg, #f5f8fb 0%, #e9eef5 100%);
  font-family: "Poppins", sans-serif;
  min-height: 100vh;
}

/* Approval Card */
.approval-card {
  background: #ffffff;
  border-radius: 20px;
  transition: all 0.3s ease-in-out;
}

.approval-card:hover {
  box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}

.details-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
  gap: 20px;
}

.info-item {
  background: #f9fbfd;
  border: 1px solid #edf1f6;
  border-radius: 10px;
  padding: 15px;
  transition: 0.3s;
}

.info-item:hover {
  background: #eef6ff;
}

.info-label {
  font-size: 0.85rem;
  color: #888;
  display: block;
}

.info-value {
  font-size: 1rem;
  color: #222;
}

.status-badge {
  background: #ffb100;
  color: #fff;
  font-size: 0.8rem;
  padding: 5px 12px;
  border-radius: 8px;
}

/* Buttons */
.btn-accept {
  background: linear-gradient(135deg, #0078d7, #00aaff);
  color: #fff;
  border: none;
  border-radius: 8px;
  padding: 10px 25px;
  font-weight: 500;
  transition: all 0.3s;
}

.btn-accept:hover {
  background: linear-gradient(135deg, #0066c2, #0090e6);
  transform: translateY(-2px);
}

.btn-reject {
  background: #f44336;
  color: #fff;
  border: none;
  border-radius: 8px;
  padding: 10px 25px;
  font-weight: 500;
  transition: all 0.3s;
}

.btn-reject:hover {
  background: #d32f2f;
}

/* Popup */
.popup-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(18, 25, 35, 0.6);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 999;
}

.popup-box {
  background: #fff;
  border-radius: 16px;
  padding: 25px 35px;
  width: 400px;
  text-align: center;
  box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
}

.popup-buttons .btn {
  min-width: 100px;
}

.btn-confirm {
  background: #0078d7;
  color: #fff;
}

.btn-cancel {
  background: #ccc;
  color: #333;
}

