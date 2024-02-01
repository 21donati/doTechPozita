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
if (isset($_POST["username"]) && isset($_POST["password"])) {
    $username = $_POST["username"];
    $password = $_POST["password"]; 
 
 $selectAdminQuery = "SELECT * FROM admin WHERE username = '$username'";

 
 $selectUserQuery = "SELECT * FROM users WHERE username = '$username'";


 $finalQuery = "($selectAdminQuery) UNION ($selectUserQuery)";

 $result = $conn->query($finalQuery);

 if ($result->num_rows == 1) {
     $row = $result->fetch_assoc();
     if (password_verify($password, $row["password"])) {
         $_SESSION["username"] = $username;
         $_SESSION["role"] = $row["role"];

         if ($_SESSION["role"] === "admin") {
             header("Location: admin_dashboard.php");
         } else {
             header("Location: jobs.php");
         }
     } else {
         echo "Fjalëkalimi i pasaktë!";
     }
 } else {

     
 }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechPozita</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    
    <div class="logIn">
        <div class="left-logIn">
        <div class="logIn-content">
            <img src="Techpozita_Logo.svg" class="logIn-logo">
            <p class="logIn-title">Log in</p>
            <p class="logIn-des">Discover your next venture</p>
            <button class="logIn-google">Log in with Google</button>
            <p class="or">or</p>
            <form action="login.php" method="post" onsubmit="">
                <label  for="inputEmail" class="label-email">Full Name</label>
                <input type="email"  placeholder="Write your Full Name" class="input-email" name="username" id="username">
                <label for="inputPassword" class="label-password">Password</label>
                <input type="password"  placeholder="Write your password" class="input-password" id="password" name="password">
                <p class="forgot-password"><u>Forgot password?</u></p>
                <button class="logIn-button" type="submit">Log In</button>
            </form>
             
            <p class="logIn-create">Not registered? <span class="logIn-create-blue"><u>Create an Account</u></span></p>
        </div>
        </div>
        <div class="right-logIn">
            <img src="undraw_selectoption_y9cm.svg" class="logIn-right-photo">
            <p class="logIn-right-title">Find the job made for you.</p>
            <p class="logIn-right-des">Browse over 130K jobs at top companies and fast growing</p>
        </div>
    </div>

    <script>
        function validateForm() {
            var email = document.getElementById('inputEmail').value;
            var password = document.getElementById('inputPassword').value;
    
            
            if (email.trim() === "" || password.trim() === "") {
                alert("Email and password cannot be empty");
                return false; 
            }
    
            window.location.href = 'jobs.html';
            return true;
        }
    </script>
</body>
</html>