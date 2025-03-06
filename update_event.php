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
