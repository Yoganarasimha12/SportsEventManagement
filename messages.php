<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Messages</title>
    <style>
        /* CSS Styles */
       /* CSS Styles */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f2f2f2;
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

.message-container {
    width: 80%;
    margin: 20px auto;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add a subtle shadow */
}

.message-container p {
    margin: 0;
}

h2 {
    text-align: center;
    margin-top: 50px;
    color: #333; /* Darken the color for better readability */
    text-shadow: 1px 1px 1px #fff; /* Add a slight text shadow */
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
    <h2>Contact Messages</h2>
    <div class="message-container">
        <?php
            // Include database connection file
            include 'config.php';

            // Fetch messages from the ContactMessages table
            $sql = "SELECT * FROM ContactMessages";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<p><strong>Name:</strong> " . $row["sender_name"]. "</p>";
                    echo "<p><strong>Email:</strong> " . $row["sender_email"]. "</p>";
                    echo "<p><strong>Subject:</strong> " . $row["message_subject"]. "</p>";
                    echo "<p><strong>Message:</strong> " . $row["message_text"]. "</p>";
                    echo "<hr>";
                }
            } else {
                echo "<p>No messages found.</p>";
            }

            // Close connection
            $conn->close();
        ?>
    </div>
</body>
</html>
