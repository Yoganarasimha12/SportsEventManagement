<?php
// Create the uploads directory if it doesn't exist
$uploads_dir = __DIR__ . '/uploads';
if (!is_dir($uploads_dir)) {
    mkdir($uploads_dir, 0755, true);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Sport</title>
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
        <h2>Add Sport</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
            <label for="sport_name">Sport Name:</label>
            <input type="text" id="sport_name" name="sport_name" required>
            
            <label for="category">Category:</label>
            <select id="category" name="category" required>
                <option value="sport">Sport</option>
                <option value="esport">Esport</option>
            </select>
            
            <label for="image">Sport Image:</label>
            <input type="file" id="image" name="image" accept="image/*" required>
            
            <button type="submit" name="submit">Add Sport</button>
        </form>
    </div>

    <?php
    // Database connection
    include 'config.php';

    // Add sport to database
    if (isset($_POST['submit'])) {
        $sport_name = $_POST['sport_name'];
        $category = $_POST['category'];

        // Upload image
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Insert sport details into database
            $sql = "INSERT INTO sports (sport_name, image_path, category) VALUES ('$sport_name', '$target_file', '$category')";

            if ($conn->query($sql) === TRUE) {
                echo "<p>Sport added successfully!</p>";
            } else {
                echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
            }
        } else {
            echo "<p>Sorry, there was an error uploading your file.</p>";
        }
    }

    $conn->close();
    ?>
</body>
</html>
