<?php
session_start();
require "db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $sql = "SELECT username FROM users WHERE username=? AND password=MD5(?)";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $_SESSION['username'] = $username;
            $_SESSION['browser'] = $_SERVER['HTTP_USER_AGENT'];
            header("Location: /project1/profile.php");
            exit();
        } else {
            echo "Invalid username or password.";
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>
<h2>Login</h2>
<form method="post" action="">
    <p>Username: <input type="text" name="username" required></p>
    <p>Password: <input type="password" name="password" required></p>
    <input type="submit" value="Login">
</form>
<p><a href="registrationform.php">Register Here</a></p>
</body>
</html>
