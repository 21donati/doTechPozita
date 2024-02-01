<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "techpozitadb";

    $conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);

    if ($conn->connect_error) {
        die("Lidhja me bazën e të dhënave ka dështuar: " . $conn->connect_error);
    }

    $title = $_POST["title"];
    $releaseDate = $_POST["release_date"];
    $salary = $_POST["salary"];

    $insertJobQuery = "INSERT INTO jobs (title, release_date, salary) VALUES ('$title', '$releaseDate', '$salary')";

    if ($conn->query($insertJobQuery) === TRUE) {
        echo "Puna u shtua me sukses!";
    } else {
        echo "Gabim gjatë shtimit të punes: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shto Punen</title>
</head>
<body>
    <h2>Shto Punen</h2>
    <nav>
        <a href="index.php">Home</a>
        <a href="list_job.php">Shiko Punet</a>
    </nav>
    <form action="add_job.php" method="post">
        <label for="title">Titulli:</label>
        <input type="text" id="title" name="title" required>

        <label for="release_date">Data e publikimit:</label>
        <input type="date" id="release_date" name="release_date" required>

        <label for="genre">Rroga:</label>
        <input type="number" id="salary" name="salary" required>

        <button type="submit">Shto Punen</button>
    </form>

    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

h2 {
    text-align: center;
    color: #333;
}

nav {
    background-color: #333;
    padding: 10px;
    text-align: left;
}

nav a {
    color: #fff;
    text-decoration: none;
    padding: 5px 15px;
    margin: 0 10px;
    border-radius: 5px;
    background-color: #555;
}

nav a:hover {
    background-color: #777;
}

form {
    max-width: 400px;
    margin: 20px auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

label {
    display: block;
    margin: 10px 0;
}

input {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    box-sizing: border-box;
}

button {
    background-color: #4caf50;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button:hover {
    background-color: #45a049;
}

    </style>
</body>
</html>