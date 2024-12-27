<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SQL Injection Demo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <h1>Vulnerable Login Page</h1>
    <form method="POST" action="">
        <input type="text" name="username" placeholder="Username"><br><br>
        <input type="password" name="password" placeholder="Password"><br><br>
        <input type="submit" value="Login">
    </form>

    <?php
    // Deliberately vulnerable code
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Connect to database
        $conn = new mysqli("localhost", "root", "", "ctf");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Vulnerable SQL Query (no prepared statement or sanitization)
        $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            echo "<p>Login successful! Welcome, " . htmlspecialchars($username) . "</p>";
        } else {
            echo "<p>Invalid credentials. Try again.</p>";
        }
    }
    ?>
</body>
</html>
