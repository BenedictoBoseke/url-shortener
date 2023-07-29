<?php
require 'config.php';
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

if (isset($_POST["submit"])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $result = mysqli_query($conn, "SELECT * FROM cred WHERE username = '$username'");
    $row = mysqli_fetch_assoc($result);
    if(mysqli_num_rows($result) > 0){
        if($password == $row["password"]){
            $_SESSION["login"] = true;
            $_SESSION["id"] = $row["id"];
            header("Location: home.php");
        } else {
            echo "<script>alert('Wrong Password');</script>";
        }
    } else {
        echo "<script>alert('User Not Registered');</script>";
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
</head>
<body>
    <h1>User Login</h1>
    <form action=" " method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit" name="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="register.php">Register</a></p>
</body>
</html>