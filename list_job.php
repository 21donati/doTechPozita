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

$selectJobQuery = "SELECT * FROM jobs";
$result = $conn->query($selectJobQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista e Puneve</title>
    <nav>
        <a href="index.php">Home</a>
        <a href="admin_dashboard.php">Dashboard</a>
    </nav>
</head>
<body>
    <h2>Lista e Puneve</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Titulli</th>
            <th>Data e Publikimit</th>
            <th>Rroga</th>
            <th>Veprimet</th>
        </tr>

        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row["id"]."</td>";
            echo "<td>".$row["title"]."</td>";
            echo "<td>".$row["release_date"]."</td>";
            echo "<td>".$row["salary"]."</td>";
            echo "<td><a href='edit_job.php?id=".$row["id"]."'>Ndrysho</a> | <a href='delete_job.php?id=".$row["id"]."'>Fshij</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>

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

table {
    width: 80%;
    margin: 20px auto;
    border-collapse: collapse;
}

th, td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: left;
}

th {
    background-color: #4caf50;
    color: white;
}

a {
    text-decoration: none;
    color: #3498db;
}

a:hover {
    text-decoration: underline;
}

</style>
</html>

<?php
$conn->close();
?>