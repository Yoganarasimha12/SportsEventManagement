<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Events</title>
    <style>
        body {
            font-family: Arial, sans-serif;
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        .venue-image, .sport-image {
            max-width: 100px;
            max-height: 100px;
        }
        .delete-button, .modify-button {
            background-color: #dc3545;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 5px 10px;
            cursor: pointer;
            margin-right: 5px; /* Adjusted margin for space between buttons */
        }
        .modify-button {
            background-color: #007bff; /* Blue color for Modify button */
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

<h2>Events</h2>

<?php
// Database connection
include 'config.php';

// Function to delete event
function deleteEvent($event_id) {
    global $conn;
    $sql = "DELETE FROM events WHERE event_id = $event_id";
    if ($conn->query($sql) === TRUE) {
        return true; // Event deleted successfully
    } else {
        return false; // Error deleting event
    }
}

// Check if event deletion form is submitted
if(isset($_POST['delete_event'])) {
    $event_id_to_delete = $_POST['event_id_to_delete'];
    if(deleteEvent($event_id_to_delete)) {
        echo "<p>Event deleted successfully!</p>";
    } else {
        echo "<p>Error deleting event.</p>";
    }
}

// Retrieve events from database
$sql = "SELECT * FROM events";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output table header
    echo '<table>';
    echo '<tr><th>Event Name</th><th>Sport</th><th>Venue</th><th>Date</th><th>Time</th><th>Action</th></tr>';

    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        
        // Retrieve sport details
        $sport_id = $row['sport_id'];
        $sport_sql = "SELECT * FROM sports WHERE sport_id = $sport_id";
        $sport_result = $conn->query($sport_sql);
        $sport_row = $sport_result->fetch_assoc();
        $sport_name = $sport_row['sport_name'];
        $sport_image_path = $sport_row['image_path'];

        // Retrieve venue details
        $venue_id = $row['venue_id'];
        $venue_sql = "SELECT * FROM venues WHERE venue_id = $venue_id";
        $venue_result = $conn->query($venue_sql);
        $venue_row = $venue_result->fetch_assoc();
        $venue_name = $venue_row['venue_name'];
        $venue_image_path = $venue_row['image_path'];

        // Output event details with images and buttons
        echo '<tr>';
        echo '<td>' . $row['event_name'] . '</td>';
        echo '<td><img class="sport-image" src="' . $sport_image_path . '" alt="Sport Image"><br>' . $sport_name . '</td>';
        echo '<td><img class="venue-image" src="' . $venue_image_path . '" alt="Venue Image"><br>' . $venue_name . '</td>';
        echo '<td>' . $row['event_date'] . '</td>';
        echo '<td>' . $row['event_time'] . '</td>';
        echo '<td>';
        // Form to submit event deletion
        echo '<form action="" method="POST" onsubmit="return confirm(\'Are you sure you want to delete this event?\')">';
        echo '<input type="hidden" name="event_id_to_delete" value="' . $row['event_id'] . '">';
        echo '<input type="submit" name="delete_event" value="Delete" class="delete-button" style="margin-bottom: 10px;">'; // Added margin-bottom
        echo '</form>';

        // Modify button with PHP redirection
        echo '<form action="modify_event.php" method="GET" style="display:inline;">';
        echo '<input type="hidden" name="event_id" value="' . $row['event_id'] . '">';
        echo '<button type="submit" class="modify-button">Modify</button>';
        echo '</form>';
        echo '</td>';
        echo '</tr>';
    }
    echo '</table>';
} else {
    echo '<p>No events found.</p>';
}

$conn->close();
?>
