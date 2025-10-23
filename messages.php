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
  position: relative;
  font-family: "Inter", "Segoe UI", sans-serif;
  padding-left: 8px;
}

#timeline-header {
  font-size: 1.1rem;
  font-weight: 600;
  color: #1e2a3a;
  margin-bottom: 25px;
  padding-left: 12px;
  border-left: 3px solid #1b4d89;
  text-transform: uppercase;
  letter-spacing: 0.4px;
}

.timeline-step {
  display: flex;
  align-items: center;
  position: relative;
  margin-bottom: 35px;
}

.timeline-link {
  text-decoration: none;
}

.circle {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  border: 2px solid #c9d6df;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 15px;
  font-weight: 500;
  color: #4a5568;
  background-color: #ffffff;
  transition: all 0.25s ease;
}

.circle.active {
  border-color: #1b4d89;
  color: #1b4d89;
  font-weight: 600;
}

.circle.completed {
  background-color: #1b4d89;
  color: #fff;
  border-color: #1b4d89;
}

.step-text {
  margin-left: 15px;
  font-size: 15px;
  color: #444;
  font-weight: 400;
  transition: color 0.3s ease;
}

.step-text.active-text {
  color: #1b4d89;
  font-weight: 600;
}

.step-text.completed {
  color: #1b4d89;
  font-weight: 500;
}

.step-text.completed::after {
  content: "✓";
  color: #1b4d89;
  font-weight: 600;
  margin-left: 8px;
}

/* Connector line */
.line {
  position: absolute;
  left: 19px;
  top: 42px;
  width: 2px;
  height: 35px;
  background-color: #e2e8f0;
  transition: background-color 0.3s ease;
  border-radius: 2px;
}

.line.active-line {
  background-color: #1b4d89;
}

/* Hover effect */
.circle:hover {
  transform: scale(1.05);
  border-color: #1b4d89;
}
