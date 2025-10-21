<?php
// Database connection
include 'config.php';

// Check if event_id parameter is set
if (isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];

    // Delete event from the database
    $sql = "DELETE FROM events WHERE event_id = $event_id";
    if ($conn->query($sql) === TRUE) {
        echo "<p>Event deleted successfully!</p>";
    } else {
        echo "<p>Error deleting event: " . $conn->error . "</p>";
    }
} else {
    echo "<p>No event ID specified.</p>";
}

// Redirect back to view_events.php
header("Location: events.php");
exit();
?>

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
  const activeStep = steps.findIndex((step) => location.pathname === step.path);

  return (
    <div>
      <div id="timeline-header" className="col-3">Application Progress</div>
      <div className="timeline-container">
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
                activeStep === index ? "active-text" : ""
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
    </div>
  );
};

export default Timeline;


.timeline-container {
  display: flex;
  flex-direction: column;
  position: relative;
  font-family: "Segoe UI", sans-serif;
}

#timeline-header {
  font-family: Arial, sans-serif;
  color: #000000;
  font-weight: bold;
  margin-bottom: 20px;
  padding-inline: 25px;
  width: 314px;
}

.timeline-step {
  display: flex;
  align-items: center;
  position: relative;
  margin-bottom: 30px;
}

.timeline-link {
  text-decoration: none;
}

.circle {
  width: 45px;
  height: 45px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: bold;
  color: #000;
  background-color: #ffffff;
  border: 3px solid #c3defa;
  transition: all 0.5s ease-in-out;
  z-index: 2;
}

.circle.active {
  background-color: white;
  border: 3px solid #0473ea; /* blue border */
  color: #000;
  box-shadow: 0 0 8px rgba(0, 30, 140, 0.3);
}

.circle.completed {
  background-color: #0473ea; /* fully filled blue */
  border: 3px solid #0473ea;
  color: white;
  transition: all 0.6s ease-in-out;
}

.step-text {
  margin-left: 20px;
  color: #333;
  font-size: 16px;
  transition: color 0.4s ease-in-out;
}

.step-text.active-text {
  color: #0473ea;
  font-weight: bold;
}

/* --- LINE ANIMATION --- */
.line {
  position: absolute;
  left: 22px;
  top: 45px;
  width: 3px;
  height: 0;
  background-color: #c3defa;
  z-index: 1;
  border-radius: 3px;
  transition: height 0.6s ease-in-out, background-color 0.6s ease-in-out;
}

.line.active-line {
  height: 30px; /* grows smoothly */
  background-color: #0473ea; /* changes color as it fills */
}
