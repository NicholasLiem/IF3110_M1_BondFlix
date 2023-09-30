<?php
$pageTitle = 'Register Page';
$stylesheet = '/public/css/register.css';
$script = 'register.js';
include BASE_PATH . "/public/templates/header.php"
?>

<body>
<div class="registration-container">
    <h1>User Registration</h1>
    <form id="registration-form">
        <input type="text" id="input-username" name="username" placeholder="Username" required>
        <input type="text" id="input-first-name" name="first_name" placeholder="First Name" required>
        <input type="text" id="input-last-name" name="last_name" placeholder="Last Name" required>
        <input type="password" id="input-password" name="password" placeholder="Password" required>
        <input type="password" id="input-password-confirmation" placeholder="Password Confirmation" required>
        <input type="submit" value="Register">
    </form>
</div>
<script>
        document.getElementById('registration-form').addEventListener('submit', submitRegister);
</script>
</body>