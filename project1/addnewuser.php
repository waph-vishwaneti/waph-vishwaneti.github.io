<?php
require "db.php";

// Sanitize function
function sanitize_input($input) {
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}

$username = sanitize_input($_POST['username']);
$password = sanitize_input($_POST['password']);
$repassword = sanitize_input($_POST['repassword']);
$fullname = sanitize_input($_POST['fullname']);
$email = sanitize_input($_POST['email']);

// Basic server-side validation
if (empty($username) || empty($password) || empty($fullname) || empty($email)) {
    die("All fields are required.");
}

if ($password !== $repassword) {
    die("Passwords do not match.");
}

// Check if username exists
$check_sql = "SELECT username FROM users WHERE username = ?";
if ($stmt = $mysqli->prepare($check_sql)) {
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        die("Username already exists.");
    }
    $stmt->close();
}

// Insert new user
$insert_sql = "INSERT INTO users (username, password, fullname, email) VALUES (?, MD5(?), ?, ?)";
if ($stmt = $mysqli->prepare($insert_sql)) {
    $stmt->bind_param("ssss", $username, $password, $fullname, $email);
    if ($stmt->execute()) {
        echo "Registration successful. <a href='index.php'>Login here</a>.";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

$mysqli->close();
?>
