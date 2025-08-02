<?php
require "session_auth.php";
require "db.php";

$username = $_SESSION['username'];

$sql = "SELECT fullname, email FROM users WHERE username=?";
if ($stmt = $mysqli->prepare($sql)) {
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($fullname, $email);
    if ($stmt->fetch()) {
        echo "<h2>Welcome, " . htmlentities($fullname) . "</h2>";
        echo "<p>Email: " . htmlentities($email) . "</p>";
    }
    $stmt->close();
}
?>
<p><a href="editprofileform.php">Edit Profile</a></p>
<p><a href="changepasswordform.php">Change Password</a></p>
<p><a href="logout.php">Logout</a></p>
