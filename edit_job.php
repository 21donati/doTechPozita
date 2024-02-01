<?php
session_start();

$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "techpozitadb";

$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);

if ($conn->connect_error) {
    die("Lidhja me bazën e të dhënave ka dështuar: " . $conn->connect_error);
}

$id = null;
$title = "";
$releaseDate = "";
$salary = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET["id"])) {

    $id = $_GET["id"];
    $title = $_POST["title"];
    $releaseDate = $_POST["release_date"];
    $salary = $_POST["salary"];

    $updateJobQuery = "UPDATE jobs SET title='$title', release_date='$releaseDate', salary='$salary' WHERE id=$id";

    if ($conn->query($updateJobQuery) === TRUE) {
        echo "Puna u ndryshua me sukses!";
    } else {
        echo "Gabim gjatë ndryshimit të punes: " . $conn->error;
    }
} elseif (isset($_GET["id"])) {
    
    $id = $_GET["id"];
    $selectJobQuery = "SELECT * FROM jobs WHERE id=$id";
    $result = $conn->query($selectJobQuery);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $title = $row["title"];
        $releaseDate = $row["release_date"];
        $salary = $row["salary"];
    } else {
        echo "Puna nuk u gjet!";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ndrysho Punen</title>
</head>
<body>
    <h2>Ndrysho Punen</h2>
    <form action="edit_job.php?id=<?php echo $_GET["id"]; ?>" method="post">
        <label for="title">Titulli:</label>
        <input type="text" id="title" name="title" value="<?php echo $title; ?>" required>

        <label for="release_date">Data e Publikimit:</label>
        <input type="date" id="release_date" name="release_date" value="<?php echo $releaseDate; ?>" required>

        <label for="salary">Rroga:</label>
        <input type="number" id="salary" name="salary" value="<?php echo $salary; ?>" required>

        <button type="submit">Ndrysho Punen</button>
    </form>
</body>
</html>
