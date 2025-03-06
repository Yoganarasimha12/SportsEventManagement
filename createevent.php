<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Event</title>
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
        form {
            max-width: 500px;
            margin: 0 auto;
            border: 2px solid #ccc; /* Add border */
            border-radius: 10px; /* Add border radius */
            padding: 20px; /* Add padding */
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        select, input[type="text"], input[type="date"], input[type="time"] {
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
        img {
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
        }
        h2 {
            text-align: center; /* Center align the heading */
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

<h2>Create New Event</h2> <!-- Moved the heading just above the form -->

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="event_name">Event Name:</label>
    <input type="text" id="event_name" name="event_name" required>

    <label for="sport">Sport/Esport:</label>
    <select id="sport" name="sport">
        <option value="">Select Sport/Esport</option>
        <!-- Fetch sports from sports table in the database -->
        <?php
        include 'config.php'; // Include your database connection file

        $sql = "SELECT * FROM sports";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row['sport_id'] . '">' . $row['sport_name'] . '</option>';
        }
        ?>
    </select>

    <label for="venue">Venue:</label>
    <select id="venue" name="venue">
        <option value="">Select Venue</option>
        <!-- Fetch venues from venues table in the database -->
        <?php
        $sql = "SELECT * FROM venues";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row['venue_id'] . '">' . $row['venue_name'] . '</option>';
        }
        ?>
    </select>

    <label for="date">Date:</label>
    <input type="date" id="date" name="date" required>

    <label for="time">Time:</label>
    <input type="time" id="time" name="time" required>

    <!-- Automatically set category based on the first choice (sport or esport) -->
    <input type="hidden" name="category" id="category">

    <input type="submit" name="submit" value="Create Event">
</form>

<!-- JavaScript to set category based on the first choice -->
<script>
    document.getElementById("sport").addEventListener("change", function() {
        document.getElementById("category").value = this.value ? "Sports" : "Esports";
    });
</script>

<?php
// Database connection
include 'config.php';

// Add event to database
if (isset($_POST['submit'])) {
    $event_name = $_POST['event_name'];
    $sport_id = $_POST['sport'];
    $venue_id = $_POST['venue'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $category = $_POST['category'];

    // Insert event details into database
    $sql = "INSERT INTO events (event_name, sport_id, venue_id, event_date, event_time) VALUES ('$event_name', '$sport_id', '$venue_id', '$date', '$time')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<p>Event created successfully!</p>";
    } else {
        echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
    }
}
?>
</body>
</html>
