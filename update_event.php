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



"Create a grayscale wireframe for a full banking login webpage styled for Standard Chartered Bank. At the very top of the page, include a fixed header bar with the company logo placeholder positioned on the left side, leaving the right side blank. Below the header, in the center of the page, place a single-column login card. Inside this card, add a bold heading labeled ‘Login’, followed by two stacked input fields with labels: one for username and one for password. The password field should show masked input with a small placeholder icon for show/hide toggle. Beneath the fields, add a ‘Remember Me’ checkbox on the left and a placeholder space for error messages just below the inputs. Underneath, place a large rectangular login button spanning the card width. Below the button, align a small link labeled ‘Forgot Password?’ to the left, and beneath it another smaller link that says ‘Don’t have an account? Sign Up’ or ‘Need Help?’. The card should be centered vertically and horizontally on the page, with balanced whitespace around it. At the very bottom of the page (global footer), include small text placeholders for ‘Privacy Policy’ and ‘Terms & Conditions’ links, aligned center. Keep everything grayscale, using only boxes, lines, and text placeholders, without colors or detailed styling. Focus on hierarchy, alignment, and clarity, making the page feel professional, minimal, and bank-grade.

