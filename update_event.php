<?php
// Start a session
session_start();

// Include the database configuration file
include 'config.php';

// Check if form is submitted and all required fields are set
if(isset($_POST['event_id'], $_POST['event_name'], $_POST['event_date'], $_POST['event_time'])) {
    // Get event details from the form
    $event_id = $_POST['event_id'];
    $event_name = $_POST['event_name'];
    $event_date = $_POST['event_date'];
    $event_time = $_POST['event_time'];
    
    // Update event details in the database
    $sql = "UPDATE events SET event_name = '$event_name', event_date = '$event_date', event_time = '$event_time' WHERE event_id = $event_id";
    if ($conn->query($sql) === TRUE) {
        // Event updated successfully, redirect to events.php
        $_SESSION['success_message'] = "Event updated successfully.";
        header("Location: events.php");
        exit();
    } else {
        // Error updating event, display error message
        $_SESSION['error_message'] = "Error updating event: " . $conn->error;
        header("Location: events.php");
        exit();
    }
} else {
    // Required fields are missing, redirect to events.php or display an error message
    $_SESSION['error_message'] = "Missing required fields.";
    header("Location: events.php");
    exit();
}

// Close the database connection
$conn->close();
?>



REACT

import React from "react";
import "bootstrap/dist/css/bootstrap.min.css";
import "./CardDetails.css";

export default function CardDetails() {
  return (
    <div className="container my-5 p-5 bg-white rounded-4 shadow-lg card-section">
      <h3 className="text-sc-blue fw-bold mb-4">CARD Details</h3>

      {/* Card Details Form */}
      <form className="row g-4">
        <div className="col-md-6">
          <label className="form-label fw-semibold">Name of the Applicant</label>
          <input
            type="text"
            className="form-control"
            placeholder="Enter name"
          />
        </div>
        <div className="col-md-6">
          <label className="form-label fw-semibold">Email Address</label>
          <input
            type="email"
            className="form-control"
            placeholder="Enter email"
          />
        </div>
        <div className="col-md-6">
          <label className="form-label fw-semibold">Credit Score</label>
          <input
            type="number"
            className="form-control"
            placeholder="e.g. 750"
          />
        </div>
        <div className="col-md-6">
          <label className="form-label fw-semibold">Application Status</label>
          <input
            type="text"
            className="form-control"
            placeholder="Pending / Approved / Rejected"
          />
        </div>
      </form>

      {/* Buttons */}
      <div className="d-flex justify-content-center gap-3 mt-5">
        <button className="btn btn-accept px-4">Accept</button>
        <button className="btn btn-reject px-4">Reject</button>
      </div>

      {/* Status Section */}
      <div className="text-center mt-5">
        <h5 className="fw-bold text-dark mb-3">Status</h5>
        <div className="status-line mx-auto">
          <div className="status-dot active"></div>
          <div className="status-dot"></div>
          <div className="status-dot"></div>
        </div>
      </div>
    </div>
  );
}

