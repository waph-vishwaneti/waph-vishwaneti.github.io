<?php
// registrationform.php
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<h2>Register</h2>
<form action="addnewuser.php" method="post">
    <p>Username: <input type="text" name="username" required pattern="\w+" title="Only letters, numbers, and underscores allowed"></p>

    <p>Password: <input type="password" name="password" 
        required
        pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&])[\w!@#$%^&]{8,}$"
        placeholder="Your password"
        title="Password must have at least 8 characters with 1 special symbol !@#$%^& 1 number, 1 lowercase, and 1 uppercase"
        onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : ''); 
                  form.repassword.pattern = this.value;">
    </p>

    <p>Confirm Password: <input type="password" name="repassword" required
        title="Passwords do not match"
        onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : '');">
    </p>

    <p>Full Name: <input type="text" name="fullname" required></p>

    <p>Email: <input type="email" name="email" required
        pattern="^[\w\.-]+@[\w-]+(\.[\w-]+)*$"
        title="Please enter a valid email"></p>

    <input type="submit" value="Register">
</form>
<p><a href="index.php">Back to Login</a></p>
</body>
</html>

