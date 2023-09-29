<?php
$pageTitle = 'Register Page';
$stylesheet = '/public/css/register.css';
include BASE_PATH . "/public/templates/header.php"
?>

<body>
<div class="registration-container">
    <h1>User Registration</h1>
    <form method="POST" action="/register">
        <input type="text" id="username" name="username" placeholder="Username" required>
        <input type="text" id="first_name" name="first_name" placeholder="First Name" required>
        <input type="text" id="last_name" name="last_name" placeholder="Last Name" required>
        <input type="password" id="password" name="password" placeholder="Password" required>
        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Password Confirmation" required>
        <input type="submit" value="Register">
    </form>
</div>
</body>
</html>