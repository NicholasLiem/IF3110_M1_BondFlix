<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Login</title>
</head>
<body>
<h1>User Login</h1>
<form method="POST" action="/login">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br><br>
    <input type="submit" value="Login">
</form>
<?php
if (isset($error)) {
    echo '<p style="color: red;">' . $error . '</p>';
}
?>
</body>
</html>
