<?php
$mysqli = new mysqli("db", "user", "userpass", "mydb");

if ($mysqli->connect_error) {
    die("Database connection failed: " . $mysqli->connect_error);
}

$message = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Sanitize inputs
    $username = $mysqli->real_escape_string($username);
    $password = $mysqli->real_escape_string($password);

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $mysqli->query($sql);

    if ($result && $result->num_rows === 1) {
        $message = "✅ Login successful. Welcome, $username!";
    } else {
        $message = "❌ Invalid username or password..";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
</head>
<body>
    <h2>Simple Login</h2>
    <form method="POST">
        <label>Username:</label><br>
        <input type="text" name="username" required><br><br>
        
        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>
        
        <button type="submit">Login</button>
    </form>

    <p style="color: blue;"><?php echo $message; ?></p>
</body>
</html>

