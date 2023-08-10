<?php
require 'config.php';

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

function incrementVisitCount($conn, $shortCode) {
    $sql = "UPDATE urls SET visit_count = visit_count + 1 WHERE short_code = '$shortCode'";
    // Prepared statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $shortCode);
    $stmt->execute();
    $stmt->close();
}

if (isset($_POST["submit"])) {
    $longURL = $_POST['url'];

    // Secure short code
    $shortCode = substr(hash("sha256", $longURL . time()), 0, 6);

    // Menggunakan prepared statement
    $sql = "INSERT INTO urls * VALUES ('$shortCode', '$longURL', 0)";
    $stmt = $conn -> prepare($sql);
    $stmt -> bind_param("ss", $shortCode, $longURL);

    if ($stmt->execute()) {
        $shortURL = "localhost:3000/" . $shortCode;
        echo "Shortened URL: <a href='" . htmlspecialchars($shortURL, ENT_QUOTES, 'UTF-8') . "'>$shortURL</a>";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

$sql = "SELECT short_code, original_url, visit_count FROM urls";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>List of Shortened URLs:</h2>";
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        $shortURL = "localhost:3000/" . $row['short_code'];
        $visitCount = $row['visit_count'];
        echo "<li><a href='$shortURL'>$shortURL</a> (Visits: $visitCount)</li>";
    }
    echo "</ul>";
} else {
    echo "No shortened URLs found.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shorten</title>
</head>
<body>
    <a href="home.php">Return?</a>
    
</body>
</html>
