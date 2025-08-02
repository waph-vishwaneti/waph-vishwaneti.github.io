<?php
require "session_auth.php"; ?>
<!DOCTYPE html>
<html>
<head>
<title>Change Password</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>
<h2>Change Password</h2>
<form method="post" action="changepassword.php">
    <!-- CSRF token -->
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
    
    <p>Current Password: 
        <input type="password" name="current_password" required>
    </p>
    <p>New Password: 
        <input type="password" name="new_password"
               required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&]).{8,}$"
               title="Must contain uppercase, lowercase, number, special char, min 8 chars">
    </p>
    <p>Confirm New Password: 
        <input type="password" name="confirm_password" required>
    </p>
    <input type="submit" value="Update Password">

</form>
<p><a href="profile.php">Back to Profile</a></p>
</body>
</html>
