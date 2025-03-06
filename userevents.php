<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Events</title>
    <style>
        /* Add your CSS styles here */
        body {
            font-family: 'Roboto', sans-serif;
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
        .participate-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 5px 10px;
            cursor: pointer;
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

    <h2>Events</h2>
    <?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if the user is not logged in
    header("Location: login.php");
    exit();
}

// Database connection
include 'config.php';

// Retrieve events from database
$sql = "SELECT * FROM events";
$result = $conn->query($sql);

// Check if there are any events
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

        // Output event details with images and participate button
        echo '<tr>';
        echo '<td>' . $row['event_name'] . '</td>';
        echo '<td><img class="sport-image" src="' . $sport_image_path . '" alt="Sport Image"><br>' . $sport_name . '</td>';
        echo '<td><img class="venue-image" src="' . $venue_image_path . '" alt="Venue Image"><br>' . $venue_name . '</td>';
        echo '<td>' . $row['event_date'] . '</td>';
        echo '<td>' . $row['event_time'] . '</td>';
        echo '<td><a href="participation_form.php?event_id=' . $row['event_id'] . '" class="participate-button">Participate</a></td>';
        echo '</tr>';
    }
    echo '</table>';
} else {
    echo '<p>No events found.</p>';
}


$conn->close();
?>

