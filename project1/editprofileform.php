<?php
require "session_auth.php";
require "db.php";

$username = $_SESSION['username'];

$sql = "SELECT fullname, email FROM users WHERE username=?";
if ($stmt = $mysqli->prepare($sql)) {
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($fullname, $email);
    $stmt->fetch();
    $stmt->close();
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Edit Profile</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>
<h2>Edit Profile</h2>
<form method="post" action="editprofile.php">
    <!-- CSRF token -->
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
    
    <p>Full Name: 
        <input type="text" name="fullname" value="<?php echo htmlentities($fullname); ?>" required>
    </p>
    <p>Email: 
        <input type="email" name="email" value="<?php echo htmlentities($email); ?>" required>
    </p>
    <input type="submit" value="Save Changes">
</form>
<p><a href="profile.php">Back to Profile</a></p>
</body>
</html>
