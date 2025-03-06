<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = clean_input($_POST["username"]);
    $email = clean_input($_POST["email"]);
    $password = clean_input($_POST["password"]);

    // Perform validation (add more validation as needed)
    if (empty($username) || empty($email) || empty($password)) {
        echo "All fields are required.";
    } else {
        // Check if the username or email is already registered
        $check_query = "SELECT * FROM register WHERE username='$username' OR email='$email'";
        $check_result = $conn->query($check_query);

        if ($check_result->num_rows > 0) {
            echo "Username or email already exists. Please choose another.";
        } else {
            // If not registered, insert data into the database
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $insert_query = "INSERT INTO register (username, email, pwd) VALUES ('$username', '$email', '$hashed_password')";

            if ($conn->query($insert_query) === TRUE) {
                echo "Registration successful!";
            } else {
                echo "Error: " . $insert_query . "<br>" . $conn->error;
            }
        }
    }
}
function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$conn->close();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sports Event Management</title>
    <link rel="stylesheet" type="text/css" href="registerstyle.css">
</head>
<body>
    < <div class="background-container">
        <div class="background-image"></div>
    </div> >

    <div class="signup-form">
        <form method="post" id="signupForm">
            <h1>SIGN UP</h1>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Sign Up</button>
        <a href="login.php">Already have an account? Login</a>
        <br>
        <br>
        <a href="index1.php">return to Home</a>
        </form>
    </div>

</body>
</html>
