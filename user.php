<?php
// Start session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if the user is not logged in
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background: url('image/admin2.jpg') no-repeat center 130px fixed; /* Adjusted background position */
            background-size: cover;
            color: #fff; /* Adjust text color for better visibility on the background */
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

        main {
            padding: 20px;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        section {
            background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent white background */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin-bottom: 20px;
            overflow: hidden;
            flex-grow: 1;
        }

        h2 {
            color: #303f9f; /* Dark Blue */
            padding: 15px;
            margin: 0;
        }

        p {
            color: #555; /* Set text color to a darker shade of gray */
            padding: 20px;
            margin: 0;
        }
        
    </style>
</head>
<body>
    <header>
        <h1>Sports Event Management System</h1>
    </header>
    <nav>
        <a href="#">Home</a>
        <a href="userevents.php">Events</a>
        <a href="myevents.php">My Events</a>
        <a href="contactus.php">Contact Us</a>
        <a href="login.php?logout=true">Logout</a>
    </nav>
    <main>
        <section>
            <h2>Welcome to our Sports Event Management System!</h2>
            <p>Explore upcoming events and participate in the sports you love. Stay active and engaged!</p>
        </section>
    </main>
</body>
</html>
