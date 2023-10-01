<?php
$pageTitle = 'Register Page';
include BASE_PATH . "/public/templates/header.php"
?>


<link rel="stylesheet" href="/public/css/register.css">
<script src="/public/js/register.js"></script>

<body>
    <div class="registration-container">
        <h1>User Registration</h1>
        <form id="registration-form">
            <input type="text" id="input-username" name="username" placeholder="Username" required>
            <input type="text" id="input-first-name" name="first_name" placeholder="First name" required>
            <input type="text" id="input-last-name" name="last_name" placeholder="Last name" required>
            <input type="password" id="input-password" name="password" placeholder="Password" required>
            <input type="password" id="input-password-confirmation" placeholder="Password confirmation" required>
            <input type="submit" value="Register">
        </form>
    </div>
    <script>
            document.getElementById('registration-form').addEventListener('submit', submitRegister);
    </script>
</body>