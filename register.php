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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $role = $_POST["role"];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    if ($role == "admin") {
        $insertAdminQuery = "INSERT INTO admin (username, password, role) VALUES ('$username', '$hashedPassword', '$role')";
        if ($conn->query($insertAdminQuery) === TRUE) {
            header("Location: admin_dashboard.php");
        } else {
            echo "Gabim gjatë regjistrimit të adminit: " . $conn->error;
        }
    } else {
        $insertUserQuery = "INSERT INTO users (username, password, role) VALUES ('$username', '$hashedPassword', '$role')";
        if ($conn->query($insertUserQuery) === TRUE) {
            header("Location: jobs.php");
        } else {
            echo "Gabim gjatë regjistrimit të përdoruesit: " . $conn->error;
        }
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
    <link rel="stylesheet" href="createAccount.css">
</head>
<body>
   
    <div class="createAccount">
        <div class="createAccount-left">
            <div class="first-left">
               <img src="undraw_product_iteration_kjok.svg" class="bottom-create-photo">
            </div>
            <div class="first-left-text">
                <p class="createAccount-leftTitle">Find the job made for you.</p>
                <p class="createAccount-leftDes">Browse over 130K jobs at top companies and fast-growing startups.</p>
            </div>
            <div class="first-left">
                <img src="undraw_photo_session_re_c0cp.svg" class="bottom-create-photo">
            </div>
        </div>
                    <form action="register.php" method="post" onsubmit="return validateForm()">
                <div class="createAccount-right">
                    <div class="createAccount-content">
                        <img src="Techpozita_Logo.svg" class="createAccount-logo">
                        <p class="createAccount-rightTitle">Create Account</p>
                        <p class="createAccount-rightDes">Discover your next venture</p>
                        
                        <p class="createAccount-input">Email</p>
                        <input type="email" placeholder="Write your Email" class="createAccount-write" name="username" id="username">
                        <p id="emailError" class="error"></p>
                        
                        <p class="createAccount-input">Password</p>
                        <input type="password" placeholder="Write your password" class="createAccount-write" name="password" id="password">
                        <p id="passwordError" class="error"></p>
                        <p class="createAccount-underDes1">Minimum of 8 characters</p>
                        
                        <p class="createAccount-input">Role</p>
                        <select id="role" name="role">
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                        
                        <p id="roleError" class="error"></p>

                        <button class="createAccount-button" type="submit">Create Account</button>
                        <p class="createAccount-underDes2">By continuing you accept our standard terms and conditions and our privacy policy</p>
                <p class="createAccount-already">Already a member? <a href="login.php"><u>Log In</u></p></a> 
                    </div>
                </div>
            </form>
                
            </div>
        </div>
</form>
    </div>

    <script>
    function validateForm() {
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; 
        var passwordRegex = /^.{8,}$/; 

        var emailInput = document.getElementById("username");
        var passwordInput = document.getElementById("password");

       
        document.getElementById("emailError").innerText = "";
        document.getElementById("passwordError").innerText = "";
        document.getElementById("roleError").innerText = "";

       
        if (!emailRegex.test(emailInput.value)) {
            document.getElementById("emailError").innerText = "Please enter a valid email address.";
            return false;
        }

    
        if (!passwordRegex.test(passwordInput.value)) {
            document.getElementById("passwordError").innerText = "Please enter a password with at least 8 characters.";
            return false;
        }

       

    s
        return true;
    }
</script>
</body>
</html>