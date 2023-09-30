<?php
$pageTitle = 'Login';
$stylesheet = '/public/css/login.css';
$script = 'login.js';
include BASE_PATH . "/public/templates/header.php"
?>

<body>
<div class="login-container">
    <a href="/"><img src="/public/logo.png" alt="Bonflix Logo" class="logo"></a>
    <h1>Sign In</h1>
    <form id="login-form">
        <input type="text" id="input-username" name="username" placeholder="Username" required>
        <input type="password" id="input-password" name="password" placeholder="Password" required>
        <input type="submit" value="Login">
    </form>
    <a class="register-link" href="/register">Haven't registered yet?</a>
</div>
<script>
    document.getElementById('login-form').addEventListener('submit', submitLogin);
</script>
</body>
