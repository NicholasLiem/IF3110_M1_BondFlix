<?php

if (!isset($_SESSION['user_id'])) {
    href('/login');
}

$userID = $_SESSION['user_id'];
$username = $_SESSION['username'];
$isAdmin = $_SESSION['is_admin'];
$isSubscribed = $_SESSION['is_subscribed'];
$pageTitle = 'Watch Movie';
include BASE_PATH . "/public/templates/header.php";
?>

<link rel="stylesheet" href="/public/css/dashboard.css">
<link rel="stylesheet" href="/public/css/watch.css">

<body>
    <div class="container">
        <?php include BASE_PATH . '/public/templates/navbar.php' ?>
        <div class="stream-container">
            <div class="video-wrapper">
                <video controls autoplay id="video-element">
                    <source src="" type="video/mp4" id="video-source">
                    Your browser does not support the video tag.
                </video>
            </div>
            <div class="video-info">
                <h1 id="movie-title"></h1>
                <p id="movie-description"></p>
            </div>
        </div>
    </div>
    <script src="/public/js/watch.js"></script>
</body>