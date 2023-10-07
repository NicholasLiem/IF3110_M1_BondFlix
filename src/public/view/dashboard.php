<?php

if (!isset($_SESSION['user_id'])) {
    header("Location: login");
    exit;
}

$userID = $_SESSION['user_id'];
$username = $_SESSION['username'];
$isAdmin = $_SESSION['is_admin'];

$pageTitle = 'User Dashboard';
include BASE_PATH . "/public/templates/header.php";
?>
<link rel="stylesheet" href="/public/css/dashboard.css">
<body>
    <?php include BASE_PATH . '/public/templates/navbar.php' ?>
    <div class="container">
        <div id="most-recommended-wrapper">
            <div id="most-recommended">
                <div class="description-card">
                    <h2>
                        Movie Title
                    </h2>
                    <p>
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sit impedit ea, totam saepe quibusdam
                        assumenda ducimus tempora aliquam! Nostrum animi quis cupiditate autem commodi placeat delectus
                        facilis eum saepe dolor.
                    </p>
                    <div id="btns-container">
                        <a id="play-btn-link">
                            <button id="play-btn">
                                <div class="btn-content">
                                    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"
                                         xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.348a1.125 1.125 0 010 1.971l-11.54 6.347a1.125 1.125 0 01-1.667-.985V5.653z"></path>
                                    </svg>
                                    <span>
                                        &nbsp;Play
                                    </span>
                                </div>
                            </button>
                        </a>
                        <button id="more-info-btn">
                            <div class="btn-content">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="info">
                                    <g data-name="Layer 2">
                                        <path d="M8 2a6 6 0 1 0 6 6 6 6 0 0 0-6-6Zm0 11a5 5 0 1 1 5-5 5 5 0 0 1-5 5Z"></path>
                                        <path d="M8 6.85a.5.5 0 0 0-.5.5v3.4a.5.5 0 0 0 1 0v-3.4a.5.5 0 0 0-.5-.5zM8 4.8a.53.53 0 0 0-.51.52v.08a.47.47 0 0 0 .51.47.52.52 0 0 0 .5-.5v-.12A.45.45 0 0 0 8 4.8z"></path>
                                    </g>
                                </svg>
                                <span>
                                        &nbsp;More info
                                    </span>
                            </div>
                        </button>
                    </div>
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
    <script src="/public/js/dashboard.js"></script>
</body>
