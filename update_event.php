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

import React, { useState } from "react";
import "bootstrap/dist/css/bootstrap.min.css";
import "./CardDetails.css"; // we'll include custom CSS below

function CardDetails() {
  const [statusStep, setStatusStep] = useState(1);
  const [applicationStatus, setApplicationStatus] = useState("Pending");

  const handleAccept = () => {
    setStatusStep(3);
    setApplicationStatus("Accepted");
  };

  const handleReject = () => {
    setStatusStep(2);
    setApplicationStatus("Rejected");
  };

  return (
    <div className="min-vh-100 bg-sc-grey d-flex flex-column">
      {/* Navbar */}
      <nav className="navbar px-4 bg-white shadow-sm">
        <span className="navbar-brand text-sc-blue fw-bold">
          Credit Card Origination System
        </span>
        <button className="btn btn-link text-sc-blue fw-semibold">Logout</button>
      </nav>

      {/* Main Content */}
      <div className="container card-container my-5 p-4 bg-white rounded-4 shadow-lg">
        <div className="row">
          {/* Left Column - Status */}
          <div className="col-md-4 text-center border-end">
            <h5 className="fw-bold text-dark mb-4">Status</h5>

            <div className="status-line mx-auto">
              <div
                className={`status-dot ${statusStep >= 1 ? "active" : ""}`}
              ></div>
              <div
                className={`status-dot ${statusStep >= 2 ? "active" : ""}`}
              ></div>
              <div
                className={`status-dot ${statusStep >= 3 ? "active" : ""}`}
              ></div>
            </div>

            <div className="d-grid gap-2 mt-4">
              <button className="btn btn-accept" onClick={handleAccept}>
                Accept
              </button>
              <button className="btn btn-reject" onClick={handleReject}>
                Reject
              </button>
            </div>

            <div className="d-grid gap-2 mt-4">
              <button className="btn btn-print">PRINT CARD</button>
              <button className="btn btn-mail">GENERATE MAIL</button>
            </div>
          </div>

          {/* Right Column - Card Details */}
          <div className="col-md-8 ps-4">
            <h4 className="section-title mb-4">CARD Details</h4>
            <form className="row g-4">
              <div className="col-md-6">
                <label className="form-label fw-semibold">
                  Name of the Applicant
                </label>
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
                <label class

