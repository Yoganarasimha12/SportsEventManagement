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
