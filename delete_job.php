<?php
session_start();

if (isset($_GET["id"])) {
    $servername = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "techpozitadb";

    $conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);

    if ($conn->connect_error) {
        die("Lidhja me bazën e të dhënave ka dështuar: " . $conn->connect_error);
    }

    $id = $_GET["id"];
    $deleteJobQuery = "DELETE FROM jobs WHERE id=$id";

    if ($conn->query($deleteJobQuery) === TRUE) {
        echo "Filmi u fshi me sukses!";
    } else {
        echo "Gabim gjatë fshirjes së Punes: " . $conn->error;
    }

    $conn->close();
}
?>