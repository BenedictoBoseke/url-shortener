<?php
require 'config.php';

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

if (isset($_POST["submit"])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "INSERT INTO cred (user_id, username, password) VALUES ('', '$username', '$password')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Login Successful'); window.location.href='login.php';</script>";
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
</head>
<body>
    <h1>User Registration</h1>
    <form action="" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit" name="submit">Register</button>
    </form>
</body>
</html>
