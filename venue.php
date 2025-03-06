<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Venue</title>
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

        input {
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
        <a href="admin.php">Home</a>
        <a href="events.php">Events</a>
        <a href="createevent.php">create Events</a>
        <a href="sports.php">Add sports</a>
        <a href="venue.php">Add venue</a>
        <a href="messages.php">Messages</a>
        <a href="participants.php">Participants</a>
        <a href="login.php?logout=true">Logout</a>
    </nav>
    <div class="container">
        <h2>Add Venue</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
            <label for="venue_name">Venue Name:</label>
            <input type="text" id="venue_name" name="venue_name" required>
            
            <label for="city">City:</label>
            <input type="text" id="city" name="city" required>
            
            <label for="image">Venue Image:</label>
            <input type="file" id="image" name="image" accept="image/*" required>
            
            <button type="submit" name="submit">Add Venue</button>
        </form>
    </div>

    <?php
    include 'config.php';
    // Add venue to database
    if (isset($_POST['submit'])) {
        $venue_name = $_POST['venue_name'];
        $city = $_POST['city'];

        // Upload image
        $image_filename = $_FILES["image"]["name"];
        $image_tmp = $_FILES["image"]["tmp_name"];
        $image_path = "uploads/" . $image_filename; // Define image path
        
        // Move uploaded file to destination directory
        if (move_uploaded_file($image_tmp, $image_path)) {
            // Insert venue details into database
            $stmt = $conn->prepare("INSERT INTO venues (venue_name, city, image_path) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $venue_name, $city, $image_path);
            
            if ($stmt->execute()) {
                echo "<p>Venue added successfully!</p>";
            } else {
                echo "<p>Error: " . $conn->error . "</p>";
            }
            $stmt->close();
        } else {
            echo "<p>Sorry, there was an error uploading your file.</p>";
        }
    }

    $conn->close();
    ?>
</body>
</html>
