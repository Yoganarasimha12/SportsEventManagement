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

import React from "react";
import "./Timeline.css";

const steps = [
  "Application Submitted",
  "Document Review",
  "Credit Check",
  "Final Approval",
  "Card Issued",
];

const Timeline = () => {
  return (
    <div className="timeline-container">
      {steps.map((step, index) => (
        <div className="timeline-step" key={index}>
          <div className="circle">{index + 1}</div>
          <div className="step-text">{step}</div>
          {index !== steps.length - 1 && <div className="line"></div>}
        </div>
      ))}
    </div>
  );
};

export default Timeline;


tl.css

:root {
  --sc-blue: #0072ce;
  --sc-green: #00b140;
  --sc-grey: #e6e6e6;
}

.timeline-container {
  display: flex;
  flex-direction: column;
  position: relative;
  align-items: flex-start;
  margin: 40px;
  font-family: "Segoe UI", sans-serif;
}

/* Each timeline step */
.timeline-step {
  display: flex;
  align-items: center;
  position: relative;
  margin-bottom: 30px;
}

/* Number circle */
.circle {
  width: 35px;
  height: 35px;
  background-color: var(--sc-green);
  color: white;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: bold;
  z-index: 2;
  border: 3px solid white;
  box-shadow: 0 0 0 2px var(--sc-blue);
}

/* Step text */
.step-text {
  margin-left: 20px;
  color: #333;
  font-size: 16px;
}

/* Connecting line */
.line {
  position: absolute;
  left: 16px; /* centers with circle */
  top: 35px;
  width: 3px;
  height: 30px;
  background-color: var(--sc-blue);
  z-index: 1;
}

/* Optional hover effect */
.timeline-step:hover .circle {
  background-color: var(--sc-blue);
  box-shadow: 0 0 0 2px var(--sc-green);
}