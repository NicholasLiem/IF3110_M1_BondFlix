<?php

if (!isset($_SESSION['user_id'])) {
    header("Location: login");
    exit;
}

$userID = $_SESSION['user_id'];
$username = $_SESSION['username'];
$isAdmin = $_SESSION['is_admin'];

$pageTitle = 'User Account';
include BASE_PATH . "/public/templates/header.php";
?>

<link rel="stylesheet" href="/public/css/account.css">
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link
  href="https://fonts.googleapis.com/css2?family=Roboto&family=Roboto+Mono&display=swap"
  rel="stylesheet"
/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Roboto:wght@700&display=swap" rel="stylesheet">

<body>
    <!-- TODO: tolong diextract navbarnya jadi tamplate -->
    <nav class="navbar">
        <div>
            <a href="/"><img class="logo" src="/public/logo.png" alt="Bondflix logo"></a>
            <div id="menu-left">
                <a href="">My List</a>
                <a href="">Movies</a>
                <a href="">TV Shows</a>
            </div>
        </div>
        <div id="menu-right">
            <input type="text" class="search-bar" placeholder="Search a movie">
            <button class="account-button">
                <img src="/public/avatar.png" alt="profile picture">
            </button>
            <div class="account-menu">
                <ul>
                    <li>
                        <a href="/account">Account</a>
                    </li>
                    <li>
                        <a href="" onclick="logout()">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main>
        <div id="account-settings-container">
            <div><h1>Account Settings</h1></div>
            <div>
                <div><img src="/public/avatar.png" alt="profile-picture"></div>
                <div>
                    <ul>
                        <li>
                            <label for="first-name">First Name</label>
                            <input type="text" id="first-name" name="first-name">
                        </li>
                        <li>
                            <label for="last-name">Last Name</label>
                            <input type="text" id="last-name" name="last-name">
                        </li>
                        <li>
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password">
                        </li>
                    </ul>
                </div>
            </div>
            <div>
                <button>Save</button>
                <button>Cancel</button>
                </div>
        </div>
    </main>
</body>
