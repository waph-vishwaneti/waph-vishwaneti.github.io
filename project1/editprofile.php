<?php
require "session_auth.php";
require "db.php";

if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    die("CSRF token validation failed.");
}

function sanitize_input($input) {
    return htmlspecialchars(stripslashes(trim($input)));
}

$fullname = sanitize_input($_POST['fullname']);
$email = sanitize_input($_POST['email']);
$username = $_SESSION['username'];

$sql = "UPDATE users SET fullname=?, email=? WHERE username=?";
if ($stmt = $mysqli->prepare($sql)) {
    $stmt->bind_param("sss", $fullname, $email, $username);
    if ($stmt->execute()) {
        echo "Profile updated successfully. <a href='profile.php'>Back to Profile</a>";
    } else {
        echo "Error updating profile.";
    }
    $stmt->close();
}
$mysqli->close();
?>
