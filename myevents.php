<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Participated Events</title>
    <style>
        /* Add your CSS styles here */
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
    </style>
</head>
<body>
<header>
        <h1>Sports Event Management System</h1>
    </header>
    <nav>
        <a href="user.php">Home</a>
        <a href="userevents.php">Events</a>
        <a href="myevents.php">My Events</a>
        <a href="contactus.php">Contact Us</a>
        <a href="login.php?logout=true">Logout</a>
    </nav>
    <h2>My Participated Events</h2>
<?php
// Start session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if the user is not logged in
    header("Location: login.php");
    exit();
}

// Get the user's reg_id from the session
$user_id = $_SESSION['user_id']; // Fix variable name to match session variable

// Database connection
include 'config.php'; // Include your database connection file

// Fetch events participated by the user with corresponding sport and venue names
$sql = "SELECT events.*, sports.sport_name, venues.venue_name
        FROM events
        JOIN participants ON events.event_id = participants.event_id
        JOIN sports ON events.sport_id = sports.sport_id
        JOIN venues ON events.venue_id = venues.venue_id
        WHERE participants.reg_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id); // Change "s" to "i" for integer parameter
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Output table header
    echo '<table>';
    echo '<tr><th>Event Name</th><th>Sport</th><th>Venue</th><th>Date</th><th>Time</th></tr>';

    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['event_name'] . '</td>';
        echo '<td>' . $row['sport_name'] . '</td>';
        echo '<td>' . $row['venue_name'] . '</td>';
        echo '<td>' . $row['event_date'] . '</td>';
        echo '<td>' . $row['event_time'] . '</td>';
        echo '</tr>';
    }
    echo '</table>';
} else {
    echo '<p>No events found.</p>';
}

// Close database connection
$stmt->close();
$conn->close();
?>
