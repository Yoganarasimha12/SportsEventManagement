<?php
session_start();
include 'config.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Participation Form</title>
    <style>
        body{
            font-family: Arial, sans-serif;
        }
        header {
            background-color: #283593; /* Dark Blue */
            color: #fff;
            margin: 0;
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
        
        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
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
    <div class="container">
        <h2>Participation Form</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="fullname">Full Name:</label>
            <input type="text" id="fullname" name="fullname" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>

            <!-- Hidden field to store event ID -->
            <input type="hidden" name="event_id" value="<?php echo isset($_GET['event_id']) ? $_GET['event_id'] : ''; ?>">

            <button type="submit" name="submit">Participate</button>
        </form>
    </div>

    <?php
    // Check if the form is submitted
    if (isset($_POST['submit'])) {
        // Get form data
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $event_id = $_POST['event_id'];
        
        // Set registration date based on current timestamp
        $registrationDate = date('Y-m-d H:i:s');

        // Get user_id from session
        $user_id = $_SESSION['user_id'];

        // Prepare and execute SQL query
        $stmt = $conn->prepare("INSERT INTO Participants (FullName, email, Gender, RegistrationDate, event_id, reg_id) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssii", $fullname, $email, $gender, $registrationDate, $event_id, $user_id);

        if ($stmt->execute()) {
            echo "<p>Thank you for your participation!</p>";
        } else {
            echo "<p>Error: " . $conn->error . "</p>";
        }
        $stmt->close();
    }

    $conn->close();
    ?>
</body>
</html>
