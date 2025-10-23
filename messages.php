<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Messages</title>
    <style>
        /* CSS Styles */
       /* CSS Styles */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f2f2f2;
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

.message-container {
    width: 80%;
    margin: 20px auto;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add a subtle shadow */
}

.message-container p {
    margin: 0;
}

h2 {
    text-align: center;
    margin-top: 50px;
    color: #333; /* Darken the color for better readability */
    text-shadow: 1px 1px 1px #fff; /* Add a slight text shadow */
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
    <h2>Contact Messages</h2>
    <div class="message-container">
        <?php
            // Include database connection file
            include 'config.php';

            // Fetch messages from the ContactMessages table
            $sql = "SELECT * FROM ContactMessages";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<p><strong>Name:</strong> " . $row["sender_name"]. "</p>";
                    echo "<p><strong>Email:</strong> " . $row["sender_email"]. "</p>";
                    echo "<p><strong>Subject:</strong> " . $row["message_subject"]. "</p>";
                    echo "<p><strong>Message:</strong> " . $row["message_text"]. "</p>";
                    echo "<hr>";
                }
            } else {
                echo "<p>No messages found.</p>";
            }

            // Close connection
            $conn->close();
        ?>
    </div>
</body>
</html>


react

import React from "react";
import { Link, useLocation } from "react-router-dom";
import "./Timeline.css";

const steps = [
  { name: "Application Submitted", path: "/show-application/document-status" },
  { name: "Document Review", path: "/show-application/document-review" },
  { name: "Credit Check", path: "/show-application/credit-check" },
  { name: "Final Approval", path: "/show-application/final-approval" },
  { name: "Card Issued", path: "/show-application/card-status" },
];

const Timeline = () => {
  const location = useLocation();
  const activeStep = steps.findIndex((step) =>
    location.pathname.startsWith(step.path)
  );

  return (
    <div className="timeline-container">
      <div id="timeline-header">Application Progress</div>
      {steps.map((step, index) => (
        <div key={index} className="timeline-step">
          <Link to={step.path} className="timeline-link">
            <div
              className={`circle ${
                activeStep === index
                  ? "active"
                  : index < activeStep
                  ? "completed"
                  : ""
              }`}
            >
              <span className="circle-number">{index + 1}</span>
            </div>
          </Link>

          <div
            className={`step-text ${
              activeStep === index
                ? "active-text"
                : index < activeStep
                ? "completed"
                : ""
            }`}
          >
            {step.name}
          </div>

          {index < steps.length - 1 && (
            <div
              className={`line ${
                index < activeStep ? "active-line" : ""
              }`}
            ></div>
          )}
        </div>
      ))}
    </div>
  );
};

export default Timeline;


.css


.timeline-container {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  position: relative;
  font-family: "Poppins", sans-serif;
  padding: 25px 10px;
  background: transparent;
}

#timeline-header {
  font-size: 1.2rem;
  font-weight: 600;
  color: #0b2447;
  margin-bottom: 25px;
  padding-left: 15px;
  border-left: 4px solid #0078ff;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.timeline-step {
  display: flex;
  align-items: center;
  position: relative;
  margin-bottom: 40px;
}

.timeline-link {
  text-decoration: none;
  z-index: 2;
}

.circle {
  width: 50px;
  height: 50px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 600;
  font-size: 18px;
  color: #0b2447;
  border-radius: 50%;
  background: rgba(255, 255, 255, 0.5);
  border: 3px solid rgba(0, 120, 255, 0.2);
  backdrop-filter: blur(6px);
  transition: all 0.4s ease;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
}

.circle.active {
  border: 3px solid #0078ff;
  background: linear-gradient(145deg, #0078ff, #00b8ff);
  color: #fff;
  box-shadow: 0 6px 18px rgba(0, 120, 255, 0.3);
  transform: scale(1.08);
}

.circle.completed {
  background: linear-gradient(145deg, #00b894, #26de81);
  border: 3px solid #00b894;
  color: #fff;
  box-shadow: 0 4px 14px rgba(0, 184, 148, 0.25);
}

.step-text {
  margin-left: 20px;
  font-size: 0.95rem;
  color: #555;
  transition: all 0.3s ease;
  font-weight: 500;
  letter-spacing: 0.3px;
}

.step-text.active-text {
  color: #0078ff;
  font-weight: 600;
}

.step-text.completed {
  color: #00b894;
  font-weight: 600;
}

.step-text.completed::after {
  content: "✓";
  color: #00b894;
  font-weight: bold;
  margin-left: 10px;
}

/* Connecting Lines */
.line {
  position: absolute;
  left: 24px;
  top: 52px;
  width: 3px;
  height: 0;
  background-color: rgba(0, 120, 255, 0.15);
  border-radius: 2px;
  transition: all 1.2s ease;
  z-index: 1;
}

.line.active-line {
  height: 35px;
  background: linear-gradient(180deg, #00b894, #0078ff);
}

/* Hover animation */
.circle:hover {
  transform: scale(1.1);
  cursor: pointer;
}
