<?php
include 'config.php'; // Include your database connection file

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Insert data into database
    $sql = "INSERT INTO ContactMessages (sender_name, sender_email, message_subject, message_text) VALUES ('$name', '$email', '$subject', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "Message sent successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="contactusstyle.css">
    <style>
        body{
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
        <h2>Contact Us</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>
            <label for="subject">Subject:</label>
            <input type="text" id="subject" name="subject" required><br><br>
            <label for="message">Message:</label><br>
            <textarea id="message" name="message" rows="4" required></textarea><br><br>
            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>


react


import React from "react";
import { Link } from "react-router-dom";

const Timeline = ({ steps, activeStep }) => {
  return (
    <div className="timeline-container">
      {steps.map((step, index) => (
        <div key={index} className="timeline-step">
          <Link to={`/step${index + 1}`}>
            <div
              className={`circle ${activeStep === index ? "active" : ""}`}
            >
              {index + 1}
            </div>
          </Link>
          <div className={`step-text ${activeStep === index ? "active-text" : ""}`}>
            {step}
          </div>

          {index !== steps.length - 1 && (
            <div className={`line ${activeStep > index ? "active" : ""}`} />
          )}
        </div>
      ))}
    </div>
  );
};

export default Timeline;