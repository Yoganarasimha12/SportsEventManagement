<?php
// Start a session
session_start();

// Include the database configuration file
include 'config.php';

// Check if event ID is provided through GET method
if(isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];
    
    // Retrieve event details from the database
    $sql = "SELECT * FROM events WHERE event_id = $event_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch event details
        $row = $result->fetch_assoc();
        $event_name = $row['event_name'];
        $event_date = $row['event_date'];
        $event_time = $row['event_time'];
    } else {
        // Event not found, redirect to events.php or display an error message
        $_SESSION['error_message'] = "Event not found.";
        header("Location: events.php");
        exit();
    }
} else {
    // Event ID not provided, redirect to events.php or display an error message
    $_SESSION['error_message'] = "Event ID not provided.";
    header("Location: events.php");
    exit();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Event</title>
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
        form {
            max-width: 500px;
            margin: 0 auto;
            border: 1px solid #ccc; /* Add border */
            padding: 20px; /* Add padding */
            border-radius: 10px; /* Add border radius */
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"], input[type="date"], input[type="time"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }
    </style>
</head>
<body>
<header>
    <h1>Sports Event Management</h1> <!-- Updated header -->
</header>

<div>
    <form method="post" action="update_event.php">
        <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
        <label for="event_name">Event Name:</label>
        <input type="text" id="event_name" name="event_name" value="<?php echo $event_name; ?>" required>
        
        <label for="event_date">Event Date:</label>
        <input type="date" id="event_date" name="event_date" value="<?php echo $event_date; ?>" required>
        
        <label for="event_time">Event Time:</label>
        <input type="time" id="event_time" name="event_time" value="<?php echo $event_time; ?>" required>
        
        <input type="submit" name="submit" value="Update Event">
    </form>
</div>

</body>
</html>
