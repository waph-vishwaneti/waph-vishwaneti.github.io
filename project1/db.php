<?php
$mysqli = new mysqli("localhost", "waphuser", "your_password_here", "waphProject");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}
?>
