<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <p>URL Shortener 1000</p>
    <form action="shorten.php" method="post">
        <label for="url">Enter your URL:</label>
        <input type="text" name="url" id="url" required>
        <button type="submit" name="submit">Shorten</button>
    </form>
    <a href="logout.php">Logout?</a>
    <a href="shorten.php">List of all urls</a>

</body>
</html>