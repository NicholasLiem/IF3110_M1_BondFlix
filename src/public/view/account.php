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
    <!-- TODO: tolong diextract navbarnya jadi template -->
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
            <div id="account-settings-content">
                <div>
                    <img src="/public/avatar.png" alt="profile-picture" id="profile-picture">
                    <button id="edit-profile-pic-button">
                        <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"></path>
                        </svg>
                    </button>
                </div>
                <div>
                    <ul>
                        <li>
                            <label for="first-name">First Name</label>
                            <input type="text" id="first-name" name="first-name" class="text-input" placeholder="Current First Name">
                        </li>
                        <li>
                            <label for="last-name">Last Name</label>
                            <input type="text" id="last-name" name="last-name" class="text-input" placeholder="Current Last Name">
                        </li>
                        <li>
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" class="text-input" placeholder="Change password">
                        </li>
                    </ul>
                </div>
            </div>
            <div id="account-settings-buttons">
                <button id="save-button">SAVE</button>
                <button id="cancel-button">CANCEL</button>
            </div>
        </div>
    </main>
</body>
