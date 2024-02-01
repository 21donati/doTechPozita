<?php
session_start();


if (!isset($_SESSION["username"]) || $_SESSION["role"] !== "admin") {
    header("Location: login.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Administrator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 15px;
        }

        nav {
            background-color: #555;
            overflow: hidden;
        }

        nav a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        nav a:hover {
            background-color: #ddd;
            color: black;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .dashboard-container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .welcome-message {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <header>
        <h1>Dashboard - Administrator</h1>
    </header>

    <nav>
        <a href="jobs.php">Home</a>
        <a href="add_job.php">Shto Punet</a>
        <a href="list_job.php">Shiko Punet</a>
        <a href="logout.php">Logout</a>
    </nav>

    <div class="dashboard-container">
        <h2 class="welcome-message">Miresevini, <?php echo $_SESSION["username"]; ?>! Ju keni te drejta administratori.</h2>

       
    </div>

</body>
</html>