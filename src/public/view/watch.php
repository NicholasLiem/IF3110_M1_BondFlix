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
        <div class="wrapper" id="wrapper">
            <div class="stream-container" id="stream-container">
                <div class="video-wrapper">
                    <video controls autoplay id="video-element" muted="muted">
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
        <div class="more-recommendation">
            <h2>Movies</h2>
            <div class="recommendations-content" id="search-result-container">
            </div>
        </div>
        <div class="pagination">
            <button id="prevPageButton">◄</button>
            <button id="currentPageButton">1</button>
            <button id="nextPageButton">►</button>
        </div>
    </div>
    <script src="/public/js/watch.js"></script>
</body>