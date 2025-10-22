<?php
include 'config.php';
// Fetch participants from the database
$participantsQuery = "SELECT * FROM Participants";
$participantsResult = $conn->query($participantsQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Participants - Sports Event Management System</title>
    <link rel="stylesheet" type="text/css" href="participantstyle.css">
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

    <main>
        <h2>Participants</h2>

        <?php
        // Display participants in a table
        if ($participantsResult->num_rows > 0) {
            echo '<table>';
            echo '<tr><th>Full Name</th><th>Email</th><th>Gender</th><th>Event_id</th></tr>';
            while ($participant = $participantsResult->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $participant['FullName'] . '</td>';
                echo '<td>' . $participant['email'] . '</td>';
                echo '<td>' . $participant['Gender'] . '</td>';
                echo '<td>' . $participant['event_id'] . '</td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo '<p class="message">No participants found.</p>';
        }

        $conn->close();
        ?>
    </main>
</body>
</html>


insert

INSERT INTO customer (
    customer_id,
    address_line1,
    annual_income,
    card_type,
    city,
    company_name,
    country,
    date_of_birth,
    email,
    first_name,
    last_name,
    middle_name,
    phone,
    pincode,
    state
) VALUES (
    DEFAULT,
    '45 Nehru Street',
    '1200000',
    'VISA',
    'Mumbai',
    'Tata Consultancy Services',
    'India',
    '1988-11-23',
    'priya.singh@example.com',
    'Priya',
    'Singh',
    'L',
    '+919812345678',
    '400001',
    'Maharashtra'
);
