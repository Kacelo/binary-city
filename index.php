<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- <?php ?> -->
    <h1>Sign Up</h1>
    <form action="includes/clients.inc.php" method="post">
        <label for="username">Client Name:</label>
        <input type="text" id="username" name="client_name" placeholder="Enter your username" required><br><br>
        <button type="submit" name="submit">Sign Up</button>
    </form>
</body>
</html>