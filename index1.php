<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Sports Event Registration</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            position: relative;
            color: #fff;
        }

        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('image/home.jpg') no-repeat center center fixed;
            background-size: cover;
            z-index: -1;
            animation: fallDown 1.5s ease;
        }

        @keyframes fallDown {
            from {
                transform: translateY(-100%);
            }
            to {
                transform: translateY(0);
            }
        }

        header {
            background-color: #2c3e50;
            color: #fff;
            padding: 15px;
            text-align: center;
        }

        nav {
            display: flex;
            justify-content: flex-end;
            background-color: rgba(44, 62, 80, 0.7);
            padding: 10px;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            margin: 0 15px;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        nav a:hover {
            color: #fff;
            opacity: 0.8;
        }

        section {
            padding: 10px;
            text-align: center;
            color: #2c3e50;
            border-radius: 10px;
            margin: 10px;
        }

        
    </style>
</head>

<body>

    <header>
        <h1>Sports Event Management</h1>
    </header>

    <nav>
        <a href="aboutus.php">About Us</a>
        <a href="login.php">Login</a>
        <a href="register.php">Signup</a>
    </nav>

    <section>
        <h2>Welcome to the Ultimate Sports Experience!</h2>
        <p>Explore and register for a variety of sports and esports events.</p>
    </section>

</body>

</html>
