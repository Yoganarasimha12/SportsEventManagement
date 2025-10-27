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
    alert("Final approval confirmed successfully!");
    setShowPopup(false);
  };

  const handleCancel = () => {
    setShowPopup(false);
  };

  return (
    <div className="approval-page">
      {/* Timeline Section */}
      <div className="timeline-container">
        {["Application Submitted", "Document Review", "Credit Check", "Final Approval", "Card Issued"].map(
          (step, index) => (
            <div className="timeline-step" key={index}>
              <div className={`circle ${index === 3 ? "active" : ""}`}>
                {index + 1}
              </div>
              {index !== 4 && <div className="line"></div>}
            </div>
          )
        )}
      </div>

      {/* Card Section */}
      <div className="card-container">
        <h3 className="card-title">Final Approval Details</h3>

        <div className="card-fields">
          <div>
            <label>Name:</label>
            <input type="text" value="John Doe" readOnly />
          </div>
          <div>
            <label>Email:</label>
            <input type="text" value="john.doe@email.com" readOnly />
          </div>
          <div>
            <label>Credit Score:</label>
            <input type="text" value="785" readOnly />
          </div>
          <div>
            <label>Income Verified:</label>
            <input type="text" value="Yes" readOnly />
          </div>
        </div>

        <div className="button-group">
          <button className="btn accept" onClick={handleAccept}>Accept</button>
          <button className="btn reject">Reject</button>
        </div>
      </div>

      {/* Popup */}
      {showPopup && (
        <div className="popup-overlay">
          <div className="popup">
            <h4>Confirm Final Approval</h4>
            <p>Applicant: John Doe</p>
            <p>Credit Score: 785</p>
            <p>Status: Ready for Card Issue</p>

            <div className="popup-actions">
              <button className="btn confirm" onClick={handleConfirm}>Confirm</button>
              <button className="btn cancel" onClick={handleCancel}>Cancel</button>
            </div>
          </div>
        </div>
      )}
    </div>
  );
};

export default FinalApproval;


tl.css

:::root {
  --sc-blue: #0072ce;
  --sc-green: #00b140;
  --sc-grey: #f7f9fa;
  --sc-border: #d9d9d9;
  --sc-dark: #333;
}

/* Page Layout */
.approval-page {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 40px;
  font-family: "Segoe UI", sans-serif;
  background: white;
}

/* Timeline */
.timeline-container {
  display: flex;
  justify-content: space-around;
  align-items: center;
  width: 70%;
  margin-bottom: 40px;
  border: 1px solid var(--sc-border);
  border-radius: 10px;
  padding: 15px 20px;
}

.timeline-step {
  display: flex;
  align-items: center;
  position: relative;
}

.circle {
  width: 28px;
  height: 28px;
  background: var(--sc-grey);
  color: var(--sc-dark);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 14px;
  font-weight: 600;
}

.circle.active {
  background: var(--sc-green);
  color: #fff;
}

.line {
  width: 50px;
  height: 2px;
  background: var(--sc-blue);
  margin: 0 8px;
}

/* Card Section */
.card-container {
  width: 60%;
  background: var(--sc-grey);
  border-radius: 10px;
  padding: 20px;
  box-shadow: 0 0 4px rgba(0, 0, 0, 0.1);
  margin-bottom: 80px; /* Leaves ~25% space below */
}

.card-title {
  color: var(--sc-blue);
  font-size: 18px;
  margin-bottom: 15px;
}

.card-fields {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 12px 20px;
  margin-bottom: 25px;
}

.card-fields label {
  display: block;
  font-weight: 600;
  color: var(--sc-dark);
  margin-bottom: 3px;
}

.card-fields input {
  width: 90%;
  padding: 6px;
  border: 1px solid var(--sc-border);
  border-radius: 6px;
  background: white;
  font-size: 14px;
}

/* Buttons */
.button-group {
  display: flex;
  gap: 12px;
}

.btn {
  padding: 7px 18px;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  font-weight: 500;
  font-size: 14px;
  transition: 0.2s ease;
}

.btn.accept {
  background: var(--sc-green);
  color: white;
}

.btn.reject {
  background: #d9534f;
  color: white;
}

.btn:hover {
  opacity: 0.9;
}

/* Popup */
.popup-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.35);
  display: flex;
  justify-content: center;
  align-items: center;
}

.popup {
  background: white;
  padding: 25px;
  border-radius: 10px;
  width: 300px;
  text-align: center;
  box-shadow: 0 0 6px rgba(0, 0, 0, 0.2);
}

.popup h4 {
  color: var(--sc-blue);
  margin-bottom: 10px;
}

.popup p {
  margin: 4px 0;
  color: var(--sc-dark);
}

.popup-actions {
  margin-top: 15px;
  display: flex;
  justify-content: space-around;
}

.btn.confirm {
  background: var(--sc-green);
  color: white;
}

.btn.cancel {
  background: var(--sc-blue);
  color: white;
}

update

const deliverySteps = {
  "Not Printed": 1,
  "Printed": 2,
  "Dispatched": 3,
  "Delivered": 4
};

const currentStep = deliverySteps[cardInfo.deliveryStatus] || 1;

