<?php
$pageTitle = 'Login Page';
$stylesheet = '/public/css/register.css';
$script = 'login.js';
include BASE_PATH . "/public/templates/header.php"
?>

<body>
<div class="login-container">
    <h1>Login</h1>
    <form id="login-form">
        <input type="text" id="input-username" name="username" placeholder="Username" required>
        <input type="password" id="input-password" name="password" placeholder="Password" required>
        <input type="submit" value="Login">
    </form>
</div>
<script>
    document.getElementById('login-form').addEventListener('submit', submitLogin);
</script>
</body>
