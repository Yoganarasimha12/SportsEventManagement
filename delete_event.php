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
