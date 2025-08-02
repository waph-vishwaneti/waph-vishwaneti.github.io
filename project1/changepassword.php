<?php

require "session_auth.php";
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    die("CSRF token validation failed.");
}

require "db.php";

function sanitize_input($input) {
    return htmlspecialchars(stripslashes(trim($input)));
}

$current_password = sanitize_input($_POST['current_password']);
$new_password = sanitize_input($_POST['new_password']);
$confirm_password = sanitize_input($_POST['confirm_password']);
$username = $_SESSION['username'];

// Check new passwords match
if ($new_password !== $confirm_password) {
    die("New passwords do not match.");
}

// Verify current password
$sql = "SELECT username FROM users WHERE username=? AND password=MD5(?)";
if ($stmt = $mysqli->prepare($sql)) {
    $stmt->bind_param("ss", $username, $current_password);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows === 0) {
        die("Current password is incorrect.");
    }
    $stmt->close();
}

// Update password
$sql = "UPDATE users SET password=MD5(?) WHERE username=?";
if ($stmt = $mysqli->prepare($sql)) {
    $stmt->bind_param("ss", $new_password, $username);
    if ($stmt->execute()) {
        echo "Password updated successfully. <a href='profile.php'>Back to Profile</a>";
    } else {
        echo "Error updating password.";
    }
    $stmt->close();
}

$mysqli->close();
?>
