<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sportsdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}?>



react

import React, { useState } from "react";
import "./FinalApproval.css";

const FinalApproval = () => {
  const [showPopup, setShowPopup] = useState(false);

  const handleAccept = () => {
    setShowPopup(true);
  };

  const handleConfirm = () => {
    alert("Final approval confirmed and card process initiated.");
    setShowPopup(false);
  };

  const handleCancel = () => {
    setShowPopup(false);
  };

  return (
    <div className="approval-container">
      {/* Timeline Section */}
      <div className="timeline-section">
        <h3 className="heading">Application Progress</h3>
        <div className="timeline-container">
          {["Application Submitted", "Document Review", "Credit Check", "Final Approval", "Card Issued"].map(
            (step, index) => (
              <div className="timeline-step" key={index}>
                <div className={`circle ${index === 3 ? "active" : ""}`}>
                  {index + 1}
                </div>
                <div className="line"></div>
              </div>
            )
          )}
        </div>
      </div>

      {/* Card Details Section */}
      <div className="card-section">
        <h3 className="card-heading">CARD DETAILS</h3>
        <div className="card-details">
          <div>
            <label>Name of Applicant:</label>
            <input type="text" value="John Doe" readOnly />
          </div>
          <div>
            <label>Email Address:</label>
            <input type="text" value="john.doe@email.com" readOnly />
          </div>
          <div>
            <label>Credit Score:</label>
            <input type="text" value="785" readOnly />
          </div>
          <div>
            <label>Income Verification Status:</label>
            <input type="text" value="Verified" readOnly />
          </div>
          <div>
            <label>Application Status:</label>
            <input type="text" value="Pending Final Approval" readOnly />
          </div>
        </div>

        <div className="button-group">
          <button className="accept-btn" onClick={handleAccept}>
            Accept
          </button>
          <button className="reject-btn">Reject</button>
        </div>
      </div>

      {/* Popup Modal */}
      {showPopup && (
        <div className="popup-overlay">
          <div className="popup-box">
            <h4>Confirm Final Approval</h4>
            <p><strong>Applicant:</strong> John Doe</p>
            <p><strong>Credit Score:</strong> 785</p>
            <p><strong>Status:</strong> Ready for card issue</p>
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


tl.css

::root {
  --sc-blue: #0072ce;
  --sc-green: #00b140;
  --sc-grey: #f3f3f3;
  --sc-dark: #333;
}

/* Layout */
.approval-container {
  display: flex;
  justify-content: space-around;
  align-items: flex-start;
  padding: 40px;
  font-family: "Segoe UI", sans-serif;
}

/* Timeline */
.timeline-section {
  width: 30%;
}
.heading {
  color: var(--sc-blue);
  margin-bottom: 10px;
}

.timeline-container {
  display: flex;
  justify-content: space-between;
  align-items: center;
  border: 2px solid var(--sc-blue);
  padding: 20px;
  border-radius: 8px;
  background: white;
}

.timeline-step {
  display: flex;
  flex-direction: column;
  align-items: center;
  position: relative;
}

.circle {
  width: 30px;
  height: 30px;
  border-radius: 50%;
  background: var(--sc-grey);
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: bold;
  color: var(--sc-dark);
  z-index: 2;
}

.circle.active {
  background: var(--sc-green);
  color: white;
  box-shadow: 0 0 0 3px var(--sc-blue);
}

.line {
  width: 40px;
  height: 3px;
  background: var(--sc-blue);
  position: absolute;
  top: 14px;
  left: 30px;
  z-index: 1;
}

/* Card Details */
.card-section {
  width: 55%;
  background: var(--sc-grey);
  padding: 25px;
  border-radius: 8px;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}

.card-heading {
  color: var(--sc-blue);
  margin-bottom: 15px;
}

.card-details {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 15px;
  margin-bottom: 25px;
}

.card-details label {
  display: block;
  font-weight: 600;
  margin-bottom: 5px;
  color: var(--sc-dark);
}

.card-details input {
  width: 90%;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 6px;
  background: #fff;
}

/* Buttons */
.button-group {
  display: flex;
  gap: 15px;
}

.accept-btn {
  background: var(--sc-green);
  color: white;
  padding: 8px 18px;
  border: none;
  border-radius: 6px;
  cursor: pointer;
}

.reject-btn {
  background: #d9534f;
  color: white;
  padding: 8px 18px;
  border: none;
  border-radius: 6px;
  cursor: pointer;
}

.accept-btn:hover {
  opacity: 0.9;
}
.reject-btn:hover {
  opacity: 0.9;
}

/* Popup */
.popup-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.4);
  display: flex;
  justify-content: center;
  align-items: center;
}

.popup-box {
  background: white;
  padding: 25px;
  border-radius: 10px;
  text-align: center;
  width: 320px;
  box-shadow: 0 0 8px rgba(0, 0, 0, 0.3);
}

.popup-buttons {
  margin-top: 20px;
  display: flex;
  justify-content: space-around;
}

.confirm-btn {
  background: var(--sc-green);
  color: white;
  padding: 8px 16px;
  border: none;
  border-radius: 6px;
  cursor: pointer;
}

.cancel-btn {
  background: var(--sc-blue);
  color: white;
  padding: 8px 16px;
  border: none;
  border-radius: 6px;
  cursor: pointer;
}