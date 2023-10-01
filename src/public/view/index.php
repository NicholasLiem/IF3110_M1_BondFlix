<?php
    $pageTitle = 'Landing Page';
    include BASE_PATH . "/public/templates/header.php";
?>

<link rel="stylesheet" href="/public/css/index.css">
<body>
<a href="/"><img src="/public/logo.png" alt="Bonflix Logo" class="logo"></a>
<div class="centered-content">
    <div class="container">
        <h1>The biggest local and international hits. The best stories. All streaming here.</h1>
        <h2>Watch anywhere. Cancel anytime.</h2>
        <h3>Ready to watch? Enter your email to create or restart your membership.</h3>
    </div>
    <div class="register-container">
        <input type="text" id="input-username" name="username" placeholder="Email address or username">
        <input type="submit" id="input-submit" class="submit-button" value="Get Started 〉">
    </div>
</div>
<a href="/login" id="sign-in-button" class="submit-button">Sign In</a>
<script src="/public/js/index.js"></script>
</body>